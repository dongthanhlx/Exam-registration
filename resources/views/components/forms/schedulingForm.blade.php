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
            <select v-model="years.year" name="year" class="form-control mt-2">
                <option v-for="year in years" >@{{ year.year }}</option>
            </select>
        </div>
        <div class="form-group">
            <label for="exam">Kỳ thi</label>
            <select name="semester" id="semester" class="form-control mt-2">
                <option></option>
                <option value="1">Thi cuối kỳ 1</option>
                <option value="2">Thi cuối kỳ 2</option>
            </select>
        </div>

        <div class="form-group">
            <label for="subject">Môn thi</label>
            <select name="subject" id="subject" class="form-control mt-2">
            </select>
        </div>

        <div class="form-group">
            <label for="duration">Thời lượng</label>
            <select name="duration" id="duration" class="form-control mt-2">
                <option value="45">45 phút</option>
                <option value="90">90 phút</option>
                <option value="120">120 phút</option>
                <option value="180">180 phút</option>
            </select>
        </div>

        <div class="form-group">
            <label for="examshift">Ca thi</label>
            <select name="examshift" id="examshift" class="form-control mt-2">
                
            </select>
        </div>

        <div class="form-group" >
            <input id="datepicker" width="276" />
        </div>

        <div class="form-group">
            <label for="place">Địa điểm</label>
            <select name="place" id="place" class="form-control mt-2">
                
            </select>
        </div>

        <div class="form-group">
            <label for="room">Phòng thi</label>
            <select name="room" id="room" class="form-control mt-2">
                
            </select>
        </div>


        <button type="submit" class="btn btn-primary btn-outline-primary rounded">Create</button>
    </form>

</div>






<script>
    $('#datepicker').datepicker({
            uiLibrary: 'bootstrap4'
        });
</script>

<script>
    
    const App = new Vue({
        el: '#app',
        data: {
            selected:'',
            deletingSubjectId:'',
            editingSubject: {},
            years:[],
            subjects:[],
            rows:[
            ]
        },
        methods: {
            

            getSchoolYear(){
                axios.get('/admin/allYear')
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
            this.getSchoolYear();
        }
    })
</script>
