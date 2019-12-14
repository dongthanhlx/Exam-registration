<table class="table table-hover">
    <thead>
    <tr>
    <th scope="col">#</th>
        <th scope="col">Mã môn học</th>
        <th scope="col">Lớp học phần</th>
        <th scope="col">Giảng viên</th>
        <th scope="col">Số lượng sinh viên</th>
        <th scope="col">Tác vụ</th>
    </tr>
    </thead>
    <tbody>
    <tr v-for="(row, index) in rows">
        <td>@{{ index+1 }}</td>
        <td>@{{row.subject_code}}</td>
        <td>@{{row.serial}}</td>
        <td>@{{row.teacher}}</td>
        <td>@{{row.maximum_number_of_student}}</td>
        <td>
            <button @click="deletingSubjectId = row.id" data-toggle="modal" data-target="#deleteModal">Delete</button>
            <button @click="getSubject(row.id)" data-toggle="modal" data-target="#editModal">Edit</button>
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
                    <label for="name">Tên môn học</label>
                    <input type="text" id="name" name="name" class="form-control mt-2" v-model="editingSubject.name" >
                </div>

                <div class="form-group">
                    <label for="subject_code">Mã môn học</label>
                    <input type="text" id="subject_code" name="subject_code" class="form-control mt-2" v-model="editingSubject.subject_code" >
                </div>

                <div class="form-group">
                    <label for="number_of_credits">Số tín chỉ</label>
                    <input type="number" id="number_of_credits" name="number_of_credits" class="form-control mt-2" v-model="editingSubject.number_of_credits" >
                </div>

            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" ref="close" data-dismiss="modal">Huỷ</button>
                <button type="button" class="btn btn-primary" @click="editSubject(editingSubject.id)">Sửa</button>
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
                <button type="button" class="btn btn-primary" @click="deleteSubject(deletingSubjectId)">Xoá</button>
            </div>
        </div>
    </div>
</div>




<script>

    const App = new Vue({
        el: '#app',
        data: {
            deletingSubjectId:'',
            editingSubject: {},
            rows:[
            ]
        },
        methods: {
            getAllSubjects() {
                axios.get('/admin/allSubject')
                    .then((response) => {
                        this.rows = response.data;
                    })
                    .catch(function (error) {

                    });
            },
            deleteSubject(subjectId) {
                this.$refs.delete.click();
                axios.delete('/admin/subject/' +subjectId).then(res =>{

                    this.getAllSubjects();
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
                    this.getAllSubjects();
                })
            }
        },
        created () {
            this.getAllSubjects();
        }
    })
</script>