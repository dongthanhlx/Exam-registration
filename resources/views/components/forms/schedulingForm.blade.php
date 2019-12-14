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
            <label for="school_year">Năm học</label>
            <select name="school_year" id="school_year" class="form-control mt-2">
                <option value="2013-2014">2013-2014</option>
                <option value="2014-2015">2014-2015</option>
                <option value="2015-2016">2015-2016</option>
                <option value="2016-2017">2016-2017</option>
                <option value="2017-2018">2017-2018</option>
                <option value="2018-2019">2018-2019</option>
                <option value="2019-2020">2019-2020</option>
                <option value="2020-2021">2020-2021</option>
                <option value="2021-2022">2021-2022</option>
            </select>
        </div>
        <div class="form-group">
            <label for="exam">Kỳ thi</label>
            <select name="semester" id="semester" class="form-control mt-2">
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
            <input name="subject" id="subject" class="form-control mt-2">
        </div>

        <div class="form-group">
            <label for="examshift">Ca thi</label>
            <select name="examshift" id="examshift" class="form-control mt-2">
                <option value="1" disabled>1</option>
                <option value="2">2</option>
                <option value="3">3</option>
                <option value="4">4</option>
            </select>
        </div>

        <div class="form-group">
            <label for="place">Địa điểm</label>
            <select name="place" id="place" class="form-control mt-2">
                <option value="E3">E3</option>
                <option value="G2">G2</option>
                <option value="G3">G3</option>
            </select>
        </div>

        <div class="form-group">
            <label for="room">Phòng thi</label>
            <select name="room" id="room" class="form-control mt-2">
                <option value="1">1</option>
                <option value="2">2</option>
            </select>
        </div>


        <button type="submit" class="btn btn-primary btn-outline-primary rounded">Create</button>
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
                        this.rows = response.data;
                    })
                    .catch(function (error) {

                    });
            },
            deleteSubject(subjectId) {
                this.$refs.delete.click();
                axios.delete('/admin/subject/' +subjectId).then(res =>{

                    this.getSubjectsByYearAndSemester();
                }).catch(err =>{
                    console.log(err);
                });
            },
            getSubject(subjectId) {
                axios.get('/admin/subject/' + subjectId).then(res => {
                    this.editingSubject = res.data;

                })
            },
            editSubject(subjectId) {
                axios.put('/admin/subject/' + subjectId, this.editingSubject).then(res => {
                    this.$refs.close.click();
                    this.getSubjectsByYearAndSemester();
                })
            }
        },
        created () {
            // this.getSubjectsByYearAndSemester();
            this.getSchoolYear();
        }
    })
</script>
