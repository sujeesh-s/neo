@extends('layouts.admin')
@section('css')
<!-- INTERNAl alert css -->
<link href="{{URL::asset('admin/assets/plugins/sweet-alert/jquery.sweet-modal.min.css')}}" rel="stylesheet" />
<link href="{{URL::asset('admin/assets/plugins/sweet-alert/sweetalert.css')}}" rel="stylesheet" />
<!--INTERNAL Select2 css -->
<link href="{{URL::asset('admin/assets/plugins/select2/select2.min.css')}}" rel="stylesheet" />
<!-- INTERNAL File Uploads css -->
<link href="{{URL::asset('admin/assets/plugins/fancyuploder/fancy_fileupload.css')}}" rel="stylesheet" />
<!-- INTERNAL File Uploads css-->
<link href="{{URL::asset('admin/assets/plugins/fileupload/css/fileupload.css')}}" rel="stylesheet" type="text/css" />
@endsection
@section('page-header')
<!--Page header-->
<div class="page-header">
    <div class="page-leftheader">
        <h4 class="page-title mb-0">{{ $title }}</h4>
        <ol class="breadcrumb">
            <li class="breadcrumb-item"><a href="{{ url('/admin/customer') }}"><i class="fe fe-grid mr-2 fs-14"></i>Users</a></li>
            <li class="breadcrumb-item active" aria-current="page"><a href="#">{{ $title }}</a></li>
        </ol>
    </div>
    <div class="page-rightheader">
    </div>
</div>
<!--End Page header-->
@endsection
@section('content')
<!--/app header-->
<div class="main-proifle">
    <div class="row">
        <div class="col-lg-7">
            <div class="box-widget widget-user">
                <div class="widget-user-image1 d-sm-flex">
                    @if($info->profile_image!='')
                    <img alt="User Avatar" class="rounded-circle border p-0" style="width:128px;height:128px;" src="{{ config('app.storage_url').'/app/public/customer_profile/'.$info->profile_image }}">
                    @else
                    <img alt="User Avatar" class="rounded-circle border p-0" src="{{URL::asset('admin/assets/images/users/2.jpg')}}">
                    @endif
                    <div class="mt-1 ml-lg-5">
                        @php 
                        $cust_id = date('y',strtotime($customer_mst->created_at)).date('m',strtotime($customer_mst->created_at)).str_pad($customer_mst->id, 6, "0", STR_PAD_LEFT); @endphp
                        <h4 class="pro-user-username mb-3 font-weight-bold">
                            {{ $info->first_name." ".$info->middle_name." ".$info->last_name }} <i class="fa fa-check-circle text-success"></i> <br>
                            <p class="pt-2" style="font-size:13px;">( {{ "#".$cust_id }}  )</p>
                        </h4>
                        <ul class="mb-0 pro-details">
                            @foreach($telecom as $tele)
                            @if($tele->usr_telecom_typ_id==2)
                            <li><span class="profile-icon"><i class="fe fe-phone-call"></i></span><span class="h6 mt-3">{{ $tele->usr_telecom_value }}</span></li>
                            @endif
                            @if($tele->usr_telecom_typ_id==1)
                            <li><span class="profile-icon"><i class="fe fe-mail"></i></span><span class="h6 mt-3">{{ $tele->usr_telecom_value }}</span></li>
                            @endif
                            @endforeach
                            <li><span class="profile-icon"><i class="fe fe-calendar"></i></span><span class="h6 mt-3">{{date('d M Y',strtotime($customer_mst->created_at))}}</span></li>
                            <li><span class="profile-icon"><i class="fe fe-globe"></i></span>@if($customer_mst->is_active==1)<span class="h6 mt-3 badge badge-primary">{{"Active"}}</span>@endif @if($customer_mst->is_active==0)<span class="h6 mt-3 badge badge-pill badge-danger" style="color:white">{{"Inactive"}}</span>@endif</li>
                        </ul>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <div class="profile-cover">
        <div class="wideget-user-tab">
            <div class="tab-menu-heading p-0">
                <div class="tabs-menu1 px-3">
                </div>
            </div>
        </div>
    </div>
    <!-- /.profile-cover -->
