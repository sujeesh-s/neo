@extends('layouts.admin')
@section('css')
		<!-- INTERNAl alert css -->
		<link href="{{URL::asset('admin/assets/plugins/sweet-alert/jquery.sweet-modal.min.css')}}" rel="stylesheet" />
		<link href="{{URL::asset('admin/assets/plugins/sweet-alert/sweetalert.css')}}" rel="stylesheet" />
<link href="{{URL::asset('admin/assets/plugins/quill/quill.snow.css')}}" rel="stylesheet">
        <link href="{{URL::asset('admin/assets/plugins/quill/quill.bubble.css')}}" rel="stylesheet">
        <!--INTERNAL Select2 css -->
		<link href="{{URL::asset('admin/assets/plugins/select2/select2.min.css')}}" rel="stylesheet" />

        <!-- INTERNAL File Uploads css -->
		<link href="{{URL::asset('admin/assets/plugins/fancyuploder/fancy_fileupload.css')}}" rel="stylesheet" />
        <!-- INTERNAL File Uploads css-->
        <link href="{{URL::asset('admin/assets/plugins/fileupload/css/fileupload.css')}}" rel="stylesheet" type="text/css" />
        <!-- INTERNAl WYSIWYG Editor css -->
		<link href="{{URL::asset('admin/assets/plugins/wysiwyag/richtext.css')}}" rel="stylesheet" />
		<link href="{{URL::asset('admin/assets/css/pixelarity.css')}}" rel="stylesheet"/>
		<!---combo tree-->
		<link href="{{URL::asset('admin/assets/css/combo-tree.css')}}" rel="stylesheet" />
		<style>.imageThumb {
            max-height: 75px;
            border: 2px solid;
            padding: 1px;
            cursor: pointer;
          }
          .pip {
            display: inline-block;
            margin: 10px 10px 0 0;
          }
          .imageThumb1 {
            max-height: 75px;
            border: 2px solid;
            padding: 1px;
            cursor: pointer;
          }
          .pip1 {
            display: inline-block;
            margin: 10px 10px 0 0;
          }
          .remove {
            display: block;
            background: #444;
            border: 1px solid black;
            color: white;
            text-align: center;
            cursor: pointer;
          }
          .remove:hover {
            background: rgb(248, 6, 6);
            color: rgb(245, 239, 239);
          } 
          #files.form-control{ line-height: 1.2; }
          </style>
