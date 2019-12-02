
<div class="card-body">
    <form action="{{ $route }}" method="POST" enctype="multipart/form-data">
        @csrf
        <input type="file" name="file" class="form-control" />
        <br>
        <button class="btn btn-success">Import</button>
    </form>
</div>
