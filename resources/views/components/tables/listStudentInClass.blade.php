

<div class="container">
    <a href="{{ route("admin.import.downloadSampleForm", $name) }}" class="float-right mb-4"><button class="btn btn-primary mr-2"><i class="far fa-file-alt"></i></button></a>
</div>
<div class="container">
    <div class="row mb-3" >
            <div class="col">
                <label for="year">Phòng thi</label>
                <select v-model="room" name="room" id="room" class="form-control">
                    <option v-for="room in rooms" >@{{ room.room }}</option>
                </select>
            </div>

            <div class="col">
                <label for="examShift">Học kỳ</label>
                <select name="examShift" id="examShift" v-model="examShift" class="form-control">
                    <option value="1">1</option>
                    <option value="2">2</option>
                    <option value="3">3</option>
                    <option value="4">4</option>
                </select>
            </div>
            <div class="col"></div>
            <div class="col-6"></div>
        </div>
    <table class="table table-striped">
        <thead>
        <tr>
            <th scope="col">SBD</th>
            <th scope="col">Họ và tên</th>
            <th scope="col">Mã sinh viên</th>
            <!-- <th scope="col">Tác vụ</th> -->
        </tr>
        </thead>

        <tbody>
        <tr v-for="(row,index) in rows">
            <td>@{{index + 1}}</td>
            <td>@{{row.full_name}}</td>
            <td>@{{row.student_code}}</td>
            <!-- <td>
                <button @click="idDelete = row.id" data-toggle="modal" data-target="#deleteModal" class="btn btn-outline-danger"><i class="fas fa-trash-alt"></i></button>
                <button @click="getStudentAccount(row.id)" data-toggle="modal" data-target="#editModal" class="btn btn-outline-primary"><i class="fas fa-edit"></i></button>
            </td> -->
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
            rooms:[],
            room:null,
            examShift:null;
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
            getAllStudentByRoomAndExamShift(room, examShift) {
                axios.get('/admin/all/account')
                    .then((response) => {
                        this.rows = response.data;
                        console.log(this.rows);
                    })
                    .catch(function (error) {

                    });
            },
            
        created () {
            // this.getAllStudentByRoomAndExamShift();
        }
    })
</script>