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


    <form action="{{ route('admin.SubjectClass.update', $record->id) }}" method="POST">
        @csrf
        @method('PATCH')
        <div class="form-group">
            <label for="subject_code">Mã học phần</label>
            <input type="text" id="subject_code" name="subject_code" class="form-control mt-2" value="{{ $record->subject_code }}" >
        </div>
        
        <div class="form-group">
            <label for="serial">Lớp học phần</label>
            <input type="number" id="serial" name="serial" class="form-control mt-2" value="{{ $record->serial }}" >
        </div>

        <div class="form-group">
            <label for="teacher">Giảng viên</label>
            <input type="text" id="teacher" name="teacher" class="form-control mt-2" value="{{ $record->teacher }}" >
        </div>

        <div class="form-group">
            <label for="maximum_student">Số lượng sinh viên tối đa</label>
            <input type="number" id="maximum_student" name="maximum_number_of_student" class="form-control mt-2" value="{{ $record->maximum_number_of_student}}" >
        </div>

        <button type="submit" class="btn btn-primary btn-outline-primary rounded">Cập nhật</button>
    </form>
</div>