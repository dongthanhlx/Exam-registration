<div class="container">
    <a href="{{ route("admin.import.downloadSampleForm", $name) }}" class="float-right mb-4 mr-2" ><button class="btn btn-primary"><i class="far fa-file-alt"></i></button></a>
</div>
<div class="container mt-5">
    <table class="table table-striped">
        <thead>
            <tr>
                <th scope="col">#</th>
                <th scope="col">Toà nhà</th>
                <th scope="col">Tên phòng</th>
                <th scope="col">Số máy tính</th>
                <th scope="col">Tác vụ</th>
            </tr>
        </thead>

        <tbody>
        <tr v-for="(row, index) in rows">
            <td>@{{ index+1 }}</td>
            <td>@{{row.location}}</td>
            <td>@{{row.name}}</td>
            <td>@{{row.number_of_computer}}</td>
            <td>
                <button @click="idDelete = row.id" data-toggle="modal" data-target="#deleteModal" class="btn btn-outline-danger"><i class="fas fa-trash-alt"></i></button>
                <button @click="getRoom(row.id)" data-toggle="modal" data-target="#editModal" class="btn btn-outline-primary"><i class="far fa-edit"></i></button>
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
                <p v-if="errors.length">
                            <b>Lỗi:</b>
                            <ul>
                            <li v-for="error in errors" class="text-danger">@{{ error }}</li>
                            </ul>
                        </p>
                    <div class="form-group">
                        <label for="location">Tòa nhà</label>
                        <input type="text" id="location" name="location" class="form-control mt-2" v-model="editingRoom.location" >
                    </div>

                    <div class="form-group">
                        <label for="name">Tên phòng</label>
                        <input type="text" id="name" name="name" class="form-control mt-2" v-model="editingRoom.name" >
                    </div>

                    <div class="form-group">
                        <label for="numberOfCredits">Số máy tính</label>
                        <input type="number" id="numberOfCredits" name="number_of_computer" class="form-control mt-2" v-model="editingRoom.number_of_computer" >
                    </div>

                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" ref="close" data-dismiss="modal">Huỷ</button>
                    <button type="button" class="btn btn-primary" @click="editRoom(editingRoom.id)">Sửa</button>
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
                    <button type="button" class="btn btn-primary" @click="deleteRoom(idDelete)">Xoá</button>
                </div>
            </div>
        </div>
    </div>

</div>
<script>
    const App = new Vue({
        el: '#app',
        data: {
            errors:[],
            idDelete:'',
            editingRoom: {},
            rows:[]
        },
        methods: {
            checkLocation(place){
                if (!place) {
                    this.errors.push('Không được để trống tên tên địa điểm.');
                    return false;
                }
                return true;
            },
            checkRoom(room){
                if (!room) {
                    this.errors.push('Không được để trống tên phòng.');
                    return false;
                }
                return true;
            },
            checkNumberOfComputers(number){
                if (!number) {
                    this.errors.push('Không được để trống số máy tính.');
                    return false;
                }
                if (!this.validNumber(number)) {
                    this.errors.push('Định dạng số máy tính không chính xác.');
                    return false;
                }
                return true;
            },
            validNumber: function (number) {
                var fnNameRegex = /^[0-9]+$/;
                return fnNameRegex.test(number);
            },
            
            getAllRoom() {
                axios.get('/admin/all/room')
                    .then((response) => {
                        this.rows = response.data;
                    })
                    .catch(function (error) {

                    });
            },
            deleteRoom(roomId) {
                this.$refs.delete.click();
                axios.delete('/admin/room/' +roomId).then(res =>{
                    this.getAllRoom();
                }).catch(err =>{
                    console.log(err);
                });
            },
            getRoom(roomId) {
                axios.get('/admin/room/' + roomId).then(res => {
                    this.editingRoom = res.data;
                })
            },
            editRoom(roomId) {
                this.errors = [];
                let location = this.editingRoom.location;
                let room = this.editingRoom.name;
                let numberOfComputers = this.editingRoom.number_of_computer;
                if(!this.checkLocation(location) | !this.checkRoom(room) | !this.checkNumberOfComputers(numberOfComputers)){
                    console.log("fail");
                }else{
                    axios.put('/admin/room/' + roomId, this.editingRoom).then(res => {
                        this.$refs.close.click();
                        this.getAllRoom();
                    })
                }
            },
        },
        created () {
            this.getAllRoom();
        }
    })
</script>