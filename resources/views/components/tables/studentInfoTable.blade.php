<table class="table table-hover">
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
            <button @click="deletingStudentAccountId = row.id" data-toggle="modal" data-target="#deleteModal">Delete</button>
            <button @click="getStudentAccount(row.id)" data-toggle="modal" data-target="#editModal">Edit</button>
        </td>
    </tr>
    </tbody>
</table>

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
                <div class="form-group">
                    <label for="firstName">Họ và tên đệm</label>
                    <input type="text" id="firstName" name="first_name" class="form-control mt-2" v-model="editingStudentAccount.first_name" >
                </div>

                <div class="form-group">
                    <label for="name">Tên</label>
                    <input type="text" id="name" name="last_name" class="form-control mt-2" v-model="editingStudentAccount.last_name" >
                </div>

                <div class="form-group">
                    <label for="email">Email</label>
                    <input type="text" id="email" name="email" class="form-control mt-2" v-model="editingStudentAccount.email" >
                </div>

            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" ref="close" data-dismiss="modal">Huỷ</button>
                <button type="button" class="btn btn-primary" @click="editStudentAccount(editingStudentAccount.id)">Sửa</button>
            </div>
        </div>
    </div>
</div>

<div class="modal fade" id="deleteModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLabel">Modal title</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                Bạn có chắc chắn muốn xoá ?
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" ref="delete" data-dismiss="modal">Huỷ</button>
                <button type="button" class="btn btn-primary" @click="deleteStudentAccount(deletingStudentAccountId)">Xoá</button>
            </div>
        </div>
    </div>
</div>




<script>

    const App = new Vue({
        el: '#app',
        data: {
            deletingStudentAccountId:'',
            editingStudentAccount: {},
            rows:[
            ]
        },
        methods: {
            getAllStudentAccounts() {
                axios.get('/admin/allStudent')
                    .then((response) => {
                        this.rows = response.data;
                        console.log(this.rows);
                    })
                    .catch(function (error) {

                    });
            },
            deleteStudentAccount(studentAccountId) {
                this.$refs.delete.click();
                axios.delete('/admin/student/' +studentAccountId).then(res =>{

                    this.getAllStudentAccounts();
                }).catch(err =>{
                    console.log(err);
                });
            },
            getStudentAccount(studentAccountId) {
                axios.get('/admin/student/' + studentAccountId).then(res => {
                    this.editingStudentAccount = res.data;

                })
            },
            editStudentAccount(studentAccountId) {
                axios.put('/admin/student/' + studentAccountId, this.editingStudentAccount).then(res => {
                    this.$refs.close.click();
                    this.getAllStudentAccounts();
                })
            }
        },
        created () {
            this.getAllStudentAccounts();
        }
    })
</script>