</div>
</div>
</div><!-- end app-content-->
</div>
<!-- Modal change password -->
<div id="changepwd" class="modal fade" role="dialog">
    <div class="modal-dialog">
        <!-- Modal content-->
        <div class="modal-content">
            <div class="modal-header">
                <h3 class="modal-title text-center">Change Password</h3>
                <button type="button" class="close" data-dismiss="modal">×</button>
            </div>
            <div class="modal-body" style="overflow: hidden;">
                <div class="alert alert-danger" role="alert" style="display: none">
                </div>
                <div class="col-md-offset-1 col-md-12">
                    <form method="POST" id="changepwd" enctype="multipart/form-data">
                        @csrf
                        <div class="row">
                            <div class="col-md-12">
                                <div class="form-group has-feedback">
                                    <label class= "form-label">New password<span class="text-red">*</span></label>
                                    <input type="text" name="password" id="password" class="form-control" placeholder="New Password">
                                </div>
                                <div class="form-group has-feedback">
                                    <label class= "form-label">Confirm password<span class="text-red">*</span></label>
                                    <input type="text" name="c_password" id="c_password"  class="form-control" placeholder="Confirm Password">
                                </div>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
<!-- Modal regsiter -->
<div id="SignUp" class="modal fade" role="dialog">
    <div class="modal-dialog modal-lg">
        <!-- Modal content-->
        <div class="modal-content">
            <div class="modal-header">
                <h3 class="modal-title text-center">Edit Profile</h3>
                <button type="button" class="close" data-dismiss="modal">×</button>
            </div>
            <div class="modal-body" style="overflow: hidden;">
                <div class="alert alert-danger" role="alert" style="display: none">
                </div>
                {{-- 
                <div id="success-msg" class="" style="">
                    <div class="alert alert-info alert-dismissible fade in" role="alert">
                        <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                        <span aria-hidden="true">×</span>
                        </button>
                        <strong>Success!</strong> Check your mail for login confirmation!!
                    </div>
                </div>
                --}}
                <div class="col-md-offset-1 col-md-12">
                    <form method="POST" id="editprofile" action="{{url('admin/customer/update-profile/'.$customer_mst->id)}}" name="editprofile" enctype="multipart/form-data">
                        @csrf
                        <div class="row">
                            <div class="col-md-6 col-lg-6">
                                <div class="form-group has-feedback">
                                    <label class= "form-label">First Name<span class="text-red">*</span></label>
                                    <input type="text" name="first_name"  id="first_name" value="{{ $info->first_name }}" class="form-control" placeholder="First name">
                                </div>
                                <div class="form-group has-feedback">
                                    <label class= "form-label">Last Name<span class="text-red">*</span></label>
                                    <input type="text" name="last_name" id="last_name" value="{{ $info->last_name }}" class="form-control" placeholder="Last name">
                                </div>
                                <div class="form-group has-feedback">
                                    <label class= "form-label">Status<span class="text-red">*</span></label>
                                    <select class="form-control select2" id="status" name="status">
                                    <option value="1" @if($info->is_active==1){{ "selected" }}@endif>Active</option>
                                    <option value="0" @if($info->is_active==0){{ "selected" }}@endif>Inactive</option>
                                    </select>
                                </div>
                            </div>
                            <div class="col-md-6 col-lg-6">
                                @foreach($telecom as $tele)
                                @if($tele->usr_telecom_typ_id==1)
                                <div class="form-group has-feedback">
                                    <label class= "form-label">Email<span class="text-red">*</span></label>
                                    <input type="email" name="email" id="email" value="{{ $tele->usr_telecom_value }}" class="form-control" placeholder="Email">
                                </div>
                                @endif
                                @if($tele->usr_telecom_typ_id==2 && isset($tele->usr_telecom_value))
                                <div class="form-group has-feedback">
                                    <label class= "form-label">Contact Number<span class="text-red">*</span></label>
                                    <input type="number" name="number" id="number" min="0" value="{{ $tele->usr_telecom_value }}" class="form-control" placeholder="Contact number">
                                </div>
                                @endif
                                @endforeach
                                <div class="form-group has-feedback">
                                    <label class="form-label">Profile Image <span class="text-red"></span></label>
                                    <input type="file" id="profile_img" class="form-control" accept=".jpg, .png, image/jpeg, image/png"  name="profile_img" />
                                </div>
                            </div>
                            <!---col--->
                        </div>
                        <!---row-->
                        <div class="row">
                            <div class="col-xs-12 col-md-12 justify-content-end">
                                <button type="submit" id="submitForm" class="btn btn-primary btn-prime white btn-flat fr">Save</button>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
