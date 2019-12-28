<div class="container">
    <a href="{{ route("admin.import.downloadSampleForm", $name) }}" class="float-right mb-4 mr-2" ><button class="btn btn-primary"><i class="far fa-file-alt"></i></button></a>
</div>
<div class="mr-5 ml-5">
    <table class="table table-striped">
        <thead>
        <tr>
            <th scope="col">#</th>
            <th scope="col">Tên môn học</th>
            <th scope="col">Mã môn học</th>
            <th scope="col">Lớp học phần</th>
            <th scope="col">Giảng viên</th>
            <th scope="col">Số lượng sinh viên tối đa</th>
            <th scope="col">Tác vụ</th>
        </tr>
        </thead>

        <tbody>
        <tr v-for="(row, index) in rows">
            <td>@{{ index+1 }}</td>
            <td>@{{ row.name }}</td>
            <td>@{{row.subject_code}}</td>
            <td>@{{row.serial}}</td>
            <td>@{{row.teacher}}</td>
            <td>@{{row.maximum_number_of_student}}</td>
            <td>
                <button @click="idDelete = row.id" data-toggle="modal" data-target="#deleteModal" class="btn btn-outline-danger"><i class="fas fa-trash-alt"></i></button>
                <button @click="getSubject(row.id)" data-toggle="modal" data-target="#editModal" class="btn btn-outline-secondary"><i class="far fa-edit"></i></button>
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
                        <input type="text" id="name" name="name" class="form-control mt-2" v-model="editingSubjectClass.name" >
                    </div>

                    <div class="form-group">
                        <label for="subject_code">Mã môn học</label>
                        <input type="text" id="subject_code" name="subject_code" class="form-control mt-2" v-model="editingSubjectClass.subject_code" >
                    </div>

                    <div class="form-group">
                        <label for="number_of_credits">Số tín chỉ</label>
                        <input type="number" id="number_of_credits" name="number_of_credits" class="form-control mt-2" v-model="editingSubjectClass.number_of_credits" >
                    </div>
                </div>

                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" ref="close" data-dismiss="modal">Huỷ</button>
                    <button type="button" class="btn btn-primary" @click="editSubjectClass(editingSubjectClass.id)">Sửa</button>
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
                    <button type="button" class="btn btn-primary" @click="deleteSubject(idDelete)">Xoá</button>
                </div>
            </div>
        </div>
    </div>
</div>

<script>
const App = new Vue({
    el: '#app',
    data: {
        idDelete: '',
        editingSubjectClass: {},
        rows:[]
    },
    methods: {
        getExamActive(){
            axios.get('/admin/examActive')
                .then(res => {
                    let exam = res.data;
                    if (exam != null) {
                        this.getAllByYearAndSemester(exam.year, exam.semester);
                    }
                })
                .catch(function (error) {
                    console.log(error);
                });
        },
        getAllByYearAndSemester(year, semester) {
            console.log(year,semester);
            axios.get('/admin/all/subjectClassOfExam/' + year + "/" + semester).then(res => {
                this.rows = res.data;
            }).catch(err => {
                console.log(err);
            })
        },
        deleteSubjectClass(id) {
            this.$refs.delete.click();
            axios.delete('/admin/SubjectClass/' +id).then(res =>{

            }).catch(err =>{
                console.log(err);
            });
        },
        getSubjectClass(id) {
            axios.get('/admin/SubjectClass/' + id).then(res => {
                this.editingSubjectClass = res.data;
            })
        },
        editSubjectClass(id) {
            axios.put('/admin/SubjectClass/' + id, this.editingSubject).then(res => {
                this.$refs.close.click();
            })
        }
    },
    created () {
        this.getExamActive();
    }
})
</script>