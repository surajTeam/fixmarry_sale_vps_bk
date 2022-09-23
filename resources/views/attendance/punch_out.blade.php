@extends("layouts.auth")
<title>Fixmarry Sales | Attendance | Punch Out </title>
@section('content')
<!-- Main Wrapper -->
<div class="main-wrapper">
    <div class="account-content">
        
        <div class="container">
            <div class="card punch-status">
	            <div class="card-body">
	                <h5 class="card-title">Timesheet <small class="text-muted">{{ date("d M Y") }}</small></h5>
	                <div class="punch-det">
	                      <h6>Punch In at </h6>
	                      @php
	                           $date = strtotime($attendance->date);
	                           $time = strtotime($attendance->punch_in_time);
	                      @endphp
	                      <p>{{ date('D', $date) }}, {{ date('d', $date) }}th {{ date('M', $date) }} {{ date('Y', $date) }} {{ date('h:i:s A', $time) }}</p>
	                     
	                </div>
	                <div class="punch-info">
	                    <div class="punch-hours">
	                       	@php
	                       		$datetime = $attendance->date." ".$attendance->punch_in_time;
	                       	   	$datetime1 = new DateTime();
	                       	   	$datetime2 = new DateTime($datetime);
	                       	   	$interval = $datetime1->diff($datetime2);
	                       	   	$elapsed = $interval->format('<span>%H:%I:%S</span>');
	                       	   	echo $elapsed;
	                       	@endphp
	                    </div>
	                </div>
	                <div class="punch-btn-section">
	                	
	                    <form onsubmit="punchOut()">
	                        <button type="submit" class="btn btn-primary punch-btn" id="btnSubmit">Punch Out</button>
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
		function punchOut() {
			event.preventDefault();
			$('#btnSubmit').attr('disabled', true);
			$('#btnSubmit').html('<span class="spinner-border spinner-border-sm" role="status" aria-hidden="true"></span>');
			$.ajax({
			    type: "POST",
			    url: "{{ route('employee.punch_out') }}",
			    headers: {'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')},
			    success: function (response) {
			       if (response) {
			       	window.location = '{{ url('/') }}';
			       }
			    },
			    error: function (e) {
			       	$('#btnSubmit').attr('disabled', false);
			       	$('#btnSubmit').html('Punch Out');
			
			    }
			});
		}
	</script>
@endsection