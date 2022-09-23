@extends("layouts.auth")
<title>Fixmarry Sales | Attendance | Punch In </title>
@section('content')
<!-- Main Wrapper -->
<div class="main-wrapper">
    <div class="account-content">
        
        <div class="container">
            <div class="card punch-status">
	            <div class="card-body">
	                <h5 class="card-title">Timesheet <small class="text-muted">{{ date("d M Y") }}</small></h5>
	                {{-- <div class="punch-det">
	                    <h6>Punch In</h6>
	                </div> --}}
	                <div class="punch-info">
	                    <div class="punch-hours">
	                       	<span>0.00.00 hrs</span>
	                    </div>
	                </div>
	                <div class="punch-btn-section">
	                    <form onsubmit="punchIn()">
	                        <button type="submit" class="btn btn-primary punch-btn" id="btnSubmit">Punch In</button>
	                    </form>
	                </div>
	                  
	            </div>
            </div>
        </div>
    </div>
</div>
<!-- /Main Wrapper -->
@endsection

@section('scripts')
	<script>
		function punchIn() {
			event.preventDefault();
			$('#btnSubmit').attr('disabled', true);
			$('#btnSubmit').html('<span class="spinner-border spinner-border-sm" role="status" aria-hidden="true"></span>');
			$.ajax({
			    type: "POST",
			    url: "{{ route('employee.punch_in') }}",
			    headers: {'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')},
			    success: function (response) {
			       if (response) {
			       	window.location = '{{ url('/') }}';
			       }
			    },
			    error: function (e) {
			       	$('#btnSubmit').attr('disabled', false);
			       	$('#btnSubmit').html('Punch In');
			
			    }
			});
		}
	</script>
@endsection