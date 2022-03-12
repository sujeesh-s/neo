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
<style type="text/css">
   .img {
   padding: 3px;
   }
</style>
@endsection
@section('page-header')
<!--Page header-->
<div class="page-header">
   <div class="page-leftheader">
      <h4 class="page-title mb-0">Edit Category</h4>
      <ol class="breadcrumb">
         <li class="breadcrumb-item"><a href="#"><i class="fe fe-grid mr-2 fs-14"></i>Master Settings</a></li>
         <li class="breadcrumb-item active" aria-current="page"><a href="{{ route('admin.category')}}">Category List</a></li>
         <li class="breadcrumb-item active" aria-current="page"><a href="#">Edit Category</a></li>
      </ol>
   </div>
   <div class="page-rightheader">
      <!-- <div class="btn btn-list">
         <a href="#" class="btn btn-info"><i class="fe fe-settings mr-1"></i> General Settings </a>
         <a href="#" class="btn btn-danger"><i class="fe fe-printer mr-1"></i> Print </a>
         <a href="#"  data-target="#user-form-modal" data-toggle="modal" class="btn btn-danger addmodule"><i class="fe fe-shopping-cart mr-1"></i> Add New</a>
         </div> -->
   </div>
</div>
<!--End Page header-->
@endsection
@section('content')
<!-- Row -->
<div class="row flex-lg-nowrap">
   <div class="col-12">
      <!--@if(Session::has('message'))-->
      <!--<div class="alert alert-{{session('message')['type']}}" role="alert"><button type="button" class="close" data-dismiss="alert" aria-hidden="true">×</button>{{session('message')['text']}}</div>-->
      <!--@endif-->
      <!--@if ($errors->any())-->
      <!--@foreach ($errors->all() as $error)-->
      <!--<div class="alert alert-danger" role="alert"><button type="button" class="close" data-dismiss="alert" aria-hidden="true">×</button>{{$error}}</div>-->
      <!--@endforeach-->
      <!--@endif-->
      <div class="row flex-lg-nowrap">
         <div class="col-12 mb-3">
            <div class="card">
               <div class="card-body">
                  <form action="{{url('admin/update-category/'.$category->category_id)}}" method="POST"  id="catForm" enctype="multipart/form-data">
                     @csrf
                     <?php  $default_lang =DB::table('glo_lang_lk')->where('is_active', 1)->first();
                        $category_name=DB::table('cms_content')->where('cnt_id', $category->cat_name_cid)->where('lang_id', $default_lang->id)->first();
                        $category_desc=DB::table('cms_content')->where('cnt_id', $category->cat_desc_cid)->where('lang_id', $default_lang->id)->first(); ?>
                     <input type="hidden" value="{{ $category->cat_name_cid }}" name="cat_content_id">
                     <input type="hidden" value="{{ $category->cat_desc_cid }}" name="desc_content_id">
                     <div class="row">
                        <div class="col-md-12">
                           <div class="form-group">
                              <label class="form-label">Select Language <span class="text-red">*</span></label>
                              <select class="form-control custom-select select2" name="language" required>
                                 @foreach ($language as $lang)
                                 <option value="{{ $lang->id }}" <?php if($category_name->lang_id==$lang->id){ echo "selected";}?>>{{ $lang->glo_lang_name }}</option>
                                 @endforeach
                              </select>
                           </div>
                        </div>
                        <div class="col-md-12">
                           <div class="form-group">
                              <label class="form-label">Category Name <span class="text-red">*</span></label>
                              <input type="text" class="form-control @error('category_name') is-invalid @enderror" placeholder="Category" name="category_name" value="{{ $category_name->content }}">
                              @error('category_name')
                              <span class="invalid-feedback" role="alert">
                              <strong>{{ $message }}</strong>
                              </span>
                              @enderror
                           </div>
                        </div>
                        <div class="col-md-12">
                           <div class="form-group">
                              <label class="form-label">Category Description <span class="text-red">*</span></label>
                              <!--<input type="text" class="form-control  @error('category_description') is-invalid @enderror" placeholder="Description" name="category_description" value="{{ $category_desc->content }}">-->
                              <textarea class="form-control @error('category_description') is-invalid @enderror" placeholder="Description"  name="category_description">{{ $category_desc->content }}</textarea>
                              @error('category_description')
                              <span class="invalid-feedback" role="alert">
                              <strong>{{ $message }}</strong>
                              </span>
                              @enderror
                           </div>
                        </div>
                        <div class="col-sm-12 col-md-12">
                           <div class="form-group">
                              <label class="form-label">Status <span class="text-red">*</span></label>
                              <select class="form-control select2" name="status">
                                 <option value="1" <?php if($category->is_active==1){ echo "selected";}?>>Active</option>
                                 <option value="0" <?php if($category->is_active==0){ echo "selected";}?>>Inactive</option>
                              </select>
                           </div>
                        </div>
                        <div class="col-lg-4 col-md-4 col-sm-12">
                           <label class="form-label">Category Image <span class="text-red">*</span></label>
                           <div class="d-flex">
                              <img src="{{ url('storage/app/public/category/'.$category->image) }}" alt="{{ $category->image }}"  style="height: 150px; max-height:150px; width:auto;">
                              <input type="hidden" value="{{ $category->image }}" name="image_file">
                           </div>
                        </div>
                        <div class="col-lg-4 col-md-4 col-sm-12">
                           <label class="form-label">Change Category Image <span class="text-red">*</span></label>
                           <p>(Image type .png,.jpeg)</p>
                           <input type="file" class="form-control img" data-height="180" name="category_image"  accept="image/png, image/jpg, image/jpeg" id="category_image" />
                           <p style="color: red" id="errNm1"></p>
                        </div>
                        <div class="col-lg-4 col-md-4 col-sm-12">
                           <div class="form-group">
                              <img src="" alt="Image" id="image_disp_id" class="no-disp" width="120px" />
                           </div>
                        </div>
                     </div>
                     <div class="col d-flex justify-content-end">
                        <a href="{{ route('admin.category')}}" class="mr-2 mt-4 mb-0 btn btn-secondary" >Cancel</a>
                        <button type="submit"  id="frontval" class="btn btn-primary mt-4 mb-0" >Submit</button>
                     </div>
                  </form>
               </div>
            </div>
            <!---ttt-->
         </div>
      </div>
   </div>
