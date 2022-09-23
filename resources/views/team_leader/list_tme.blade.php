@extends('layouts.main')
@section('title')
    <title>Fixmarry Sales | Employees List</title>
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
                                <th>Fixmarry Id</th>
                                <th>Email Id</th>
                                <th>Contact Number</th>
                                <!-- <th>Comment</th> -->
                                <th>Action</th>
                            </tr>
                        </thead>
                        <tbody>
                           @foreach($tme->salesTeamLeaderEmployee as $tm)
                           <?php $user=$tm->salesEmployee;?>
                                    <tr>
                                        <td>{{ $user->name }}</td>
                                        <td>{{ $user->fixmarry_employee_id }}</td>
                                        <td>{{ $user->email }}</td>
                                        <td>{{ $user->contact_number }}</td>
                                        <!-- <td>{{ $user->TLComment($user->id) }}</td> -->
										<td>
                                            <a href="{{ url('team-leader/tme/tme-leads-list/'.$user->id) }}" class="btn btn-sm btn-primary"><i class="la la-pencil"></i>View leads</a>
                                            <!-- <a href="{{ url('team-leader/tme/edit-tme/'.$user->id) }}" class="btn btn-sm btn-info"><i class="la la-pencil"></i>Add Comment</a> -->
                                        </td>
                                    </tr>
                            @endforeach
                                    <!--  <tr>

                                       
                                        <td>ram</td>
                                        <td>ram</td>
                                        <td>ram</td>
                                        <td>9874563210</td>
                                        
                                    </tr> -->
                               
                               
                        </tbody>
                    </table>
                </div>
				
				 <div id="myModal" class="modal" tabindex="-1" role="dialog">
                    <div class="modal-dialog modal-lg" role="document">
                        <div class="modal-content">
                            <div class="modal-header">
                                <h5 class="modal-title">Leads List</h5>
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
    @if ($message = Session::get('success'))
        $.toaster({ priority : 'success', title : 'Notice', message : '{{ $message }}'});           
    @endif
	
	$('.view_leads').click(function(){
        var base_url     = $('input[name="base_url"]').val();
        var tme_id       = $(this).attr('data-lead-id');
            var redirect_url = base_url+'/team-leader/tme/tme-leads-list/'+tme_id;
        $.ajax({
            url: redirect_url,
            method:'GET', 
            success: function(result){
                $('#myModal').modal('show');
                $('.append-content').html(result);
            }
        });
       
    });
</script>
@endsection