<script src="https://printjs-4de6.kxcdn.com/print.min.js"></script>
<div class="container" xmlns:v-bind="http://www.w3.org/1999/xhtml">
    <div class="row mb-3" >
        <div class="col">
            <label for="subject">Môn thi</label>
            <select v-model="subjectID" name="subject" id="subject" class="form-control">
                <option v-for="subject in subjects" v-bind:value="subject.subject_code">@{{ subject.name }}</option>
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
                <option v-for="room in rooms" v-bind:value="room">@{{ room.name }}</option>
            </select>
        </div>
        <div class="col-6"></div>
    </div>
<form id="print">
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
</form>
    

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
            subjectID: '',
            exam: {},
            examID:null,
            subjects: [],
            subject:null,
            id:null,
            rooms:[],
            room:null,
            examShift:null,
            rows:[]
        },
        watch:{
            examShift: function(newval,oldval) {
                if(this.subjectID !== null){
                    this.getAllRoomBySubjectCodeAndExamShift(this.subjectID,newval,this.exam.id);
                }else{
                    console.log(newval)
                }
            },
            room: function(newval,oldval) {
                this.getAllStudentByScheduling(newval);
            }
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
            getAllRoomBySubjectCodeAndExamShift(subjectCode, examShift, examID) {
                axios.get('/admin/all/roomBySubjectCodeAndExamShift/' + subjectCode + '/' + examShift + '/' + examID)
                    .then(res => {
                        this.rooms = res.data;
                    })
                    .catch(res => {
                        console.log(res);
                    })
            },

            getAllStudentByScheduling(room) {
                axios.get('/admin/all/studentBySchedulingID/' + room.exams_subjects_rooms_id + '/' + room.id)
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