
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
        <th scope="col">Mã môn học</th>
        <th scope="col">Lớp học phần</th>
        <th scope="col">Giảng viên</th>
        <th scope="col">Số lượng sinh viên</th>
        <th scope="col"></th>
    </tr>
    </thead>
    <tbody>
    @foreach ($records as $record)
        <tr>
            <th scope="row">{{ $loop->index + 1 }}</th>
            <th scope="row">{{ $record->subject_code }}</th>
            <th scope="row">{{ $record->serial }}</th>
            <th scope="row">{{ $record->teacher }}</th>
            <th scope="row">{{ $record->maximum_number_of_student }}</th>
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