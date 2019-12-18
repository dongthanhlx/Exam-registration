<div class="container form">
    @if ($errors->any())
        <div class="alert alert-danger">
            <ul>
                @foreach ($errors->all() as $error)
                    <li>{{ $error }}</li>
                @endforeach
            </ul>
        </div>
    @elseif(session()->has('message'))
        <div class="alert alert-success">
            {{ session()->get('message') }}
        </div>
    @endif

    <form class="" action="" method="POST">
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
                <option v-for="subject in subjects" >@{{ subject.name }}</option>
            </select>
        </div>

        <div class="form-group">
            <label for="duration">Thời lượng</label>
            <select v-model="duration" name="duration" id="duration" class="form-control mt-2">
                <option value="45">45 phút</option>
                <option value="90">90 phút</option>
                <option value="120">120 phút</option>
            </select>
        </div>

        <div class="form-group" >
            <label for="date">Ngày thi</label>
            <input v-model="date" type="date" id="date" name="date" class="form-control mt-2">
        </div>
{{--

        <div class="form-group">
            <label for="examshift">Ca thi</label>
            <select v-model="examshift" name="examshift" id="examShift" class="form-control mt-2">
                <option v-for="examshift in examshifts" >@{{ examshift.examshift }}</option>
            </select>
        </div>
--}}
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
            <label for="room">Phòng thi</label>
            <div v-model="room" id="room">
                <input type="checkbox" name="101 G2">
                <input type="checkbox" name="102 G2">
                <input type="checkbox" name="103 G2">
            </div>
        </div>

        <button type="submit" class="btn btn-primary">Create</button>
    </form>

</div>



<script>
    
    const App = new Vue({
        el: '#app',
        data: {
            selected:'',
            deletingSubjectId:'',
            editingSubject: {},
            years:[],
            subjects:[],
            examshifts:[],
            places:[],
            rooms:[],
            rows:[],
            year:null,
            semester:null,
            subject:null,
            duration:null,
            date:null,
            examShift:null,
            room:null,
            allRemainingInfoInDate: [],
            dataFake: {
                'year': '2015-2016',
                'semester': '1',
                'subject': 'toán',
                'duration': '20',
                'date': '10-10-2010',
                'examShift': '1',
                'rooms': {
                    '1': '101 G2',
                    '2': '102 G2',
                    '3': '103 G2'
                }
            }
        },
        watch:{
            year: function(newval,oldval) {
                if(this.semester !== null){
                    this.getSubjectsByYearAndSemester(newval, this.semester);
                }else{
                    document.getElementById("semester").disabled = false;
                    console.log(newval)
                }
            },
            semester: function(newval,oldval) {
                this.getSubjectsByYearAndSemester(this.year,newval);
                document.getElementById('subject').disabled = false;
            },
            subject: function(newval,oldval){
                document.getElementById('duration').disabled = false;
            },
            duration: function(newval,oldval){
                document.getElementById('date').disabled = false;
            },
            date: function(newval,oldval){
                document.getElementById('examShift').disabled = false;

            },
            examshift: function(newval,oldval){
                document.getElementById('room').disabled = false;
            },
            room: function(newval,oldval){
                
            },

        },
        methods: {
            init(){
                document.getElementById("semester").disabled = true;
                document.getElementById("subject").disabled = true;
                document.getElementById("duration").disabled = true;
                document.getElementById("date").disabled = true;
                document.getElementById("examShift").disabled = true;
                document.getElementById("room").disabled = true;
            },
            getSchoolYear(){
                axios.get('/admin/all/year')
                    .then((response) => {
                        this.years = response.data;
                        console.log(this.years);
                    })
                    .catch(function (error) {

                    });
            },

            getSubjectsByYearAndSemester(year,semester) {
                console.log(year, semester);
                axios.get('/admin/all/subjectOfExam/' + year + "/" + semester )
                    .then((response) => {
                        this.subjects = response.data;
                    })
                    .catch(function (error) {

                    });
            },
            getSubject(subjectId) {
                axios.get('/admin/subject/' + subjectId).then(res => {
                    this.editingSubject = res.data;

                })
            },
            getAllRemainingInfoSchedulingInDate(date) {
                axios.get('admin/scheduling/' + date)
                    .then(res => {
                        this.allRemainingInfoInDate = res.data;
                    })
            },
            postFake() {

            }
        },
        created () {
            // this.getSubjectsByYearAndSemester();
            this.init();
            this.getSchoolYear();
        }
    })
</script>
