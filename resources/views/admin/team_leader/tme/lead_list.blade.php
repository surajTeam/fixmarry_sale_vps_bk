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
                    <h3 class="page-title">Lead</h3>
                    <ul class="breadcrumb">
                        <li class="breadcrumb-item"><a href="{{ url('/') }}">Dashboard</a></li>
                        <li class="breadcrumb-item active">Lead</li>
                    </ul>
                </div>
                <div class="col-auto float-right ml-auto">
                    <a href="{{ url('admin/lead/register/step-one') }}" class="btn add-btn"><i class="fa fa-plus"></i> Add Lead</a>
                    
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
                                <th>S.No</th>
                                <th>Name</th>
                                <th>Email Id</th>
                                <th>Contact Number</th>
                                <th>Assigned TL</th>
                              
                            </tr>
                        </thead>
                        <tbody>
<?php $i=1;?>
                             @foreach($leads as $lead)
                         
                                        <tr>
                                        <td>{{ $i }}</td>
                                        <td>{{ $lead->firstname }} {{ $lead->lastname }}</td>
                                        
                                        <td>{{ $lead->email }}</td>
                                        <td>{{ $lead->mobile }}</td>
                                        <td>{{(isset($lead->assinedlead[0]))?$lead->assinedlead[0]->teamlead->name:'-'}}</td>
                                        </tr>
                                 
                                    <?php $i=$i+1;?>
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
            </div>
        </div>
    </div>
</div>
@endsection

@section('scripts')
<script type="text/javascript">
    rrtt='';
    oTable = $('#employeeList').DataTable({
        "bFilter": true
    });
    @if ($message = Session::get('success'))
        $.toaster({ priority : 'success', title : 'Notice', message : '{{ $message }}'});           
    @endif
 @foreach($teamleaders as $teamleader)
 rrtt+= '<option value="{{$teamleader->name}}">{{$teamleader->name}}</option>'
 @endforeach
    $('<div class="pull-right">' +
        '<select class="form-control search" id="tl_list">'+
        '<option value="">Select Team Leader</option>'+
            rrtt + 
            '<option value="-">-</option>'+
        '</div>').appendTo("#employeeList_wrapper .dataTables_filter");
 $(".dataTables_filter label").addClass("pull-right");

 $('#tl_list').change(function () {
                oTable.search($(this).val()).draw();
            });
</script>
@endsection