@extends('layouts.main')
@section('title')
    <title>Fixmarry Sales | Employees List</title>
@endsection

@section('content')
<!-- Page Wrapper -->
<div class="page-wrapper">
	<!-- Page Content -->
	<div class="content container-fluid">
		<div class="row">
			<div class="col-md-6 offset-md-3">
				@if (Session::has('success'))
					<div class="alert alert-success" role="alert">
						<a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a>
							{{ Session::get('success') }}
					</div>
                @endif
				<div class="card pt-2">
					<div class="card-title text-center">
						<h3 class="page-title">Assign Leads to TME</h3>
					</div>
					<div class="card-body">
						<form method="POST" autocomplete="off" action="{{ route('team_leader.assign_lead') }}">
							@csrf
							<input type="hidden" name="owner" value="Teamleader">
							<div class="col-md-12">
								<div class="form-group">
									<label>Select TME</label>
									<select class="form-control @error('team_leader') is-invalid @enderror" id="teamLeader" name="team_leader">
										<option value="">--SELECT--</option>


										@foreach($team_leaders->salesTeamLeaderEmployee  as $employee)
										 <?php $user=$employee->salesEmployee;?>
											<option value="{{ $user->id }}">{{ $user->name }}</option>
										@endforeach
									</select>

									@error('team_leader')
									    <div class="invalid-feedback" role="alert">
									        <strong>{{ $message }}</strong>
									    </div>
									@enderror
								</div>
							</div>
							<div class="col-md-12">
								<div class="form-group">
									<label>Select Lead</label>
									<select class="form-control @error('tme') is-invalid @enderror" id="rmList" name="tme[]" multiple="multiple">
										@foreach($leads as $employee)
											<option value="{{ $employee->index_id }}">{{ $employee->firstname }}</option>
										@endforeach
									</select>
									@error('tme')
									    <div class="invalid-feedback" role="alert">
									        <strong>{{ $message }}</strong>
									    </div>
									@enderror
								</div>
							</div>
							<div class="submit-section">
								<button class="btn btn-primary btn-sm">Assign Team Leader</button>
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
	$('#teamLeader').select2({
		width: '100%'
	});

	$('#rmList').select2({
		width: '100%'
	});
</script>
@endsection