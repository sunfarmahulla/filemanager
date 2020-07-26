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
    

<div class="container" style="padding-top: 50px;">
    <section class="">
            <div class="card">
                <div class="card-header">File Manager</div>
                <div class="card-body">
                    
                        <form class="form" action="{{route('dir')}}" method="post" >
                        @csrf
                            <div class="row">
                                <div class="col-sm-8" style="padding:10px">
                                    <div class="input-group">
                                        <input class="form-control" type="text" name="name_of_folder" placeholder="Create New Directory" >
                                    </div>
                                </div>
                        
                                <div class="col-sm-4" >
                                    <button  class="btn btn-success" type="submit" value="submit">Create Directory <i class="fa fa-plus"></i></button>
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
                            <th scope="col">Action</th>
                            </tr>
                        </thead>
                        <tbody>
                        @forelse($dir as $dir)
                            <tr>
                                <td><a href="/dir/{{$dir->name_of_folder}}" style="color:blue"><i class="fa fa-folder-open" aria-hidden="true"></i> {{$dir->name_of_folder}}</a></td>
                                <td>{{$dir->created_at}}</td>
                                <td><button type="button" data-myid="{{$dir->id}}" data-myname="{{$dir->name_of_folder}}"  class="btn btn-primary btn-rounded" data-toggle="modal" data-target="#exampleModal" data-whatever="@mdo"><i class="fa fa-edit" aria-hidden="true"></i></button>
                                <a href="/dir-delete/{{$dir->name_of_folder}}" class="btn btn-danger btn-rounded "><i class="fa fa-trash" aria-hidden="true"></i></a></td>
                                
                            </tr>
                        @empty
                       <li>Oops no Directory, Create Directory</li>
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
        <form action="/dir-rename" method="post" enctype="multipart/form-data">
          @csrf
          <div class="form-group">
            <input type="hidden" name="id" class="form-control" id="id">
          </div>
          <div class="form-group">
            <input type="text" name="folder" class="form-control" id="folder">
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