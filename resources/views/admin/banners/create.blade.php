@extends('layouts.admin')
@section('css')
		<!-- INTERNAl Data table css -->
		<link href="{{URL::asset('admin/assets/plugins/datatable/css/dataTables.bootstrap4.min.css')}}" rel="stylesheet" />
		<link href="{{URL::asset('admin/assets/plugins/datatable/css/buttons.bootstrap4.min.css')}}"  rel="stylesheet">
		<link href="{{URL::asset('admin/assets/plugins/datatable/responsive.bootstrap4.min.css')}}" rel="stylesheet" />
		<link href="{{URL::asset('admin/assets/plugins/sweet-alert/jquery.sweet-modal.min.css')}}" rel="stylesheet" />
		<link href="{{URL::asset('admin/assets/plugins/sweet-alert/sweetalert.css')}}" rel="stylesheet" />
		<link href="{{URL::asset('admin/assets/css/combo-tree.css')}}" rel="stylesheet" />
		<link rel="stylesheet" href="https://cdn.materialdesignicons.com/5.0.45/css/materialdesignicons.min.css">
		<link href="{{URL::asset('admin/assets/css/datepicker.css')}}" rel="stylesheet" />
		<link href="{{URL::asset('admin/assets/css/chosen.min.css')}}" rel="stylesheet"/>
		<link rel="stylesheet" type="text/css" href="{{URL::asset('admin/assets/css/bootstrap-datetimepicker.min.css')}}">
@endsection
@section('page-header')
						<!--Page header-->


						<div class="page-header">
							<div class="page-leftheader">
								<h4 class="page-title mb-0">{{ $title }}</h4>
								<ol class="breadcrumb">
									<li class="breadcrumb-item"><a href="#"><i class="fe fe-grid mr-2 fs-14"></i>Settings</a></li>
									<li class="breadcrumb-item"><a href="{{ url('admin/banners')}}"><i class="fe fe-grid mr-2 fs-14"></i>Banners</a></li>
									
									<li class="breadcrumb-item active" aria-current="page"><a href="#">{{ $title }}</a></li>
								</ol>
							</div>
							<div class="page-rightheader">
						
							</div>
						</div>
                        <!--End Page header-->
