@extends('layouts.auth')
@section('title')
	<title>Fixmarry Sales | OTP</title>
@endsection

@section('content')
	<!-- Main Wrapper -->
	<div class="main-wrapper">
		<div class="account-content">
			
			<div class="container">
				<!-- Account Logo -->
				{{-- <div class="account-logo">
				    <a href="{{ url('/') }}"><img src="{{ url('assets/img/logo.png') }}" alt="PAYGET"></a>
				</div> --}}
				<!-- /Account Logo -->
				<div class="account-box">
					<div class="account-wrapper">
						<h3 class="account-title">OTP</h3>
						<p class="account-subtitle">Verification your account</p>
						@if (Session::has('message'))
	                        <div class="alert alert-success" role="alert">
	                        	<a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a>
	                            {{ Session::get('message') }}
	                        </div>
	                    @endif
						<!-- Account Form -->
						<form action="{{ route('employee.forgot-password-otp') }}" method="POST" autocomplete="off">
							@csrf
							<div class="form-group">
								<label>Enter Otp</label>
								<input class="form-control @error('otp') is-invalid @enderror" type="number" name="otp" value="{{ old('otp') }}" autofocus>

								@error('otp')
	                                <span class="invalid-feedback" role="alert">
	                                    <strong>{{ $message }}</strong>
	                                </span>
	                            @enderror
							</div>
							<div class="form-group text-center">
								<input type="hidden" name="email" value="{{ $email }}">
								<button class="btn btn-primary account-btn" type="submit">Verify</button>
							</div>
							
						</form>
						<!-- /Account Form -->
					</div>
				</div>
			</div>
		</div>
	</div>
	<!-- /Main Wrapper -->
@endsection