<div class="container">
    <div class="box-header blue-background">
        <div class="title">Danh sách tất cả môn thi và ca thi của bạn</div>
        <br>
    </div>
    <div class="border border-dark" style='overflow:auto; width:100%;height:400px;'>
        <table class="table table-bordered">
            <thead>
                <tr>
                    <th scope="col">Chọn</th>
                    <th scope="col">#</th>
                    <th scope="col">Môn thi</th>
                    <th scope="col">Mã học phần</th>
                    <th scope="col">Ngày thi</th>
                    <th scope="col">Ca thi</th>
                    <th scope="col">Địa điểm</th>
                </tr>
            </thead>

            <tbody>
            <tr v-for="(row, index) in rows" class=row.subject>
                <td>
                    <input type="checkbox" @change="getRow(row,selectedRow)" v-bind:class="row.subject" v-bind:id="row.id">
                </td>
                <td>@{{ index+1 }}</td>
                <td>@{{row.subject}}</td>
                <td>@{{row.subject_class}}</td>
                <td>@{{row.date}}</td>
                <td>@{{row.examshift}}</td>
                <td>@{{row.room}}</td>
            </tr>
            </tbody>
        </table>
    </div>

    <div class="box-header blue-background">
        <br>
        <div class="title">Danh sách môn thi đã được chọn</div>
        <br>
    </div>

    <div class="border border-dark" style='overflow:auto; width:100%;height:300px;'>
    <table class="table table-bordered">
        <thead>
            <tr>
                <th scope="col">#</th>
                <th scope="col">Môn thi</th>
                <th scope="col">Mã học phần</th>
                <th scope="col">Ngày thi</th>
                <th scope="col">Ca thi</th>
                <th scope="col">Địa điểm</th>
                <!-- <th scope="col">Tác vụ</th> -->
            </tr>
        </thead>

        <tbody>
        <tr v-for="(selectedrow, index) in selectedRow">
            <td>@{{ index+1 }}</td>
            <td>@{{selectedrow.subject}}</td>
            <td>@{{selectedrow.subject_class}}</td>
            <td>@{{selectedrow.date}}</td>
            <td>@{{selectedrow.examshift}}</td>
            <td>@{{selectedrow.room}}</td>
            <!-- <td>
                <button @click="deleteSelection(selectedrow,selectedRow)" data-toggle="modal" data-target="#deleteModal" class="btn btn-outline-danger">Delete</button>
            </td> -->
        </tr>
        </tbody>
    </table>
    </div>
    <div class="mt-4">
        <button class="btn btn-primary float-right">Confirm</button>
    </div>

    <!-- <div class="container"> -->
<!-- <table class="table">
        <thead>
        <tr>
            <th scope="col"></th>
            <th scope="col">#</th>
            <th scope="col">Tên</th>
        </tr>
        </thead>
        <tbody>
        <tr v-for="(fakeData, index) in fakeDatas">
            <td><input type="checkbox" @change="getRow(fakeData,selectedRow)"></td>
            <td>@{{ index+1 }}</td>
            <td>@{{fakeData.name}}</td>
        </tr>
        </tbody>
    </table>

    <table class="table">
        <thead>
        <tr>
            <th scope="col">#</th>
            <th scope="col">Tên</th>
            <th scope="col"></th>
            <th scope="col"></th>
        </tr>
        </thead>
        <tbody>
        <tr v-for="(selectedrow, index) in selectedRow">
            <td>@{{ index+1 }}</td>
            <td>@{{selectedrow.name}}</td>
        </tr>
        </tbody>
    </table>
</div> -->



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

    <!-- <div class="modal fade" id="deleteModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
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
    </div> -->

</div>




<script>
    const App = new Vue({
        el: '#app',
        data: {
            selectedItems: [],
            max: 2,
            fakeDatas:[{"id":"1","name":"Hung Cao"},{"id":"2","name":"Dong Thanh"},{"id":"3","name":"LoLa"}],
            selectedRow:[],
            idDelete:'',
            editingRoom: {},
            rows:[
                {"id":"1","subject":"TTCN","subject_class":"INT3306 1","date":"20-11-2019","examshift":1,"room":"301G2"},
                {"id":"2","subject":"TTCN","subject_class":"INT3306 1","date":"20-11-2019","examshift":2,"room":"302G2"},
                {"id":"3","subject":"TTCN","subject_class":"INT3306 1","date":"20-11-2019","examshift":3,"room":"303G2"},
                {"id":"4","subject":"TTCN","subject_class":"INT3306 1","date":"20-11-2019","examshift":"4","room":"304G2"},
                {"id":"5","subject":"KTMT","subject_class":"INT3309 1","date":"20-11-2019","examshift":1,"room":"305G2"},
                {"id":"6","subject":"KTMT","subject_class":"INT3309 1","date":"21-11-2019","examshift":"2","room":"306G2"},
                {"id":"7","subject":"KTMT","subject_class":"INT3309 1","date":"21-11-2019","examshift":"3","room":"307G2"},
                {"id":"8","subject":"KTMT","subject_class":"INT3309 1","date":"21-11-2019","examshift":"4","room":"308G2"},
                {"id":"9","subject":"ATANM","subject_class":"INT3345 1","date":"22-11-2019","examshift":"1","room":"309G2"},
                {"id":"10","subject":"ATANM","subject_class":"INT3345 1","date":"22-11-2019","examshift":"2","room":"310G2"},
                {"id":"11","subject":"ATANM","subject_class":"INT3345 1","date":"22-11-2019","examshift":"3","room":"310G2"},
                {"id":"12","subject":"ATANM","subject_class":"INT3345 1","date":"22-11-2019","examshift":"4","room":"311G2"}
            ]
        },
        methods: {
            getAll() {
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
                    this.getAll();
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
                    this.getAll();
                })
            },
            disableRow(value, select, status){
                // var clasName = [];
                var className = document.getElementsByClassName(value.subject);
                className = Array(className);
                
                for(var i = 0; i<this.rows.length;i++){
                    if((value.date == this.rows[i].date) && (value.examshift == this.rows[i].examshift )){
                        className.push(document.getElementById(this.rows[i].id));
                        // className.push( i);
                    }
                }
                console.log(className);
                
                // console.log(status)
                for (var i=0; i<className.length; i++) {
                    className[i].disabled = status;
                }
                document.getElementById(value.id).disabled = false;
            },

            

            getRow(value, select){
                
                this.disableRow(value,select,true);
                var exist = 0;
                var record = 0;
                for(var i = 0; i < select.length  ;i++){
                    if(value.id == select[i].id){
                        exist++;
                        // console.log(exist);
                        
                    }
                    if( value.id == select[i].id ){
                        record = i;
                        this.disableRow(value,select,false);
                
                    }
                    else continue;
                        
                    }
                
                if(exist == 0){
                    select.push(value);
                }else if(exist == 1){
                    select.splice(record, 1)
                }
                
               
            },
            deleteSelection(value, select){
                
                select.splice(value.id-1, 1);
                // console.log(select);
            },
            confirm(){
                // var value = [];
                // for(var i = 0;i<this.selectedRow.length;i++){
                //     value.push({})
                // }
                
            },
            disable(){
                
                document.getElementsByClassName("test").disabled = true;
                
            }
        },
        created () {
            // this.getAll();
        // this.disableRow("TTCN");
        this.disable();
        }
    })
</script>