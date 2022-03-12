@extends('layouts.admin')
@section('css')
		<!-- INTERNAl Data table css -->
		<link href="{{URL::asset('admin/assets/plugins/datatable/css/dataTables.bootstrap4.min.css')}}" rel="stylesheet" />
		<link href="{{URL::asset('admin/assets/plugins/datatable/css/buttons.bootstrap4.min.css')}}"  rel="stylesheet">
		<link href="{{URL::asset('admin/assets/plugins/datatable/responsive.bootstrap4.min.css')}}" rel="stylesheet" />
		<link href="{{URL::asset('admin/assets/plugins/sweet-alert/jquery.sweet-modal.min.css')}}" rel="stylesheet" />
		<link href="{{URL::asset('admin/assets/plugins/sweet-alert/sweetalert.css')}}" rel="stylesheet" />
		<style>
        #sortable-row { list-style: none; color: black; }
        #sortable-row li { margin-bottom:4px; padding:10px; background-color:#BBF4A8;cursor:move;}
        #sortable-row li.ui-state-highlight { height: 1.0em; background-color:#F0F0F0;border:#ccc 2px dotted;}
        .modal-open 
        {
        overflow: scroll;
        }
    </style>
@endsection
@section('page-header')
						<!--Page header-->


						<div class="page-header">
							<div class="page-leftheader">
								<h4 class="page-title mb-0">Category List</h4>
								<ol class="breadcrumb">
									<li class="breadcrumb-item"><a href="#"><i class="fe fe-grid mr-2 fs-14"></i>Masters</a></li>

									<li class="breadcrumb-item active" aria-current="page"><a href="#">Category List</a></li>
								</ol>
							</div>
							<div class="page-rightheader" style="display:flex; flex-direction: row; justify-content: center; align-items: center">
							    <label class="form-label mr-2" for="filterSel">Filter </label>
							    						<select class="form-control mr-2" id="filterSel">
                                                        <option value="">All Status</option>
                                                        <option value="Active">Active</option>
                                                        <option value="Inactive">Inactive</option>
                                                        </select>
								<div class="btn btn-list">
									<!-- <a href="#" class="btn btn-info"><i class="fe fe-settings mr-1"></i> General Settings </a>
									<a href="#" class="btn btn-danger"><i class="fe fe-printer mr-1"></i> Print </a> -->
									
									<a href="{{ route('admin.newcategory') }}"   class="btn btn-primary addmodule"><i class="fe fe-plus mr-1"></i> Add New</a>
									<button style="" data-backdrop="static" class="btn btn-warning" data-toggle="modal"  data-target="#sort-modal" data-container=""><i class="fa fa-sort mr-1"></i> Sort Order</button>
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
													<div class="table-responsive table-lg mt-3" id="table_body">
														<table id="category-table" class="category-table table table-striped table-bordered w-100 text-nowrap">
															<thead>
																<tr>
																	<th class="align-top border-bottom-0 wd-5">Select</th>
																	<th class="border-bottom-0 w-30">Category</th>
																	<th class="border-bottom-0 w-15">Local name</th>
																	<th class="border-bottom-0 w-30">Description</th>
																	<th class="border-bottom-0 w-15">Order</th>
																	<th class="border-bottom-0 w-15">Status</th>
																	<th class="border-bottom-0 w-20">Created On</th>
																	<th class="border-bottom-0 w-30">Actions</th>
																</tr>
															</thead>

															<tbody>

																@if($category && count($category) > 0) @php $n= 0; @endphp
                    											@foreach($category as $row) @php $n++; @endphp
                    											 @php if($row->is_active == 1){ $active = "Active"; $checked = 'checked'; }else if ($row->is_active == 0){ $active = "Inactive"; $checked = ""; } @endphp
                                                               <?php  $default_lang =DB::table('glo_lang_lk')->where('is_active', 1)->first();
                                                                       $category_name=DB::table('cms_content')->where('cnt_id', $row->cat_name_cid)->where('lang_id', $default_lang->id)->first();
                                                                       $category_desc=DB::table('cms_content')->where('cnt_id', $row->cat_desc_cid)->where('lang_id', $default_lang->id)->first(); ?>
																<tr>
																	<td class="align-middle select-checkbox">
																	    <span class=""></span>
																	</td>
																	<td class="align-middle">
																	    @php $av_image=url('storage/app/public/category/'.$row->image);
																	    @endphp
																	    <div class="d-flex">
																			@if($row->image)
																	<span class="avatar brround avatar-md d-block" style="background-image: url(<?php echo $av_image; ?>)"></span>
																			@else
																			<span class="avatar brround avatar-md d-block" style="background-image: url({{URL::asset('admin/assets/images/users/2.jpg')}})"></span>
																			@endif
																			<div class="ml-3 mt-1">
																			    @php	$cat_name = Str::of($category_name->content)->limit(20); @endphp
																				<h6 class="mb-0 font-weight-bold"><a href="{{ url('admin/category/view/') }}/{{$row->category_id}}">{{$cat_name}}</a></h6>
																			</div>
																		</div>
																		<!--<div class="d-flex">-->
																		<!--<h6 class=" font-weight-bold">{{$category_name->content}}</h6>-->
                  <!--                                                      </div>-->
																	</td>
																	<td class="text-nowrap align-middle"><p style="overflow: hidden;white-space: nowrap;text-overflow: ellipsis; max-width: 100px;">{{$row->local_name}}</p>
																	</td>
																	<td class="text-nowrap align-middle"><p style="overflow: hidden;white-space: nowrap;text-overflow: ellipsis; max-width: 100px;">{{$category_desc->content}}</p>
																	</td>
																	<td class="align-middle">
																		<div class="d-flex">
																		<h6 class=" font-weight-bold">{{$row->sort_order}}</h6>
                                                                        </div>
																	</td>
																	<td class="text-nowrap align-middle" data-search="@if($row->is_active==1){{ "Active" }}@else{{ "Inactive" }}@endif">
																	    <div class="switch">
                                                                            <input class="switch-input status-btn ser_status" data-selid="{{$row->category_id}}" id="status-{{$row->category_id}}"  data-id="{{ $row->category_id }}" name="status" type="checkbox"  @if($row->is_active==1) {{ "checked" }} @endif >
                                                                            <label class="switch-paddle" for="status-{{$row->category_id}}">
                                                                                <span class="switch-active" aria-hidden="true">Active</span>
                                                                                <span class="switch-inactive" aria-hidden="true">Inactive</span>
                                                                            </label>
                                                                        </div>
																	</td>
																	<td class="text-nowrap align-middle"><span>{{date('d M Y',strtotime($row->created_at))}}</span></td>
                                                                    <td class="align-middle">
																		<div class="btn-group align-top">
																		    @if(checkPermission('admin/category','edit') == true)
																			<a href="{{ url('admin/category/edit/') }}/{{$row->category_id}}"   class="btn btn-sm btn-info mr-2"><i class="fe fe-edit mr-1"></i> Edit</a>
																			@endif
																			@if(checkPermission('admin/category','delete') == true)
																			<button  class="btn btn-sm btn-secondary deletecategory" type="button" onclick="delete_cat({{ $row->category_id}})"><i class="fe fe-trash-2"></i>Delete</button>
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

            <!-- Modal -->
			<!-- sort order modal -->              
                        <div id="sort-modal" class="modal fade">
                            <div class="modal-dialog modal-confirm">
                                <div class="modal-content">
                                    <div class="modal-header">
                                        <h3 class="modal-title">Change Order</h3>  
                                        <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
                                    </div>
                                  <form  action="{{route('category.sort-order')}}" method="POST" >
                                  @csrf
                                    <div class="modal-body">
                                    
                                        @if($category_sort && count($category_sort) > 0)
                                      <input type = "hidden" name="row_order" id="row_order" /> 
                                      <ul id="sortable-row">
                    											@foreach($category_sort as $row)
                                                                <?php  $default_lang =DB::table('glo_lang_lk')->where('is_active', 1)->first();
                                                                       $category_name=DB::table('cms_content')->where('cnt_id', $row->cat_name_cid)->where('lang_id', $default_lang->id)->first();
                                                                       $category_desc=DB::table('cms_content')->where('cnt_id', $row->cat_desc_cid)->where('lang_id', $default_lang->id)->first(); ?>
                                            <li id={{$row->category_id}}>{{$category_name->content}}</li>
                                          @endforeach
                                      </ul>
                                      @endif
                                    </div>
                                    <div class="modal-footer">
                                        <button type="button" class="btn btn-danger" data-dismiss="modal">Cancel</button>
                                        <button type="submit" id="" onClick="saveOrder();" class="btn btn-success"> Save </button>
                                    </div>
                                  </form>
                                </div>
                            </div>
                        </div>
                        
