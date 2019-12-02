@extends('layouts.admin')

@section('content')
<div class="container">
    <div class="row">
        <div class="col-md-8 col-md-offset-2">
            <div class="panel panel-default">
                <div class="panel-heading">ADMIN Dashboard</div>
                <div class="panel-body">
                    <a href="{{ route('admin.import.StudentAccount') }}"><button class="btn btn-primary">Import Student Account</button></a>
                    <a href="{{ route('admin.import.StudentInfo') }}"><button class="btn btn-primary">Import Student Info </button></a>
                    <a href="{{ route('admin.import.StudentListOfSubject') }}"><button class="btn btn-primary">Import Student List Of Subject</button></a>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