@endsection
@section('content')
						<!-- Row -->
						<div class="row flex-lg-nowrap">
							<div class="col-12">

						
								<div class="row flex-lg-nowrap">
									<div class="col-12 mb-3">
										<div class="e-panel card">
											<div class="card-body">
												<div class="e-table">
													<div class="table-responsiv table-lg mt-3">
													{{ Form::open(array('url' => "/admin/banners/save", 'id' => 'bannerForm', 'name' => 'bannerForm', 'class' => '','files'=>'true')) }}
												{{Form::hidden('id',0,['id'=>'bannerid'])}}
												<div class="py-1">
													
														<div class="row">
															<div class="col">
																<div class="row">

																	<div class="col">
																		<div class="form-group">
																			<label class="form-label">Select Language <span class="text-red">*</span></label>
                                                                <select class="form-control custom-select select2" name="glo_lang_cid" required>
                                                                    
                                                                    @foreach ($language as $lang)
                                                                    <option value="{{ $lang->id }}">{{ $lang->glo_lang_name }}</option>
                                                                    @endforeach
                                                                </select>
																		</div>
																		
																	</div>
																	<div class="col">
																		<div class="form-group">
																			<label class="form-label">Caption <span class="text-red">*</span></label>
																			
																			{!! Form::text('caption', null, ['class' => 'form-control','rows' => 3,'id'=>'caption']) !!}
																		</div>
																		@error('caption')
																	<p style="color: red" class="error">{{ $message }}</p>
																	@enderror
																		
																	</div>
																</div>
															

																<div class="row">
														
																	<div class="col">
																		<div class="form-group">
																			<label class="form-label">Banner Type <span class="text-red">*</span></label>
																		<select class="form-control dropfill" id="banner_type" name="banner_type" >

																		@if($banner_types && count($banner_types) > 0)
																		@foreach($banner_types as $kv)
																		<option value="{{ $kv['id'] }}">{{ $kv['title'] }}</option>
																		@endforeach
																		@endif

																		</select>
																		</div>
																		<p style="color: red" id="errNm3"></p>
																		@error('banner_type')
																	<p style="color: red" class="error">{{ $message }}</p>
																	@enderror
																		
																	</div>

																	<div class="col" >
																		<div class="form-group">
																			<label class="form-label">Media Type <span class="text-red">*</span></label>
																			
																			{!! Form::select('media_type', array('image' => 'Image', 'video' => 'Video'), 'image',['class' => 'form-control','required','id'=>'media_type']); !!}
																		</div>
																		@error('media_type')
																	<p style="color: red" class="error">{{ $message }}</p>
																	@enderror
																		
																	</div>
																</div>
																<div class="row">
															<div class="col">
															<div class="form-group" id="image_type">
															<!-- <label class="form-label">Image<span class="text-red">*</span></label> -->

															@php $n_img = 0 @endphp
															    <div class="card-header mb-4"><div class="card-title">Images <span class="text-red">*</span></div></div>
															  
															    <div id="prd_imgs">
															        <div id="img_row_0" class="col-12 fl img_row">
															            <div class="col-lg-6 fl">
															                <div class="form-group">
															                    {{Form::hidden('imgId[]',0,['id'=>'img_id_'.$n_img])}}
															                    {{Form::file('image[]',['id'=>'image_'.$n_img,'class'=>'form-control img','placeholder'=>'Choose Image','accept'=>'image/*'])}}
															                </div>
															            </div>
															        <div class="col-lg-5 col-8 fl">
															                <div class="form-group">
															                    <img src="" alt="Image" id="image_{{$n_img}}_img" class="no-disp" height="90" />
															                </div>
															            </div> @php $n_img++; @endphp
															            <div class="clr"></div>
															        </div>
															            <div class="clr"></div>
															            <p style="color: red" id="errNm1"></p>
															    </div>
															    <div class="clr"></div>
															    <div class="col-12 text-right">
															        <button id="add_more" class="mt-4 mb-4 btn btn-info btn-sm" type="button"><i class="fa fa-plus mr-1"></i>Add More</button>
															    </div>


															<div id="add_more_img" class="d-none">
															    <div id="img_row_id" class="col-12 fl img_row">
															        <div class="col-lg-6 fl">
															            <div class="form-group">
															                {{Form::file('image[]',['id'=>'image_file_id','class'=>'form-control img','placeholder'=>'Choose Image','accept'=>'image/*'])}}
															            </div>
															        </div>
															        <div class="col-lg-5 col-8 fl">
															            <div class="form-group">
															                <img src="" alt="Image" id="image_disp_id" class="no-disp" />
															            </div>
															        </div>
															        <div class="col-lg-1 col-2 pl-0 mb-2 fl">
															            <div class="form-group">
															                <label>&nbsp; &nbsp;</label><div class="clr"></div>
															                <a id="del_img_id" class="del_img del"><i class="fa fa-trash"></I></a>
															            </div>
															        </div>@php $n_img++; @endphp
															        <div class="clr"></div>
															    </div>
															</div>
															</div>
															<div class="form-group " id="video_type" style="display:none;">
															<label class="form-label">Video Link <span class="text-red">*</span></label>

															{!! Form::text('media_link', null, ['class' => 'form-control','rows' => 3,'id'=>'media_link','placeholder'=>'Eg: youtube.com/embed/ScMzIvxBSi4']) !!}
															</div>
															</div>
															
															

															</div>
																<div class="row">
																	
																	 <div class="col">
																		<div class="form-group">
																			<label class="form-label">Button Text </label>
																			
																			{!! Form::text('btn_text', null, ['class' => 'form-control','rows' => 3,'id'=>'btn_text']) !!}
																		</div>
																		@error('btn_text')
																	<p style="color: red" class="error">{{ $message }}</p>
																	@enderror
																	</div> 
																	 <div class="col">
																		<div class="form-group">
																			<label class="form-label">Button Link </label>
																			
																			{!! Form::text('btn_link', null, ['class' => 'form-control','rows' => 3,'id'=>'btn_link']) !!}
																		</div>
																		@error('btn_link')
																	<p style="color: red" class="error">{{ $message }}</p>
																	@enderror
																	</div> 

																</div>	


																<div class="row">
																	
																	<div class="col-md-6" id="alt_text_div">
																		<div class="form-group">
																			<label class="form-label">Alt Text </label>
																			
																			{!! Form::text('alt_text', null, ['class' => 'form-control','rows' => 3,'id'=>'alt_text']) !!}
																		</div>
																		@error('alt_text')
																	<p style="color: red" class="error">{{ $message }}</p>
																	@enderror
																	</div> 
																	<div class="col-md-6" id="status_div">
																		<div class="form-group">
																			<label class="form-label">Status <span class="text-red">*</span></label>
																	
																			{!! Form::select('is_active', array('1' => 'Active', '0' => 'Inactive'), '1',['class' => 'form-control','required','id'=>'coupon_status']); !!}
																		</div>
																		@error('is_active')
																	<p style="color: red" class="error">{{ $message }}</p>
																	@enderror
																	</div>
																	
																	
																</div>
																
																

																
															</div>
														</div>
														
														<div class="row">
															<div class="col d-flex justify-content-end">
															<input class="btn btn-primary" type="submit" id="frontval" value="Save Changes">
															</div>
														</div>
													
												</div>
												{{Form::close()}}

													</div>
												</div>
											</div>
										</div>
									</div>
								</div>
							</div>
						</div>
						<!-- End Row -->


								

					</div>
				</div><!-- end app-content-->
            </div>
