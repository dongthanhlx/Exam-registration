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
                    <th scope="col">Mã môn thi</th>
                    <th scope="col">Ngày thi</th>
                    <th scope="col">Ca thi</th>
                    <th scope="col">Phòng thi</th>
                </tr>
            </thead>

            <tbody>
                <tr v-for="(row, index) in rows">
                    <td>
                        {{--<div class="custom-control custom-checkbox">
                            <input class="custom-control-input" type="checkbox" @change="checkedBox(row, row.rooms)" v-bind:class="row.subject_code" v-bind:id="row.id" disabled>
                            <label for="row.id" class="custom-control-label"></label>
                        </div>--}}
{{--                        <input type="checkbox" @change="checkedBox(row, row.room)" v-bind:class="row.subject_code" v-bind:id="row.id" disabled>--}}
                        <div class="custom-control custom-checkbox">
                            <input type="checkbox" class="custom-control-input" @change="checkedBox(row, row.room)" v-bind:class="row.subject_code" v-bind:id="row.id" disabled>
                            <label class="custom-control-label" v-bind:for="row.id"></label>
                        </div>
                    </td>
                    <td>@{{ index+1 }}</td>
                    <td>@{{row.name}}</td>
                    <td>@{{row.subject_code}}</td>
                    <td>@{{row.date}}</td>
                    <td>@{{row.exam_shift}}</td>
                    <td>
                        <select v-model="row.room" name="room" class="form-control mt-2" @change="clickOption(row)" v-bind:class="row.subject_code" style="border-color: #00AAAA">
                            <option v-for="room in row.rooms" v-bind:value="room">@{{  room.name }} (@{{  room.numRegistered }}/@{{  room.maxNum }})</option>
                        </select>
                    </td>
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
                    <th scope="col">Mã môn thi</th>
                    <th scope="col">Ngày thi</th>
                    <th scope="col">Ca thi</th>
                    <th scope="col">Phòng thi</th>
                </tr>
            </thead>

            <tbody>
                <tr v-for="(selectedrow, index) in selectedRow">
                    <td>@{{ index+1 }}</td>
                    <td>@{{selectedrow.name}}</td>
                    <td>@{{selectedrow.subject_code}}</td>
                    <td>@{{selectedrow.date}}</td>
                    <td>@{{selectedrow.exam_shift}}</td>
                    <td>@{{selectedrow.room.name}}</td>
                </tr>
            </tbody>
        </table>
    </div>

    <div class="mt-4">
        <button type="button" class="btn btn-primary float-right" @click="submit()">Confirm</button>
    </div>
</div>

<script>
    const App = new Vue({
        el: '#app',
        data: {
            roomSelected: {},
            selectedRow:[],
            rows:[],
            room: {}
        },
        methods: {
            getAll() {
                axios.get('admin/all/infoScheduling')
                    .then(res => {
                        this.rows = res.data;
                    })
                    .catch(res => {
                        console.log(res);
                    })
            },
            clickOption(row) {
                let classNames = document.getElementsByClassName(row.subject_code);

                for (let i=0; i<classNames.length; i++) {
                    classNames[i].disabled = true;
                }

                this.checkedBox(row, row.room);
                document.getElementById(row.id).disabled = false;
            },
            statusRow(row, status){
                let className = document.getElementsByClassName(row.subject_code);
                className = Array.prototype.slice.call( className );

                for(let i = 0; i<this.rows.length;i++){
                    let rowTmp = this.rows[i];

                    if (
                        (row.date == rowTmp.date && row.exam_shift == rowTmp.exam_shift)||
                        row.name == rowTmp.name
                    )
                    {
                        className.push(document.getElementById(rowTmp.id));
                    }
                }

                for (let i=0; i<className.length; i++) {
                    className[i].disabled = status;
                }

                document.getElementById(row.id).disabled = false;
                document.getElementById(row.id).checked = status;
            },
            statusClass(className, status) {
                let classNames = document.getElementsByClassName(className);

                for (let i=0; i<classNames.length; i++) {
                    classNames.disabled = status;
                }
            },
            checkedBox(row, room){
                if (room == null) {
                    document.getElementById(row.id).checked = false;
                    return;
                }
                row.room = room;
                let resultCheck = this.checkRow(row);

                if (!resultCheck && (typeof resultCheck) != "number") {
                    this.statusRow(row, true);
                    this.selectedRow.push(row);
                } else {
                    this.selectedRow.splice(resultCheck, 1);
                    this.statusRow(row, false);
                }
            },
            checkRow(row) {
                for (let i=0; i<this.selectedRow.length; i++) {
                    let tmpRow = this.selectedRow[i];

                    if (row.id == tmpRow.id) {
                        return i;
                    }
                }

                return false;
            },
            submit() {
                console.log(this.selectedRow);
            }
        },
        created () {
            this.getAll();
        }
    })
</script>