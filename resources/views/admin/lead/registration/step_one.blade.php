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
				<div class="col-sm-12">
					<h3 class="page-title">Lead</h3>
					<ul class="breadcrumb">
						<li class="breadcrumb-item"><a href="{{ url('/') }}">Dashboard</a></li>
						<li class="breadcrumb-item active">Register Lead</li>
					</ul>
				</div>
			</div>
		</div>
		<!-- /Page Header -->
		@if(Session::has('success'))
<div class="alert alert-success">
  {{ Session::get('success')}}
</div>
@endif
<form method="POST" autocomplete="off" action="{{ route('lead') }}">
		@csrf
		<div class="row">
			<div class="col-md-6 d-flex">
				<div class="card profile-box flex-fill">
					<div class="card-body">
						<h3 class="card-title">Personal Informations </h3>
						<div class="form-group">
							<label>First Name</label>
							<input type="text" name="first_name" class="form-control @error('first_name') is-invalid @enderror" value="{{ old('first_name') }}">
						</div>
						<div class="form-group">
							<label>Last Name</label>
							<input type="text" name="last_name" class="form-control @error('last_name') is-invalid @enderror" value="{{ old('last_name') }}">
						</div>
						<div class="form-group">
							<label>Email Id</label>
							<input type="email" name="email_id" class="form-control @error('email_id') is-invalid @enderror" value="{{ old('email_id') }}">
						</div>



						<div class="row">
							<div class="col-md-3">
								<div class="form-group">
									<label>Country Code</label>
									<select class="form-control @error('country_code') is-invalid @enderror" name="country_code">
										<option value="">--SELECT--</option>
										@include('includes.components.country_code_option')
									</select>
								</div>
							</div>
							<div class="col-md-9">
								<div class="form-group">
									<label>Mobile Number</label>
									<input type="number" name="mobile_number" class="form-control @error('mobile_number') is-invalid @enderror" value="{{ old('mobile_number') }}">
								</div>
							</div>
						</div>
						<div class="form-group">
							<label>Gender</label>
							<select class="form-control @error('gender') is-invalid @enderror" name="gender">
								<option value="">--SELECT--</option>
								<option value="male">Male</option>
								<option value="female">Female</option>
							</select>
						</div>
						<div class="form-group">
							<label>Date of birth</label>
							<input type="date" name="date_of_birth" class="form-control @error('date_of_birth') is-invalid @enderror" value="{{ old('date_of_birth') }}">
						</div>
					</div>
				</div>
			</div>
			<div class="col-md-6 d-flex">
				<div class="card profile-box flex-fill">
					<div class="card-body">
						<h3 class="card-title">General Informations </h3>
						<div class="form-group">
							<label>Marital status</label>
							<select class="form-control @error('marital_status') is-invalid @enderror" name="marital_status" v-model="marital_status">
								<option value="">--SELECT--</option>
								<option value="Never Married">Never Married</option>
								<option value="Widower">Widower</option>
								<option value="Divorced">Divorced</option>
								<option value="Awaiting Divorce">Awaiting Divorce</option>
							</select>

						</div>

						<div class="form-group" v-if="showChildrenCount">
							<label>Number of children</label>
							<input type="number" name="no_of_children" class="form-control @error('no_of_children') is-invalid @enderror" value="{{ old('no_of_children') }}">
						</div>

						<div class="form-group">
							<label>Religion</label>
							<select class="form-control select @error('religion') is-invalid @enderror" name="religion">
								<option value="">--SELECT--</option>
								@foreach($religions as $religion)
												<option value ="{{ $religion->religion_id}}">{{ $religion->religion_name }}</option>
											@endforeach
							</select>
						</div>

						<div class="form-group">
							<label>Caste</label>
							<select class="form-control select @error('caste') is-invalid @enderror" name="caste">
								<option value="">--SELECT--</option>
								@foreach($castes as $caste)
												<option value ="{{ $caste->caste_id}}">{{ $caste->caste_name }}</option>
											@endforeach
							</select>
						</div>

						<div class="form-group">
							<label>Mother Tongue</label>
							<!-- <select class="form-control select" name="mother_tongue">
								<option value="">--SELECT--</option>
							</select> -->
							<select class="select form-control @error('languages_known') is-invalid @enderror" name="languages_known">
											<option value="">--SELECT--</option>
											@foreach($languages as $language)
												<option value ="{{ $language->mtongue_id }}">{{ $language->mtongue_name}}</option>
											@endforeach
										</select>
										
						</div>
						<div class="form-group">
							<label>Country Live In</label>
							<select class="form-control select @error('residing_country') is-invalid @enderror" v-select='country' v-model="country" name="residing_country" v-on:change="getStates()">
								<option value="">--SELECT--</option>
								<option v-for='(data, index) in countries' :value='data.id' :key="'country' + index">@{{ data.country_name }}</option>
							</select>
						</div>
						<div class="form-group" v-if="country != ''">
							<label>Residing state</label>
							<select class="form-control select @error('residing_state') is-invalid @enderror"  v-model="state" name="residing_state"  v-on:change="getCities()">
								<option value="">--SELECT--</option>
								<option v-for='(data, index) in states' :value='data.state_id' :key="'state' + index">@{{ data.state_name }}</option>
							</select>
						</div>
						<div class="form-group" v-if="state != ''">
							<label>Residing city</label>
							<select class="form-control select @error('residing_city') is-invalid @enderror" name="residing_city">
								<option value="">--SELECT--</option>
								<option v-for='(data, index) in cities' :value='data.city_id' :key="'city' + index">@{{ data.city_name }}</option>
							</select>
						</div>
						<div class="form-group">
							<label>Address</label>
							<input type="text" name="address" class="form-control" value="{{ old('address') }}">
						</div>
					</div>
				</div>
			</div>
		</div>

		<div class="submit-section">
								<button class="btn btn-primary submit-btn">Lead Register</button>
							</div>
	</form>
	</div>
	
