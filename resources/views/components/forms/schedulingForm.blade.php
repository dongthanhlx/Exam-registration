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
                <option></option>
                <option value="1">Thi cuối kỳ 1</option>
                <option value="2">Thi cuối kỳ 2</option>
            </select>
        </div>

        <div class="form-group">
            <label for="subject">Môn thi</label>
            <select v-model="subject" name="subject" id="subject" class="form-control mt-2">
                    <option v-for="subject in subjects" >@{{ subject.subject }}</option>
            </select>
        </div>

        <div class="form-group">
            <label for="duration">Thời lượng</label>
            <select v-model="duration" name="duration" id="duration" class="form-control mt-2">
                <option value="45">45 phút</option>
                <option value="90">90 phút</option>
                <option value="120">120 phút</option>
                <option value="180">180 phút</option>
            </select>
        </div>

        <div class="form-group" >
            <label for="date">Ngày thi</label>
            <input v-model="date" type="date" id="date" name="date" class="form-control mt-2">
        </div>

        <div class="form-group">
            <label for="examshift">Ca thi</label>
            <select v-model="examshift" name="examshift" id="examshift" class="form-control mt-2">
                <option v-for="examshift in examshifts" >@{{ examshift.examshift }}</option>
            </select>
        </div>


        <div class="form-group">
            <label for="place">Địa điểm</label>
            <select v-model="place" name="place" id="place" class="form-control mt-2">
                
            </select>
        </div>

        <div class="form-group">
            <label for="room">Phòng thi</label>
            <select v-model="room" name="room" id="room" class="form-control mt-2">
                
            </select>
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
            examshift:null,
            place:null,
            room:null

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
            },
            subject: function(newval,oldval){
                
            },
            duration: function(newval,oldval){
                
            },
            date: function(newval,oldval){
                
            },
            examshift: function(newval,oldval){
                
            },
            place: function(newval,oldval){
                
            },
            

        },
        methods: {
            init(){
                document.getElementById("semester").disabled = true;
                document.getElementById("subject").disabled = true;
                document.getElementById("duration").disabled = true;
                document.getElementById("date").disabled = true;
                document.getElementById("examshift").disabled = true;
                document.getElementById("place").disabled = true;
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
                axios.get('/admin/all/allSubjectByExam/' + year + "/" + semester )
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
        },
        created () {
            // this.getSubjectsByYearAndSemester();
            this.init();
            this.getSchoolYear();
        }
    })
</script>
