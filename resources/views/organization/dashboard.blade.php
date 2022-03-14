@extends('layouts.organization')
@section('css')
    <link href="{{URL::asset('admin/assets/traffic/web-traffic.css')}}" rel="stylesheet" type="text/css">
    		<link href="{{URL::asset('admin/assets/css/daterangepicker.css')}}" rel="stylesheet" />
@endsection

   @section('page-header')
						<!--Page header-->
						<div class="page-header mt-0 pt-3 pb-4 pl-4" style="background: #fff;">
							<div class="page-leftheader">
								<h4 class="page-title mb-0">Hi! Welcome Back</h4>
								<ol class="breadcrumb">
									<li class="breadcrumb-item"><a href="#"><i class="fe fe-home mr-2 fs-14"></i>Home</a></li>
									<li class="breadcrumb-item active" aria-current="page"><a href="#">Dashboard</a></li>
								</ol>
							</div>
						</div>
						<!--End Page header-->
						@endsection
						@section('content')						
						<!-- Row-1 -->
						<div class="row">
							<div class="col-xl-3 col-lg-6 col-md-12">
								<div class="card">
									<div class="card-body">
										<i class="mdi mdi-file-outline card-custom-icon text-primary fs-40"></i>
										<p class="mb-4" style="font-size: 16px; color: #24476d;">Training Contents</p>
										<h2 class="mb-3 font-weight-bold text-right" style="color: #24476d; font-size: 2.3rem;">50</h2>
									</div>
								</div>
							</div>
							<div class="col-xl-3 col-lg-6 col-md-12">
								<div class="card">
									<div class="card-body">
										<i class="mdi mdi-clock card-custom-icon text-warning fs-40"></i>
										<p class="mb-4" style="font-size: 16px; color: #1d9909 ;">Tranings Completed</p>
										<h2 class="mb-3 font-weight-bold text-right" style="color: #1d9909; font-size: 2.3rem;">25</h2>
									</div>
								</div>
							</div>
							<div class="col-xl-3 col-lg-6 col-md-12">
								<div class="card">
									<div class="card-body">
										<i class="mdi mdi-heart-outline card-custom-icon text-success fs-40"></i>
										<p class="mb-4" style="font-size: 16px; color: #6babeb;">Participation</p>
										<h2 class="mb-3 font-weight-bold text-right" style="color: #6babeb; font-size: 2.3rem;">150</h2>
									</div>
								</div>
							</div>
							<div class="col-xl-3 col-lg-6 col-md-12">
								<div class="card">
									<div class="card-body">
										<i class="mdi mdi-account-multiple-outline card-custom-icon text-secondary fs-40"></i>
										<p class="mb-4" style="font-size: 16px; color: #099990 ;">No. Of Users</p>
										<h2 class="mb-3 font-weight-bold text-right" style="color: #099990; font-size: 2.3rem;">200</h2>
									</div>
								</div>
							</div>
						</div>
						<!-- End Row-1 -->

						<!-- Row-2 -->
						<div class="row" id="graps">
							<div class="col-xl-6 col-lg-6 col-md-12">
								<div class="card">
									<div class="card-header">
										<div class="card-title">Contents Created</div>
									</div>
									<div class="card-body">
										<div class="morris-wrapper-demo" id="morrisBar1"></div>
									</div>
								</div>
							</div>
							<div class="col-xl-3 col-lg-3 col-md-12">
								<div class="card mg-b-md-20">
									<div class="card-header">
										<div class="card-title">Success Rate</div>
									</div>
									<div class="card-body">
										<div class="morris-donut-wrapper-demo" id="morrisDonut1"></div>
									</div>
								</div>
							</div>
							<div class="col-xl-3 col-lg-3 col-md-12">
								<div class="card">
									<div class="card-header">
										<h3 class="card-title">Top 5 Branches</h3>
									</div>
									<div class="card-body">
										<table class="table table-striped card-table table-vcenter text-nowrap">
											<tbody style="font-size: 15px;">
												<tr>
													<th scope="row">1</th>
													<td>Branch A</td>													
												</tr>
												<tr>
													<th scope="row">2</th>
													<td>Branch B</td>
												</tr>
												<tr>
													<th scope="row">3</th>
													<td>Branch C</td>													
												</tr>
												<tr>
													<th scope="row">4</th>
													<td>Branch D</td>
												</tr>
												<tr>
													<th scope="row">5</th>
													<td>Branch E</td>
												</tr>
											</tbody>
										</table>
									</div>
								</div>
							</div>
						</div>
						<!-- End Row-2 -->

						<!-- Row-3 -->
						<div class="row" id="graps">
							<div class="col-xl-6 col-md-12">
								<div class="card">
									<div class="card-header">
										<div class="card-title">Productivity</div>
									</div>
									<div class="card-body">
										<div class="morris-wrapper-demo" id="morrisLine1"></div>
									</div>
								</div>
							</div>
							<div class="col-xl-6 col-md-12">
								<div class="card">
									<div class="card-header">
										<h3 class="card-title">Branch A</h3>
										<div class="card-options">
											<!-- <a href="#" class="option-dots" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false"><i class="fe fe-more-horizontal fs-20"></i></a>
											<div class="dropdown-menu dropdown-menu-right">
												<a class="dropdown-item" href="#">Today</a>
												<a class="dropdown-item" href="#">Last Week</a>
												<a class="dropdown-item" href="#">Last Month</a>
												<a class="dropdown-item" href="#">Last Year</a>
											</div> -->
											<a href="#" class="btn btn-info mr-2">View Users </a>
											<a href="#" class="btn btn-info mr-2">View Details </a>
										</div>
									</div>
									<div class="card-body">
										<table class="table card-table table-vcenter text-nowrap">
											<tbody style="font-size: 15px;">
												<tr>
													<td scope="row">Training contents by training admin</td>
													<td>15</td>													
												</tr>
												<tr>
													<td scope="row">Training contents created by trainer</td>
													<td>15</td>
												</tr>
												<tr>
													<td scope="row">User participation rate</td>
													<td>15</td>													
												</tr>
												<tr>
													<td scope="row">Training content completion rate</td>
													<td>15</td>
												</tr>
												<tr>
													<td scope="row">Pending training content</td>
													<td>15</td>
												</tr>
											</tbody>
										</table>
									</div>
								</div>
							</div>
						</div>
						<!-- End Row-3 -->	

						<!-- Row-3 -->
						<div class="row" id="graps">
							<div class="col-xl-6 col-md-12">
								<div class="card">
									<div class="card-header">
										<h3 class="card-title">Branch B</h3>
										<div class="card-options">
											<!-- <a href="#" class="option-dots" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false"><i class="fe fe-more-horizontal fs-20"></i></a>
											<div class="dropdown-menu dropdown-menu-right">
												<a class="dropdown-item" href="#">Today</a>
												<a class="dropdown-item" href="#">Last Week</a>
												<a class="dropdown-item" href="#">Last Month</a>
												<a class="dropdown-item" href="#">Last Year</a>
											</div> -->
											<a href="#" class="btn btn-info mr-2">View Users </a>
											<a href="#" class="btn btn-info mr-2">View Details </a>
										</div>
									</div>
									<div class="card-body">
										<table class="table card-table table-vcenter text-nowrap">
											<tbody style="font-size: 15px;">
												<tr>
													<td scope="row">Training contents by training admin</td>
													<td>15</td>													
												</tr>
												<tr>
													<td scope="row">Training contents created by trainer</td>
													<td>15</td>
												</tr>
												<tr>
													<td scope="row">User participation rate</td>
													<td>15</td>													
												</tr>
												<tr>
													<td scope="row">Training content completion rate</td>
													<td>15</td>
												</tr>
												<tr>
													<td scope="row">Pending training content</td>
													<td>15</td>
												</tr>
											</tbody>
										</table>
									</div>
								</div>
							</div>
							<div class="col-xl-6 col-md-12">
								<div class="card">
									<div class="card-header">
										<h3 class="card-title">Branch C</h3>
										<div class="card-options">
											<!-- <a href="#" class="option-dots" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false"><i class="fe fe-more-horizontal fs-20"></i></a>
											<div class="dropdown-menu dropdown-menu-right">
												<a class="dropdown-item" href="#">Today</a>
												<a class="dropdown-item" href="#">Last Week</a>
												<a class="dropdown-item" href="#">Last Month</a>
												<a class="dropdown-item" href="#">Last Year</a>
											</div> -->
											<a href="#" class="btn btn-info mr-2">View Users </a>
											<a href="#" class="btn btn-info mr-2">View Details </a>
										</div>
									</div>
									<div class="card-body">
										<table class="table card-table table-vcenter text-nowrap">
											<tbody style="font-size: 15px;">
												<tr>
													<td scope="row">Training contents by training admin</td>
													<td>15</td>													
												</tr>
												<tr>
													<td scope="row">Training contents created by trainer</td>
													<td>15</td>
												</tr>
												<tr>
													<td scope="row">User participation rate</td>
													<td>15</td>													
												</tr>
												<tr>
													<td scope="row">Training content completion rate</td>
													<td>15</td>
												</tr>
												<tr>
													<td scope="row">Pending training content</td>
													<td>15</td>
												</tr>
											</tbody>
										</table>
									</div>
								</div>
							</div>
						</div>
						<!-- End Row-3 -->	
						
						<!-- Row -->
						<div class="row" style="display: none;">
							<div class="col-lg-6">
								<div class="card">
									<div class="card-header">
										<div class="card-title">Bar Chart</div>
									</div>
									<div class="card-body">
										<div class="morris-wrapper-demo" id="morrisBar1"></div>
									</div>
								</div>
							</div><!-- col-6 -->
							<div class="col-lg-6">
								<div class="card">
									<div class="card-header">
										<div class="card-title">Stacked Bar Chart</div>
									</div>
									<div class="card-body">
										<div class="morris-wrapper-demo" id="morrisBar3"></div>
									</div>
								</div>
							</div><!-- col-6 -->
							<div class="col-lg-6">
								<div class="card">
									<div class="card-header">
										<div class="card-title">Line Chart</div>
									</div>
									<div class="card-body">
										<div class="morris-wrapper-demo" id="morrisLine1"></div>
									</div>
								</div>
							</div><!-- col-6 -->
							<div class="col-lg-6">
								<div class="card">
									<div class="card-header">
										<div class="card-title">Area Chart</div>
									</div>
									<div class="card-body">
										<div class="morris-wrapper-demo" id="morrisArea1"></div>
									</div>
								</div>
							</div><!-- col-6 -->

							<div class="col-lg-6">
								<div class="card">
									<div class="card-header">
										<div class="card-title">Donut Chart</div>
									</div>
									<div class="card-body">
										<div class="morris-donut-wrapper-demo" id="morrisBar6"></div>
									</div>
								</div>
							</div><!-- col-6 -->
							<div class="col-lg-6">
								<div class="card">
									<div class="card-header">
										<div class="card-title">Donut Chart</div>
									</div>
									<div class="card-body">
										<div class="morris-donut-wrapper-demo" id="morrisBar7"></div>
									</div>
								</div>
							</div><!-- col-6 -->
							<div class="col-lg-6">
								<div class="card mg-b-md-20">
									<div class="card-header">
										<div class="card-title">Donut Chart</div>
									</div>
									<div class="card-body">
										<div class="morris-donut-wrapper-demo" id="morrisDonut1"></div>
									</div>
								</div>
							</div><!-- col-6 -->
						</div>
						<!-- /Row -->

					

								

					</div>
				</div>
				<!-- End app-content-->
			</div>
			<style type="text/css">
				.chart {
  width:900px;
  height:400px;
  margin: auto;
  display: block;

}

			</style>
@endsection
@section('js')

<script src="{{URL::asset('admin/assets/plugins/morris/raphael-min.js')}}"></script>
<script src="{{URL::asset('admin/assets/plugins/morris/morris.js')}}"></script>
<script src="{{URL::asset('admin/assets/js/morris.js')}}"></script>

<!--INTERNAL ECharts js-->
<script src="{{URL::asset('admin/assets/plugins/echarts/echarts.js')}}"></script>
  <script type="text/javascript">

$(document).ready(function(){

  

  });

  </script>
@endsection