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


    <form action="{{ $route }}" method="POST">
        @csrf
        @method('PATCH')
        <div class="form-group">
            <label for="name">Tên môn học</label>
            <input type="text" id="name" name="name" class="form-control mt-2" value="{{ $record->name }}" >
        </div>
        
        <div class="form-group">
            <label for="subject_code">Mã môn học</label>
            <input type="text" id="subject_code" name="subject_code" class="form-control mt-2" value="{{ $record->subject_code }}" >
        </div>

        <div class="form-group">
            <label for="numberOfCredits">Số tín chỉ</label>
            <input type="text" id="numberOfCredits" name="numberOfCredits" class="form-control mt-2" value="{{ $record->number_of_credits }}" >
        </div>

        <button type="submit" class="btn btn-primary btn-outline-primary rounded">Cập nhật</button>
    </form>
</div>