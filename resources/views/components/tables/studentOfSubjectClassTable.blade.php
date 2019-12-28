<div class="container">
    <a href="{{ route("admin.import.downloadSampleForm", $name) }}" class="float-right mb-4 mr-2" ><button class="btn btn-primary"><i class="far fa-file-alt"></i></button></a>
</div>
<div class="container">
    <a href="{{ route("admin.import.downloadSampleForm", $name) }}" class="float-right mb-4 mr-2" ><button class="btn btn-primary"><i class="far fa-file-alt"></i></button></a>
</div>
<div class="m-5">
    <div class="container mt-3" xmlns:v-bind="http://symfony.com/schema/routing">
        <div class="row mb-3">
            <div class="col">
                <label for="subject">Môn học</label>
                <select name="subject" id="subject" v-model="subjectSelected" class="form-control" @click="getAllStudentBySubjectCode()">
                    <option v-for="subject in subjects" v-bind:value="subject.subject_code">@{{ subject.name }}</option>
                </select>
            </div>

            <div class="col">
                <label for="subject_class">Lớp học phần</label>
                <select name="subject_class" id="subject_class" v-model="serialSelected" class="form-control" @click="getAllStudentBySerial()">
                    <option v-for="serial in serials">@{{ serial }}</option>
                </select>
            </div>

            <div class="col"></div>
        </div>
    </div>

    <table class="table table-striped">
        <thead>
        <tr>
            <th scope="col">#</th>
            <th scope="col">Họ và tên</th>
            <th scope="col">Mã sinh viên</th>
            <th scope="col">Mã môn học</th>
            <th scope="col">Lớp học phần</th>
            <th scope="col">Điều kiện dự thi</th>
            <th scope="col">Ghi chú</th>
            <th scope="col">Tác vụ</th>
        </tr>
        </thead>

        <tbody>
        <tr v-for="(row, index) in rows">
            <td>@{{ index+1 }}</td>
            <td>@{{row.full_name}}</td>
            <td>@{{row.student_code}}</td>
            <td>@{{row.subject_code}}</td>
            <td>@{{row.serial}}</td>
            <td>@{{row.contest_conditions}}</td>
            <td>@{{row.comments}}</td>
            <td>
                <button @click="deletingSubjectId = row.id" data-toggle="modal" data-target="#deleteModal" class="btn btn-outline-danger"><i class="fas fa-trash-alt"></i></button>
                <button @click="getStudentOfSubject(row.id)" data-toggle="modal" data-target="#editModal" class="btn btn-outline-primary"><i class="far fa-edit"></i></button>
            </td>
        </tr>
        </tbody>
    </table>

    <!-- <div class="float-right"> -->
        <!-- <div>
            <a href="{{ route("admin.import.downloadSampleForm", $name) }}" class="mb-4">SampleForm1</a>
        </div>
        <div>
            <a href="{{ route("admin.import.downloadSampleForm", $name2) }}" class="mb-4">SampleForm2</a>
        </div> -->
    <!-- </div> -->
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
                    <label for="name">Họ và tên sinh viên</label>
                    <input type="text" id="name" name="name" class="form-control mt-2" v-model="editingSubject.full_name" disabled>
                </div>

                <div class="form-group">
                    <label for="student_code">Mã sinh viên</label>
                    <input type="text" id="student_code" name="student_code" class="form-control mt-2" v-model="editingSubject.student_code" disabled>
                </div>

                <div class="form-group">
                    <label for="subject_class">Lớp học phần</label>
                    <input type="text" id="subject_class" name="subject_class" class="form-control mt-2" v-model="editingSubject.subject_class" disabled>
                </div>

                <div class="form-group">
                    <label for="contest_conditions">Điều kiện dự thi</label>
                    <input type="text" id="contest_conditions" name="contest_conditions" class="form-control mt-2" v-model="editingSubject.contest_conditions" >
                </div>

                <div class="form-group">
                    <label for="comments">Ghi chú</label>
                    <input type="text" id="comments" name="comments" class="form-control mt-2" v-model="editingSubject.comments" >
                </div>
            </div>

            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" ref="close" data-dismiss="modal">Huỷ</button>
                <button type="submit" class="btn btn-primary" @click="editSubject(editingSubject.id)">Sửa</button>
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
        subjectSelected: '',
        serialSelected: '',
        subjectClassSelected: '',
        deletingSubjectId:'',
        err: '',
        editingSubject: {},
        subjectClasses: [],
        subjects: [],
        serials: [],
        rows: [],
        allStudent: [],
        examID: ''
    },
    methods: {
        getExamActive(){
            axios.get('/admin/examActive')
                .then(res => {
                    let exam = res.data;
                    if (exam != null) {
                        this.getAllSubjectClassByExam(exam.year, exam.semester);
                    }
                })
                .catch(function (error) {
                    console.log(error);
                });
        },
        getAllSubjectClassByExam(year, semester) {
            axios.get('/admin/all/subjectClassOfExam/' + year + '/' + semester)
                .then((res) => {
                    this.subjectClasses = res.data;
                    this.getAllSubject();
                    this.examID = this.subjectClasses[0].exam_id;
                })
        },
        getAllSubject() {
            const map = new Map();
            var result = [];
            var objects = this.subjectClasses;
            for (const object of objects) {
                if (!map.has(object.name)) {
                    map.set(object.name, true);
                    result.push(object);
                }
            }
            this.subjects = result;
        },
        getAllStudentBySubjectCode() {
            if (this.subjectSelected === '') return;
            axios.get('/admin/all/studentOfSubjectCodeAndExamID/' + this.subjectSelected + '/' + this.examID)
                .then((res) => {
                    this.allStudent = res.data;
                    this.rows = this.allStudent;
                    this.getSerialBySubjectCode();
                })
                .catch(function (err) {

                });
        },
        getSerialBySubjectCode()
        {
            var result = [];
            var objects = this.subjectClasses;
            for (const object of objects) {
                if (object.subject_code === this.subjectSelected)
                    result.push(object.serial);
            }
            this.serials = result;
        },
        getAllStudentBySerial() {
            if (this.serialSelected === '') return;
            var result = [];
            for (const row of this.allStudent) {
                if (row.serial == this.serialSelected) {
                    result.push(row);
                }
            }
            this.rows = result;
        },
        deleteSubject(subjectId) {
            this.$refs.delete.click();
            axios.delete('/admin/registrationStudy/' + subjectId).then(res =>{
                this.getAllStudentBySubjectCode();
            }).catch(err =>{
                console.log(err);
            });
        },
        getStudentOfSubject(id) {
            axios.get('/admin/registrationStudy/' + id).then(res => {
                this.editingSubject = res.data;
                console.log(this.editingSubject);
            })
        },
        editSubject(id) {
            axios.put('/admin/registrationStudy/' + id, this.editingSubject).then(res => {
                this.$refs.close.click();
                this.getAllStudentBySubjectCode();
            })
        }
    },
    created () {
        this.getExamActive();
    }
})
</script>