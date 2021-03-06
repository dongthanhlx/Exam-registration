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

    <form action="{{ route('admin.exam.store') }}" method="POST">
        @csrf
        <div class="form-group">
            <label for="name">Kỳ thi</label>
            <input type="text" id="name" name="name" class="form-control mt-2" value="Thi cuối kỳ" readonly/>
        </div>

        <div class="form-group">
            <label for="semester">Học kỳ</label>
            <select name="semester" id="semester" class="form-control mt-2">
                <option value="1">1</option>
                <option value="2">2</option>
            </select>
        </div>

        <div class="form-group">    
            <label for="year">Năm học</label>
            <select name="year" id="year" class="form-control mt-2">
                <option value="2013-2014">2013-2014</option>
                <option value="2014-2015">2014-2015</option>
                <option value="2015-2016">2015-2016</option>
                <option value="2016-2017">2016-2017</option>
                <option value="2017-2018">2017-2018</option>
                <option value="2018-2019">2018-2019</option>
                <option value="2019-2020">2019-2020</option>
                <option value="2020-2021">2020-2021</option>
                <option value="2021-2022">2021-2022</option>
            </select>
        </div>

        <button type="submit" class="btn btn-primary">Create</button>
    </form>
</div>