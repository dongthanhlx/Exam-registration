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
        <th scope="col">Họ và tên</th>
        <th scope="col">Email</th>
        <th scope="col"></th>
    </tr>
    </thead>
    <tbody>
    @foreach ( json_decode($records) as $record)
        <tr>
            <th scope="row">{{ $loop->index + 1 }}</th>
            <th scope="row">{{ $record->full_name }}</th>
            <th scope="row">{{ $record->email }}</th>
            <th scope="row">
                <form action="{{ route('admin.user.delete', $record->id) }}" method="POST" class="float-right">
                    @csrf
                    @method('DELETE')
                    <button class="btn btn-outline-danger ml-2" onclick="return confirm('Chắc không ?')"><i class="fas fa-trash-alt"></i></button>
                </form>
                <a href="{{ route('admin.user.edit', $record->id) }}"><button class="btn btn-outline-primary float-right"><i class="far fa-edit"></i></button></a>
            </th>
        </tr>
    @endforeach
    </tbody>
</table>