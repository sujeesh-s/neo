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
                            <h5 style="text-align: center;">Register Account</h5>
                         
                        </div> <!-- section title -->
                        <div class="main-form pt-45">
                            {{ Form::open(array('url' => "/register", 'id' => 'register', 'name' => 'register', 'class' => '','files'=>'true')) }}
                                <div class="row">
                                    <div class="col-md-8">
                                        <div class="single-form form-group">
                                            <input name="domain_name" id="domain_name" type="text" placeholder="Domain Name"  >
                                            <span class="error"></span>
                                        </div> <!-- single form -->
                                    </div>
                                    <div class="col-md-4">
                                        <div class="single-form form-group">
                                            <input name="domains" type="text" placeholder="neobench.com" disabled >
                                            <span class="error"></span>
                                        </div> <!-- single form -->
                                    </div>
                                    <div class="col-md-6">
                                        <div class="single-form form-group">
                                            <input name="fname" id="fname" type="text" placeholder="Name"  required="required">
                                            <span class="error"></span>
                                        </div> <!-- single form --> 
                                    </div>
                                    <div class="col-md-6">
                                        <div class="single-form form-group">
                                            <input name="job" id="job" type="text" placeholder="Job Title"  required="required">
                                            <span class="error"></span>
                                        </div> <!-- single form -->
                                    </div>
                                    <div class="col-md-6">
                                        <div class="single-form form-group">
                                            <input name="org_name" id="org_name" type="text" placeholder="Organization Name"  required="required">
                                            <span class="error"></span>
                                        </div> <!-- single form --> 
                                    </div>
                                    <div class="col-md-6">
                                        <div class="single-form form-group">
                                            {{Form::select('country',$countries,"",['id'=>'country','class'=>'form-control','placeholder'=>'Country'])}}
                                            <span class="error"></span>
                                        </div> <!-- single form -->
                                    </div>
                                    <div class="col-md-6">
                                        <div class="single-form form-group">
                                            <input name="email" id="email" type="email" placeholder="Email"  required="required">
                                            <span class="error"></span>
                                        </div> <!-- single form --> 
                                    </div>
                                    <div class="col-md-6">
                                        <div class="single-form form-group">
                                            <input name="phone" id="phone" type="text" placeholder="Phone"  required="required">
                                            <span class="error"></span>
                                        </div> <!-- single form --> 
                                    </div>
                                    <div class="col-md-6">
                                        <div class="single-form form-group">
                                            <input name="username" id="username" type="text" placeholder="Username"  required="required">
                                            <span class="error"></span>
                                        </div> <!-- single form --> 
                                    </div>
                                    <div class="col-md-6">
                                        <div class="single-form form-group">
                                            <input name="password" id="password" type="text" placeholder="Password" required="required">
                                            <span class="error"></span>
                                        </div> <!-- single form --> 
                                    </div>
                                    <div class="col-md-12">
                                        <label class="custom-control custom-checkbox">
                                                    <input class="custom-control-input" type="checkbox" name="terms" checked id="terms">
                                                    <label class="custom-control-label" for="remember">
                                                      By Requesting for Demo I agree to the <a href="#">Terms and Services</a>
                                                     </label>
												</label>
                                    </div>
                                    <p class="form-message"></p>
                                    <div class="col-md-12">
                                        <div class="single-form">
                                            <button type="submit" id="save_btn" class="main-btn">Create Account</button>
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

$("#register").validate({
	ignore: [],
rules: {

"domain_name" : {
required: true
},

"fname" : {
required: true
},
"job" : {
required: true
},
"org_name" : {
required: true
},

"email": {
required: true,
email: true
},
"phone": {

required: true,
number: true,
},
"username" : {
required: true
},
"password" : {
required: true,
maxlength: 15,
minlength: 6

},



},

messages : {
"fname": {
required: "Name is required."
},
"domain_name": {
required: "Domain Name is required."
},
"job": {
required: "Job Title is required."
},
"email": {
required: "Email is required."
},
"phone": {
required: "Phone number is required."
},
"password": {
required: "Password is required."
},
"username": {
required: "Username is required."
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



 $('body').on('submit','#register',function(e){ 
        $('#register .error').html('');
      
            e.preventDefault();    
            var formData = new FormData(this);
            $('#register #save_btn').attr('disabled',true); $('#register #save_btn').text('Validating...'); 
            $.ajax({
                type: "POST",
                url: '{{url("/register/validate")}}',
                data: formData,
                cache: false,
                contentType: false,
                processData: false,
                success: function (data) {
                    if(data == 'success'){ 
                        $('#register #save_btn').text('Saving...'); $('#register #cancel_btn').trigger('click'); 
                        document.register.submit();  return false;
                    }else{
                        var errKey = ''; var n = 0;
                        $.each(data, function(key,value) { if(n == 0){ errKey = key; n++; }

                       
                        	 	 $('#register #'+key).closest('div').find('.error').html(value);
                        	 
                           
                        }); 
                        $('#register #'+errKey).focus();
                        $('#register #save_btn').attr('disabled',false); $('#register #save_btn').text('Save'); return false;
                    }
                    return false;
                }
            });


        
      return false; 
    });

	});
</script>
@endsection