<style type="text/css">
	.radio-opts {
		margin-top: 10px;
	}

.chosen-container-multi .chosen-choices {
    padding: 4px 10px;
    border: 1px solid #e3e4e9;
    transition: border-color 0.15s ease-in-out, box-shadow 0.15s ease-in-out;
    border-radius: 5px;
}

</style>

@endsection
@section('js')
		<!-- INTERNAl Data tables -->
<script src="{{URL::asset('admin/assets/js/jquery.validate.min.js')}}"></script>

<script src="{{URL::asset('admin/assets/js/chosen.jquery.min.js')}}"></script>
<script type="text/javascript" src="{{URL::asset('admin/assets/js/moment.js')}}"></script>
<script src="{{URL::asset('admin/assets/js/bootstrap-datetimepicker.min.js')}}"></script>
		<script src="{{URL::asset('admin/assets/js/datatables.js')}}"></script>
	<!-- INTERNAL Popover js -->
		<script src="{{URL::asset('admin/assets/js/popover.js')}}"></script>
		<script src="{{URL::asset('admin/assets/js/bootstrap-datepicker.js')}}"></script>
		<!-- INTERNAL Sweet alert js -->
		<script src="{{URL::asset('admin/assets/plugins/sweet-alert/jquery.sweet-modal.min.js')}}"></script>
		<script src="{{URL::asset('admin/assets/plugins/sweet-alert/sweetalert.min.js')}}"></script>
		<script src="{{URL::asset('admin/assets/js/sweet-alert.js')}}"></script>
		<script src="{{URL::asset('admin/assets/js/sweet-alert.js')}}"></script>
		<script src="{{URL::asset('admin/assets/js/comboTreePlugin.js')}}"></script>
