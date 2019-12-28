<div class="container">
    <a href="{{ route("admin.import.downloadSampleForm", $name) }}" class="float-right mb-4 mr-2" ><button class="btn btn-primary"><i class="far fa-file-alt"></i></button></a>
</div>
<div class="container-fluid pt-5" >
    <table class="table table-striped large-table">
        <thead>
            <tr>
                <th scope="col">#</th>
                <th scope="col">Họ và tên đệm</th>
                <th scope="col">Tên</th>
                <th scope="col">Ngày sinh</th>
                <th scope="col">Giới tính</th>
                <th scope="col">Mã sinh viên</th>
                <th scope="col">Lớp</th>
                <th scope="col">Tác vụ</th>
            </tr>
        </thead>

        <tbody>
        <tr v-for="(row,index) in rows">
            <td>@{{index + 1}}</td>
            <td>@{{row.first_name}}</td>
            <td>@{{row.last_name}}</td>
            <td>@{{row.birthday}}</td>
            <td>@{{row.gender}}</td>
            <td>@{{row.student_code}}</td>
            <td>@{{row.class}}</td>
            <td>
                <button @click="idDelete = row.id" data-toggle="modal" data-target="#deleteModal" class="btn btn-outline-danger"><i class="fas fa-trash-alt"></i></button>
                <button @click="getStudentAccount(row.id)" data-toggle="modal" data-target="#editModal" class="btn btn-outline-primary"><i class="far fa-edit"></i></button>
            </td>
        </tr>
        </tbody>
    </table>

</div>
<!-- Modal -->
<div class="modal fade" id="editModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLabel">Chỉnh sửa</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>

            <div class="modal-body">
                <p v-if="errors.length">
                            <b>Lỗi:</b>
                            <ul>
                            <li v-for="error in errors" class="text-danger">@{{ error }}</li>
                            </ul>
                        </p>
                <div class="form-group">
                    <label for="firstName">Họ và tên đệm</label>
                    <input type="text" id="firstName" name="first_name" class="form-control mt-2" v-model="editingStudentInfo.first_name" disabled>
                </div>

                <div class="form-group">
                    <label for="name">Tên</label>
                    <input type="text" id="name" name="last_name" class="form-control mt-2" v-model="editingStudentInfo.last_name" disabled>
                </div>

                <div class="form-group">
                    <label for="birthday">Ngày sinh</label>
                    <input type="date" id="birthday" name="birthday" class="form-control mt-2" v-model="editingStudentInfo.birthday" >
                </div>

                <div class="form-group">    
                    <label for="gender">Giới tính</label>
                    <select name="gender" id="gender" class="form-control mt-2" v-model="editingStudentInfo.gender">
                        <option value="nam">nam</option>
                        <option value="nữ">nữ</option>
                    </select>
                </div>

                <div class="form-group">
                    <label for="studentCode">Mã sinh viên</label>
                    <input type="text" id="studentCode" name="studentCode" class="form-control mt-2" v-model="editingStudentInfo.student_code" >
                </div>

                <div class="form-group">
                    <label for="class">Lớp</label>
                    <input type="text" id="class" name="class" class="form-control mt-2" v-model="editingStudentInfo.class" >
                </div>
            </div>

            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" ref="close" data-dismiss="modal">Huỷ</button>
                <button type="submit" class="btn btn-primary" @click="editStudentAccount(editingStudentInfo.id)">Sửa</button>
            </div>
        </div>
    </div>
</div>

<div class="modal fade" id="deleteModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLabel">Xoá</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>

            <div class="modal-body">
                Bạn có chắc chắn muốn xoá ?
            </div>

            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" ref="delete" data-dismiss="modal">Huỷ</button>
                <button type="button" class="btn btn-primary" @click="deleteStudentInfo(idDelete)">Xoá</button>
            </div>
        </div>
    </div>
</div>


<script>
    const App = new Vue({
        el: '#app',
        data: {
            errors:[],
            gender: '',
            idDelete:'',
            editingStudentInfo: {},
            rows:[]
        },
        methods: {    
            checkDate(date){
                if (!date) {
                    this.errors.push('Không được để trống ngày sinh.');
                    return false;
                }
                return true;
            },        
            checkStudentCode(studentCode){
                if (!studentCode) {
                    this.errors.push('Không được để trống mã sinh viên.');
                    return false;
                }

                if (!this.validNumber(studentCode)) {
                    this.errors.push('Định dạng mã sinh viên không chính xác.');
                    return false;
                }
                return true;
            },
            checkClass(className){
                if (!className) {
                    this.errors.push('Không được để trống tên lớp.');
                    return false;
                }
                return true;
            },
            validNumber: function (number) {
                var fnNameRegex = /^[0-9]+$/;
                return fnNameRegex.test(number);
                },
            getAllStudentInfo() {
                axios.get('/admin/all/student')
                    .then((response) => {
                        this.rows = response.data;
                        console.log(this.rows);
                    })
                    .catch(function (error) {

                    });
            },
            deleteStudentInfo(studentInfoId) {
                this.$refs.delete.click();
                axios.delete('/admin/student/' +studentInfoId).then(res =>{

                    this.getAllStudentInfo();
                }).catch(err =>{
                    console.log(err);
                });
            },
            getStudentAccount(studentInfoId) {
                axios.get('/admin/student/' + studentInfoId).then(res => {
                    this.editingStudentInfo = res.data;

                })
            },
            editStudentAccount(studentInfoId) {
                this.errors = [];
                let date =  this.editingStudentInfo.birthday;
                let studentCode = this.editingStudentInfo.student_code;
                let className = this.editingStudentInfo.class;
                if(!this.checkDate(date) | !this.checkStudentCode(studentCode) | !this.checkClass(className)){
                    console.log("fail");
            

                }else{
                    axios.put('/admin/student/' + studentInfoId, this.editingStudentInfo).then(res => {
                        this.$refs.close.click();
                        this.getAllStudentInfo();
                    })
                }
            }
        },
        created () {
            this.getAllStudentInfo();
        } 
    })
</script> 