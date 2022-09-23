<!DOCTYPE html>
<html lang="en">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0, user-scalable=0">
        
        @section('title')
        	@show
        <meta name="csrf-token" content="{{ csrf_token() }}">
		<!-- Bootstrap CSS -->
        <link rel="stylesheet" href="{{ url('assets/css/bootstrap.min.css') }}">
		
		<!-- Fontawesome CSS -->
        <link rel="stylesheet" href="{{ url('assets/css/font-awesome.min.css') }}">
		
		<!-- Main CSS -->
        <link rel="stylesheet" href="{{ url('assets/css/style.css') }}">
		<!-- font awesome  -->
		<link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.7.2/css/all.css" integrity="sha384-fnmOCqbTlWIlj8LyTjo7mOUStjsKC4pOpQbqyi7RrhN7udi9RwhKkMHpvLbHG9Sr" crossorigin="anonymous" />
    </head>
    <body class="account-page">
	
		@yield('content')
		
		<!-- jQuery -->
        <script src="{{ url('assets/js/jquery-3.5.1.min.js') }}"></script>
		
		<!-- Bootstrap Core JS -->
        <script src="{{ url('assets/js/popper.min.js') }}"></script>
        <script src="{{ url('assets/js/bootstrap.min.js') }}"></script>
		
		<!-- Custom JS -->
		<script src="{{ url('assets/js/app.js') }}"></script>
		
		<script type="text/javascript">
			$(document).ready(function() {
			    $(".form-control").on("focus", function() {
			        $(this).on("keydown", function(event) {
			            if (event.keyCode === 38 || event.keyCode === 40) {
			                event.preventDefault();
			            }
			        });
			    });

			});

			function password_show_hide() {
			  	var x = document.getElementById("password");
			  	var show_eye = document.getElementById("show_eye");
			  	var hide_eye = document.getElementById("hide_eye");
			  	hide_eye.classList.remove("d-none");
			  	if (x.type === "password") {
			    	x.type = "text";
			    	show_eye.style.display = "none";
			    	hide_eye.style.display = "block";
			  	} else {
			    	x.type = "password";
			    	show_eye.style.display = "block";
			    	hide_eye.style.display = "none";
				}
			}
		</script>
		@section('scripts')
			@show
    </body>
</html>