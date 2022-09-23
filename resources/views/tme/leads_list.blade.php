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
                        <input type="hidden" value="{{url('/')}}" name="base_url">
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
                                <th>View Leads</th>
                                <th>Action</th>
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
                                        <td><button class="btn btn-primary btn-sm view_leads" data-lead-id="{{$leads->lead_id}}">View History</button></td>
                                        <td>
                                            <a href="{{ url('team-leader/tme/edit-lead/'.$leads->lead_id) }}" class="btn btn-sm btn-info"><i class="la la-pencil"></i> Edit</a>
                                        </td>
                                    </tr>
                                @endforeach
                            @endif
                        </tbody>
                    </table>
                </div>
                <div id="myModal" class="modal" tabindex="-1" role="dialog">
                    <div class="modal-dialog modal-lg" role="document">
                        <div class="modal-content">
                            <div class="modal-header">
                                <h5 class="modal-title">Leads History</h5>
                                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                <span aria-hidden="true">&times;</span>
                                </button>
                            </div>
                            <div class="modal-body append-content">
                                
                            </div>
                            <div class="modal-footer">
                                <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                            </div>
                        </div>
                    </div>
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
    $('.view_leads').click(function(){
        var base_url     = $('input[name="base_url"]').val();
        var cmt_id       = $(this).attr('data-lead-id');
        var redirect_url = base_url+'/team-leader/tme/leads-comment/'+cmt_id;
        $.ajax({
            url: redirect_url,
            method:'GET', 
            success: function(result){
                $('#myModal').modal('show');
                $('.append-content').html(result);
            }
        });
    });
    @if ($message = Session::get('success'))
        $.toaster({ priority : 'success', title : 'Notice', message : '{{ $message }}'});           
    @endif
</script>
@endsection