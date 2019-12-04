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


    <form action="" method="POST">
        @csrf
        <div class="form-group">
            <label for="fullName">Họ và tên</label>
            <input type="text" id="fullName" name="fullName" class="form-control mt-2" value="{{ $record->full_name }}" />
        </div>
    
        <div class="form-group">
            <label for="studentCode">Mã sinh viên</label>
            <input type="text" id="studentCode" name="studentCode" class="form-control mt-2" value="{{ $record->student_code }}" />
        </div>

        <div class="form-group">
            <label for="email">Email</label>
            <input type="text" id="email" name="email" class="form-control mt-2" value="{{ $record->email }}" >
        </div>

        <div class="form-group">
            <label for="password">Lớp</label>
            <input type="text" id="password" name="password" class="form-control mt-2" value="{{ $record->password }}" />
        </div>

        <button type="submit" class="btn btn-primary btn-outline-primary rounded">Cập nhật</button>
    </form>
</div>