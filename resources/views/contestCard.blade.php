@extends('layouts.student')

@section('content')

<script src="https://printjs-4de6.kxcdn.com/print.min.js"></script>
<!-- <link rel="stylesheet" type="text/css" href="pr"> -->

<form id="print">
    <div class="container border p-5">
       <table style="width: 100%; border: none; border-collapse: collapse;">
            <tbody><tr>
                    <td style="width: 40%; text-align: center; vertical-align: top;">
                        <p style="text-transform: uppercase; font-weight: normal; margin: 0; padding: 0; font-size: 12pt; font-weight:bold;">ĐẠI HỌC QUỐC GIA HÀ NỘI</p>
                        <p style="text-transform:uppercase; margin: 0; padding: 0; font-size:12pt; font-weight:bold;">TRƯỜNG ĐẠI HỌC CÔNG NGHỆ</p>
                    </td>
                    <td style="width: 60%; text-align: center; vertical-align: top;">
                        <p style="text-transform: uppercase; font-weight: bold; margin: 0; padding: 0; font-size: 12pt;">CỘNG HÒA XÃ HỘI CHỦ NGHĨA VIỆT NAM</p>
                        <p style="margin: 0; padding: 0; font-weight: bold;">Độc lập - Tự do - Hạnh phúc</p>
                    </td>
                </tr>
            </tbody>
        </table>
            
        
     <div style="margin-bottom:40px">  
        <h1 style="text-align: center; text-transform: uppercase; font-weight: bold; font-size: 14pt; margin: 30px 0 0 0; padding: 0;" id="header" v-model="newestExam">Phiếu báo dự thi - @{{newestExam.name}}</h1>
     </div>       
            <div class="col">
                <h5 style="margin-bottom:20px">Họ và tên: @{{studentInfo.first_name}} @{{ studentInfo.last_name }}</h5>
                <h5 style="margin-bottom:20px">Ngày sinh: @{{studentInfo.birthday}}</h5>
                <h5 style="margin-bottom:20px">Lớp: @{{studentInfo.class}}</h5>
                <h5 style="margin-bottom:20px">Mã sinh viên: @{{studentInfo.student_code}}</h5>
            </div>
            <div class="col">
            
            </div>
            <div class="col">
                
            </div>
            <table style="border:none; width: 100%; border-collapse:collapse;">
                <thead>
                    <tr>
                        <th style="border-top: 1px solid #000; border-left: 1px solid #000; border-right: 1px solid #000; text-align: center;" scope="col">#</th>
                        <th style="border-top: 1px solid #000; border-left: 1px solid #000; border-right: 1px solid #000; text-align: center;" scope="col">Môn thi</th>
                        <th style="border-top: 1px solid #000; border-left: 1px solid #000; border-right: 1px solid #000; text-align: center;" scope="col">Mã môn thi</th>
                        <th style="border-top: 1px solid #000; border-left: 1px solid #000; border-right: 1px solid #000; text-align: center;" scope="col">Ngày thi</th>
                        <th style="border-top: 1px solid #000; border-left: 1px solid #000; border-right: 1px solid #000; text-align: center;" scope="col">Ca thi</th>
                        <th style="border-top: 1px solid #000; border-left: 1px solid #000; border-right: 1px solid #000; text-align: center;" scope="col">Phòng thi</th>
                    </tr>
                </thead>

                <tbody>
                    <tr v-for="(row, index) in rows">
                        <td style="border-top: 1px solid #000; border-left: 1px solid #000; border-right: 1px solid #000; border-bottom: 1px solid #000; text-align: center;">@{{ index+1 }}</td>
                        <td style="border-top: 1px solid #000; border-left: 1px solid #000; border-right: 1px solid #000; border-bottom: 1px solid #000; text-align: center;">@{{row.name}}</td>
                        <td style="border-top: 1px solid #000; border-left: 1px solid #000; border-right: 1px solid #000; border-bottom: 1px solid #000; text-align: center;">@{{row.subject_code}}</td>
                        <td style="border-top: 1px solid #000; border-left: 1px solid #000; border-right: 1px solid #000; border-bottom: 1px solid #000; text-align: center;">@{{row.date}}</td>
                        <td style="border-top: 1px solid #000; border-left: 1px solid #000; border-right: 1px solid #000; border-bottom: 1px solid #000; text-align: center;">@{{row.exam_shift}}</td>
                        <td style="border-top: 1px solid #000; border-left: 1px solid #000; border-right: 1px solid #000; border-bottom: 1px solid #000; text-align: center;">@{{row.room}}</td>
                    </tr>
                </tbody>
        </table>
    </div>
</form>


<div class="container pt-4">
    <button class=" btn btn-primary float-right" type="button" onclick="printJS('print', 'html')">
        Print/Download
    </button>
</div>
<script>
    Vue.prototype.$userId = document.querySelector("meta[name='user-id']").getAttribute('content');

    const App = new Vue({
        el: '#app',
        data: {
            info:{"exam":"KẾT THÚC HỌC KỲ 2 NĂM HỌC 2019-2020","name":"Cao Huu Hung","birthday":"19/02/1998","class":"K61N","student_code":"16021589"},
            rows:[],
            newestExam: '',
            studentInfo: {}
        },
        methods: {
            getInfoRegistered() {
                axios.get('/infoPrint/' + this.$userId)
                    .then(res => {
                        this.rows = res.data;
                    })
                    .catch(res => {
                        console.log(res);
                    })
            },
            getExamInfo() {
                axios.get('/newestExam')
                    .then(res => {
                        this.newestExam = res.data;
                    })
                    .catch(res => {
                        console.log(res);
                    })
            },
            getUserInfo() {
                axios.get('/studentInfoByUserID/' + this.$userId)
                    .then(res => {
                        this.studentInfo = res.data;
                    })
                    .catch(res => {
                        console.log(res);
                    })
            }
        },
        created () {
            this.getExamInfo();
            this.getUserInfo();
            this.getInfoRegistered();
        }
    })
</script>

@endsection