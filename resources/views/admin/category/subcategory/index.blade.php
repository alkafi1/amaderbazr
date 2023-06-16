@extends('layouts.admin_layout')

@section('admin_content')
<div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
      <div class="container-fluid">
        <div class="row mb-2">
          <div class="col-sm-6">
            <h1>Sub Category</h1>
          </div>
          <div class="col-sm-6">
            <ol class="breadcrumb float-sm-right">
                <button class="btn btn-primary" data-toggle="modal" data-target="#categoryModal">+ Add Sub Ctegory</button>
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
                <h3 class="card-title">All Sub Categories Here</h3>
              </div>
              <!-- /.card-header -->
              <div class="card-body">
                <table id="example1" class="table table-bordered table-hover">
                  <thead>
                  <tr>
                    <th>SL</th>
                    <th>Category Name</th>
                    <th>SubCategory Name</th>
                    <th>SubCategory Slug</th>
                    <th>SubCategory Image</th>
                    <th>Action</th>
                  </tr>
                  </thead>
                  <tbody>
                    @foreach ($subcategories as $key=>$subcategory )
                    <tr>
                      <td>{{$key+1}}</td>
                      <td>{{$subcategory->name}}</td>
                      <td>{{$subcategory->subcategory_name}}</td>
                      <td>{{$subcategory->slug}}</td>
                      <td>
                        <img  width="100" src="{{ asset('/uploads/categories/subcategory')}}/{{ $subcategory->image }}" alt="" srcset="">
                    </td>
                      <td>
                        <a href="" class="btn btn-info btn-sm" id="edit" data-id= {{$subcategory->id}} data-toggle="modal" data-target="#editModal"> <i class="fas fa-edit"></i></a>
                        <a href="{{route('subcategory.delete',$subcategory->id)}}" class="btn btn-danger btn-sm" id="delete"><i class="fas fa-trash"></i></a>
                      </td>
                    </tr>
                        
                    
                  @endforeach
                  </tbody>
                  <tfoot>
                  <tr>
                    <th>SL</th>
                    <th>Category Name</th>
                    <th>SubCategory Name</th>
                    <th>SubCategory Slug</th>
                    <th>SubCategory Image</th>
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
          <h5 class="modal-title" id="exampleModalLabel">Add Sub Category</h5>
          <button type="button" class="close" data-dismiss="modal" aria-label="Close">
            <span aria-hidden="true">&times;</span>
          </button>
        </div>
        <form  method="POST" action="{{route('subcategory.store')}}" enctype="multipart/form-data">
            @csrf
        <div class="modal-body">
            
                <div class="form-group">
                  <label for="exampleInputEmail1">Select Category</label>
                  <select class="form-control" name="category_id" id="">
                    <option value="">-- Select Category --</option>
                    @foreach ($categories as $key=>$category)
                    <option value="{{$category->id}}">{{$category->name}}</option>
                    @endforeach
                    
                  </select>
                </div>
                <div class="form-group">
                  <label for="exampleInputEmail1">SubCategory Name</label>
                  <input type="text" class="form-control"  name="name" value="">
                </div>
                <div class="form-group">
                  <label for="exampleInputPassword1">SubCategory Image</label>
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
          <h5 class="modal-title" id="exampleModalLabel">SubCategory Edit</h5>
          <button type="button" class="close" data-dismiss="modal" aria-label="Close">
            <span aria-hidden="true">&times;</span>
          </button>
        </div>
        <div id="modal-body">

        </div>
        
                
                {{-- <div class="form-check">
                  <input type="checkbox" class="form-check-input" id="exampleCheck1">
                  <label class="form-check-label" for="exampleCheck1">Check me out</label>
                </div> --}}
                {{-- <button type="submit" class="btn btn-primary">Submit</button> --}}
              
        </div>
        
    
      </div>
    </div>
  </div>
  <script src = "https://ajax.googleapis.com/ajax/libs/jquery/2.1.3/jquery.min.js"> </script>
   <script type="text/javascript">
        $('body').on('click','#edit',function(){
            let id = $(this).data('id');
            $.get('subcategory/edit/'+id,function(data){
              
              $('#modal-body').html(data);
            })
        });
         
      </script>
@endsection