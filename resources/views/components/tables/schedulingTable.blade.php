
<div class="mr-5 ml-5 mt-3">
    <table class="table table-striped large-table">
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
            </td>
        </tr>
        </tbody>
    </table>

    <!-- Modal -->
    <!-- <div class="modal fade" id="editModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
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
                        <input type="text" id="name" name="name" class="form-control mt-2" v-model="editingScheme.name" >
                    </div>

                    <div class="form-group">
                        <label for="subject_code">Mã môn học</label>
                        <input type="text" id="subject_code" name="subject_code" class="form-control mt-2" v-model="editingScheme.subject_code" >
                    </div>

                    <div class="form-group">
                        <label for="number_of_credits">Số tín chỉ</label>
                        <input type="number" id="number_of_credits" name="number_of_credits" class="form-control mt-2" v-model="editingScheme.number_of_credits" >
                    </div>
                </div>

                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" ref="close" data-dismiss="modal">Huỷ</button>
                    <button type="button" class="btn btn-primary" @click="editScheme(editingScheme.id)">Sửa</button>
                </div>
            </div>
        </div>
    </div> -->

<div class="modal fade" id="deleteModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLabel">Tạo mới</h5>
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
        rows:[]
    },
    methods: {
        getAll(){
            axios.get('/admin/all/year')
                .then((response) => {
                    this.rows = response.data;
                })
                .catch(function (error) {

                });
        },
        deleteExam(id) {
            this.$refs.delete.click();
            axios.delete('/admin/SubjectClass/' +id).then(res =>{

            }).catch(err =>{
                console.log(err);
            });
        },

    },
    created () {
        this.getExamActive();
    }
})
</script>
{{--

<div class="modal fade" id="createScheme" tabindex="-1" role="dialog" aria-labelledby="exampleModalLongTitle" aria-hidden="true">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLongTitle">Tạo mới</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                <span aria-hidden="true">&times;</span>
                </button>
            </div>
            
            <div class="modal-body">
                @include('components.forms.schedulingForm');
            </div>
            </div>
        </div>
    </div>--}}
