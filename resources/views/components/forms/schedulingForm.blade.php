
<div class="container form" style="width: 40%" xmlns:v-bind="http://symfony.com/schema/routing">

    <form method="POST">
        @csrf
        <div class="form-group">
            <label for="year">Năm học</label>

            <select v-model="year" name="year" class="form-control mt-2">
                <option v-for="year in years" >@{{ year.year }}</option>
            </select>
        </div>

        <div class="form-group">
            <label for="exam">Kỳ thi</label>

            <select v-model="semester" name="semester" id="semester" class="form-control mt-2">
                <option value="1">Thi cuối kỳ 1</option>
                <option value="2">Thi cuối kỳ 2</option>
            </select>
        </div>

        <div class="form-group">
            <label for="subject">Môn thi</label>
            <select v-model="subject" name="subject" id="subject" class="form-control mt-2">
                <option v-for="subject in subjects" v-bind:value="subject.id">@{{ subject.name }}</option>
            </select>
        </div>

        <div class="form-group">
            <label for="duration">Thời gian làm bài</label>
            <select v-model="duration" name="duration" id="duration" class="form-control mt-2">
                <option value="45">45 phút</option>
                <option value="60">60 phút</option>
                <option value="90">90 phút</option>
                <option value="120">120 phút</option>
            </select>
        </div>

        <div class="form-group" >
            <label for="date">Ngày thi</label>

            <input v-model="date" type="date" id="date" name="date" class="form-control mt-2">
        </div>

        <div class="form-group">
            <label for="examShift">Ca thi</label>

            <select v-model="examShift" name="examShift" id="examShift" class="form-control mt-2">
                <option value="1">ca 1</option>
                <option value="2">ca 2</option>
                <option value="3">ca 3</option>
                <option value="4">ca 4</option>
            </select>
        </div>

        <div class="form-group">
            <label for="remainRooms">Phòng thi</label>

            <multiselect
                id = "remainRooms"
                v-model="rooms"
                placeholder=""
                label="name" track-by="id"
                :options="remainRooms"
                :multiple="true"
                :taggable="true"
            ></multiselect>
        </div>

        <button type="button" class="btn btn-outline-primary" @click="post()">Tạo</button>
    </form>
</div>


<script src="https://cdn.jsdelivr.net/npm/vue/dist/vue.js"></script>
<script src="https://unpkg.com/vue-multiselect@2.1.0"></script>
<link rel="stylesheet" href="https://unpkg.com/vue-multiselect@2.1.0/dist/vue-multiselect.min.css">

<script>

    const App = new Vue({
        el: '#app',
        //mutiselect
        components: { Multiselect: window.VueMultiselect.default },
        data: {
            selected:'',
            deletingSubjectId:'',
            editingSubject: {},
            years:[],
            subjects:[],
            remainRooms: [],

            year: null,
            semester: null,
            subject: null,
            duration: null,
            date: null,
            examShift: null,
            rooms: [],
        },
        watch:{
            year: function(newval,oldval) {
                if (this.semester != null) {
                    this.getSubjectsByYearAndSemester(newval, this.semester);
                } else {
                    document.getElementById("semester").disabled = false;
                }
            },
            semester: function(newval,oldval) {
                this.getSubjectsByYearAndSemester(this.year,newval);
                if (this.subjects != null) {
                    document.getElementById('subject').disabled = false;
                }
            },
            subject: function(newval,oldval) {
                document.getElementById('duration').disabled = false;
            },
            duration: function(newval,oldval) {
                document.getElementById('date').disabled = false;
            },
            date: function(newval,oldval) {
                document.getElementById('examShift').disabled = false;
                if (this.examShift != null) {
                    this.getAllRemainingRoomInDateAndExamShift(newval, this.examShift);
                }
            },
            examShift: function(newval,oldval) {
                this.getAllRemainingRoomInDateAndExamShift(this.date, newval);
                if (this.remainRooms != null) {
                    document.getElementById('remainRooms').disabled = false;
                }
            }
        },
        methods: {
            resetInput() {
                document.getElementById("semester").disabled = true;
                document.getElementById("subject").disabled = true;
                document.getElementById("duration").disabled = true;
                document.getElementById("date").disabled = true;
                document.getElementById("examShift").disabled = true;
                document.getElementById("remainRooms").disabled = true;
            },
            resetWatch() {
                this.year = null;
                this.semester = null;
                this.subject = null;
                this.duration = null;
                this.date = null;
                this.examShift = null;
                this.rooms = [];
            },
            resetVariables() {
                this.years = [];
                this.subjects = [];
                this.remainRooms = [];
            },
            getAllYear(){
                axios.get('/admin/all/year')
                    .then((response) => {
                        this.years = response.data;
                    })
                    .catch(function (error) {
                        console.log(error);
                    });
            },
            getSubjectsByYearAndSemester(year,semester) {
                axios.get('/admin/all/subjectOfExam/' + year + "/" + semester )
                    .then((response) => {
                        this.subjects = response.data;
                    })
                    .catch(function (error) {
                        console.log(error);
                    });
            },
            getAllRemainingRoomInDateAndExamShift(date, examShift) {
                axios.get('/admin/all/remainingRoomInfoInDateAndExamShift/' + date + '/' + examShift)
                    .then(res => {
                        this.remainRooms = res.data;
                    })
                    .catch(res => {
                        console.log(res);
                    })
            },
            getAllIdOfRooms()
            {
                var result = [];

                for (var i=0; i<this.rooms.length; i++) {
                    result.push(this.rooms[i].id);
                }

                return result;
            },
            post() {
                console.log(this.rooms);
                axios.post('/admin/scheduling/', {
                    year: this.year,
                    semester: this.semester,
                    subject: this.subject,
                    duration: this.duration,
                    date: this.date,
                    examShift: this.examShift,
                    room: this.getAllIdOfRooms()
                })
                    .then(res => {
                        this.resetInput();
                        this.resetWatch();
                        this.resetVariables();
                        this.getAllYear();
                    })
                    .catch(res => {
                        console.log(res);
                    })
            }
        },
        created () {
            this.resetInput();
            this.resetWatch();
            this.resetVariables();
            this.getAllYear();
        }
    })
</script>