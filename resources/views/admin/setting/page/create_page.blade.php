@extends('layouts.admin_layout')

@section('admin_content')

    
    <div class="content-wrapper">
        <!-- Content Header (Page header) -->
        <section class="content-header">
          <div class="container-fluid">
            <div class="row mb-2">
              <div class="col-sm-6">
                <h1>Create Page</h1>
              </div>
              {{-- <div class="col-sm-6">
                <ol class="breadcrumb float-sm-right">
                    <button class="btn btn-primary" data-toggle="modal" data-target="#categoryModal">+ Add New</button>
                </ol>
              </div> --}}
              
            </div>
          </div><!-- /.container-fluid -->
        </section>
    
        <!-- Main content -->
        <section class="content">
          <div class="container-fluid">
            <div class="row">
                <div class="col-md-8 m-auto">
                    <div class="card card-primary">
                        <div class="card-header">
                          <h3 class="card-title">Create Page</h3>
                        </div>
                        <!-- /.card-header -->
                        <!-- form start -->
                        <form action="{{route('page.store')}}" method="POST">
                            @csrf
                          <div class="card-body">
                            <div class="form-group">
                              <label for="exampleInputEmail1">Page Position</label>
                              <select name="page_position" id="" class="form-control">
                                <option value="1">Line 1</option>
                                <option value="2">Line 2</option>
                              </select>
                            </div>
                            <div class="form-group">
                              <label for="exampleInputPassword1">Page Name</label>
                              <input type="text" class="form-control" name="page_name" placeholder="Enter Page Name">
                            </div>
                            <div class="form-group">
                              <label for="exampleInputPassword1">Page Title</label>
                              <input type="text" class="form-control" name="page_title" placeholder="Enter Page Title">
                            </div>
                            
                            <div class="form-group">
                              <label for="exampleInputPassword1">Page Description</label>
                              <textarea id="summernote" class="form-control #textarea" name="page_description"></textarea>
                            </div>
                            
                          </div>
                          <!-- /.card-body -->
          
                          <div class="card-footer">
                            <button type="submit" class="btn btn-primary">Create</button>
                          </div>
                        </form>
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

@endsection