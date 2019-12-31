<div class="container">
    <div class="row mb-3" >
        <div class="col">
            <label for="subject">Môn thi</label>
            <select v-model="subject" name="subject" id="subject" class="form-control">
                <option v-for="subject in subjects" >@{{ subject.name }}</option>
            </select>
        </div>

        <div class="col">
            <label for="examShift">Ca thi</label>
            <select name="examShift" id="examShift" v-model="examShift" class="form-control">
                <option value="1">1</option>
                <option value="2">2</option>
                <option value="3">3</option>
                <option value="4">4</option>
            </select>
        </div>

        <div class="col">
            <label for="room">Phòng thi</label>
            <select v-model="room" name="room" id="room" class="form-control">
                <option v-for="room in rooms" >@{{ room.name }}</option>
            </select>
        </div>
        <div class="col-6"></div>
    </div>

    <table class="table table-striped">
        <thead>
        <tr>
            <th scope="col">SBD</th>
            <th scope="col">Họ và tên</th>
            <th scope="col">Mã sinh viên</th>
        </tr>
        </thead>

        <tbody>
        <tr v-for="(row,index) in rows">
            <td>@{{index + 1}}</td>
            <td>@{{row.full_name}}</td>
            <td>@{{row.student_code}}</td>
        </tr>
        </tbody>
    </table>

</div>

<div class="container pt-4">
    <button class=" btn btn-primary float-right" type="button" onclick="printJS('print', 'html')">
        Print/Download
    </button>
</div>

<script>
    const App = new Vue({
        el: '#app',
        data: {
            exam: {},
            subjects: [],
            rooms:[],
            room:null,
            examShift:null,
            rows:[]
        },
        watch:{
            room: function(newval,oldval) {
                if(this.examShift !== null){
                    this.getAllStudentByRoomAndExamShift(newval, this.examShift);
                }else{
                    console.log(newval)
                }
            },
            examShift: function(newval,oldval) {
                if(this.room !== null){
                    this.getAllStudentByRoomAndExamShift(this.room,newval);
                }else{
                    console.log(newval)
                }
            },
        },
        methods: {
            getExamActive() {
                axios.get('/admin/examActive')
                    .then(res => {
                        this.exam = res.data;
                    })
                    .catch(res => {
                        console.log(res);
                    })
            },
            getAllSubject() {
                axios.get('/admin/all/subject')
                    .then (res => {
                        this.subjects = res.data;
                    })
                    .catch(res => {
                        console.log(res);
                    })
            },
            getAllRoomBySubjectIDAndExamShift(subjectID, examShift, examID) {
                axios.get('/admin/all/roomBySubjectCodeAndExamShift/' + subjectID + '/' + examShift + '/' + examID)
                    .then(res => {
                        this.rooms = res.data;
                    })
                    .catch(res => {
                        console.log(res);
                    })
            },
            getAllStudentBySchedulingID(id) {
                axios.get('/admin/all/studentBySchedulingID/' + id)
                    .then((response) => {
                        this.rows = response.data;
                        console.log(this.rows);
                    })
                    .catch(function (error) {

                    });
            }
        },
        created () {
            this.getExamActive();
            this.getAllSubject();
        }
    });
</script>