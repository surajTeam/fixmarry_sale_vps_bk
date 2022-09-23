<!DOCTYPE html>
<html lang="en">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0, user-scalable=0">
        <meta name="robots" content="noindex, nofollow">
        @section('title')
            @show
        
        <!-- Bootstrap CSS -->
        <link rel="stylesheet" href="{{ url('assets/css/bootstrap.min.css') }}">
        
        <!-- Fontawesome CSS -->
        <link rel="stylesheet" href="{{ url('assets/css/font-awesome.min.css') }}">
        
        <!-- Lineawesome CSS -->
        <link rel="stylesheet" href="{{ url('assets/css/line-awesome.min.css') }}">
        
       
        <!-- Datatable CSS -->
        <link rel="stylesheet" href="{{ url('assets/css/dataTables.bootstrap4.min.css') }}">
        {{-- <link rel="stylesheet" href="{{ url('assets/css/buttons.dataTables.min.css') }}"> --}}
        
        <!-- Select2 CSS -->
        <link rel="stylesheet" href="{{ url('assets/css/select2.min.css') }}">
        
        <!-- Datetimepicker CSS -->
        <link rel="stylesheet" href="{{ url('assets/css/bootstrap-datetimepicker.min.css') }}">
        <!-- Summernote CSS -->
        <link rel="stylesheet" href="{{ url('assets/plugins/summernote/dist/summernote-bs4.css') }}">

        <!-- Main CSS -->
        <link rel="stylesheet" href="{{ url('assets/css/style.css') }}">
        <link rel="stylesheet" href="{{ url('assets/css/tokenize2.min.css') }}" />
        
        <!-- HTML5 shim and Respond.js IE8 support of HTML5 elements and media queries -->
        <!--[if lt IE 9]>
            <script src="assets/js/html5shiv.min.js"></script>
            <script src="assets/js/respond.min.js"></script>
        <![endif]-->
    </head>
    
    <body>
        <!-- Main Wrapper -->
        <div class="main-wrapper" id="app">
            
            @php
                $sales_employee_role_id = Session::get('sales_employee_role_id');
                $role = App\Models\SalesRole::where('id', $sales_employee_role_id)->first()['name'];
            @endphp      
            @switch($role)
                @case('admin')
                    @include('includes.sidebar.admin')
                    @break;
                @case('team_leader')
                    @include('includes.sidebar.team_leader')
                    @break;
                @case('telemarketing_executive')
                    @include('includes.sidebar.tme')
                    @break;
                
            @endswitch       
            @include('includes.header')
            <!-- Page Wrapper -->
            @yield('content')
            <!-- /Page Wrapper -->
            
        </div>
        <!-- /Main Wrapper -->
        
        
        <!-- jQuery -->
        <script src="{{ url('assets/js/jquery-3.5.1.min.js') }}"></script>
        
        <!-- Bootstrap Core JS -->
        <script src="{{ url('assets/js/popper.min.js') }}"></script>
        <script src="{{ url('assets/js/bootstrap.min.js') }}"></script>
        
        <!-- Slimscroll JS -->
        <script src="{{ url('assets/js/jquery.slimscroll.min.js') }}"></script>
        <!-- Mask JS -->
        <script src="{{ url('assets/js/jquery.maskedinput.min.js') }}"></script>
        <script src="{{ url('assets/js/mask.js') }}"></script>
        
        <!-- Select2 JS -->
        <script src="{{ url('assets/js/select2.min.js') }}"></script>

        <!-- Datetimepicker JS -->
        <script src="{{ url('assets/js/moment.min.js') }}"></script>
        <script src="{{ url('assets/js/bootstrap-datetimepicker.min.js') }}"></script>

        <!-- Datatable JS -->
        <script src="{{ url('assets/js/jquery.dataTables.min.js') }}"></script>
        <script src="{{ url('assets/js/dataTables.bootstrap4.min.js') }}"></script>
        {{-- <script src="https://cdn.datatables.net/buttons/2.2.2/js/dataTables.buttons.min.js"></script>
        <script src="https://cdnjs.cloudflare.com/ajax/libs/jszip/3.1.3/jszip.min.js"></script>
        <script src="https://cdnjs.cloudflare.com/ajax/libs/pdfmake/0.1.53/vfs_fonts.js"></script>
        <script src="https://cdn.datatables.net/buttons/2.2.2/js/buttons.html5.min.js"></script>
        <script src="https://cdn.datatables.net/buttons/2.2.2/js/buttons.print.min.js"></script> --}}

        <!-- Summernote JS -->
        <script src="{{ url('assets/plugins/summernote/dist/summernote-bs4.min.js') }}"></script>
        <!-- Toastr JS -->
        <script src="{{ url('assets/js/toastr.min.js') }}"></script>
        

        <!-- Custom JS -->
        <script src="{{ url('assets/js/app.js') }}"></script>
        <script src="{{ url('assets/js/tokenize2.min.js') }}"></script>
        <!-- App.js -->
        
        <script type="text/javascript">
            $(document).ready(function() {
                $(".form-control").on("focus", function() {
                    $(this).on("keydown", function(event) {
                        if (event.keyCode === 38 || event.keyCode === 40) {
                            event.preventDefault();
                        }
                    });
                });

            });
        </script>
        <script src="https://cdn.jsdelivr.net/npm/vue@2.6.14/dist/vue.js"></script>
        <script src="https://cdnjs.cloudflare.com/ajax/libs/axios/0.27.2/axios.min.js"></script>
        @section('scripts')
            @show
        
    </body>
</html>