@endsection
@section('js')
		<!-- INTERNAl Data tables -->
		<script src="{{URL::asset('admin/assets/js/datatable/tables/category-datatable.js')}}"></script>
		
		
	<!-- INTERNAL Popover js -->
		<script src="{{URL::asset('admin/assets/js/popover.js')}}"></script>

		<!-- INTERNAL Sweet alert js -->
		<script src="{{URL::asset('admin/assets/plugins/sweet-alert/jquery.sweet-modal.min.js')}}"></script>
		<script src="{{URL::asset('admin/assets/plugins/sweet-alert/sweetalert.min.js')}}"></script>
		<script src="{{URL::asset('admin/assets/js/sweet-alert.js')}}"></script>
		
		<script src="https://code.jquery.com/ui/1.12.1/jquery-ui.js"></script>
		
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



	function delete_cat(cat_id){
	    
	   $('body').removeClass('timer-alert');
        swal({
            title: "Delete Confirmation",
            text: "Are you sure you want to delete this Category?",
            // type: "input",
            showCancelButton: true,
            closeOnConfirm: true,
            confirmButtonText: 'Yes'
        },function(inputValue){
    if (inputValue == true) {
        $.ajax({
            type: "POST",
            url: '{{url("/admin/delete-category/")}}',
            data: { "_token": "{{csrf_token()}}", cat_id: cat_id},
            success: function (data) {
                location.reload();

            }
        });
        }
    });
    }
    
    function saveOrder() 
    {
      var selectedLanguage = new Array();
      $('ul#sortable-row li').each(function() 
      {
          selectedLanguage.push($(this).attr("id"));
      });
      document.getElementById("row_order").value = selectedLanguage;
    }
    
    $(function() {
        
        $( "#sortable-row" ).sortable(
      {
        placeholder: "ui-state-highlight"
      });  
      
    $('.ser_status').change(function() {
        var status = $(this).prop('checked') == true ? 1 : 0;
        var cat_id = $(this).data('id');

        $.ajax({
            type: "POST",
            url: '{{url("/admin/category/change-status")}}',
            data: { "_token": "{{csrf_token()}}", cat_id: cat_id,status: status},
            success: function (data) {
                console.log(data.success)
           
            }
        });
        if(status!=true)
        { toastr.success("Inactivated Successfully");
        jQuery('#status-'+cat_id).closest("td").attr("data-search","Inactive");
        $(this).prop("");
             var table = $.fn.dataTable.tables( { api: true } );
            table.rows().invalidate().draw();
        }else{
            jQuery('#status-'+cat_id).closest("td").attr("data-search","Active");
            toastr.success("Activated Successfully");
                 var table = $.fn.dataTable.tables( { api: true } );
            table.rows().invalidate().draw();}
    })
  })
</script>

@endsection