@endsection
@section('page-header')
						<!--Page header-->


						<div class="page-header">
							<div class="page-leftheader">
								<h4 class="page-title mb-0">Edit Admin Product</h4>
								<ol class="breadcrumb">
									<li class="breadcrumb-item"><a href="#"><i class="fe fe-grid mr-2 fs-14"></i>Masters</a></li>
									<li class="breadcrumb-item active" aria-current="page"><a href="{{url('admin/product/list')}}">Admin Product List</a></li>
									<li class="breadcrumb-item active" aria-current="page"><a href="#">Edit Admin Product</a></li>
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
                                                    <form action="{{url('admin/update-product/'.$product->id)}}" method="POST" enctype="multipart/form-data" id="adminForm">
													@csrf
                                                    <div class="row">
                                                        <div class="col-md-12">
                                                            <div class="form-group">
                                                                <label class="form-label">Select Language <span class="text-red">*</span></label>
                                                                <select class="form-control custom-select select2" name="language" required>
                                                                    @foreach ($language as $lang)
                                                                    <option value="{{ $lang->id }}">{{ $lang->glo_lang_name }}</option>
                                                                    @endforeach
                                                                </select>
                                                            </div>
                                                        </div>
                                                        <input type="hidden" name="name_cid" value="{{$product->name_cid}}">
                                                        <input type="hidden" name="short_desc" value="{{$product->short_desc}}">
                                                        <input type="hidden" name="desc" value="{{$product->desc}}">
                                                        <input type="hidden" name="content" value="{{$product->content}}">
                                                        <div class="col-md-6">
                                                            <div class="form-group">
                                                                <label class="form-label">Product Name <span class="text-red">*</span></label>
                                                                <input type="text" class="form-control @error('product_name') is-invalid @enderror" placeholder="Product Name" name="product_name" value="{{ $product->name }}">
                                                                @error('product_name')
                                                                    <span class="invalid-feedback" role="alert">
                                                                        <strong>{{ $message }}</strong>
                                                                    </span>
                                                                @enderror
                                                            </div>
                                                        </div>
                                                        
                                                       
                                                        <div class="col-md-6">
                                                            <div class="form-group">
                                                                <label class="form-label">Category <span class="text-red">*</span></label>
                                                                <select class="form-control select2 @error('category') is-invalid @enderror" id="categoryList" onchange="loadsubcat()"  name="category">
                                                                    <option value="">Select</option>
                                                                    @foreach($category as $key )
                                                                    <?php $default_lang =DB::table('glo_lang_lk')->where('is_active', 1)->first();
                                                                    $category_name=DB::table('cms_content')->where('cnt_id', $key->cat_name_cid)->where('lang_id', $default_lang->id)->first();?>
                                                                    <option value="{{ $key->category_id }}" @if($key->category_id==$product->category_id) {{ "selected" }} @endif>{{ $category_name->content }}</option>
                                                                    @endforeach
                                                                </select>
                                                                @error('category')
                                                                    <span class="invalid-feedback" role="alert">
                                                                        <strong>{{ $message }}</strong>
                                                                    </span>
                                                                @enderror
                                                            </div>
                                                        </div>
                                                        <div class="col-md-6">
                                                            <div class="form-group">
                                                                <label class="form-label">Subcategory<span class="text-red">*</span></label>
                                                                
                                                                <input type="text" id="sub-category-id" placeholder="Type to filter" class="@error('subcategory_id') is-invalid @enderror" name="subcategory_id" autocomplete="off" value="@if(isset($product->sub_category_id)) {{ $product->sub_category_id }} @endif" hidden />
																<input type="text" id="sub-category-drop" class="form-control " value="" placeholder="Select Subcategory" readonly style="background-color: #fff !important;">
                                                                
                                                            <!--    <input type="hidden" id="cat_ids" value="{{ $product->sub_category_id }}">-->
                                                            <!--    <select id="subcategory" class="form-control select2 tagselect @error('subcategory_id') is-invalid @enderror" name="subcategory_id" required>-->
                                                            <!--    <?php $subcats=DB::table('subcategory')->where('category_id',$product->category_id)->where('is_active',1)->where('is_deleted',0)->get();?>-->
                                                            <!--    @foreach($subcats as $key )-->
                                                            <!--    <?php $subcat_name=DB::table('cms_content')->where('cnt_id', $key->sub_name_cid)->where('lang_id', $default_lang->id)->first(); ?>-->
                                                            <!--    <option value="{{$key->subcategory_id}}" @if($key->subcategory_id==$product->sub_category_id){{"selected"}} @endif>{{$subcat_name->content}}</option>-->
                                                            <!--     @endforeach-->

                                                            <!--</select>-->
                                                            @error('subcategory_id')
                                                                    <span class="invalid-feedback" role="alert">
                                                                        <strong>{{ $message }}</strong>
                                                                    </span>
                                                                @enderror
                                                            </div>
                                                        </div>
                                                        {{--
                                                        <div class="col-md-6">
                                                            <div class="form-group">
                                                                <label class="form-label">Tag<span class="text-red"></span></label>
                                                                <select id="tag" class="form-control select2" name="tag[]" multiple>
                                                                    @foreach($tag as $tagdt)
                                                                    <?php
                                                                    
                                                                    $prd_tag_ids =explode(',',$product->tag_ids);
                                                                    $tag_details=DB::table('prod_tag')->where('id',$tagdt->id)->where('is_active',1)->where('is_deleted',0)->first();
                                                                    $tags_name=DB::table('cms_content')->where('cnt_id', $tag_details->tag_name_cid)->where('lang_id', $default_lang->id)->first();
                                                                    ?>
                                                                    @foreach($prd_tag_ids as $tag_sel)
                                                                    
                                                                <option value="{{$tagdt->id}}" @if($tagdt->id==$tag_sel) {{"selected"}} @endif>{{$tags_name->content}}</option>
                                                                   @endforeach
                                                                   @endforeach
                                                            </select>
                                                            </div>
                                                        </div>
                                                        <div class="col-md-6">
                                                            <div class="form-group">
                                                                <label class="form-label">Brand<span class="text-red"></span></label>
                                                                <select id="brand" class="form-control select2" name="brand" >
                                                                <option value="">Select</option>
                                                                    @foreach($brand as $bd )
                                                                    <?php $default_lang =DB::table('glo_lang_lk')->where('is_active', 1)->first();
                                                                    $brand_name=DB::table('cms_content')->where('cnt_id', $bd->brand_name_cid)->where('lang_id', $default_lang->id)->first();?>
                                                                    <option value="{{ $bd->id }}" @if($bd->id==$product->brand_id){{"selected"}}@endif>{{ $brand_name->content }}</option>
                                                                    @endforeach
                                                            </select>
                                                            </div>
                                                        </div>--}}
                                                        
                                                        <div class="col-sm-6 col-md-6">
                                                            <div class="form-group">
                                                                <label class="form-label">Status <span class="text-red">*</span></label>
                                                                <select class="form-control select2" name="status">
                                                                    <option value="1" @if($product->is_active==1){{"selected"}}@endif >Active</option>
                                                                    <option value="0"@if($product->is_active==0){{"selected"}}@endif >Inactive</option>
                                                                </select>
                                                            </div>
                                                        </div>
                                                        
                                              <div class="col-lg-12 fl">
                                                 <div class="form-group">
                                                                <label class="form-label">Short Description <span class="text-red">*</span></label>
                                                                <?php $default_lang =DB::table('glo_lang_lk')->where('is_active', 1)->first();
                                                                    $short_desc_name=DB::table('cms_content')->where('cnt_id', $product->short_desc)->where('lang_id', $default_lang->id)->first();?>
                                                                <textarea rows="1" class="form-control @error('short_description') is-invalid @enderror" placeholder="Short Description about the product" name="short_description" >{{$short_desc_name->content}}</textarea>
                                                                @error('short_description')
                                                                <span class="invalid-feedback" role="alert">
                                                                    <strong>{{ $message }}</strong>
                                                                </span>
                                                            @enderror
                                                            </div>
                                                        </div>
                                                        <div class="col-lg-12 col-md-12 col-sm-12">
                                                            <label class="form-label">Change Product Image <span class="text-red">*</span></label>
                                                            <div class="form-group mb-2">
                                                                <input id="files" type="file" class="form-control crp_img @error('product_image') is-invalid @enderror" name="product_image[]" accept=".jpg, .png, image/jpeg, image/png"  multiple>
                                                                
                                                                <img src="" alt="Image" id="image_1_img" class="no-disp" height="90" style="margin-top: 20px;" />
                                                               <input type="hidden" name="img_crp[]" id="image_1_img">
                                                               
                                                               @error('product_image')
                                                                    <span class="invalid-feedback" role="alert">
                                                                        <strong>{{ $message }}</strong>
                                                                    </span>
                                                                @enderror
                                                            </div>
                                                        </div>
                                                        <br>
                                                        <?php $image_product =DB::table('prd_admin_images')->where('prd_id', $product->id)->get(); ?>
                                                        @if($image_product)
                                                        <div class="col-lg-12 col-md-12 col-sm-12">
                                                        <div class="form-group">
                                                        <label class="form-label">Selected Product Image</label></div></div> 
                                                        <input type="hidden" id="up_imgs" name="up_imgs" value="{{count($image_product)}}" />
                                                        @foreach($image_product as $imgprd)
                                                            <div class="d-flex">
                                                                <span class="pip">
                                                                <img src="{{ config('app.storage_url').$imgprd->image }}" alt="{{ $imgprd->image }}" class="imageThumb">
                                                                <input type="hidden" value="{{ $imgprd->id }}" name="image_file">
                                                                <a class="remove" style="color: white;" type="button"  data-selid="{{$imgprd->id}}"  data-id="{{ $imgprd->id }}">Remove image</a>
                                                            </span>
                                                            </div>
                                                        @endforeach
                                                        @endif

                                                    </div>

                                                    <div class="row">
															<div class="col d-flex justify-content-end">
                                                            <a class="btn btn-secondary mt-4 mb-0 mr-2" href="{{route('admin.productlist')}}">Cancel</a>
															<button class="btn btn-primary mt-4 mb-0 " type="submit">Save Changes</button>
															</div>
														</div>
                                                </form>
                                                </div>
                                            </div>
                                                    <!---hhj-->


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
		
		<!-- INTERNAL WYSIWYG Editor js -->
		<script src="{{URL::asset('admin/assets/plugins/wysiwyag/jquery.richtext.js')}}"></script>
		<script src="{{URL::asset('admin/assets/js/form-editor.js')}}"></script>
		
		<!---combo tree--->
		<script src="{{URL::asset('admin/assets/plugins/combotree/comboTreePlugin.js')}}"></script>
