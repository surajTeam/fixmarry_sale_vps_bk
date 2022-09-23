@extends('layouts.main')
@section('title')
	<title>Fixmarry Sales | Lead | Registration</title>
@endsection

@section('content')
<!-- Page Wrapper -->
<div class="page-wrapper" id="app">
	<!-- Page Content -->
	<div class="content container-fluid">
		<!-- Page Header -->
		<div class="page-header">
			<div class="row">
				<div class="col">
					<h3 class="page-title">Lead</h3>
					<ul class="breadcrumb">
						<li class="breadcrumb-item"><a href="{{ url('/') }}">Dashboard</a></li>
						<li class="breadcrumb-item active">Register Lead</li>
					</ul>
				</div>
				<div class="col-auto float-right ml-auto">
                    <a href="http://localhost:8000/admin/lead/register/step-one" class="btn add-btn"><i class="fa fa-plus"></i>Add Lead</a>                  
                </div>
			</div>
		</div>
		<!-- /Page Header -->
		@if(\Session::has('success'))
			<div class="alert alert-success">
				{{ Session::get('success')}}
			</div>
		@endif
		@if(\Session::has('danger'))
			<div class="alert alert-danger">
				{{ Session::get('danger')}}
			</div>
		@endif
		<form method="POST" autocomplete="off" action="{{ route('importLead') }}"  enctype="multipart/form-data">
				@csrf
				<div class="row">
					<div class="col-md-6 d-flex">
						<div class="card profile-box flex-fill">
							<div class="card-body">
								<h3 class="card-title">Import Lead </h3>
								<div class="form-group">
									<label>Upload File: </label>
									<input type="file" name="import_file" id="import_file" class="front_id_card " required="">							
									<div class="submit-section">
										<button class="btn btn-primary submit-btn">Lead Register</button>
									</div>
								</div>
							</div>
						</div>
					</div>
					
				</div>
		</form>
	</div>
</div>
@endsection

