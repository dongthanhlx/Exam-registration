<button {{--style="width:100px;margin-left:90%" --}}class="btn btn-success mr-3" data-toggle="modal" data-target="#exampleModal" >Import</button>

<div class="modal fade" id="exampleModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="exampleModalLabel">Import file excel</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body">
            <div class="card-body float-right" >
            <form action="{{ $route }}" method="POST" enctype="multipart/form-data">
                @csrf
                <input type="file" name="file" class="form-control" />
                
                <div class="float-right">
                    <button style="width:100px" class="btn btn-success ml-5" type="submit">Import</button>
                </div>
            </form>
        </div>
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-secondary" data-dismiss="modal">Cancel</button>
        <button type="button" class="btn btn-primary">Import</button>
      </div>
    </div>
  </div>
</div>
