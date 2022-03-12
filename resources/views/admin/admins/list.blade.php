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
								<h4 class="page-title mb-0">{{ $title }}</h4>
								<ol class="breadcrumb">
									<li class="breadcrumb-item"><a href="#"><i class="fe fe-grid mr-2 fs-14"></i>User Management</a></li>
									
									<li class="breadcrumb-item active" aria-current="page"><a href="#">{{ $title }}</a></li>
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
									<a href="{{ url('/admins-list/create') }}"   class="btn btn-primary addmodule"><i class="fe fe-plus mr-1"></i> Add New</a>
								</div>
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
													<div class="table-responsive table-lg mt-3">
														<table class="table table-bordered border-top text-nowrap adminlist" id="adminlist">
															<thead>
																<tr>
																	<th class="align-top border-bottom-0 wd-5 userroles">Select</th>
																	<th class="border-bottom-0 w-15">Name</th>
																	
																	<th class="border-bottom-0 w-15">Email</th>
																	<th class="border-bottom-0 w-15">Phone</th>
																	<th class="border-bottom-0 w-10">Role</th>
																	
																	<th class="border-bottom-0 w-10">Created On</th>	
																	<th class="border-bottom-0 w-15">Status</th>						
																	<th class="border-bottom-0 w-10 userroles">Actions</th>
																</tr>
															</thead>

															<tbody>

																@if($admins && count($admins) > 0)
                    											@foreach($admins as $row)
																<tr>
																	<td class="align-middle select-checkbox" id="moduleid" data-value="{{$row->id}}">
																		<label class="custom-control custom-checkbox">
																			
																			<!--{{ $loop->iteration }}-->
																		</label>
																	</td>
																	<td class="align-middle" >
																	    @php $avatar=url('storage'.$row->avatar);
																	    @endphp
																	    <div class="d-flex">
																			@if($row['avatar'])
																	<span class="avatar brround avatar-md d-block" style="background-image: url(<?php echo $avatar; ?>)"></span>
																			@else
																	<span class="avatar brround avatar-md d-block" style="background-image: url(<?php echo url('storage/app/public/no-avatar.png'); ?>)"></span>
																			@endif
																			<div class="ml-3 mt-1">
																				<h6 class=" font-weight-bold"><a href="{{ url('admin/admins-list/view/') }}/{{$row->id}}" >{{ $row->fname." ".$row->lname }} </a></h6>
																			</div>
																		</div>
																	
																	</td> 
																	<td class="text-nowrap align-middle">
																		<p>{{$row->email}}</p>
																	</td>
																	<td class="text-nowrap align-middle">
																		<p>@if($row->isd_code) +{{ $row->isd_code }} @endif {{$row->phone}}</p>
																	</td>
																
																	<td class="text-nowrap align-middle"><span></span></td>
																	<td class="text-nowrap align-middle" data-search="@if($row->is_active ==1){{ "Active" }}@else{{ "Inactive" }}@endif">
																		<!--<label class="onswitch  ">-->
                  <!--                                                  <input class='ser_status' data-selid="{{$row->id}}"  type="checkbox"  @if($row->is_active ==1) {{ "checked" }} @endif />-->
                  <!--                                                  <span class="slider round"></span>-->
                  <!--                                                  </label>-->
                                                                    
<div class="switch">
<input class="switch-input status-btn ser_status" data-selid="{{$row->id}}"  id="status-{{$row->id}}"  type="checkbox"  @if($row->is_active ==1) {{ "checked" }} @endif >
<label class="switch-paddle" for="status-{{$row->id}}">
<span class="switch-active" aria-hidden="true">Active</span>
<span class="switch-inactive" aria-hidden="true">Inactive</span>
</label>
</div>
                                                                    
																	</td>
																	
																	
																	<td class="align-middle">
																	
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
            
<style type="text/css">
table.dataTable tr.parent {
animation: none !important;
}
table.dataTable tr.selected p {
color: #fff;
}


</style>

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
			<script src="{{URL::asset('admin/assets/js/datatable/tables/admins-datatable.js')}}"></script>
	<!-- INTERNAL Popover js -->
		<script src="{{URL::asset('admin/assets/js/popover.js')}}"></script>

		<!-- INTERNAL Sweet alert js -->
		<script src="{{URL::asset('admin/assets/plugins/sweet-alert/jquery.sweet-modal.min.js')}}"></script>
		<script src="{{URL::asset('admin/assets/plugins/sweet-alert/sweetalert.min.js')}}"></script>
		<script src="{{URL::asset('admin/assets/js/sweet-alert.js')}}"></script>
<script type="text/javascript">



function deletecpn(cpnid){
$('body').removeClass('timer-alert');
		swal({
			title: "Delete Confirmation",
			text: "Are you sure you want to delete this User?",
			// type: "input",
			showCancelButton: true,
			closeOnConfirm: true,
			confirmButtonText: 'Yes'
		},function(inputValue){



			if (inputValue == true) {
			 $.ajax({
            type: "POST",
            url: '{{url("/admin/admins-list/delete")}}',
            data: { "_token": "{{csrf_token()}}", id: cpnid},
            success: function (data) {
            	// alert(data);
            	if(data ==1){
            		location.reload();
            	}
            
            }
        });

			}
		});
}

	jQuery(document).ready(function(){



	// Prompt
	

 $(".ser_status").on("click", function(e){
        
        var selid = jQuery(this).data("selid");
        
        var sestatus='0';
        if($(this).prop('checked') == true)
        {
        sestatus='1';
        }
        
        $.ajax({
        type: "POST",
        url: '{{url("/admin/admins-list/status")}}',
        data: { "_token": "{{csrf_token()}}", id: selid,status:sestatus},
        success: function (data) {
        // alert(data);
        if(data ==1) {
            if(sestatus ==1) {
            	jQuery('#status-'+selid).closest("td").attr("data-search","Active");
              toastr.success("Admin activated successfully.");   
            }else {
            	jQuery('#status-'+selid).closest("td").attr("data-search","Inactive");
               toastr.success("Admin deactivated successfully.");  
            }
            var table = $.fn.dataTable.tables( { api: true } );
            table.rows().invalidate().draw();
        
        }else {
        toastr.error("Failed to update status."); 	
        }
        
        
        }
        });
        });

 $('#adminslist').DataTable({
		language: {
			searchPlaceholder: 'Search...',
			sSearch: '',
			lengthMenu: '_MENU_',
		}
	});
	});
</script>



@endsection