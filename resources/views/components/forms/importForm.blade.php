<div class="container">
    <button type="button" class="btn btn-primary float-right my-3" data-toggle="modal" data-target="#staticBackdrop">
    Import
    </button>
    
</div>

<div class="modal fade" id="staticBackdrop" data-backdrop="static" tabindex="-1" role="dialog" aria-labelledby="staticBackdropLabel" aria-hidden="true">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="staticBackdropLabel">Import file</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body">
        <div class="card-body mx-4" >
                <!-- <form action="{{ $route }}" method="POST" enctype="multipart/form-data">
                    @csrf
                    <input type="file" name="file" class="form-control border-0" />
                    
                    <div class="float-right">
                        <button style="width:100px" class="btn btn-success ml-5">Import</button>
                    </div>
                </form> -->
                <form class="md-form" action="{{ $route }}" method="POST" enctype="multipart/form-data">
                    @csrf
                    <div class="input-group mb-3 ">
                        <div class="custom-file">
                            <input type="file" class="custom-file-input" id="inputGroupFile02">
                            <label class="custom-file-label" for="inputGroupFile02" aria-describedby="inputGroupFileAddon02">Choose file</label>
                        </div>
                        <!-- <div class="input-group-append">
                            <span class="input-group-text" id="inputGroupFileAddon02">Upload</span>
                        </div> -->
                    </div>
                    </form>
            </div>
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
        <button type="button" class="btn btn-primary">Import</button>
      </div>
    </div>
  </div>
</div>