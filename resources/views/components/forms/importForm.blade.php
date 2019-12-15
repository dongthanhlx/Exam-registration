<div class="container">
    <button type="button" class="btn btn-primary float-right" style="width:120px" data-toggle="modal" data-target="#staticBackdrop">
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
                <form class="md-form" action="{{ $route }}" method="POST" enctype="multipart/form-data">
                    @csrf
                    <div class="input-group mt-2 mb-3 ">
                        <div class="custom-file">
                          <input type="file" class="custom-file-input" id="inputGroupFile02"/>
                          <label id="fileName" class="custom-file-label" for="inputGroupFile02">Choose a file</label>
                        </div>
                    </div>
                    <div class="float-right mt-5 mb-2">
                        <button type="button" class="btn btn-secondary mr-2" data-dismiss="modal">Close</button>
                        <button type="submit" class="btn btn-primary">Import</button>
                    </div>
                </form>
        </div>
      </div>
    </div>
  </div>
</div>

<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0-alpha.6/css/bootstrap.min.css" integrity="sha384-rwoIResjU2yc3z8GV/NPeZWAv56rSmLldC3R/AZzGRnGxQQKnKkoFVhFQhNUwEyJ" crossorigin="anonymous">
<script src="https://code.jquery.com/jquery-3.1.1.slim.min.js" integrity="sha384-A7FZj7v+d/sdmMqp/nOQwliLvUsJfDHW+k9Omg/a/EheAdgtzNs3hpfag6Ed950n" crossorigin="anonymous"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/tether/1.4.0/js/tether.min.js" integrity="sha384-DztdAPBWPRXSA/3eYEEUWrWCy7G5KFbe8fFjk5JAIxUYHKkDx6Qin1DkWx51bBrb" crossorigin="anonymous"></script>
<script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0-alpha.6/js/bootstrap.min.js" integrity="sha384-vBWWzlZJ8ea9aCX4pEW3rVHjgjt7zpkNpZk+02D9phzyeVkE+jo0ieGizqPLForn" crossorigin="anonymous"></script>

<script>
      $('#inputGroupFile02').on('change',function(){
          //get the file name
          var fileName = $(this).val();
          console.log(fileName);
          //replace the "Choose a file" label
          $(this).next('#fileName').html(fileName);
      })
</script>