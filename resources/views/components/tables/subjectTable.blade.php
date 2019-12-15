<div class="container">
    <div class="form-group col-md-2" >
        <div>
            <label for="year">Năm học</label>
            <select v-model="years.year" name="year" class="form-control" id="year">
                <option v-for="year in years" >@{{ year.year }}</option>
            </select>
        </div>

        <div class="form-group">
            <label for="semester">Học kỳ</label>
            <select name="semester" id="semester" v-model="selected" @click="getSubjectsByYearAndSemester(years.year,selected)" class="form-control">
                <option value="1">1</option>
                <option value="2">2</option>
            </select>
        </div>
    </div>

    <table class="table table-hover">
        <thead>
        <tr>
            <th scope="col">#</th>
            <th scope="col">Tên môn học</th>
            <th scope="col">Mã môn học</th>
            <th scope="col">Số tín chỉ</th>
            <th scope="col">Tác vụ</th>
        </tr>
        </thead>
        <tbody>
        <tr v-for="(row, index) in rows">
            <td>@{{ index+1 }}</td>
            <td>@{{row.name}}</td>
            <td>@{{row.subject_code}}</td>
            <td>@{{row.number_of_credits}}</td>
            <td>
                <button @click="deletingSubjectId = row.id" data-toggle="modal" data-target="#deleteModal" class="btn btn-outline-danger">Delete</button>
                <button @click="getSubject(row.id)" data-toggle="modal" data-target="#editModal" class="btn btn-outline-primary">Edit</button>
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
</div>
<script>
    const App = new Vue({
        el: '#app',
        data: {
            yearSelected: '',
            semesterSelected: '',
            deletingSubjectId:'',
            err: '',
            editingSubject: {},
            years: [],
            rows:[
            ]
        },
        methods: {
            getAllYear(){
                axios.get('/admin/all/year')
                    .then((response) => {
                        this.years = response.data;
                        console.log(this.years);
                    })
                    .catch(function (error) {

                    });
            },

            getSubjectsByYearAndSemester(year, semester) {
                if (year == null) {
                    this.err = 'Hãy chọn năm trước';
                    return;
                } else {
                    this.err = '';
                }
                console.log(year + semester);
                axios.get('/admin/all/subjectOfExam/' + year +"/"+ semester )
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
            getAllSubject() {
                axios.get('/admin/all/subject').then(res => {
                    this.rows = res.data;
                }).catch(err => {
                    console.log(err);
                })
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
            this.getAllYear();
            this.getAllSubject();
        }
    })
</script>