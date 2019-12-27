@extends('layouts.admin')

@section('content')
<div class="container mt-5" xmlns:v-bind="http://www.w3.org/1999/xhtml" xmlns:v-on="http://www.w3.org/1999/xhtml" style="width: 60%">
    <table class="table">
        <thead>
        <tr>
            <th scope="col">#</th>
            <th scope="col">Kỳ thi</th>
            <th scope="col">Thời gian bắt đầu</th>
            <th scope="col">Thời gian kết thúc</th>
            <th scope="col">Trạng thái</th>
        </tr>
        </thead>

        <tbody>
        <tr v-for="(exam, index) in exams">
            <th scope="row">@{{ index+1 }}</th>
            <th>@{{ exam.name }}</th>
            <th><input type="date" class="form-control" v-model="exam.start_registration" v-bind:value="exam.start_registration" v-on:change="new Date($event.target.value)"></th>
            <th><input type="date" class="form-control" v-model="exam.finish_registration" v-bind:value="exam.finish_registration" v-on:change="new Date($event.target.value)"></th>
            <th>
                <form method="POST">
                    @csrf
                    <button class="btn btn-outline-primary" type="button" @click="updatedStatus(exam.start_registration, exam.finish_registration, exam)">@{{ exam.status }}</button>
                </form>
            </th>
        </tr>
        </tbody>
    </table>
</div>

<script>
    const App = new Vue({
        el: '#app',
        data: {
            exams: [],
            date: "2019-12-12"
        },
        methods: {
            getAllInfo() {
                axios.get('admin/exam')
                    .then(res => {
                        this.exams = res.data;
                    })
                    .catch(res => {
                        console.log(res);
                    })
            },
            updatedStatus(start, finish, exam) {
                axios.put('admin/exam/' + exam.id, {
                    'start': start,
                    'finish': finish,
                    'status': exam.status
                })
                    .then(res => {
                        this.getAllInfo();
                    })
                    .catch(res => {
                        console.log(res);
                    })
            }
        },
        created() {
            this.getAllInfo();
        }
    })
</script>
@endsection
