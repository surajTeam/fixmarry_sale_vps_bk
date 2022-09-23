@extends('layouts.main')
@section('title')
    <title>Fixmarry Sales | Edit Lead</title>
@endsection

@section('content')
<!-- Page Wrapper -->
<div class="page-wrapper">
    <!-- Page Content -->
    <div class="content container-fluid">
        <!-- Page Header -->
        <div class="page-header">
            <div class="row align-items-center">
                <div class="col">
                    <h3 class="page-title">Leads</h3>
                    <ul class="breadcrumb">
                        <li class="breadcrumb-item"><a href="{{ url('/') }}">Dashboard</a></li>
                        <li class="breadcrumb-item active">Leads</li>
                    </ul>
                </div>
            </div>
        </div>
        <!-- /Page Header -->
        <div class="row mt-3">
            <div class="col-md-12">
                 @if (Session::has('success'))
					<div class="alert alert-success" role="alert">
						<a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a>
							{{ Session::get('success') }}
					</div>
                @endif
                <div class="table-responsive">
                    <table class="table table-borderless custom-table" id="employeeList" data-ordering="false">
                        <tr>
                            <td>Name</td>
                            <td>{{$leadsvalue->firstname}}</td>
                            <td>Email</td>
                            <td>{{$leadsvalue->email}}</td>
                        </tr>
                        <tr>
                            <td>Matri Id</td>
                            <td>{{$leadsvalue->matri_id}}</td>
                            <td>Contact Number</td>
                            <td>{{$leadsvalue->mobile}}</td>
                        </tr>
                    </table>
                </div>
                <div class="card pt-2">
                    <div class="card-body">
                        <form method="POST" autocomplete="off" action="{{ url('team-leader/tme/update-status') }}">
                        @csrf
                        <input type="hidden" name="lead_id" value="{{$leadsvalue->index_id}}">
                        <div class="row">
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label>Status</label>
                                    <select class="form-control @error('status') is-invalid @enderror" id="status" name="status">
                                        <option value="">--SELECT--</option>
                                        <option value="free" @if($leadsvalue->status=='free') selected @endif>Free User</option>
                                        <option value="followup" @if($leadsvalue->status=='followup') selected @endif>Follow Up</option>
                                        <option value="paid" @if($leadsvalue->status=='paid') selected @endif>Paid User</option>
                                    </select>

                                    @error('status')
                                        <div class="invalid-feedback" role="alert">
                                            <strong>{{ $message }}</strong>
                                        </div>
                                    @enderror
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label>Comment</label>
                                    <textarea class="form-control @error('comment') is-invalid @enderror" name="comment">{{$leadsvalue->comment}}</textarea>
                                    @error('comment')
                                        <div class="invalid-feedback" role="alert">
                                            <strong>{{ $message }}</strong>
                                        </div>
                                    @enderror
                                </div>
                            </div>
                        </div>
                        <div class="submit-section">
                            <button class="btn btn-primary btn-sm">Submit</button>
                            <a href="{{url('team-leader/tme/tme-lead-list')}}"><button class="btn btn-primary btn-sm">Cancel</button></a>
                        </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection