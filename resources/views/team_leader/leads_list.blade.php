@extends('layouts.main')
@section('title')
    <title>Fixmarry Sales | Leads List</title>
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
                
                <div class="table-responsive">
                    <table class="table table-bordered custom-table" id="employeeList" data-ordering="false">
                        <thead>
                            <tr class="bg-primary text-white">
                                <th>Name</th>
                                <th>Email</th>
                                <th>Date of Birth</th>
                                <th>Contact Number</th>
                                <th>Status</th>
                                <th>Comment</th>
                            </tr>
                        </thead>
                        <tbody>    
                            @if(count($leadlist)>0)
                                @foreach($leadlist as $leads)
                                    <tr>
                                        <td>{{$leads->firstname}}</td>
                                        <td>{{$leads->email}}</td>
                                        <td>{{$leads->birthdate}}</td>
                                        <td>{{$leads->mobile}}</td>
                                        <td>
                                            @if($leads->status=='free')
                                                Free User
                                            @elseif($leads->status=='followup')
                                                Follow Up
                                            @else
                                                Paid User
                                            @endif
                                        </td>
                                        <td>{{$leads->comment}}</td>
                                    </tr>
                                @endforeach
                            @endif
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection

@section('scripts')
<script type="text/javascript">
    $('#employeeList').DataTable({
        "bFilter": true
    });
    @if ($message = Session::get('success'))
        $.toaster({ priority : 'success', title : 'Notice', message : '{{ $message }}'});           
    @endif
</script>
@endsection