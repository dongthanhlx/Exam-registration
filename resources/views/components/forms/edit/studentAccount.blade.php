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
    <form class="" action="" method="POST">
        @csrf
        <div class="form-group">
            <label for="fulltName">Họ và tên</label>
            <input type="text" id="fullName" name="fullName" class="form-control mt-2"/ value="" >
        </div>
    
        <div class="form-group">
            <label for="studenCode">Mã sinh viên</label>
            <input type="text" id="studenCode" name="studentCode" class="form-control mt-2"/ value="" >
        </div>

        <div class="form-group">
            <label for="email">Email</label>
            <input type="text" id="email" name="email" class="form-control mt-2"/ value="" >
        </div>

        <div class="form-group">
            <label for="password">Lớp</label>
            <input type="text" id="password" name="password" class="form-control mt-2"/ value="" >
        </div>

        <button type="submit" class="btn btn-primary btn-outline-primary rounded">Create</button>
    </form>

</div>