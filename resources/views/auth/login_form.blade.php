@extends('layouts.auth')

@section('title')
    <title>Fixmarry Sales| Login</title>
@endsection

@section('content')
<!-- Main Wrapper -->
<div class="main-wrapper">
    <div class="account-content">
        
        <div class="container">
            
            <div class="account-box">
                <div class="account-wrapper">
                    <h3 class="account-title">Login</h3>
                    <p class="account-subtitle">Access to our dashboard</p>
                    <!-- Account Form -->
                    @if (Session::has('message'))
                        <div class="alert alert-success" role="alert">
                            <a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a>
                                {{ Session::get('message') }}
                        </div>
                    @endif
                    
                    <form method="POST" autocomplete="off" action="{{ route('employee.login') }}">
                        @csrf
                        <div class="form-group">
                            <label>Email Address</label>
                            <input id="email" type="email" class="form-control @error('email') is-invalid @enderror" name="email" value="{{ old('email') }}" autofocus>

                            @error('email')
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                            @enderror
                        </div>

                        <div class="form-group">
                            <div class="row">
                                <div class="col">
                                    <label>Password</label>
                                </div>
                                <div class="col-auto">
                                    <a class="text-muted" href="{{ url('forgot-password') }}">
                                        {{ __('Forgot Your Password?') }}
                                    </a>
                                </div>
                            </div>

                            {{-- <div class="input-group" id="show_hide_password">
                                <input id="password" type="password" class="form-control @error('password') is-invalid @enderror" name="password" autofocus>
                                <div class="input-group-addon">
                                    <a href=""><i class="fa fa-eye-slash" aria-hidden="true"></i></a>
                                </div>
                            </div> --}}
                           <div class="input-group">
                            <input id="password" type="password" class="form-control @error('password') is-invalid @enderror" name="password" autofocus>
                            <div class="input-group-append">
                                <span class="input-group-text" onclick="password_show_hide();">
                                    <i class="fas fa-eye" id="show_eye"></i>
                                    <i class="fas fa-eye-slash d-none" id="hide_eye"></i>
                                </span>
                            </div>
                           </div>

                            @error('password')
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                            @enderror
                        </div>

                        
                        <div class="form-group text-center">
                            <button class="btn btn-primary account-btn" type="submit">Login</button>
                        </div>
                        {{-- <div class="account-footer">
                            <p>Are you PAYGET vendor? <a href="{{ url('vendor') }}">Click Here</a></p>
                        </div> --}}
                    </form>
                    <!-- /Account Form -->
                </div>
            </div>
        </div>
    </div>
</div>
<!-- /Main Wrapper -->
@endsection