<script src="{{URL::asset('admin/assets/plugins/quill/quill.min.js')}}"></script>

    <script src="{{URL::asset('admin/assets/js/pixelarity-face.js')}}"></script>


<script type="text/javascript">
// with face detection

$('body').on('change','.crp_img',function(e){  
var img = e.target.files[0];
var selc =  $(this).data('img');

if(!pixelarity.open(img, selc, function(res, faces){

$('#adminForm img#image_1_img').attr('src', res); $('#adminForm img#image_1_img').show();
$('#adminForm input#image_1_img').attr('value', res);

$(".face").remove();
// Looping through the faces returned
for(var i = 0; i < faces.length; i++){
// Do something with the faces
}
}, "jpg", 0.7, true)){
alert("Please select valid image!");
}
});

</script>

    <script type="text/javascript">


    var instance = $('#sub-category-drop').comboTree({
    collapse:true,
    cascadeSelect:true,
    isMultiple: false
    });
    loadsubcat('1');
    var selectionIdList = new Array($("#sub-category-id").val());
    instance.setSelection(selectionIdList);
 function loadsubcat(clear='',selected='')
    {
        var category_id=$("#categoryList").val();
        // alert(category_id);
        if(clear!='1')
        {
            $("#sub-category-id").val('');
        }
        
         $.ajax({
            type: "POST",
            url: '{{url("/admin/tags/subcategory")}}',
            data: { "_token": "{{csrf_token()}}", category_id: category_id},
            success: function (data) {
            	var obj = JSON.parse(data);
            
            	console.log(obj);
            	 var obj = JSON.parse(data);
            if(obj.subdata.length >=1)
            {
               $('#sub-category-drop').attr("placeholder", "Select subcategory"); 
            }
            else
            {
                $('#sub-category-drop').attr("placeholder", "No subcategory to display"); 
            }
            instance.setSource(obj.subdata);
            if($("#sub-category-id").val())
            {
                var selectionIdList = new Array($("#sub-category-id").val());
                instance.setSelection(selectionIdList);

            }
            
            }
        });
        
        
        
    }
    $('#sub-category-drop').on('change',function()
        {
            var selected_subcatid={{$product->sub_category_id}};
            //alert(selected_subcatid);
            if(instance.getSelectedIds())
            {
                $("#sub-category-id").val(instance.getSelectedIds()[0]);
            }
            
            if(selected_subcatid!=$("#sub-category-id").val())
            {
                var cat_id = $('#categoryList').val();
            var subcat_id = $('#sub-category-id').val();
            $.ajax({
            url:"{{ route('taglist_ajax') }}",
            type:"POST",
            data: {
            cat_id: cat_id,subcat_id:subcat_id
            },
            success:function (data) {
            $('#tag').empty();
            $.each(data.tags,function(index,tag){
                //alert(subcategory.subcategory_id);
            
            $('#tag').append('<option value="'+tag.id+'">'+tag.tag_name+'</option>');
            })
            }
            })
            }
            
            
           
        });
       


</script>
    
    
<script type="text/javascript">
$.ajaxSetup({
headers: {
'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
}
});
$(document).ready(function () {
  $('#adminpro').addClass("active");
  $('#adm_pro').addClass("active");
  $('#master').addClass("is-expanded");
  
//   $('#files').on('change',function(){ var upImgs =   parseInt($('#up_imgs').val()); if(this.value != ''){ $('#up_imgs').val((upImgs+1)); } })

//     if (window.File && window.FileList && window.FileReader) {
//     $("#files").on("change", function(e) {
//         $(".pip1").remove();
//       var files = e.target.files,
//         filesLength = files.length;
//       for (var i = 0; i < filesLength; i++) {
//         var f = files[i]
//         var fileReader = new FileReader();
//         fileReader.onload = (function(e) {
//           var file = e.target;
//           $("<span class=\"pip1\">" +
//             "<input type=\"file\" id=\"havefil\" hidden name=\"havefil[]\" value=\"" + e.target.result + "\"/>"+
//             "<img class=\"imageThumb1\" src=\"" + e.target.result + "\" title=\"" + file.name + "\"/>" +
//             "<br/>" +
//             "</span>").insertAfter("#files");
//           $(".remove").click(function(){
//             $(this).parent(".pip").remove();
//           });

//           // <span class=\"remove\">Remove image</span>Old code here
//           /*$("<img></img>", {
//             class: "imageThumb",
//             src: e.target.result,
//             title: file.name + " | Click to remove"
//           }).insertAfter("#files").click(function(){$(this).remove();});*/

//         });
//         fileReader.readAsDataURL(f);
//       }
//     });
//   } else {
//     alert("Your browser doesn't support to File API")
//   }
  
    $(".remove").click(function(){
    var img_id = $(this).data('id');
    $(this).parent(".pip").remove();
    var upImgs      =   parseInt($('#up_imgs').val());
     toastr.success("Image removed successfully."); 
        $.ajax({
            type: "POST",
            url: '{{url("/admin/product/remove-image")}}',
            data: { "_token": "{{csrf_token()}}", img_id: img_id},
            success: function (data) {
                upImgs = (upImgs-1);
                $('#up_imgs').val(upImgs);
                console.log(data.success)

            }
        });
            
          });
  
$('#categoryList').on('change',function(e) {
var cat_id = e.target.value;
$.ajax({
url:"{{ route('subcategory_ajax') }}",
type:"POST",
data: {
cat_id: cat_id
},
success:function (data) {
$('#subcategory').empty();
$.each(data.subcategories,function(index,subcategory){
    //alert(subcategory.subcategory_id);

$('#subcategory').append('<option value="'+subcategory.subcategory_id+'">'+subcategory.subname+'</option>');
})
}
})
});


});
	
	$(document).ready(function () {
  $('body').on('submit','#adminForm',function(e){ 
            
            $("#specification").val(JSON.stringify(new Quill('#quillEditor').getContents()));
  });
});
</script>
<script type="text/javascript">
     
