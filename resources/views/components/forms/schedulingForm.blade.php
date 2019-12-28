
<div class="container form" style="width: 40%" xmlns:v-bind="http://symfony.com/schema/routing">

    <form method="POST">
        @csrf
        <p v-if="errors.length">
                            <b>Lỗi:</b>
                            <ul>
                            <li v-for="error in errors" class="text-danger">@{{ error }}</li>
                            </ul>
                        </p>

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

        <button style="width:100px" type="button" class="btn btn-outline-primary float-right" @click="post()">Tạo</button>
    </form>
</div>


<script src="https://cdn.jsdelivr.net/npm/vue/dist/vue.js"></script>
<link rel="stylesheet" href="https://unpkg.com/vue-multiselect@2.1.0/dist/vue-multiselect.min.css">
<script src="https://unpkg.com/vue-multiselect@2.1.0"></script>

<script>

    const App = new Vue({
        el: '#app',
        //mutiselect
        components: { Multiselect: window.VueMultiselect.default },
        data: {
            errors:[],
            selected:'',
            deletingSubjectId:'',
            editingSubject: {},
            subjects:[],
            remainRooms: [],

            subject: null,
            duration: null,
            date: null,
            examShift: null,
            rooms: [],
        },
        watch:{
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
            getExamActive() {
                axios.get('/admin/examActive')
                    .then(res => {
                        let exam = res.data;
                        if (exam != null) {
                            this.getSubjectsByYearAndSemester(exam.year, exam.semester);
                        }
                    })
                    .catch(res => {
                        console.log(res);
                    })
            },
            checkSubject(subject){
                if (!subject) {
                    this.errors.push('Không được để trống môn thi.');
                    return false;
                }
                return true;
            },
            checkDuration(duration){
                if (!duration) {
                    this.errors.push('Không được để trống thời gian làm bài.');
                    return false;
                }
                return true;
            },
            checkDate(date){
                if (!date) {
                    this.errors.push('Không được để trống ngày thi.');
                    return false;
                }
                return true;
            },
            checkExamShift(examshift){
                if (!examshift) {
                    this.errors.push('Không được để trống ca thi.');
                    return false;
                }
                return true;
            },
            checkRooms(room){
                if (!room) {
                    this.errors.push('Không được để trống phòng thi.');
                    return false;
                }
                return true;
            },
            resetInput() {
                document.getElementById("duration").disabled = true;
                document.getElementById("date").disabled = true;
                document.getElementById("examShift").disabled = true;
                document.getElementById("remainRooms").disabled = true;
            },
            resetWatch() {
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
                this.errors = [];
                console.log(this.rooms);
                if(!this.checkSchoolYear(this.year) | !this.checkSemester(this.semester) | !this.checkSubject(this.subject) | !this.checkDuration(this.duration) | !this.checkDate(this.date) | !this.checkExamShift(this.examShift) | !this.checkRooms(this.rooms[0])){
                    console.log("fail");
                }else{
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
            }
        },
        created () {
            this.resetInput();
            this.resetWatch();
            this.resetVariables();
            this.getExamActive();
        }
    })
</script>