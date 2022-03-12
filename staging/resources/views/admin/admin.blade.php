@extends('layouts.admin')
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
  <script type="text/javascript">

$(document).ready(function(){

  

  });

  </script>
@endsection