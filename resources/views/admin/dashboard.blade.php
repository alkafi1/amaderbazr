@extends('layouts.admin_layout')

@section('admin_content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header">{{ __('Admin Dashboard') }}</div>

                <div class="card-body">
                    @if (session('status'))
                        <div class="alert alert-success" role="alert">
                            abcvyhvhvihv
                        </div>
                    @endif

                    {{ __('You are logged in! ') }}
                </div>
            </div>
        </div>
    </div>
</div>
@endsection