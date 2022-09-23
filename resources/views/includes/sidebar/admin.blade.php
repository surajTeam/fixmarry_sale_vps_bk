<!-- Sidebar -->
<div class="sidebar" id="sidebar">
    <div class="sidebar-inner slimscroll">
        <div id="sidebar-menu" class="sidebar-menu">
            <ul>
                <li class="menu-title"> 
                    <span>Admin</span>
                </li>
                <li class="@if(Request::url() == url('admin')) active @endif"> 
                    <a href="{{ url('admin') }}">
                        <i class="la la-dashboard"></i> 
                        <span>Dashboard</span>
                    </a>
                </li>
               {{--  <li class="@if(Request::url() == url('admin/change-password')) active @endif"> 
                    <a href="{{ url('admin/change-password') }}"><i class="la la-lock"></i> <span>Change Password</span></a>
                </li> --}}
                <li class="menu-title"> 
                    <span>Employees</span>
                </li>
                <li class="@if(Request::url() == url('admin/employees/register')) active @endif"> 
                    <a href="{{ url('admin/employees/register') }}">
                        <i class="la la-pencil"></i> 
                        <span>Register Employee</span>
                    </a>
                </li>
                <li class="@if(Request::url() == url('admin/employees')) active @endif"> 
                    <a href="{{ url('admin/employees') }}">
                        <i class="la la-users"></i> 
                        <span>All Employees</span>
                    </a>
                </li>
                 <li class="@if(Request::url() == url('admin/team-leader/list-lead')) active @endif"> 
                    <a href="{{ url('admin/team-leader/list-lead') }}">
                        <i class="la la-users"></i> 
                        <span>All Leads</span>
                    </a>
                </li>
                <li class="@if(Request::url() == url('admin/employees/attendance')) active @endif"> 
                    <a href="{{ url('admin/employees/attendance') }}">
                        <i class="la la-calendar"></i> 
                        <span>Attendance</span>
                    </a>
                </li>
                <li class="@if(Request::url() == url('admin/team-leader/team-leader-list')) active @endif"> 
                    <a href="{{ url('admin/team-leader/team-leader-list') }}">
                        <i class="la la-users"></i> 
                        <span>All Teamleaders</span>
                    </a>
                </li>
                <li class="menu-title"> 
                    <span>Team Leader Management</span>
                </li>
                <li class="@if(Request::url() == url('admin/team-leader/assign-tme')) active @endif"> 
                    <a href="{{ url('admin/team-leader/assign-tme') }}">
                        <i class="la la-user"></i> 
                        <span>Assign TME</span>
                    </a>
                </li>
                <li class="@if(Request::url() == url('admin/team-leader/assign-lead')) active @endif"> 
                    <a href="{{ url('admin/team-leader/assign-lead') }}">
                        <i class="la la-user"></i> 
                        <span>Assign Leads</span>
                    </a>
                </li>
                <li class="menu-title"> 
                    <span>Lead Management</span>
                </li>
                <li class="@if(Request::url() == url('admin/lead/register/step-one')) active @endif"> 
                    <a href="{{ url('admin/lead/register/step-one') }}">
                        <i class="la la-pencil"></i> 
                        <span>Register Lead</span>
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