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
            <label for="firstName">Họ và tên đệm</label>
            <input type="text" id="firstName" name="firstName" class="form-control mt-2" value="{{ $record->first_name }}" />
        </div>

        <div class="form-group">
            <label for="lastName">Tên</label>
            <input type="text" id="lastName" name="lastName" class="form-control mt-2" value="{{ $record->last_name }}" />
        </div>

        <div class="form-group">
            <label for="email">Email</label>
            <input type="text" id="email" name="email" class="form-control mt-2" value="{{ $record->email }}" >
        </div>

        <button type="submit" class="btn btn-primary btn-outline-primary rounded">Cập nhật</button>
    </form>
</div>