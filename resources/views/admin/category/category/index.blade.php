@extends('layouts.admin_layout')

@section('admin_content')
<div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
      <div class="container-fluid">
        <div class="row mb-2">
          <div class="col-sm-6">
            <h1>Category</h1>
          </div>
          <div class="col-sm-6">
            <ol class="breadcrumb float-sm-right">
                <button class="btn btn-primary" data-toggle="modal" data-target="#categoryModal">+ Add CAtegory</button>
            </ol>
          </div>
          
        </div>
      </div><!-- /.container-fluid -->
    </section>

    <!-- Main content -->
    <section class="content">
      <div class="container-fluid">
        <div class="row">
          <div class="col-12">
            <div class="card">
              <div class="card-header">
                <h3 class="card-title">All Categories Here</h3>
              </div>
              <!-- /.card-header -->
              <div class="card-body">
                <table id="example1" class="table table-bordered table-hover">
                  <thead>
                  <tr>
                    <th>SL</th>
                    <th>Category Name</th>
                    <th>Category Slug</th>
                    <th>Category Image</th>
                    <th>Action</th>
                  </tr>
                  </thead>
                  <tbody>
                    @foreach ($categories as $key=>$category )
                    <tr>
                      <td>{{$key+1}}</td>
                      <td>{{$category->name}}</td>
                      <td>{{$category->slug}}</td>
                      <td>
                        <img  width="100" src="{{ asset('/uploads/categories/category')}}/{{ $category->image }}" alt="" srcset="">
                    </td>
                      <td>
                        <a href="" class="btn btn-info btn-sm" id="edit" data-id= {{$category->id}} data-toggle="modal" data-target="#editModal"> <i class="fas fa-edit"></i></a>
                        <a href="{{route('category.delete',$category->id)}}" class="btn btn-danger btn-sm" id="delete"><i class="fas fa-trash"></i></a>
                      </td>
                    </tr>
                        
                    
                  @endforeach
                  </tbody>
                  <tfoot>
                  <tr>
                    <th>SL</th>
                    <th>Category Name</th>
                    <th>Category Slug</th>
                    <th>Category Image</th>
                    <th>Action</th>
                  </tr>
                  </tfoot>
                </table>
              </div>
              <!-- /.card-body -->
            </div>
            
          </div>
          <!-- /.col -->
        </div>
        <!-- /.row -->
      </div>
      <!-- /.container-fluid -->
    </section>
    <!-- /.content -->
  </div>
{{-- category modal --}}
  <div class="modal fade" id="categoryModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog" role="document">
      <div class="modal-content">
        <div class="modal-header">
          <h5 class="modal-title" id="exampleModalLabel">Add Category</h5>
          <button type="button" class="close" data-dismiss="modal" aria-label="Close">
            <span aria-hidden="true">&times;</span>
          </button>
        </div>
        <form  method="POST" action="{{route('category.store')}}" enctype="multipart/form-data">
            @csrf
        <div class="modal-body">
            
                <div class="form-group">
                  <label for="exampleInputEmail1">Category Name</label>
                  <input type="text" class="form-control"  name="name" placeholder="Enter Category NAme">
                  <small  class="form-text text-muted">This is Your Main CAtegory</small>
                </div>
                <div class="form-group">
                  <label for="exampleInputPassword1">Category Image</label>
                  <img id="pic" width="100" class="float-right mt-2">
                  <input type="file" class="form-control" name="image"  oninput="pic.src=window.URL.createObjectURL(this.files[0])">
                  
                </div>
                {{-- <div class="form-check">
                  <input type="checkbox" class="form-check-input" id="exampleCheck1">
                  <label class="form-check-label" for="exampleCheck1">Check me out</label>
                </div> --}}
                {{-- <button type="submit" class="btn btn-primary">Submit</button> --}}
              
        </div>
        <div class="modal-footer">
          <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
          <button type="submit" class="btn btn-primary">Submit</button>
        </div>
    </form>
      </div>
    </div>
  </div>

  {{-- edit modal --}}
  <div class="modal fade" id="editModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog" role="document">
      <div class="modal-content">
        <div class="modal-header">
          <h5 class="modal-title" id="exampleModalLabel">Category Edit</h5>
          <button type="button" class="close" data-dismiss="modal" aria-label="Close">
            <span aria-hidden="true">&times;</span>
          </button>
        </div>
        <form  method="POST" action="{{route('category.update')}}" enctype="multipart/form-data">
            @csrf
        <div class="modal-body">
                <div class="form-group">
                  <label for="exampleInputEmail1">Category Name</label>
                  <input type="text" class="form-control e_name"  name="name">
                  <input type="hidden" class="form-control e_id"  name="id">
                  <small  class="form-text text-muted">This is Your Main CAtegory</small>
                </div>
                <div class="form-group">
                  <label for="exampleInputPassword1">Category Image</label>
                  <img id="pic" width="100" class="float-right mt-2 e_image" src="">
                  <input type="file" class="form-control" name="image"  oninput="pic.src=window.URL.createObjectURL(this.files[0])">
                  
                </div>
                {{-- <div class="form-check">
                  <input type="checkbox" class="form-check-input" id="exampleCheck1">
                  <label class="form-check-label" for="exampleCheck1">Check me out</label>
                </div> --}}
                {{-- <button type="submit" class="btn btn-primary">Submit</button> --}}
              
        </div>
        <div class="modal-footer">
          <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
          <button type="submit" class="btn btn-primary">Save And Changes</button>
        </div>
    </form>
      </div>
    </div>
  </div>
  <script src = "https://ajax.googleapis.com/ajax/libs/jquery/2.1.3/jquery.min.js"> </script>
   <script type="text/javascript">
        $('body').on('click','#edit',function(){
            let id = $(this).data('id');
            $.get('category/edit/'+id,function(data){
                $('.e_name').val(data.name); 
                $('.e_id').val(data.id); 
                var path = 'uploads/categories/category/'+data.image;
                $('.e_image').attr('src',path); 
            })
        });
         
      </script>
@endsection