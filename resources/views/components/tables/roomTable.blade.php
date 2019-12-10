<table class="table table-hover">
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
        <tr v-for="row in rows">
            <td>@{{row.id}}</td>
            <td>@{{row.location}}</td>
            <td>@{{row.name}}</td>
            <td>@{{row.number_of_computer}}</td>
            <td>
                <button @click="deletingRoomId = row.id" data-toggle="modal" data-target="#deleteModal">Delete</button>
                <button @click="getRoom(row.id)" data-toggle="modal" data-target="#editModal">Edit</button>
            </td>
        </tr>
    <!-- @foreach (json_decode($records) as $record)
        <tr>
            <th scope="row">{{ $loop->index + 1 }}</th>
            <th scope="row">{{ $record->location }}</th>
            <th scope="row">{{ $record->name }}</th>
            <th scope="row">{{ $record->number_of_computer }}</th>
            <th scope="row">
                <form action="{{ route('admin.room.delete', $record->id) }}" method="post" class="float-right">
                    @csrf
                    @method('DELETE')
                    <button class="btn btn-outline-primary ml-2" onclick="return confirm('Chắc không ?')"><i class="fas fa-trash-alt"></button>
                </form>
                <a href="{{ route('admin.room.edit', $record->id) }}"><button class="btn btn-outline-primary float-right"><i class="far fa-edit"></button></a>
            </th>
        </tr>
    @endforeach -->
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
        <button type="button" class="btn btn-primary" @click="deleteRoom(deletingRoomId)">Xoá</button>
      </div>
    </div>
  </div>
</div>




<script>
    

const App = new Vue({
        el: '#app',
        data: {
            deletingRoomId:'',
            editingRoom: {},
          rows:[
          ]
        },
        methods: {
            getAllRooms() {
                axios.get('/test')
                .then((response) => {
                    this.rows = response.data;
                    console.log(this.rows);
                })
                .catch(function (error) {
                
                }); 
            },
            deleteRoom(roomId) {
                this.$refs.delete.click();
                axios.delete('/admin/room/' +roomId).then(res =>{
                    
                    this.getAllRooms();

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
                axios.put('/admin/room/' + roomId, this.editingRoom).then(res => {
                    this.$refs.close.click();
                    this.getAllRooms();
                })
            }

        },
        created () {
            this.getAllRooms();
        }
      })

</script>

