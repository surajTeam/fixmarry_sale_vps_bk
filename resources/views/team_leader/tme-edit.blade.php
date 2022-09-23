@extends('layouts.main')
@section('title')
    <title>Fixmarry Sales | Edit TME</title>
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
                    <h3 class="page-title">TME</h3>
                    <ul class="breadcrumb">
                        <li class="breadcrumb-item"><a href="{{ url('/') }}">Dashboard</a></li>
                        <li class="breadcrumb-item active">TME</li>
                    </ul>
                </div>
            </div>
        </div>
        <!-- /Page Header -->
        <div class="row mt-3">
            <div class="col-md-12">
                <div class="table-responsive">
                    <table class="table table-borderless custom-table" id="employeeList" data-ordering="false">
                        <tr>
                            <td>Name</td>
                            <td>{{$tme->name}}</td>
                            <td>Email</td>
                            <td>{{$tme->email}}</td>
                        </tr>
                        <tr>
                            <td>Fixmarry Id</td>
                            <td>{{$tme->fixmarry_employee_id}}</td>
                            <td>Contact Number</td>
                            <td>{{$tme->contact_number}}</td>
                        </tr>
                    </table>
                </div>
                <div class="card pt-2">
                    <div class="card-body">
                        <form method="POST" autocomplete="off" action="{{ url('team-leader/tme/update-tme-comment') }}">
                        @csrf
                        <input type="hidden" name="tme_id" value="{{$tme->id}}">
                        <div class="row">
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label>Comment</label>
                                    <textarea class="form-control @error('tl_comment') is-invalid @enderror" name="tl_comment">{{$tme->tl_comment}}</textarea>
                                    @error('tl_comment')
                                        <div class="invalid-feedback" role="alert">
                                            <strong>{{ $message }}</strong>
                                        </div>
                                    @enderror
                                </div>
                            </div>
                        </div>
                        <div class="submit-section">
                            <button type="submit" class="btn btn-primary btn-sm">Submit</button>
                            <a href="{{url('team-leader/tme')}}"><button class="btn btn-primary btn-sm" type="button">Cancel</button></a>
                        </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection