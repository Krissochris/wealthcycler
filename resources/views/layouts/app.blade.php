<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <!-- CSRF Token -->
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title> {{ config('app.name', '') }} >> @yield("title") </title>
    <link rel="shortcut icon" type="image/x-icon" href="{{asset('assets/images/logo.png')}}">
    <!-- Styles -->
    <link rel="stylesheet" href="{{ asset('account/vendors/bootstrap/dist/css/bootstrap.min.css') }}">
    <link rel="stylesheet" href="{{ asset('account/vendors/font-awesome/css/font-awesome.min.css') }}">
    <link rel="stylesheet" href="{{ asset('account/assets/css/style.css') }}">
    <link href='https://fonts.googleapis.com/css?family=Open+Sans:400,600,700,800' rel='stylesheet' type='text/css'>
    <link rel="stylesheet" href="https://cdn.datatables.net/1.10.20/css/jquery.dataTables.min.css">

    <!-- Scripts -->
    <script src="{{ asset('account/vendors/jquery/dist/jquery.min.js') }}"></script>
    <script src="{{ asset('account/vendors/popper.js/dist/umd/popper.min.js') }}"></script>
    <script src="{{ asset('account/vendors/bootstrap/dist/js/bootstrap.min.js') }}"></script>
    <script src="https://cdn.datatables.net/1.10.20/js/jquery.dataTables.min.js"></script>
</head>
<body>
    @include('element.sidebar')
    <!-- Right Panel -->

    <div id="right-panel" class="right-panel">

        @include('element.loggedInHeader')


        <div class="content mt-3">
            @include('flash::message')
            @include('element.flash.error')


            @yield('content')

            <!--/.col-->



        </div> <!-- .content -->
    </div><!-- /#right-panel -->

    <!-- Right Panel -->
    <script src="{{ asset('account/assets/js/main.js') }}"></script>


    <script src="{{ asset('account/assets/js/dashboard.js') }}"></script>
    <script src="{{ asset('account/assets/js/widgets.js') }}"></script>
    @yield('js')
    <script>
        jQuery(document).ready( function () {
            jQuery('#data-table').DataTable();
        } );
    </script>

</body>
</html>
