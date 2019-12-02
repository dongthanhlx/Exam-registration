<div class="container">
    @if($errors->any())
        <div class="alert alert-danger">
            <ul>
                @foreach($errors->all() as $error)
                    <li>{{ $error }}</li>
                @endforeach
            </ul>
        </div>
    @elseif(session()->has('message'))
        <div class="alert alert-success">
            {{ session()->get('message') }}
        </div>
    @endif

        <form action="{{ route('admin.create.exam') }}" method="POST">
            @csrf
            {{--<div class="form-group row">
                <label for="staticName" class="col-sm-2 col-form-label">Tên kỳ thi</label>
                <div class="col-sm-10">
                    <input type="text" readonly class="form-control  mt-2" value="Thi cuối kỳ" id="staticName"/>
                </div>
            </div>

            <div class="form-group row">
                <label for="semester" class="col-sm-2 col-form-label">Kỳ</label>
                <select name="semester" class="form-control mt-2" id="semester">
                    <option value="1">1</option>
                    <option value="2">2</option>
                </select>
            </div>

            <div class="form-group now">
                <label class="col-sm-2 col-form-label">Năm học</label>
                <input type="number" class="col-2" name="startYear" /> - <input type="number" class="col-2" name="finishYear" />
            </div>

            <button class="btn btn-outline-secondary">Tạo</button>
--}}
            <div class="form-group">
                <div>
                    <label for="staticName" class="col-sm-2 col-form-label">Tên kỳ thi</label>
                    <div class="col-sm-10">
                        <input type="text" readonly class="form-control  mt-2" value="Thi cuối kỳ" id="staticName"/>
                    </div>
                </div>

                <div>
                    <label for="semester" class="col-sm-2 col-form-label">Kỳ</label>
                    <select name="semester" class="form-control mt-2" id="semester">
                        <option value="1">1</option>
                        <option value="2">2</option>
                    </select>
                </div>

                <div>
                    <label class="col-sm-2 col-form-label">Năm học</label>
                    <input type="number" class="col-2" name="startYear" /> - <input type="number" class="col-2" name="finishYear" />
                </div>
            </div>

            <button class="btn btn-outline-secondary">Tạo</button>
        </form>
</div>