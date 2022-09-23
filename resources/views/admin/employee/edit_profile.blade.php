@extends('layouts.main')
@section('title')
	<title>Fixmarry Sales | Edit Employee</title>
@endsection

@section('content')
<!-- Page Wrapper -->
<div class="page-wrapper">
	<!-- Page Content -->
	<div class="content container-fluid">
		<div class="row">
			<div class="col-md-8 offset-md-2">
				
				<div class="card pt-2">
					<div class="card-title text-center">
						<h3 class="page-title">Edit Employees</h3>
					</div>
					<div class="card-body">
						<form method="POST" autocomplete="off" action="{{ route('employee.edit-profile') }}">
							@csrf
							<input type="hidden" name="fixmarry_employee_id" value="{{ $employee->fixmarry_employee_id }}">
							<input type="hidden" name="employee_id" value="{{$employee->id}}">
							<div class="row">
								<div class="col-sm-6">
									<div class="form-group">
										<label>Name </label>
										<input class="form-control @error('name') is-invalid @enderror" type="text" value="{{ $employee->name }}" name="name">
										@error('name')
										    <div class="invalid-feedback" role="alert">
										        <strong>{{ $message }}</strong>
										    </div>
										@enderror
									</div>
								</div>
								<div class="col-sm-6">
									<div class="form-group">
										<label>Email</label>
										<input class="form-control @error('email') is-invalid @enderror" value="{{ $employee->email }}" type="email" name="email" disabled>
										@error('email')
										    <div class="invalid-feedback" role="alert">
										        <strong>{{ $message }}</strong>
										    </div>
										@enderror
									</div>
								</div>
							</div>
							<div class="row">
								<div class="col-sm-6">
									<div class="form-group">
										<label>Date of birth</label>
										<input class="form-control @error('dob') is-invalid @enderror" value="{{ $employee->date_of_birth }}" type="date" name="dob" max="9999-12-31">
										@error('dob')
										    <div class="invalid-feedback" role="alert">
										        <strong>{{ $message }}</strong>
										    </div>
										@enderror
									</div>
								</div>
								<div class="col-sm-6">
									<div class="form-group">
										<label>Gender</label>
										<select class="form-control @error('gender') is-invalid @enderror" value="{{ old('gender') }}" name="gender">
											<option value="">--SELECT--</option>
											<option value="male" @if($employee->gender == 'male') selected @endif>Male</option>
											<option value="female" @if($employee->gender == 'female') selected @endif>Female</option>
											<option value="transgender" @if($employee->gender == 'transgender') selected @endif>Transgender</option>
										</select>
										@error('gender')
										    <div class="invalid-feedback" role="alert">
										        <strong>{{ $message }}</strong>
										    </div>
										@enderror
									</div>
								</div>
							</div>
							<div class="row">
								<div class="col-sm-6">
									<div class="form-group">
										<label>Address</label>
										<input type="text" class="form-control @error('address') is-invalid @enderror" value="{{ $employee->address }}" name="address">
										@error('address')
										    <div class="invalid-feedback" role="alert">
										        <strong>{{ $message }}</strong>
										    </div>
										@enderror
									</div>
								</div>
								<div class="col-sm-6">
									<div class="form-group">
										<label>Mobile Number</label>
										<input class="form-control @error('mobile_number') is-invalid @enderror" value="{{ $employee->contact_number }}" type="number" name="mobile_number">
										@error('mobile_number')
										    <div class="invalid-feedback" role="alert">
										        <strong>{{ $message }}</strong>
										    </div>
										@enderror
									</div>
								</div>
							</div>

							<div class="row">
								<div class="col-sm-6">
									<div class="form-group">
										<label>Language Known</label>
										@php
											if(isset($employee->languages_known))
											$languages_known = explode(",", $employee->languages_known);
										@endphp
										<select class="select form-control @error('languages_known') is-invalid @enderror" name="languages_known[]" multiple="multiple">
											<option value="">--SELECT--</option>
											@foreach($languages as $language)
												<option @if(isset($employee->languages_known) && in_array($language->name, $languages_known)) selected @endif>{{ $language->name }}</option>
											@endforeach
										</select>
										@error('languages_known')
										    <div class="invalid-feedback" role="alert">
										        <strong>{{ $message }}</strong>
										    </div>
										@enderror
									</div>
								</div>
								<div class="col-sm-6">
									<div class="form-group">
										<label>Employee Role</label>
										
										<select class="form-control @error('employee_role') is-invalid @enderror" name="employee_role">
										    <option value="">--SELECT--</option>
										    @foreach($sales_employee_roles as $role)
										        <option value="{{ $role->id }}" @if($employee->role_id == $role->id) selected @endif>{{ $role->display_name }}</option>
										    @endforeach
										</select>
										@error('employee_role')
										    <div class="invalid-feedback" role="alert">
										        <strong>{{ $message }}</strong>
										    </div>
										@enderror
									</div>
								</div>
							</div>
							<div class="submit-section">
								<button class="btn btn-primary submit-btn">Update Employee</button>
							</div>
						</form>
					</div>
				</div>
			</div>
		</div>
	</div>
</div>
@endsection
