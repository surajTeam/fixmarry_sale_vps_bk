@extends('layouts.main')
@section('title')
    <title>Fixmarry Sales | Team Leader</title>
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
                    <h3 class="page-title">Team Leader</h3>
                    <ul class="breadcrumb">
                        <li class="breadcrumb-item"><a href="{{ url('/') }}">Dashboard</a></li>
                        <li class="breadcrumb-item active">Team Leader</li>
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
                            <td>{{$teamleader->name}}</td>
                            <td>Email</td>
                            <td>{{$teamleader->email}}</td>
                        </tr>
                        <tr>
                            <td>Contact Number</td>
                            <td>{{$teamleader->contact_number}}</td>
                            <td>Fix marry Employeeid</td>
                            <td>{{$teamleader->fixmarry_employee_id}}</td>
                        </tr>
                    </table>
                </div>
                <div class="card pt-2">
                    <div class="card-body">
                        <form method="POST" autocomplete="off" action="{{ url('admin/team-leader/update-comment') }}">
                        @csrf
                        <input type="hidden" name="team_leader_id" value="{{$teamleader->id}}">
                        <div class="row">
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label>Comment</label>
                                    <textarea class="form-control @error('admin_comment') is-invalid @enderror" name="admin_comment">{{$teamleader->admin_comment}}</textarea>
                                    @error('admin_comment')
                                        <div class="invalid-feedback" role="alert">
                                            <strong>{{ $message }}</strong>
                                        </div>
                                    @enderror
                                </div>
                            </div>
                        </div>
                        <div class="submit-section">
                            <button type="submit" class="btn btn-primary btn-sm">Submit</button>
                            <a href="{{url('admin/team-leader/team-leader-list')}}"><button class="btn btn-primary btn-sm" type="button">Cancel</button></a>
                        </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection