@extends('layouts.admin')
@section('css')
		<!-- INTERNAl Data table css -->
		<link href="{{URL::asset('admin/assets/plugins/datatable/css/dataTables.bootstrap4.min.css')}}" rel="stylesheet" />
		<link href="{{URL::asset('admin/assets/plugins/datatable/css/buttons.bootstrap4.min.css')}}"  rel="stylesheet">
		<link href="{{URL::asset('admin/assets/plugins/datatable/responsive.bootstrap4.min.css')}}" rel="stylesheet" />
		<link href="{{URL::asset('admin/assets/plugins/sweet-alert/jquery.sweet-modal.min.css')}}" rel="stylesheet" />
		<link href="{{URL::asset('admin/assets/plugins/sweet-alert/sweetalert.css')}}" rel="stylesheet" />
@endsection
@section('page-header')
						<!--Page header-->


						<div class="page-header">
							<div class="page-leftheader">
								<h4 class="page-title mb-0">User Roles</h4>
								<ol class="breadcrumb">
									<li class="breadcrumb-item"><a href="#"><i class="fe fe-grid mr-2 fs-14"></i>User Management</a></li>
									
									<li class="breadcrumb-item active" aria-current="page"><a href="#">User Roles</a></li>
								</ol>
							</div>
													<div class="page-rightheader" style="display:flex; flex-direction: row; justify-content: center; align-items: center">
								<label class="form-label" for="filterSel" style="margin-right: 8px;">Filter </label>
							    	<select class="form-control" id="filterSel" style="margin-right: 30px;">
									<option value="">All Status</option>
									<option value="Active">Active</option>
									<option value="Inactive">Inactive</option>
									</select>
								<div class="btn btn-list">
									<!-- <a href="#" class="btn btn-info"><i class="fe fe-settings mr-1"></i> General Settings </a>
									<a href="#" class="btn btn-danger"><i class="fe fe-printer mr-1"></i> Print </a> -->
									<a href="{{ url('/admin/user-roles/create') }}"   class="btn btn-primary addmodule"><i class="fe fe-plus mr-1"></i> Add New</a>
								</div>
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
										<div class="e-panel card">
											<div class="card-body">
												<div class="e-table">
													<div class="table-responsive table-lg mt-3">
														<table class="table table-bordered border-top text-nowrap userroles" id="userroles">
															<thead>
																<tr>
																	<th class="align-top border-bottom-0 wd-5 notexport">Select</th>
																	<th class="border-bottom-0 w-20">User Role</th>
																	
																	<th class="border-bottom-0 w-30">Description</th>
																	
																	<th class="border-bottom-0 w-15">Created On</th>							<th class="border-bottom-0 w-30">Status</th>							
																	<th class="border-bottom-0 w-10 notexport">Actions</th>
																</tr>
															</thead>

															<tbody>

																@if($userroles && count($userroles) > 0)
                    											@foreach($userroles as $row)
																<tr>
																	<td class="align-middle select-checkbox" id="moduleid" data-value="{{$row['id']}}">
																		<label class="custom-control custom-checkbox">
																			
																			<!--{{ $loop->iteration }}-->
																		</label>
																	</td>
																	<td class="align-middle" >
																		<div class="d-flex">
																			
																			
																				<h6 class=" font-weight-bold"><a href="{{ url('admin/user-roles/view/') }}/{{$row['id']}}"> {{$row['usr_role_name']}}</a></h6>
																				
																			
																		</div>
																	</td>
																	<td class="text-nowrap align-middle">
																	    @php	$usr_role_desc = Str::of($row['usr_role_desc'])->limit(20); @endphp
																		<p>{{$usr_role_desc}}</p>
																	</td>
																	<td class="text-nowrap align-middle"><span>{{date('d M Y',strtotime($row['created_at']))}}</span></td>
																	<td class="text-nowrap align-middle" data-search="@if($row['is_active'] ==1){{ "Active" }}@else{{ "Inactive" }}@endif">
																	   
																		
																		<div class="switch">
																		<input class="switch-input status-btn ser_status" data-selid="{{$row['id']}}"  id="status-{{$row['id']}}"  type="checkbox" @if($row['id'] ==1) {{ "checked disabled" }}   @endif  @if($row['is_active'] ==1) {{ "checked" }} @endif >
																		<label class="switch-paddle" for="status-{{$row['id']}}">
																		<span class="switch-active" aria-hidden="true">Active</span>
																		<span class="switch-inactive" aria-hidden="true">Inactive</span>
																		</label>
																		</div>
                                                                  
																	</td>
																	
																	
																	<td class="align-middle">
																		<div class="btn-group align-top">
																			@if($row['id'] !=1)
																		@if(checkPermission('/admin/user-roles','edit') == true)
																		<a href="{{ url('admin/user-roles/edit/') }}/{{$row['id']}}"   class="mr-2 btn btn-info btn-sm editmodule"><i class="fe fe-edit mr-1"></i> Edit</a>
																		@endif
																		@if(checkPermission('/admin/user-roles','delete') == true)
																			<button  class="btn btn-secondary btn-sm deletemodule" type="button" data-users="{{$row['assigned_users']}}"><i class="fe fe-trash-2 mr-1"></i>Delete</button>
																		@endif
																		@endif
																		</div>
																	</td>
																</tr>
																     @endforeach
                @endif
																
																
																
																
															</tbody>
														</table>
													</div>
												</div>
											</div>
										</div>
									</div>
								</div>
							</div>
						</div>
						<!-- End Row -->


						<!-- User Form Modal -->
								

					</div>
				</div><!-- end app-content-->
            </div>
