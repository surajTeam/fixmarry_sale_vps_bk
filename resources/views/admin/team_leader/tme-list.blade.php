@extends('layouts.main')
@section('title')
    <title>Fixmarry Sales | TME List</title>
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
						<input type="hidden" value="{{url('/')}}" name="base_url">
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
                    <table class="table table-bordered custom-table" id="employeeList" data-ordering="false">
                        <thead>
                            <tr class="bg-primary text-white">
                                <th>Name</th>
                                <th>Email Id</th>
                                <th>Contact Number</th>
                                <!-- <th>Comment</th>-->
                                <th>Action</th> 
                            </tr>
                        </thead>
                        <tbody>
                            @if(count($tme_list)>0)
                                @foreach($tme_list as $tme)
                                    <tr>
                                        <td>{{$tme->salesEmployee->name}}</td>
                                        <td>{{$tme->salesEmployee->email}}</td>
                                        <td>{{$tme->salesEmployee->contact_number}}</td>
                                        <td>
                                            <a href="{{ url('admin/team-leader/tme-leads-list/'.$tme->salesEmployee->id) }}" class="btn btn-sm btn-primary"><i class="la la-eye"></i>View Leads</a>
                                        </td>
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