$(function() {
    'use strict'
    var icons = Quill.import('ui/icons');
    icons['bold'] = '<i class="fa fa-bold" aria-hidden="true"><\/i>';
    icons['italic'] = '<i class="fa fa-italic" aria-hidden="true"><\/i>';
    icons['underline'] = '<i class="fa fa-underline" aria-hidden="true"><\/i>';
    icons['strike'] = '<i class="fa fa-strikethrough" aria-hidden="true"><\/i>';
    icons['list']['ordered'] = '<i class="fa fa-list-ol" aria-hidden="true"><\/i>';
    icons['list']['bullet'] = '<i class="fa fa-list-ul" aria-hidden="true"><\/i>';
    icons['link'] = '<i class="fa fa-link" aria-hidden="true"><\/i>';
    icons['image'] = '<i class="fa fa-image" aria-hidden="true"><\/i>';
    icons['video'] = '<i class="fa fa-film" aria-hidden="true"><\/i>';
    icons['code-block'] = '<i class="fa fa-code" aria-hidden="true"><\/i>';
    var toolbarOptions = [
        [{
            'header': [1, 2, 3, 4, 5, 6, false]
        }],
        ['bold', 'italic', 'underline', 'strike'],
        [{
            'list': 'ordered'
        }, {
            'list': 'bullet'
        }],
        ['link', 'image', 'video']
    ];
    const editor = new Quill('#quillEditor', {
      bounds: '#quillEditor',
      modules: {
            toolbar: toolbarOptions
        },
      placeholder: 'Product Specification',
      theme: 'snow'
    });

      /**
       * Step1. select local image
       *
       */
    function selectLocalImage() {
      const input = document.createElement('input');
      input.setAttribute('type', 'file');
      input.click();

      // Listen upload local image and save to server
      input.onchange = () => {
        const file = input.files[0];

        // file type is only image.
        if (/^image\//.test(file.type)) {
          saveToServer(file);
        } else {
          alert('Please select an image.');
        }
      };
    }

    /**
     * Step2. save to server
     *
     * @param {File} file
     */
    function saveToServer(file) {
      const fd = new FormData();
      fd.append('image', file);

      const xhr = new XMLHttpRequest();


      xhr.open('POST', "{{ url('/admin/editor-image') }}", true);
      // xhr.setRequestHeader("Content-type", "application/x-www-form-urlencoded");
var csrfToken = "{{ csrf_token() }}";
xhr.setRequestHeader('X-CSRF-TOKEN', csrfToken);
      xhr.onload = () => {
        if (xhr.status === 200) {
          // this is callback data: url
          // const url = JSON.parse(xhr.responseText).data;
          console.log(xhr.responseText);
          // console.log(url);
          insertToEditor(xhr.responseText);
        }
      };
      xhr.send(fd);
    }

    /**
     * Step3. insert image url to rich editor.
     *
     * @param {string} url
     */
    function insertToEditor(url) {
      // push image url to rich editor.
      const range = editor.getSelection();
      editor.insertEmbed(range.index, 'image', `${url}`);
    }

    // quill editor add image handler
    editor.getModule('toolbar').addHandler('image', () => {
      selectLocalImage();
    });

editor.setContents(JSON.parse($('#specification').val()), 'api');

});

 </script>
@endsection
