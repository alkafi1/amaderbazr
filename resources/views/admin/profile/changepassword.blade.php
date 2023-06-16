@extends('layouts.admin_layout')

@section('admin_content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8 mt-5">
            <div class="card card-outline card-primary mt-5">
                <div class="card-header text-center">
                  <a href="../../index2.html" class="h1"><b>Amader</b>Bazar</a>
                </div>
                <div class="card-body">
                  
                  <form action="{{route('admin.password_update')}}" method="post">
                    @csrf
                    <div class="input-group mb-3">
                      <input id="password" type="password" class="form-control @error('c_password') is-invalid @enderror" name="c_password" required autocomplete="current-password" placeholder="Current Password">
                                @error('password')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                      <div class="input-group-append">
                        <div class="input-group-text">
                          <span class="fas fa-key"></span>
                        </div>
                      </div>
                    </div>
                    <div class="input-group mb-3">
                      <input id="password" type="password" class="form-control " name="password" required autocomplete="current-password" placeholder="New Password">
                      <div class="input-group-append">
                        <div class="input-group-text">
                          <span class="fas fa-key"></span>
                        </div>
                      </div>
                    </div>
                    <div class="input-group mb-3">
                      <input id="" type="password" class="form-control @error('password') is-invalid @enderror" name="password_confirmation" required autocomplete="current-password" placeholder="Confirm Password">
                      <div class="input-group-append">
                        <div class="input-group-text ">
                          <span class="fas fa-key"></span>
                        </div>
                      </div>
                    </div>
                    <div class="row">
                      <div class="col-12">
                        <button type="submit" class="btn btn-primary btn-block">Change password</button>
                      </div>
                      <!-- /.col -->
                    </div>
                  </form>
                  <p class="login-box-msg mt-5">You forgot your password? Here you can easily retrieve a new password.</p>
                </div>
                <!-- /.login-card-body -->
            </div>
        </div>
    </div>
</div>
@endsection