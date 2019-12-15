<div class="container">
    <table class="table table-striped">
        <thead>
        <tr>
            <th scope="col">#</th>
            <th scope="col">Họ và tên</th>
            <th scope="col">Email</th>
            <th scope="col">Tác vụ</th>
        </tr>
        </thead>

        <tbody>
        <tr v-for="(row,index) in rows">
            <td>@{{index + 1}}</td>
            <td>@{{row.full_name}}</td>
            <td>@{{row.email}}</td>
            <td>
                <button @click="idDelete = row.id" data-toggle="modal" data-target="#deleteModal" class="btn btn-outline-danger">Delete</button>
                <button @click="getStudentAccount(row.id)" data-toggle="modal" data-target="#editModal" class="btn btn-outline-primary">Edit</button>
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
                <button type="button" class="btn btn-primary" @click="deleteStudentAccount(idDelete)">Xoá</button>
            </div>
        </div>
    </div>
</div>


<script>
    const App = new Vue({
        el: '#app',
        data: {
            idDelete:'',
            editingStudentAccount: {},
            rows:[
            ]
        },
        methods: {
            getAllStudentAccounts() {
                axios.get('/admin/all/account')
                    .then((response) => {
                        this.rows = response.data;
                        console.log(this.rows);
                    })
                    .catch(function (error) {

                    });
            },
            deleteStudentAccount(studentAccountId) {
                this.$refs.delete.click();
                axios.delete('/admin/account/' +studentAccountId).then(res =>{
                    this.getAllStudentAccounts();
                }).catch(err =>{
                    console.log(err);
                });
            },
            getStudentAccount(studentAccountId) {
                axios.get('/admin/account/' + studentAccountId).then(res => {
                    this.editingStudentAccount = res.data;

                })
            },
            editStudentAccount(studentAccountId) {
                axios.put('/admin/account/' + studentAccountId, this.editingStudentAccount).then(res => {
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