<input type="hidden" id="ord_dt" value="0">
@endsection
@section('js')
<!--INTERNAL Select2 js -->
<script src="{{URL::asset('admin/assets/plugins/select2/select2.full.min.js')}}"></script>
<script src="{{URL::asset('admin/assets/js/select2.js')}}"></script>
<!-- INTERNAL Popover js -->
<script src="{{URL::asset('admin/admin/assets/js/popover.js')}}"></script>
<!-- INTERNAL Sweet alert js -->
<script src="{{URL::asset('admin/assets/plugins/sweet-alert/jquery.sweet-modal.min.js')}}"></script>
<script src="{{URL::asset('admin/assets/plugins/sweet-alert/sweetalert.min.js')}}"></script>
<script src="{{URL::asset('admin/assets/js/sweet-alert.js')}}"></script>
<script src="{{URL::asset('admin/assets/js/jquery.validate.min.js')}}"></script>
<!-- INTERNAl Data tables -->
<!--<script src="{{URL::asset('admin/assets/js/datatable/tables/ordertable-datatable.js')}}"></script>-->
<script type="text/javascript">
    var myLink = document.getElementById('ord_hist');
    
        myLink.onclick = function(){
            var ord_dt = $('#ord_dt').val();
            var script = document.createElement("script");
            script.type = "text/javascript";
            script.src = "{{URL::asset('admin/assets/js/datatable/tables/ordertable-datatable.js')}}"; 
            if (  ord_dt == 0 ) {
            $('#ord_dt').val(1);
            document.getElementsByTagName("head")[0].appendChild(script);
            }
            return false;
        }
        
    
    
    
    	$(document).ready(function(){
    jQuery.validator.addMethod("lettersonly", function(value, element) {
      return this.optional(element) || /^[a-z ]+$/i.test(value);
    }, "Please enter valid name."); 
    
     $('body').on('click', '#submitForm', function(e){
         
    
    $("#editprofile").validate({
        
    rules: {
    
    first_name : {
    required: true,
    lettersonly: true 
    },
    
    last_name: {
    required: true,
    lettersonly: true
    },
    number: {
    required: true,
    number: true,
    minlength:7,
    maxlength:15
    },
    email : {
    required: true,
    email: true,
    },
    
    
    
    },
    
    messages : {
    first_name: {
    required: "First Name is required."
    },
    last_name: {
    required: "Last Name is required."
    },
    number: {
    required: "Contact Number is required.",
    minlength: "Contact Number is invalid",
    maxlength: "Contact Number is invalid"
    },
    email: {
    required: "Email is required."
    },
    password: {
    required: "Password is required.",
    minlength: "Password must be greater than 8 digits.",
    maxlength: "Password must be less than 20 digits."
    },
    
    
    },
    
    });
    });
    
    });
    
     $(document).ready(function(){
                @if(Session::has('message'))
                @if(session('message')['type'] =="success")
                
                toastr.success("{{session('message')['text']}}"); 
                @else
                toastr.error("{{session('message')['text']}}"); 
                @endif
                @endif
                
                @if ($errors->any())
                @foreach ($errors->all() as $error)
                toastr.error("{{$error}}"); 
                
                @endforeach
                @endif
        });
</script>
@endsection

