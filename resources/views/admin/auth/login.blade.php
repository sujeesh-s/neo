@extends('layouts.master2')
@section('css')
<style> #adminLogin .error{ color: #fff; }</style>
@endsection
@section('content')
<div class="page">
    <div class="page-content">
        <div class="container">
            <div class="row align-items-center justify-content-center">
                <div class="col-md-6">
                    <div class="">
                        <div class="text-white">
                            <div class="card-body">
                                <h2 class="display-4 mb-2 font-weight-bold error-text text-center"><strong>{{ config('settings.app_name') }} Login</strong></h2>
                                <h4 class="text-white-80 mb-7 text-center">Sign In to your account</h4>
                                <form method="POST" id="adminLogin" action="{{ url('admin/login') }}">
                                    @csrf
                                    <div class="row">
                                        <div class="col-9 d-block mx-auto">
                                            <div class="input-group mb-4">
                                                <div class="input-group-prepend">
                                                    <div class="input-group-text">
                                                        <i class="fe fe-user"></i>
                                                    </div>
                                                </div>
                                                <input type="email" name="email" class="form-control" placeholder="Email" required="">
                                                @error('email')
                                                <span class="invalid-feedback" role="alert">
                                                <strong>{{ $message }}</strong>
                                                </span>
                                                @enderror
                                            </div>
                                            <div class="input-group mb-4">
                                                <div class="input-group-prepend">
                                                    <div class="input-group-text">
                                                        <i class="fe fe-lock"></i>
                                                    </div>
                                                </div>
                                                <input type="password" name="password" class="form-control" placeholder="Password" required="">
                                                @error('password')
                                                <span class="invalid-feedback" role="alert">
                                                <strong>{{ $message }}</strong>
                                                </span>
                                                @enderror
                                               
                                            </div>
                                            <div class="input-group mb-4">
                                              
                                             <div class="error tac fw" role="alert">
                                                    <strong>{{ Session::get('message')}}</strong>
                                                </div>
                                               
                                            </div>
                                            <div class="row">
                                                <div class="col-12">
                                                    <label class="custom-control custom-checkbox">
                                                    <input class="custom-control-input" type="checkbox" name="remember" id="remember" {{ old('remember') ? 'checked' : '' }}>
                                                    <label class="custom-control-label" for="remember" >
                                                    {{ __('Remember Me') }}
                                                    </label>
                                                    </label>
                                                </div>
                                            </div>
                                            <div class="row">
                                                <div class="col-12">
                                                    <button type="submit" class="btn btn-secondary btn-block px-4" style="background:#fff; color:#ff0000 !important; padding:10px;">Login</button>
                                                </div>
                                                <div class="col-12 text-center">
                                                    <a href="{{ url('/password/reset')}}" class="btn btn-link box-shadow-0 px-0 text-white-80">Forgot password?</a>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </form>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
@section('js')
@endsection