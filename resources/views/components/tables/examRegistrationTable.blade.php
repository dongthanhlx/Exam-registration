<div class="container" xmlns:v-bind="http://www.w3.org/1999/xhtml">
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
            <tr v-for="(row, index) in rows">
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
</div>

<script>
    const App = new Vue({
        el: '#app',
        data: {
            selectedItems: [],
            max: 2,
            selectedRow:[],
            idDelete:'',
            editingRoom: {},
            rows:[
                {"id":"1","subject":"TTCN","date":"20-11-2019","examshift":1,"room":"301G2 (45/50)"},
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

            }
        },
        created () {
            this.disable();
        }
    })
</script>