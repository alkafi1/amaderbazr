@extends('layouts.admin_layout')

@section('admin_content')

    
    <div class="content-wrapper">
        <!-- Content Header (Page header) -->
        <section class="content-header">
          <div class="container-fluid">
            <div class="row mb-2">
              <div class="col-sm-6">
                <h1>SEO</h1>
              </div>
              <div class="col-sm-6">
                <ol class="breadcrumb float-sm-right">
                    <button class="btn btn-primary" data-toggle="modal" data-target="#categoryModal">+ Add New</button>
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
                          <h3 class="card-title">Your SEO Setting</h3>
                        </div>
                        <!-- /.card-header -->
                        <!-- form start -->
                        <form action="{{route('seo.update',$seos->id)}}" method="POST">
                            @csrf
                          <div class="card-body">
                            <div class="form-group">
                              <label for="exampleInputEmail1">Meta Title</label>
                              <input type="text" class="form-control" name="meta_title" placeholder="Enter Meta title" value="{{$seos->meta_title}}">
                            </div>
                            <div class="form-group">
                              <label for="exampleInputPassword1">Meta author</label>
                              <input type="text" class="form-control" name="meta_author" placeholder="Enter Meta Author" value="{{$seos->meta_author}}">
                            </div>
                            <div class="form-group">
                              <label for="exampleInputPassword1">Meta Tag</label>
                              <input type="text" class="form-control" name="meta_tag" placeholder="Enter Meta Tag" value="{{$seos->meta_tag}}">
                            </div>
                            <div class="form-group">
                                <label for="exampleInputPassword1">Meta Keyword</label>
                                <input type="text" class="form-control" name="meta_keyword" placeholder="Enter Meta Keyword" value="{{$seos->meta_keyword}}">
                                <small>Example:ecommerce,online,shop,productname</small>
                            </div>
                            <div class="form-group">
                              <label for="exampleInputPassword1">Meta Description</label>
                              <textarea id="summernote" class="form-control #textarea" name="meta_description" placeholder="Enter Meta Description">{{$seos->meta_description}}</textarea>
                            </div>
                            <hr>
                            <strong>-- Others --</strong>
                            <hr>
                            <div class="form-group">
                                <label for="exampleInputPassword1">Google Varification</label>
                                <input type="text" class="form-control" name="googel_varification" placeholder="Enter Googel varification" value="{{$seos->googel_varification}}">
                            </div>
                            <div class="form-group">
                                <label for="exampleInputPassword1">Google Analytics</label>
                                <input type="text" class="form-control" name="google_analytics" placeholder="Enter Googel Analytics" value="{{$seos->google_analytics}}">
                            </div>
                            <div class="form-group">
                                <label for="exampleInputPassword1">Google Adsense</label>
                                <input type="text" class="form-control" name="google_adsense" placeholder="Enter Googel Adsense" value="{{$seos->google_adsense}}">
                            </div>
                            <div class="form-group">
                                <label for="exampleInputPassword1">Alexa Varification</label>
                                <input type="text" class="form-control" name="alexa_varification" placeholder="Enter Googel varification" value="{{$seos->alexa_verification}}">
                            </div>
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