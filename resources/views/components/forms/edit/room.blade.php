<div class="container form">
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

    <form action="{{ route('admin.room.update', $record->id) }}" method="POST">
        @csrf
        @method('PATCH')
        <div class="form-group">
            <label for="location">Tòa nhà</label>
            <input type="text" id="location" name="location" class="form-control mt-2" value="{{ $record->location }}" >
        </div>

        <div class="form-group">
            <label for="name">Tên phòng</label>
            <input type="text" id="name" name="name" class="form-control mt-2" value="{{ $record->name }}" >
        </div>

        <div class="form-group">
            <label for="numberOfCredits">Số máy tính</label>
            <input type="number" id="numberOfCredits" name="number_of_computer" class="form-control mt-2" value="{{ $record->number_of_computer }}" >
        </div>

        <button type="submit" class="btn btn-primary btn-outline-primary rounded">Cập nhật</button>
    </form>
</div>