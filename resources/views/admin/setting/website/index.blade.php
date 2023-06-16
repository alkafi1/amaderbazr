@extends('layouts.admin_layout')

@section('admin_content')

    
    <div class="content-wrapper">
        <!-- Content Header (Page header) -->
        <section class="content-header">
          <div class="container-fluid">
            <div class="row mb-2">
              <div class="col-sm-6">
                <h1>Website Settings</h1>
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
                          <h3 class="card-title">Website Setting</h3>
                        </div>
                        <!-- /.card-header -->
                        <!-- form start -->
                        <form action="{{route('website.update',$website_info->id)}}" method="POST" enctype="multipart/form-data">
                            @csrf
                          <div class="card-body">
                            <div class="form-group">
                              <label for="exampleInputEmail1">Currency</label>
                              <select name="currency" id="" class="form-control">
                                <option value="৳" {{(($website_info->currency =='৳')?'selected':'')}}>Taka</option>
                                <option value="$" {{(($website_info->currency =='$')?'selected':'')}}>USD</option>
                              </select>
                            </div>
                            <div class="form-group">
                              <label for="exampleInputPassword1">Phone Number 1</label>
                              <input type="text" class="form-control" name="phone_one" placeholder="Phone NUmber" value="{{$website_info->phone_one}}">
                            </div>
                            <div class="form-group">
                              <label for="exampleInputPassword1">Phone Number 1</label>
                              <input type="text" class="form-control" name="phone_two" placeholder="Phone Number" value="{{$website_info->phone_two}}">
                            </div>
                            <div class="form-group">
                              <label for="exampleInputPassword1">MAin Mail</label>
                              <input type="email" class="form-control" name="main_mail" placeholder="Phone Number" value="{{$website_info->main_mail}}">
                            </div>
                            <div class="form-group">
                              <label for="exampleInputPassword1">Support Mail</label>
                              <input type="email" class="form-control" name="support_mail" placeholder="Phone Number" value="{{$website_info->support_mail}}">
                            </div>
                            <div class="form-group">
                              <label for="exampleInputPassword1">Address </label>
                              <input type="text" class="form-control" name="address" placeholder="Phone Number" value="{{$website_info->address}}">
                            </div>
                            <div class="form-group">
                              <label for="exampleInputPassword1">Facebook Link </label>
                              <input type="text" class="form-control" name="facebook" placeholder="Phone Number" value="{{$website_info->facebook}}">
                            </div>
                            <div class="form-group">
                              <label for="exampleInputPassword1">Twitter Link </label>
                              <input type="text" class="form-control" name="twitter" placeholder="Phone Number" value="{{$website_info->twitter}}">
                            </div>
                            <div class="form-group">
                              <label for="exampleInputPassword1">Instagram Link </label>
                              <input type="text" class="form-control" name="instagram" placeholder="Phone Number" value="{{$website_info->instagram}}">
                            </div>
                            <div class="form-group">
                              <label for="exampleInputPassword1">LinkedIn Link </label>
                              <input type="text" class="form-control" name="linkedin" placeholder="Phone Number" value="{{$website_info->linkedin}}">
                            </div>
                            <div class="form-group">
                              <label for="exampleInputPassword1">Youtube Link </label>
                              <input type="text" class="form-control" name="youtube" placeholder="Phone Number" value="{{$website_info->youtube}}">
                            </div>
                            <div class="form-group">
                              <label for="exampleInputPassword1">Logo</label>
                              <img id="pic1" width="100" class="float-right mt-2 e_image" src="{{asset('uploads/logo')}}/{{$website_info->logo}}">
                              <input type="file" class="form-control" name="logo"  oninput="pic1.src=window.URL.createObjectURL(this.files[0])" value="{{$website_info->logo}}">
                            </div>
                            <div class="form-group">
                              <label for="exampleInputPassword1">Favicon</label>
                              <img id="pic" width="100" class="float-right mt-2 e_image" src="{{asset('uploads/logo')}}/{{$website_info->favicon}}">
                              <input type="file" class="form-control" name="favicon"  oninput="pic.src=window.URL.createObjectURL(this.files[0])" value="{{$website_info->favicon}}">
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