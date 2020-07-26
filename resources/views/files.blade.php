@extends('layouts/app')
@section('content')
<style>
    section {
        
        box-sizing:border-box;
        box-shadow: 0 4px 8px 0 rgba(0, 0, 0, 0.2), 0 6px 20px 0 rgba(0, 0, 0, 0.19);
        
    }
</style>
<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>
<script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.0/js/bootstrap.min.js"></script>
<script src='https://kit.fontawesome.com/a076d05399.js'></script>


<div class="container" style="padding-top: 50px;">
    <section class="">
            <div class="card">
                <div class="card-header"><a href="/file-manager">File Manager</a><a href="/dir/{{$folder}}"> ->{{$folder}}</a></div>
                <div class="card-body">
                    
                        <form class="form" action="/upload-file/{{$folder}}" method="post" enctype="multipart/form-data">
                        @csrf
                            <div class="row">
                                <div class="col-sm-8" style="padding:10px">
                                <div class="input-group">
                                    <div class="input-group-prepend">
                                        <span class="input-group-text" id="inputGroupFileAddon01">Upload</span>
                                    </div>
                                    <div class="custom-file">
                                        <input type="file" name="files" class="custom-file-input" id="inputGroupFile01"
                                        aria-describedby="inputGroupFileAddon01" required>
                                        <label class="custom-file-label" for="inputGroupFile01">Choose file</label>
                                    </div>
                                </div>
                                </div>
                        
                                <div class="col-sm-4" >
                                    <button  class="btn btn-primary" type="submit" value="submit">Upload <i class='fas fa-cloud-upload-alt' style='font-size:15px;color:#fff'></i></button>
                                </div>
                            </div>
                        </form>    
                                
                </div>
                <div class="container" >
                    <table class="table table-bordered table-hover " style="float:right">
                        <thead>
                            <tr>
                            <th scope="col">Directories</th>
                            <th scope="col">Created_at</th>
                            <th scope="col">Size</th>
                            <th scope="col">Action</th>
                            </tr>
                        </thead>
                        <tbody>
                        @forelse($files as $row)
                            <tr>
                                <td style="color: blue"><u> {{$row->file_name}}</u></td>
                                <td>{{$row->size}}</td>
                                <td>{{$row->created_at}}</td>
                                <td><button type="button" data-myid="{{$row->id}}" data-myname="{{$row->file_name}}"  class="btn btn-primary btn-rounded" data-toggle="modal" data-target="#exampleModal" data-whatever="@mdo"><i class="fa fa-edit" aria-hidden="true"></i></button>
                                <a href="/file-delete/{{$row->id}}" class="btn btn-danger btn-rounded "><i class="fa fa-trash" aria-hidden="true"></i></a>
                                <a href="/file-download/{{$row->file_name}}" class="btn btn-info btn-rounded "><i class="fa fa-download" aria-hidden="true"></i></a></td>
                                
                            </tr>
                        @empty
                       <li>Oops no Files</li>
                        @endforelse
                        </tbody>
                    </table>
                </div>
            </div>
    
    </section>
</div>
<div class="modal fade" id="exampleModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="exampleModalLabel">Rename</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body">
        <form action="/rename-file" method="post" enctype="multipart/form-data">
          @csrf
          <div class="form-group">
            <input type="hidden" name="id" class="form-control" id="id">
          </div>
          <div class="form-group">
          <label>Old Name</label>
            <input type="text" name="folder" class="form-control" id="folder" readonly>
          </div>
          <div class="form-group">
          <label>New Name</label>
            <input type="text" name="newfolder" class="form-control" id="folder">
          </div>
          
          <div class="modal-footer">
        <button type="submit"  class="btn btn-primary">Rename</button>
      </div>
        </form>
      </div>
     
    </div>
  </div>
</div>   

<script type="text/javascript">
$('#exampleModal').on('show.bs.modal', function (event) {
  var button = $(event.relatedTarget)
  var recipient = button.data('myid')
  var folder = button.data('myname')

  var modal = $(this)
   modal.find('.modal-body #id').val(recipient)
   modal.find('.modal-body #folder').val(folder)
 
})


    </script>


@endsection