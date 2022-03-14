@extends('layouts.master2')
@section('css')
<link rel="stylesheet" href="{{URL::asset('admin/assets/css/toastr.min.css')}}" />
@endsection
@section('content')
<div class="login-4">
   <div class="container-fluid">
      <div class="row">
         <div class="col-xl-5 col-lg-5 col-md-12 bg-color-10">
            <div class="form-section">
               <div class="logo clearfix">
                  <a href="login-4.html">
                  <img src="{{URL::asset('admin/assets/images/logo.png')}}" alt="logo">
                  </a>
               </div>
               <h3>Sign Into Your Account</h3>
               <div class="login-inner-form">
                  <form method="POST" action="{{ url('organization/login') }}" id="sellerlogin">
                  	@csrf
                     <div class="form-group form-box">
                        <input type="email" name="email" class="form-control" placeholder="Email Address" aria-label="Email Address" required>
                        <i class="flaticon-mail-2"></i>
                        @error('email')
                        <span class="invalid-feedback" role="alert">
                        <strong>{{ $message }}</strong>
                        </span>
                        @enderror
                     </div>
                     <div class="form-group form-box">
                        <input type="password" name="password" class="form-control" autocomplete="off" placeholder="Password" aria-label="Password" required>
                        <i class="flaticon-password"></i>
                        @error('password')
                        <span class="invalid-feedback" role="alert">
                        <strong>{{ $message }}</strong>
                        </span>
                        @enderror
                        <div class="error tac fw pt-2" role="alert">
                           <strong>{{ Session::get('message')}}</strong>
                        </div>
                     </div>
                     <div class="checkbox form-group form-box">
                        <div class="form-check checkbox-theme">
                           <input class="form-check-input" type="checkbox" value="" id="rememberMe">
                           <label class="form-check-label" for="rememberMe">
                           Remember me
                           </label>
                        </div>
                        <a href="{{ url('/password/reset')}}" >Forgot passsword?</a>
                     </div>
                     <div class="form-group">
                        <!-- <button type="button" onclick="location.href='index.html';" value="index.html" class="btn-md btn-theme w-50">Sign In</button> -->
                        <button type="submit" class="btn-md btn-theme w-50">Sign In</button>
                     </div>
                  </form>
               </div>
               <p>Don't have an account? Select a package and<a href="#" class="thembo"> <b style="color: #094d99;">Sign Up</b></a></p>
            </div>
         </div>
         <div class="col-xl-7 col-lg-7 col-md-12 bg-img none-992">
            <div class="info">
               <h1><span>Welcome to</span> Mailo</span></h1>
               <p>Lorem Ipsum is simply dummy text of the printing and typesetting industry. Lorem Ipsum has been the industry's standard dummy text ever since the 1500s, when an unknown printer took a galley of type and scrambled it to make a type specimen book.  make a type specimen book.  make a type specimen book.</p>
            </div>
         </div>
      </div>
   </div>
</div>

<style>
   #sellerlogin .error  {
        color:#f22828;
    }        
</style>

@endsection
@section('js')
<script src="{{URL::asset('admin/assets/js/toastr.min.js')}}"></script>
<script type="text/javascript">
   $(document).ready(function(){ 
       @if(Session::has('success')) toastr.success("{{ Session::get('success')}}"); 
       @elseif(Session::has('error')) toastr.error("{{ Session::get('error')}}");  @endif 
   });
</script>
@endsection