</div>
@endsection

@section('scripts')
	<script type = "text/javascript">
		Vue.directive('select', {
		  twoWay: true,
		  bind: function (el, binding, vnode) {
		    $(el).select2().on("select2:select", (e) => {
		      // v-model looks for
		      //  - an event named "change"
		      //  - a value with property path "$event.target.value"
		      el.dispatchEvent(new Event('change', { target: e.target }));
		    });
		  },
		  componentUpdated: function(el, me) {
		    // update the selection if the value is changed externally
		    $(el).trigger("change");
		  }
		});
	    var app = new Vue({
	        el: '#app',
	        data: {
	            marital_status: '',
	            country: '',
	            countries: [],
	            state: '',
	            states: [],
	            city: '',
	            cities: []
	        },
	        computed: {
	        	showChildrenCount() {

			    	if (this.marital_status == 'Never Married' || this.marital_status == '') {
			    		return false;
			    	} else {
			    		return true;
			    	}
			    }
	        },
	        methods:{
	            getCountries: async function() {
	            	await axios.get('{{ url('api/get-countries') }}')
	            	            .then(response => {this.countries = response.data})
	            	            .catch( error => console.log(error));
	                
	            },
	            getStates: async function() {
	                await axios.post( '{{ url('api/get-states') }}',
	                		{
		                        country_id: this.country
		                    })
	                		.then( response => {
	                			this.states = response.data;

							})
	                		.catch( error => {

	                		});

	            },

	             getCities: async function() {
	                await axios.post( '{{ url('api/get-cities') }}',
	                		{
		                        state_id: this.state
		                    })
	                		.then( response => {
	                			this.cities = response.data
	                			$('.select').select2()
							})
	                		.catch( error => {

	                		});

	            }


	            


	        },
	        created() {
	            this.getCountries()
	        }
	    });

	</script>
@endsection