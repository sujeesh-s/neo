@extends('layouts.frontend')
@section('css')
    <link href="{{URL::asset('admin/assets/traffic/web-traffic.css')}}" rel="stylesheet" type="text/css">
    		<link href="{{URL::asset('admin/assets/css/daterangepicker.css')}}" rel="stylesheet" />
@endsection


						@section('content')						
						 <section id="contact-page" class="pt-90 pb-120 gray-bg">
        <div class="container">
            <div class="row">
                <div class="col-lg-12">
                    <div class="contact-from mt-30">
                        <div class="section-title" >
                            <h5 style="text-align: center;">Welcome {{ $name }}</h5>
                            <p style="text-align: center;">Please answer a few questions to complete registration.</p>
                        </div> <!-- section title -->
                        <div class="main-form pt-45">
                            {{ Form::open(array('url' => "/welcomeform", 'id' => 'welcomeform', 'name' => 'welcomeform', 'class' => '','files'=>'true')) }}
                                <div class="row">
                                    <input type="hidden" name="tenant" value="{{ $tenant }}">
                                    <div class="col-md-6">
                                        <div class="single-form form-group">
                                            <label for="org_type">Is your Organization Public or Private Sector?</label>
                                            <select name="org_type" id="org_type" class="form-control required">
                                                <option value="">Select Organization Type</option>
                                                <option value="public">Public</option>
                                                <option value="private">Private</option>
                                            </select>
                                            <span class="error"></span>
                                        </div> <!-- single form --> 
                                    </div>
                                    <div class="col-md-6">
                                        <div class="single-form form-group">
                                            {{Form::label('business_category','What does your Organization do?',['class'=>''])}} <span class="text-red">*</span>
            {{Form::select('business_category',$business_category,"",['id'=>'business_category','class'=>'form-control required','placeholder'=>'Select Category'])}}
                                            <span class="error"></span>
                                        </div> <!-- single form -->
                                    </div>
                                    <div class="col-md-6">
                                        <div class="single-form form-group">
                                              {{Form::label('employee_range','How many employees do you want to train?',['class'=>''])}} <span class="text-red">*</span>
            {{Form::select('employee_range',$employee_range,"",['id'=>'employee_range','class'=>'form-control required','placeholder'=>'Select Range'])}}
                                            <span class="error"></span>
                                        </div> <!-- single form --> 
                                    </div>
                                    <div class="col-md-6">
                                        <div class="single-form form-group">
                                             {{Form::label('language','What is your organization language?',['class'=>''])}} <span class="text-red">*</span>
            {{Form::select('language',$language,"",['id'=>'language','class'=>'form-control required','placeholder'=>'Select Language'])}}
                                            <span class="error"></span>
                                        </div> <!-- single form -->
                                    </div>
                                    
                                    <p class="form-message"></p>
                                    <div class="col-md-12">
                                        <div class="single-form">
                                            <button type="submit" id="save_btn" class="main-btn">Submit</button>
                                        </div> <!-- single form -->
                                    </div> 
                                </div> <!-- row -->
                            {{Form::close()}}
                        </div> <!-- main form -->
                    </div> <!--  contact from -->
                </div>
                
            </div> <!-- row -->
        </div> <!-- container -->
    </section>
		
@endsection

@section('js')
		<!-- INTERNAl Data table css -->
<script src="{{URL::asset('admin/assets/js/jquery.validate.min.js')}}"></script>
	<script type="text/javascript">

    $.ajaxSetup({
    headers: {
        'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
    }
}); 

			jQuery(document).ready(function(){


$("#save_btn").click(function(){

$("#welcomeform").validate({
	ignore: [],
rules: {

"org_type" : {
required: true
},
"business_category" : {
required: true
},
"employee_range" : {
required: true
},
"language" : {
required: true
},




},

messages : {
"business_category": {
required: "Business Category is required."
},
"org_type": {
required: "Organization Type is required."
},
"employee_range": {
required: "Employee Range is required."
},
"language": {
required: "Language is required."
},


},


 errorPlacement: function(error, element) {
 	 // $("#errNm1").empty();$("#errNm2").empty();
 	 console.log($(error).text());
            if (element.attr("name") == "subcat_id" ) {
            	console.log("innnnnn");
                $("#errNm1").text($(error).text());
                
            }else if (element.attr("name") == "product_id" ) {
                $("#errNm2").text($(error).text());
                
            }else {
               error.insertAfter(element)
            }
        },

});
});



 $('body').on('submit','#welcomeform',function(e){ 
        $('#welcomeform .error').html('');
      
            e.preventDefault();    
            var formData = new FormData(this);
            $('#welcomeform #save_btn').attr('disabled',true); $('#welcomeform #save_btn').text('Validating...'); 
            $.ajax({
                type: "POST",
                url: '{{url("/welcomeform/validate")}}',
                data: formData,
                cache: false,
                contentType: false,
                processData: false,
                success: function (data) {
                    if(data == 'success'){ 
                        $('#welcomeform #save_btn').text('Saving...'); $('#welcomeform #cancel_btn').trigger('click'); 
                        document.welcomeform.submit();  return false;
                    }else{
                        var errKey = ''; var n = 0;
                        $.each(data, function(key,value) { if(n == 0){ errKey = key; n++; }

                       
                        	 	 $('#welcomeform #'+key).closest('div').find('.error').html(value);
                        	 
                           
                        }); 
                        $('#welcomeform #'+errKey).focus();
                        $('#welcomeform #save_btn').attr('disabled',false); $('#welcomeform #save_btn').text('Save'); return false;
                    }
                    return false;
                }
            });


        
      return false; 
    });

	});
</script>
@endsection