</div>
<!-- End Row -->
</div>
</div><!-- end app-content-->
</div>
@endsection
@section('js')
<!--INTERNAL Select2 js -->
<script src="{{URL::asset('admin/assets/plugins/select2/select2.full.min.js')}}"></script>
<script src="{{URL::asset('admin/assets/js/select2.js')}}"></script>
<script src="{{URL::asset('admin/assets/js/jquery.validate.min.js')}}"></script>
<!-- INTERNAL Popover js -->
<script src="{{URL::asset('admin/admin/assets/js/popover.js')}}"></script>
<!-- INTERNAL Sweet alert js -->
<script src="{{URL::asset('admin/assets/plugins/sweet-alert/jquery.sweet-modal.min.js')}}"></script>
<script src="{{URL::asset('admin/assets/plugins/sweet-alert/sweetalert.min.js')}}"></script>
<script src="{{URL::asset('admin/assets/js/sweet-alert.js')}}"></script>
<!-- INTERNAL File-Uploads Js-->
<script src="{{URL::asset('admin/assets/plugins/fancyuploder/jquery.ui.widget.js')}}"></script>
<script src="{{URL::asset('admin/assets/plugins/fancyuploder/jquery.fileupload.js')}}"></script>
<script src="{{URL::asset('admin/assets/plugins/fancyuploder/jquery.iframe-transport.js')}}"></script>
<script src="{{URL::asset('admin/assets/plugins/fancyuploder/jquery.fancy-fileupload.js')}}"></script>
<script src="{{URL::asset('admin/assets/plugins/fancyuploder/fancy-uploader.js')}}"></script>
<!-- INTERNAL File uploads js -->
<script src="{{URL::asset('admin/assets/plugins/fileupload/js/dropify.js')}}"></script>
<script src="{{URL::asset('admin/assets/js/filupload.js')}}"></script>
<script type="text/javascript">
   function readURL(input) { 
      if (input.files && input.files[0]) { 
          var reader = new FileReader(); 
          reader.onload = function (e) { $('#image_disp_id').attr('src', e.target.result); $('#image_disp_id').show(); }
          reader.readAsDataURL(input.files[0]);
      }
   }
   
   $(document).ready(function () {
      $("body").on('change','#category_image',function(){ readURL(this); });
   
   $('#category_list').addClass("active");
   $('#a_cat').addClass("active");
   $('#master').addClass("is-expanded");
   });
   
   jQuery(document).ready(function(){
   
   
   $("#frontval").click(function(){
   
   $("#catForm").validate({
   ignore: [],
   rules: {
   
   category_name : {
   required: true
   },
   
   category_description: {
   required: true
   },
   // category_image: {
   
   // required: true
   // }
   
   },
   
   messages : {
   category_name: {
   required: "Category Name is required."
   },
   category_description: {
   required: "Category Description is required."
   },
   category_image: {
   required: "Category Image is required."
   }
   },
   
   
   errorPlacement: function(error, element) {
   // $("#errNm1").empty();$("#errNm2").empty();
   console.log($(error).text());
          if (element.attr("name") == "category_image" ) {
              
              $("#errNm1").text($(error).text());
              
          }else if (element.attr("name") == "product_id" ) {
              $("#errNm2").text($(error).text());
              
          }else {
             error.insertAfter(element)
          }
      },
   
   });
   });
   
   });
</script>
<script type="text/javascript">
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