@endsection
@section('js')
		<!-- INTERNAl Data tables -->
		<!--<script src="{{URL::asset('admin/assets/plugins/datatable/js/jquery.dataTables.js')}}"></script>-->
		<!--<script src="{{URL::asset('admin/assets/plugins/datatable/js/dataTables.bootstrap4.js')}}"></script>-->
		<!--<script src="{{URL::asset('admin/assets/plugins/datatable/js/dataTables.buttons.min.js')}}"></script>-->
		<!--<script src="{{URL::asset('admin/assets/plugins/datatable/js/buttons.bootstrap4.min.js')}}"></script>-->
		<!--<script src="{{URL::asset('admin/assets/plugins/datatable/js/jszip.min.js')}}"></script>-->
		<!--<script src="{{URL::asset('admin/assets/plugins/datatable/js/pdfmake.min.js')}}"></script>-->
		<!--<script src="{{URL::asset('admin/assets/plugins/datatable/js/vfs_fonts.js')}}"></script>-->
		<!--<script src="{{URL::asset('admin/assets/plugins/datatable/js/buttons.html5.min.js')}}"></script>-->
		<!--<script src="{{URL::asset('admin/assets/plugins/datatable/js/buttons.print.min.js')}}"></script>-->
		<!--<script src="{{URL::asset('admin/assets/plugins/datatable/js/buttons.colVis.min.js')}}"></script>-->
		<!--<script src="{{URL::asset('admin/assets/plugins/datatable/dataTables.responsive.min.js')}}"></script>-->
		<!--<script src="{{URL::asset('admin/assets/plugins/datatable/responsive.bootstrap4.min.js')}}"></script>-->
		<!--<script src="{{URL::asset('admin/assets/js/datatables.js')}}"></script>-->
		
		<script src="{{URL::asset('admin/assets/js/datatable/tables/user-roles-datatable.js')}}"></script>
	<!-- INTERNAL Popover js -->
		<script src="{{URL::asset('admin/assets/js/popover.js')}}"></script>

		<!-- INTERNAL Sweet alert js -->
		<script src="{{URL::asset('admin/assets/plugins/sweet-alert/jquery.sweet-modal.min.js')}}"></script>
		<script src="{{URL::asset('admin/assets/plugins/sweet-alert/sweetalert.min.js')}}"></script>
		<script src="{{URL::asset('admin/assets/js/sweet-alert.js')}}"></script>
<script type="text/javascript">
	jQuery(document).ready(function(){


// Prompt
	$(".deletemodule").on("click", function(e){

		var roleid = jQuery(this).parents("tr").find("#moduleid").data("value");
		var assigned_users = jQuery(this).data("users");
		var warning_text = "Are you sure you want to delete this role?";
		if(assigned_users > 0) {
			var warning_text = "There are users mapped to this role, do you want to continue?";
		}
		$('body').removeClass('timer-alert');
		swal({
			title: "Delete Confirmation",
			text: warning_text,
			// type: "input",
			showCancelButton: true,
			closeOnConfirm: true,
			confirmButtonText: 'Yes'
		},function(inputValue){



			if (inputValue == true) {
			 $.ajax({
            type: "POST",
            url: '{{url("/admin/user-roles/delete")}}',
            data: { "_token": "{{csrf_token()}}", id: roleid},
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



        $(".ser_status").on("click", function(e){
        
        var selid = jQuery(this).data("selid");
        
        var sestatus='0';
        if($(this).prop('checked') == true)
        {
        sestatus='1';
        }
        
        $.ajax({
        type: "POST",
        url: '{{url("/admin/user-roles/status")}}',
        data: { "_token": "{{csrf_token()}}", id: selid,status:sestatus},
        success: function (data) {
        // alert(data);
        if(data ==1) {
        
        if(sestatus ==1) {
        	jQuery('#status-'+selid).closest("td").attr("data-search","Active");
              toastr.success("Role activated successfully.");   
            }else {
            	jQuery('#status-'+selid).closest("td").attr("data-search","Inactive");
               toastr.success("Role deactivated successfully.");  
            } 
            var table = $.fn.dataTable.tables( { api: true } );
            table.rows().invalidate().draw();
        }else {
        toastr.error("Failed to update status."); 	
        }
        
        
        }
        });
        });
        
        $('#userrole').DataTable({
		language: {
			searchPlaceholder: 'Search...',
			sSearch: '',
			lengthMenu: '_MENU_',
		}
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