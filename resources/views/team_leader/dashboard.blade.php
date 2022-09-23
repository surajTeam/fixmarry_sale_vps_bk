@extends('layouts.main')

@section('title')
    <title>Fixmarry Sales | Team Leader Dashboard</title>
@endsection
@section('content')
<!-- Page Wrapper -->
<div class="page-wrapper">
    <!-- Page Content -->
    <div class="content container-fluid">
        <div class="row">
            <div class="col-md-12">
                <div class="welcome-box">
                    <div class="welcome-img">
                        <img alt="profile" src="{{ $team_leader->profile_photo_url }}"> 
                    </div>
                    <div class="welcome-det">
                        <h3>Welcome, {{ $team_leader->name }}</h3>
                        <p>{{ date("D") }}, {{ date('d M Y') }}</p>
                    </div>
                </div>
            </div>
        </div>
       
    </div>
    <!-- /Page Content -->


</div>
<!-- /Page Wrapper -->
@endsection