<script type="text/javascript">

  function readURL(input) { 
        if (input.files && input.files[0]) { 
        	$("#errNm1").empty();
            var reader = new FileReader(); 
            reader.onload = function (e) { $('#bannerForm img#'+input.id+'_img').attr('src', e.target.result); $('#bannerForm #'+input.id+'_img').show(); }
            reader.readAsDataURL(input.files[0]);
        }
    }

	jQuery(document).ready(function(){


 var row      =   parseInt('{{$n_img}}'); 
        $('body').on('click','#add_more',function(){ 
            var htmlContent             =   $('#add_more_img').html();
            htmlContent                 =   htmlContent.replace('img_row_id','img_row_'+row);
            htmlContent                 =   htmlContent.replace('img_id_id','img_id_'+row);
            htmlContent                 =   htmlContent.replace('image_file_id','image_'+row);
            htmlContent                 =   htmlContent.replace('image_disp_id','image_'+row+'_img');
            htmlContent                 =   htmlContent.replace('del_img_id','del_img_'+row);
            $('#bannerForm #prd_imgs').append(htmlContent); row++;
        });

         $('body').on('click','#bannerForm .del_img.del',function(){
            var id      =   this.id.replace('del_img_',''); 
            $('#bannerForm #img_row_'+id).remove();
        });
        
        $("body").on('change','#bannerForm input.img',function(){ readURL(this); });

$("#frontval").click(function(){

$("#bannerForm").validate({
	ignore: [],
rules: {

caption : {
required: true
},
"image[]": {
required: '#media_type option[value="image"]:selected',

},
"media_link": {
required: '#media_type option[value="video"]:selected',

},
"btn_text": {
required: function(){
return (''+$("#btn_link").val() !="") ;
}
},
btn_link : {
url: true
},


},

messages : {
caption: {
required: "Caption is required."
},


"image[]": {
required: "Image is required."
},
media_link: {
required: "Link is required."

},
offer_value: {
required: "Offer Value is required."

},

btn_text: {
required: "Button Text is required."
}

},


 errorPlacement: function(error, element) {
 	 $("#errNm1").empty();
 	 console.log($(error).text());
            if (element.attr("name") == "image[]" ) {
                $("#errNm1").text($(error).text());
                
            }else if (element.attr("name") == "sale_start" ) {
                $("#errNm3").text($(error).text());
                
            }else {
               error.insertAfter(element)
            }
        },

});
});



	 $(".datepicker").datepicker({ 
        autoclose: true, 
        todayHighlight: true,
       startDate: new Date()
  }).datepicker('update', new Date());




	// Prompt
	$(".deletemodule").on("click", function(e){

		var moduleid = jQuery(this).parents("tr").find("#moduleid").data("value");
		$('body').removeClass('timer-alert');
		swal({
			title: "Delete Confirmation",
			text: "Are you sure you want to delete this module?",
			// type: "input",
			showCancelButton: true,
			closeOnConfirm: true,
			confirmButtonText: 'Yes'
		},function(inputValue){



			if (inputValue == true) {
			 $.ajax({
            type: "POST",
            url: '{{url("/admin/modules/delete")}}',
            data: { "_token": "{{csrf_token()}}", id: moduleid},
            success: function (data) {
            	// alert(data);
            	if(data ==1){
            		location.reload();
            	}
            
            }
        });

			}
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


<script type="text/javascript">


$(document).ready(function(){


$(".chosen-select").chosen({
  no_results_text: "Oops, nothing found!"
});

$("#banner_type").change(function(){

var b_type =$(this).val();
if(b_type ==1){
	$("#add_more").show('1000');
	$("#alt_text_div").show('1000');
	$("#status_div").removeClass("col-md-offset-6");
	$("#media_type option[value='video']").removeAttr("disabled");
}else{
	$("#add_more").hide('1000');
	$("#alt_text_div").hide('1000');
	$("#status_div").addClass("col-md-offset-6");
	$('#media_type option[value="video"]').attr("disabled",true);

$("#bannerForm #prd_imgs .img_row:not(#img_row_0)").remove();
}

});

$("#media_type").change(function(){

var media_type =$(this).val();

if(media_type == "video"){
	$("#image_type").hide('1000');
	$("#video_type").show('1000');
}else{
	$("#image_type").show('1000');
	$("#video_type").hide('1000');
}

});


});

 function date_check() 
    {
      var sdate=$("[name='valid_from']").val();
      var tdate=$("[name='valid_to']").val();
      
      $('#valid_from').datepicker('setStartDate',new Date(sdate));
      if(sdate && tdate)
      {
        var d1 = Date.parse(sdate);
        var d2 = Date.parse(tdate);
        if (d1 > d2) 
        {
          $("[name='valid_to']").val(sdate);
          $('#valid_to').datepicker('setStartDate',new Date(sdate));
        }
      }
      
    }

</script>
@endsection