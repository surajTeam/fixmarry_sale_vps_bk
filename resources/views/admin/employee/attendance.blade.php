@extends('layouts.main')
@section('title')
	<title>Fixmarry Sales | Admin | Employee Attendance</title>
@endsection
@section('content')
<!-- Page Wrapper -->
<div class="page-wrapper">
	<div class="content container-fluid">
		<!-- Page Header -->
		<div class="page-header">
			<div class="row">
				<div class="col-sm-12">
					<h3 class="page-title">Attendance</h3>
					<ul class="breadcrumb">
						<li class="breadcrumb-item"><a href="{{ url('/') }}">Dashboard</a></li>
						<li class="breadcrumb-item active">Attendance</li>
					</ul>
				</div>
			</div>
		</div>
		<!-- /Page Header -->
		<div class="row">
			<div class="col-md-3">
				<div class="stats-info">
					<h6>Today Presents</h6>
					<h4>{{ App\Helpers\Helper::present_count(date("Y-m-d")) }} / {{ count($employees) }}</h4>
				</div>
			</div>
			
		</div>
		
		<div class="row">
			<div class="col-lg-12">
				<div class="table-responsive">
					<table class="table table-striped custom-table table-nowrap mb-0">
						<thead>
							<tr>
								<th>Employee</th>
								@for($i=1;$i<=$days;$i++)
									<th>{{ $i }}</th>
								@endfor
							</tr>
						</thead>
						<tbody>
							
							@foreach($employees as $employee)
								<tr>
									<td class="sorting_1">
										<h2 class="table-avatar">
											<a href="#" class="avatar"><img alt="" src="{{ $employee->profile_photo_url }}"></a>
											<a href="profile.html">{{ $employee->name }} <span>{{ $employee->fixmarry_employee_id }}</span></a>
										</h2>
									</td>
									@for($i=1;$i<=$total_days;$i++)
										@if( App\Helpers\Helper::check_day_present($i, $month, $year, $employee->id))
										<td>
											<a href="javascript:void(0);"><i class="fa fa-check text-success"></i></a>
											
										</td>
										@else
										<td><i class="fa fa-close text-danger"></i></td>
										@endif

									@endfor
								</tr>
							@endforeach
							
							
						</tbody>
					</table>
				</div>
			</div>
		</div>
	</div>
	<!-- /Page Content -->
	
</div>
<!-- Page Wrapper -->
@endsection