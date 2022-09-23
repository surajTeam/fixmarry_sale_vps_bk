@extends('layouts.main')
@section('title')
	<title>Fixmarry Sales | Add Employee</title>
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
						<h3 class="page-title">Add Employees</h3>
					</div>
					<div class="card-body">
						<form method="POST" autocomplete="off" action="{{ route('employee.register') }}">
							@csrf
							<div class="row">
								<div class="col-sm-6">
									<div class="form-group">
										<label>Name </label>
										<input class="form-control @error('name') is-invalid @enderror" type="text" value="{{ old('name') }}" name="name">
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
										<input class="form-control @error('email') is-invalid @enderror" value="{{ old('email') }}" type="email" name="email">
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
										<input class="form-control @error('dob') is-invalid @enderror" value="{{ old('dob') }}" type="date" name="dob" max="9999-12-31">
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
										<select class="form-control @error('gender') is-invalid @enderror" name="gender">
											<option value="">--SELECT--</option>
											<option value="male" @if(old('gender') == 'male') selected @endif>Male</option>
											<option value="female" @if(old('gender') == 'female') selected @endif>Female</option>
											<option value="transgender" @if(old('gender') == 'transgender') selected @endif>Transgender</option>
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
										<input type="text" class="form-control @error('address') is-invalid @enderror" value="{{ old('address') }}" name="address">
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
										<input class="form-control @error('mobile_number') is-invalid @enderror" value="{{ old('mobile_number') }}" type="number" name="mobile_number">
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
										

										<select class="select form-control @error('languages_known') is-invalid @enderror" name="languages_known[]" multiple="multiple">
											<option value="">--SELECT--</option>
											@foreach($languages as $language)
												<option @if(old('languages_known') != NULL && in_array($language->name, old('languages_known'))) selected @endif>{{ $language->name }}</option>
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
										       <option value="{{ $role->id }}" @if(old('employee_role') == $role->id) selected @endif>{{ $role->display_name }}</option>
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
								<button class="btn btn-primary submit-btn">Create Employee</button>
							</div>
						</form>
					</div>
				</div>
			</div>
		</div>
	</div>
</div>
@endsection
@section('scripts')
<script>
	
</script>
@endsection