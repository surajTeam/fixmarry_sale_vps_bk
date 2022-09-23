@extends('layouts.main')
@section('title')
	<title>Fixmarry Sales | Employees List</title>
@endsection

@section('content')
<!-- Page Wrapper -->
<div class="page-wrapper">
	<!-- Page Content -->
	<div class="content container-fluid">
		<!-- Page Header -->
		<div class="page-header">
			<div class="row align-items-center">
				<div class="col">
					<h3 class="page-title">Employees</h3>
					<ul class="breadcrumb">
						<li class="breadcrumb-item"><a href="{{ url('/') }}">Dashboard</a></li>
						<li class="breadcrumb-item active">Employees</li>
					</ul>
				</div>
				<div class="col-auto float-right ml-auto">
					<a href="{{ url('manager/employees/register') }}" class="btn add-btn"><i class="fa fa-plus"></i> Add Employees</a>
					
				</div>
			</div>
		</div>
		<!-- /Page Header -->
		<div class="row mt-3">
			<div class="col-md-12">
				
				<div class="table-responsive">
					<table class="table table-bordered custom-table" id="employeeList" data-ordering="false">
						<thead>
							<tr class="bg-primary text-white">
								<th>Name</th>
								<th>Fixmarry Id</th>
								<th>Email Id</th>
								<th>Contact Number</th>
								<th>Languages Known</th>
								<th>Employee Role</th>
								<th>Action</th>
							</tr>
						</thead>
						<tbody>
							@foreach($employees as $employee)
								@if($employee->role->id != 1)
									<tr>

										<td class="text-black">
											<h2 class="table-avatar">
												<span class="avatar"><img alt="" src="{{ $employee->profile_photo_url }}"></span>
												<span>{{ $employee->name }} <span>{{ $employee->created_at }}</span></span>
											</h2>
										</td>
										<td>{{ $employee->fixmarry_employee_id }}</td>
										<td>{{ $employee->email }}</td>
										<td>{{ $employee->contact_number }}</td>
										<td>{{ $employee->languages_known }}</td>
										<td>{{ $employee->role->display_name }}</td>
										<td>
											<a href="{{ url('admin/employees/edit-profile') }}/{{ $employee->fixmarry_employee_id }}" class="btn btn-sm btn-info"><i class="la la-pencil"></i> Edit</a>
										</td>
									</tr>
								@endif
							@endforeach
						</tbody>
					</table>
				</div>
			</div>
		</div>
	</div>
</div>
@endsection

@section('scripts')
<script type="text/javascript">
	$('#employeeList').DataTable({
		"bFilter": true
	});
	@if ($message = Session::get('success'))
		$.toaster({ priority : 'success', title : 'Notice', message : '{{ $message }}'});			
	@endif
</script>
@endsection