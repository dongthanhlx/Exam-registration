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
        <th scope="col">Tên môn học</th>
        <th scope="col">Mã môn học</th>
        <th scope="col">Số tín chỉ</th>
        <th scope="col"></th>
    </tr>
    </thead>
    <tbody>
    @foreach ($records as $record)
        <tr>
            <th scope="row">{{ $record->id }}</th>
            <th scope="row">{{ $record->name }}</th>
            <th scope="row">{{ $record->subject_code }}</th>
            <th scope="row">{{ $record->number_of_credits }}</th>
            <th scope="row">
                <form action="{{ route('admin.subject.delete', $record->id) }}" method="post" class="float-right">
                    @csrf
                    @method('DELETE')
                    <button class="btn btn-outline-primary ml-2" onclick="return confirm('Chắc cú ?')"><i class="fas fa-trash-alt"></i></button>
                </form>
                <a href="{{ route('admin.subject.edit', $record->id) }}"><button class="btn btn-outline-primary float-right"><i class="far fa-edit"></i></button></a>
            </th>
        </tr>
    @endforeach
    </tbody>
</table>