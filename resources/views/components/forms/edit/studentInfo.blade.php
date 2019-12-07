<div class="container form">
    @if ($errors->any())
        <div class="alert alert-danger">
            <ul>
                @foreach ($errors->all() as $error)
                    <li>{{ $error }}</li>
                @endforeach
            </ul>
        </div>
    {{--@elseif(session()->has('message'))
        <div class="alert alert-success">
            {{ session()->get('message') }}
        </div>--}}
    @endif


    <form action="{{ route('admin.student.update', $record->id) }}" method="POST">
        @csrf
        @method('PATCH')
        <div class="form-group">
            <label for="firstName">Họ và tên đệm</label>
            <input type="text" id="firstName" name="firstName" class="form-control mt-2" value="{{ $record->first_name }}" disabled>
        </div>
        
        <div class="form-group">
            <label for="lastName">Tên</label>
            <input type="text" id="lastName" name="lastName" class="form-control mt-2" value="{{ $record->last_name }}" disabled>
        </div>

        <div class="form-group">
            <label for="lastName">Ngày sinh</label>
            <input type="text" id="lastName" name="birthday" class="form-control mt-2" value="{{ $record->birthday }}" >
        </div>

        <div class="form-group">    
            <label for="gender" >Giới tính</label>
            <select name="gender" id="gender" class="form-control mt-2">
                <option value="nam" @if($record->gender == "nam") selected @endif>Nam</option>
                <option value="nữ" @if($record->gender == "nữ") selected @endif>Nữ</option>
            </select>
        </div>

        <div class="form-group">
            <label for="studentCode">Mã sinh viên</label>
            <input type="text" id="studentCode" name="student_code" class="form-control mt-2" value="{{ $record->student_code }}" >
        </div>

        <div class="form-group">
            <label for="class">Lớp</label>
            <input type="text" id="class" name="class" class="form-control mt-2" value="{{ $record->class }}" >
        </div>

        <button type="submit" class="btn btn-primary btn-outline-primary rounded">Cập nhật</button>
    </form>

</div>