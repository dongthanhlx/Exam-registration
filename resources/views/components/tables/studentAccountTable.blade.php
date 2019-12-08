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
<div class="container">
    <table class="table table-hover">
        <thead>
        <tr>
            <th scope="col">#</th>
            <th scope="col">Họ và tên</th>
            <th scope="col">Mã sinh viên</th>
            <th scope="col">Email</th>
            <th scope="col"></th>
        </tr>
        </thead>
        <tbody>
        @foreach ($records as $record)
            <tr>
                <th scope="row">{{ $loop->index + 1 }}</th>
                <th scope="row">{{ $record->full_name }}</th>
                <th scope="row">{{ $record->student_code }}</th>
                <th scope="row">{{ $record->email }}</th>
                <th scope="row">
                    <form action="{{ route('admin.user.delete', $record->id) }}" method="POST" class="float-right">
                        @csrf
                        @method('DELETE')
                        <button class="btn btn-outline-primary" onclick="return confirm('Chắc không ?')">Delete</button>
                    </form>
                    <a href="{{ route('admin.user.edit', $record->id) }}"><button class="btn btn-outline-primary float-right">Edit</button></a>
                </th>
            </tr>
        @endforeach
        </tbody>
    </table>
</div>