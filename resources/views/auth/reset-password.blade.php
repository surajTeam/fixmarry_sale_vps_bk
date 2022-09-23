@extends('layouts.auth')
@section('title')
<title>Fixmarry  Sales | Reset Password</title>
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
                    <h3 class="account-title">Reset Password</h3>
                    <!-- Account Form -->
                    <form method="POST" action="{{ route('employee.reset-password') }}">
                        @csrf
                        
                        <div class="form-group">
                            <label>Email Address</label>
                            <input id="email" type="email" class="form-control @error('email') is-invalid @enderror" name="email" value="{{ $email ?? old('email') }}" required autocomplete="email">

                            @error('email')
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                            @enderror
                        </div>
                        <div class="form-group">
                            <label for="password">{{ __('Password') }}</label>

                            <input id="password" type="password" class="form-control @error('password') is-invalid @enderror" name="password" required autocomplete="new-password">

                            @error('password')
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                            @enderror
                        </div>

                        <div class="form-group">
                            <label for="password-confirm">{{ __('Confirm Password') }}</label>

                           <input id="password-confirm" type="password" class="form-control" name="password_confirmation" required autocomplete="new-password">
                        </div>
                        <div class="form-group text-center">
                            <button class="btn btn-primary account-btn" type="submit">Reset Password</button>
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
