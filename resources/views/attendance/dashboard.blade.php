@extends('layouts.main')
@section('title')
	<title>Fixmarry Sales | Attendance </title>
@endsection
@section('content')
<!-- Page Wrapper -->
<div class="page-wrapper">
	<div class="content container-fluid">
		<!-- Page Header -->
		{{-- <div class="page-header">
			<div class="row">
				<div class="col-sm-12">
					<h3 class="page-title">Attendance</h3>
					<ul class="breadcrumb">
						<li class="breadcrumb-item"><a href="index.html">Dashboard</a></li>
						<li class="breadcrumb-item active">Attendance</li>
					</ul>
				</div>
			</div>
		</div> --}}
		<!-- /Page Header -->
		
		
		<div class="row">
			<div class="col-lg-12">
				<div class="card mb-0">
					<div class="card-header">
						<h4 class="card-title mb-0">Attendance</h4>
						{{-- <p class="card-text">
							This is the most basic example of the datatables with zero configuration. Use the <code>.datatable</code> class to initialize datatables.
						</p> --}}
					</div>
					<div class="card-body">
						<div class="table-responsive">
							<table class="table table-stripped datatable" data-ordering="false">
								<thead>
									<tr>
										<th>#</th>
										<th>Date </th>
										<th>Punch In</th>
										<th>Punch Out</th>
										<th>Production</th>
									</tr>
								</thead>
								<tbody>
									@php
										$i = 1;
									@endphp
									@foreach($attendances as $attendance)
										<tr>
											<td>{{ $i }}</td>
											<td>{{ $attendance->date }}</td>
											<td>{{ date("h:i:s A", strtotime($attendance->punch_in_time)) }}</td>
											<td>
												@if($attendance->punch_out_time == NULL && $attendance->date == date('Y-m-d'))
													<span class="badge bg-inverse-success">on going</span>
												@elseif($attendance->punch_out_time == NULL)
													<span class="badge bg-inverse-danger">not punchout</span>
												@else
													
												<span class="badge bg-inverse-primary">{{ date("h:i:s A", strtotime($attendance->punch_out_time)) }}</span>
												@endif
											</td>
											<td>
												@if($attendance->punch_out_time == NULL && $attendance->date == date('Y-m-d'))
													@php
														$datetime = $attendance->date." ".$attendance->punch_in_time;
													   	$datetime1 = new DateTime();
													   	$datetime2 = new DateTime($datetime);
													   	$interval = $datetime1->diff($datetime2);
													   	$elapsed = $interval->format('<span>%H:%I:%S</span>');
													   	echo $elapsed." Hrs";
													@endphp
												@elseif($attendance->punch_out_time == NULL)
													-
												@else
													@php
														$datetime1 = $attendance->date." ".$attendance->punch_in_time;
														$datetime2 = $attendance->date." ".$attendance->punch_out_time;
													   	$datetime1 = new DateTime($datetime1);
													   	$datetime2 = new DateTime($datetime2);
													   	$interval = $datetime1->diff($datetime2);
													   	$elapsed = $interval->format('<span>%H:%I:%S</span>');
													   	echo $elapsed ." Hrs";
													@endphp

												@endif
											</td>
										</tr>
										@php
											$i += 1;
										@endphp
									@endforeach
								</tbody>
							</table>
						</div>
					</div>
				</div>
				
			</div>
		</div>
	</div>
	<!-- /Page Content -->
</div>
<!-- Page Wrapper -->
@endsection