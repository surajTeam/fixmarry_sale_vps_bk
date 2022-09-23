<!-- Sidebar -->
<div class="sidebar" id="sidebar">
    <div class="sidebar-inner slimscroll">
        <div id="sidebar-menu" class="sidebar-menu">
            <ul>
                <li class="menu-title"> 
                    <span>Team Leader</span>
                </li>
                <li class="@if(Request::url() == url('telemarketing-executive')) active @endif"> 
                    <a href="{{ url('telemarketing-executive') }}">
                        <i class="la la-dashboard"></i> 
                        <span>Dashboard</span>
                    </a>
                </li>
                <li class="menu-title"> 
                    <span>Attendance Management</span>
                </li>
                <li class="@if(Request::url() == url('telemarketing-executive/attendance')) active @endif"> 
                    <a href="{{ url('telemarketing-executive/attendance') }}">
                        <i class="la la-calendar"></i> 
                        <span>Attendance</span>
                    </a>
                </li>
                <li> 
                    <a href="{{ url('punch-out') }}">
                        <i class="la la-key"></i> 
                        <span>Punch Out</span>
                    </a>
                </li>
                <li class="menu-title"> 
                    <span>TME Management</span>
                </li>
                 <li class="@if(Request::url() == url('team-leader/tme/tme-lead-list')) active @endif"> 
                    <a href="{{ url('team-leader/tme/tme-lead-list') }}">
                        <i class="la la-graduation-cap"></i> 
                        <span>Leads List</span>
                    </a>
                </li>
                <li> 
                    <a href="{{ route('logout') }}" onclick="event.preventDefault();
                                                     document.getElementById('logout-form').submit();"><i class="la la-power-off"></i> <span>Logout</span></a>
                    <form id="logout-form" action="{{ route('logout') }}" method="POST" style="display: none;">
                        @csrf
                    </form>
                </li>
                
            </ul>
        </div>
    </div>
</div>
<!-- /Sidebar