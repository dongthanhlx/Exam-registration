<div class="mr-5 ml-5">
    <div class="row mb-3" >
        <div class="col">
            <label for="year">Năm học</label>
            <select v-model="year" name="year" id="year" class="form-control">
                <option v-for="year in years" >@{{ year.year }}</option>
            </select>
        </div>

        <div class="col">
            <label for="semester">Học kỳ</label>
            <select name="semester" id="semester" v-model="semester" class="form-control">
                <option value="1">1</option>
                <option value="2">2</option>
            </select>
        </div>
        <div class="col"></div>
        <div class="col-6"></div>
    </div>

    <table class="table table-striped">
        <thead>
        <tr>
            <th scope="col">#</th>
            <th scope="col">Môn thi</th>
            <th scope="col">Ngày thi</th>
            <th scope="col">Ca thi</th>
            <th scope="col">Phòng thi</th>
            <th scope="col">Tác vụ</th>
        </tr>
        </thead>

        <tbody>
        <tr v-for="(row, index) in rows">
            <td>@{{ index+1 }}</td>
            <td>@{{row.subject}}</td>
            <td>@{{row.date}}</td>
            <td>@{{row.examShift}}</td>
            <td>@{{row.room}}</td>
            <td>
                <button @click="idDelete = row.id" data-toggle="modal" data-target="#deleteModal" class="btn btn-outline-danger">Delete</button>
                <button @click="getSubject(row.id)" data-toggle="modal" data-target="#editModal" class="btn btn-outline-secondary">Edit</button>
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
        yearSelected: '',
        semesterSelected: '',
        idDelete: '',
        editingSubjectClass: {},
        year:null,
        semester:null,
        years:[],
        rows:[
        ]
    },
    watch:{
            year: function(newval,oldval) {
                if(this.semester !== null){
                this.getAllByYearAndSemester(newval, this.semester);
                }else{
                console.log(newval)
                }
            },
            semester: function(newval,oldval) {
                this.getAllByYearAndSemester(this.year,newval);
            }
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
        this.getAllYear();
    }
})
</script>