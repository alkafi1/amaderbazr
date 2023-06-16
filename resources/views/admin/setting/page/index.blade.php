@extends('layouts.admin_layout')

@section('admin_content')
<div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
      <div class="container-fluid">
        <div class="row mb-2">
          <div class="col-sm-6">
            <h1>Pages</h1>
          </div>
          <div class="col-sm-6">
            <ol class="breadcrumb float-sm-right">
              <a href="{{route('page.create')}}">  <button class="btn btn-primary">+ Add Page</button> </a>
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
                <h3 class="card-title">All Pages Here</h3>
              </div>
              <!-- /.card-header -->
              <div class="card-body">
                <table id="example1" class="table table-bordered table-hover">
                  <thead>
                  <tr>
                    <th>SL</th>
                    <th>Page Name</th>
                    <th>Page Title</th>
                    <th>Action</th>
                  </tr>
                  </thead>
                  <tbody>
                    @foreach ($pages as $key=>$page )
                    <tr>
                      <td>{{$key+1}}</td>
                      <td>{{$page->page_name}}-{{$page->id}}</td>
                      <td>{{$page->page_title}}</td>
                      <td>
                        <a href="{{route('page.edit',$page->id)}}" class="btn btn-info btn-sm"> <i class="fas fa-edit"></i></a>
                        <a href="{{route('page.delete',$page->id)}}" class="btn btn-danger btn-sm" id="delete"><i class="fas fa-trash"></i></a>
                      </td>
                    </tr>
                        
                    
                  @endforeach
                  </tbody>
                  <tfoot>
                  <tr>
                    <th>SL</th>
                    <th>Page Name</th>
                    <th>Page Title</th>
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

@endsection