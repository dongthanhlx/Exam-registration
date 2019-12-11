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
        <th scope="col">Toà nhà</th>
        <th scope="col">Tên phòng</th>
        <th scope="col">Số máy tính</th>
        <th scope="col"></th>
    </tr>
    </thead>
    <tbody>
    @foreach ($records as $record)
        <tr>
            <th scope="row">{{ $loop->index + 1 }}</th>
            <th scope="row">{{ $record->location }}</th>
            <th scope="row">{{ $record->name }}</th>
            <th scope="row">{{ $record->number_of_computer }}</th>
            <th scope="row">
                <form action="{{ route('admin.room.delete', $record->id) }}" method="post" class="float-right">
                    @csrf
                    @method('DELETE')
                    <button class="btn btn-outline-primary" onclick="return confirm('Chắc không ?')">Delete</button>
                </form>
                <a href="{{ route('admin.room.edit', $record->id) }}"><button class="btn btn-outline-primary float-right">Edit</button></a>
            </th>
        </tr>
    @endforeach
    </tbody>
</table>
