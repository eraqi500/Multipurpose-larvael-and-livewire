<!DOCTYPE html>


<html lang="en">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta http-equiv="x-ua-compatible" content="ie=edge">

    <title> {{setting('site_title')}} | {{setting('site_name')}}</title>

    <!-- Font Awesome Icons -->
    <link rel="stylesheet" href="{{asset('backend/plugins/fontawesome-free/css/all.min.css')}}">
    <!-- Theme style -->
    <link rel="stylesheet" href="{{asset('backend/dist/css/adminlte.min.css')}}">
    <!-- Google Font: Source Sans Pro -->
    <link href="https://fonts.googleapis.com/css?family=Source+Sans+Pro:300,400,400i,700" rel="stylesheet">

    <link rel="stylesheet" type="text/css" href="{{asset('backend/plugins/toastr/toastr.min.css')}}">

    <style>
        .custom-error .select2-selection {
            border:none;
        }
    </style>
    <link rel="stylesheet" type="text/css"
          href="{{asset('backend/plugins/tempusdominus-bootstrap-4/css/tempusdominus-bootstrap-4.min.css')}}">

    <script defer src="https://unpkg.com/alpinejs@3.x.x/dist/cdn.min.js"></script>

    <!-- ICheck -->
    <link rel="stylesheet" href="{{asset('backend/plugins/icheck-bootstrap/icheck-bootstrap.min.css')}}">

    <link rel="stylesheet" href="{{asset('backend/plugins/select2/css/select2.min.css')}}">
    <link rel="stylesheet" href="{{asset('backend/plugins/select2-bootstrap4-theme/select2-bootstrap4.min.css')}}">

    <!-- Bootstrap Color Picker -->
    <link rel="stylesheet" href="{{asset('backend/plugins/bootstrap-colorpicker/css/bootstrap-colorpicker.min.css')}}">

    <livewire:styles />
    @stack('styles')

</head>
<body class="hold-transition sidebar-mini
{{setting('sidebar_collapse') ? 'sidebar-collapse' : ''}}">
<div class="wrapper">

    <!-- Navbar -->
    @include('layouts.partials.navbar')
    <!-- /.navbar -->

    <!-- Main Sidebar Container -->
    @include('layouts.partials.aside')

    <!-- Content Wrapper. Contains page content -->
    <div class="content-wrapper">
{{--        @yield('content')--}}
        {{$slot}}
    </div>
    <!-- /.content-wrapper -->

    <!-- Control Sidebar -->
    <aside class="control-sidebar control-sidebar-dark">
        <!-- Control sidebar content goes here -->
        <div class="p-3">
            <h5> {{setting('site_title') }}</h5>
            <p>Sidebar content</p>
        </div>
    </aside>
    <!-- /.control-sidebar -->

    <!-- Main Footer -->
    @include('layouts.partials.footer')
</div>
<!-- ./wrapper -->

<!-- REQUIRED SCRIPTS -->

<!-- jQuery -->
<script src="{{asset('backend/plugins/jquery/jquery.min.js')}}"></script>
<!-- Bootstrap 4 -->
<script src="{{asset('backend/plugins/bootstrap/js/bootstrap.bundle.min.js')}}"></script>
<!-- AdminLTE App -->
<script src="{{asset('backend/dist/js/adminlte.min.js')}}"></script>

<script type="text/javascript" src="{{asset('backend/plugin/toastr/toastr.min.js')}}"></script>
<script rel="stylesheet" type="text/javascript"
        href="{{asset('backend/plugins/tempusdominus-bootstrap-4/js/tempusdominus-bootstrap-4.min.js')}}">
</script>

<!-- bootstrap color picker -->
<script src="{{asset('backend/plugins/bootstrap-colorpicker/js/bootstrap-colorpicker.min.js')}}"></script>


<script type="text/javascript" src="https://unpkg.com/moment">
</script>




<script>
    $(document).ready(function(){
        toastr.options ={
            "positionClass":"toast-bottom-right",
            "progressBar":true,
        }

        window.addEventListener('hide-form', event=>{
            $('#form').modal('hide');

            toastr.success(event.detail.message,'Success!');

        })
    })
</script>

<script>
    window.addEventListener('show-form', event => {
       $('#form').modal('show');
    });

    window.addEventListener('show-delelte-modal' , event => {
        $('#confirmationModal').modal('show');
    })

    window.addEventListener('hide-delete-modal', event => {
        $('#confirmationModal').modal('hide');
        toastr.success(event.detail.message , 'Success');
    });php artisan vendor:publish --provider="Laravel\Fortify\FortifyServiceProvider"

    window.addEventListener('alert', event => {
        toastr.success(event.detail.message , 'Success');
    });

    window.addEventListener('updated', event => {
        toastr.success(event.detail.message , 'Success');
    });


</script>
@stack('js')

<livewire:scripts />
</body>
</html>
