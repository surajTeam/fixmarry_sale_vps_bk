@extends('layouts.auth')
@section('title')
	<title>Fixmarry Sales | Forgot Password</title>
@endsection

@section('content')
<!-- Main Wrapper -->
<div class="main-wrapper">
	<div class="account-content">
		
		<div class="container">
			
			<div class="account-box">
				<div class="account-wrapper">
					<h3 class="account-title">Forgot Password?</h3>
					<p class="account-subtitle">Enter your email to get a password reset link</p>
					
					<!-- Account Form -->
					<form method="POST" autocomplete="off" action="{{ route('employee.forgot-password') }}">
						@csrf
						<div class="form-group">
							<label>Email Address</label>
							<input class="form-control @error('email') is-invalid @enderror" type="email" name="email" value="{{ old('email') }}" autofocus>

							@error('email')
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                            @enderror
						</div>
						<div class="form-group text-center">
							<button class="btn btn-primary account-btn" type="submit">Reset Password</button>
						</div>
						<div class="account-footer">
							<p>Remember your password? <a href="{{ url('login') }}">Login</a></p>
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