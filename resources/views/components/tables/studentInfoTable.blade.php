@extends('layouts.admin')

@section('content')
    @if ($errors->any())
        <div class="alert alert-danger">
            <ul>
                @foreach ($errors->all() as $error)
                    <li>{{ $error }}</li>
                @endforeach
            </ul>
        </div>
    @elseif(session()->has('message'))
        <div class="alert alert-success">
            {{ session()->get('message') }}
        </div>
    @endif
    <table class="table table-hover">
        <thead>
        <tr>
            <th scope="col">#</th>
            <th scope="col">Họ và tên đệm</th>
            <th scope="col">Tên</th>
            <th scope="col">Ngày sinh</th>
            <th scope="col">Giới tính</th>
            <th scope="col">Mã sinh viên</th>
            <th scope="col">Lớp</th>
            <th scope="col"></th>
        </tr>
        </thead>
        <tbody>
        @foreach ($records as $record)
            <tr>
                <th scope="row">{{ $loop->index + 1 }}</th>
                <th scope="row">{{ $record->first_name }}</th>
                <th scope="row">{{ $record->last_name }}</th>
                <th scope="row">{{ $record->birthday }}</th>
                <th scope="row">{{ $record->gender }}</th>
                <th scope="row">{{ $record->student_code }}</th>
                <th scope="row">{{ $record->class }}</th>
                <th scope="row">
                    <form action="" method="post" class="float-right">
                        @csrf
                        @method('DELETE')
                        <button class="btn btn-outline-primary" onclick="return confirm('Chắc không ?')">Delete</button>
                    </form>
                    <a href="#"><button class="btn btn-outline-primary float-right">Edit</button></a>
                </th>
            </tr>
        @endforeach
        </tbody>
    </table>
@endsection