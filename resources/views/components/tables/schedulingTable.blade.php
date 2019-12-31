<div class="mr-5 ml-5">
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
            <td>@{{row.name}}</td>
            <td>@{{row.date}}</td>
            <td>@{{row.exam_shift}}</td>
            <td><span v-for="room in row.rooms"><div>@{{room.name}}</div></span></td>
            <td>
                <button @click="idDelete = row.id" data-toggle="modal" data-target="#deleteModal" class="btn btn-outline-danger">Delete</button>
            </td>
        </tr>
        </tbody>
    </table>
</div>

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
                <button type="button" class="btn btn-primary" @click="deleteExam(idDelete)">Xoá</button>
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
            getExamActive() {
                axios.get('/admin/examActive')
                    .then(res => {
                        let exam = res.data;
                        this.getAllByExamID(exam.id);
                    })
            },
            getAllByExamID(id){
                axios.get('/admin/all/schedulingByExamID/' + id)
                    .then((response) => {
                        this.rows = response.data;
                    })
                    .catch(function (error) {

                    });
            },
            deleteExam(id) {
                this.$refs.delete.click();
                axios.delete('/admin/scheduling/' + id).then(res =>{
                    this.getExamActive();
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