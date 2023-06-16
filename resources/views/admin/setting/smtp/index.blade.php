@extends('layouts.admin_layout')

@section('admin_content')

    
    <div class="content-wrapper">
        <!-- Content Header (Page header) -->
        <section class="content-header">
          <div class="container-fluid">
            <div class="row mb-2">
              <div class="col-sm-6">
                <h1>SMTP</h1>
              </div>
              <div class="col-sm-6">
                <ol class="breadcrumb float-sm-right">
                    {{-- <button class="btn btn-primary" data-toggle="modal" data-target="#categoryModal">+ Add New</button> --}}
                </ol>
              </div>
              
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
                          <h3 class="card-title">Your SMTP Setting</h3>
                          <small>Mailer Seeting</small>
                        </div>
                        <!-- /.card-header -->
                        <!-- form start -->
                        <form action="{{route('smtp.update',$smtp->id)}}" method="POST">
                            @csrf
                          <div class="card-body">
                            <div class="form-group">
                              <label for="exampleInputEmail1">Mailer</label>
                              <input type="text" class="form-control" name="mailer" placeholder="Enter Meta Mailer" value="{{$smtp->mailer}}">
                            </div>
                            <div class="form-group">
                              <label for="exampleInputPassword1">Host</label>
                              <input type="text" class="form-control" name="host" placeholder="Enter Mailer Host" value="{{$smtp->host}}">
                            </div>
                            <div class="form-group">
                              <label for="exampleInputPassword1">Port</label>
                              <input type="text" class="form-control" name="port" placeholder="Enter Mailer Port" value="{{$smtp->port}}">
                            </div>
                            <div class="form-group">
                                <label for="exampleInputPassword1">User name</label>
                                <input type="text" class="form-control" name="user_name" placeholder="Enter User Name" value="{{$smtp->user_name}}">
                            </div>
                            <div class="form-group">
                                <label for="exampleInputPassword1">Password</label>
                                <input type="text" class="form-control" name="password" placeholder="Enter Password" value="{{$smtp->password}}">
                            </div>
                          <!-- /.card-body -->
          
                          <div class="card-footer">
                            <button type="submit" class="btn btn-primary">Update</button>
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