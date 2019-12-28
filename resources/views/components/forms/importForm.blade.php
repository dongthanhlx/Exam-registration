<div class="container">
    <button type="button" class="btn btn-primary float-right" data-toggle="modal" data-target="#staticBackdrop">
        Thêm mới
    </button>
</div>

<div class="modal fade" id="staticBackdrop" data-backdrop="static" tabindex="-1" role="dialog" aria-labelledby="staticBackdropLabel" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="staticBackdropLabel">Thêm</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>

            <div class="modal-body">
                <div class="card-body mx-4" >
                    <form class="md-form" action="{{ $route }}" method="POST" enctype="multipart/form-data">
                        @csrf
                        <div class="input-group mb-5 ">
                            <div class="mt-2 ml-5 pl-3">
                                <input type="file" id="inputGroupFile02" name="file">
                                <!-- <label class="custom-file-label" for="inputGroupFile02" aria-describedby="inputGroupFileAddon02">Choose file</label> -->
                            </div>
                        </div>

                        <div class="float-right">
                            <button type="button" class="btn btn-secondary" data-dismiss="modal">Huỷ</button>
                            <button type="submit" class="btn btn-primary">Thêm</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>