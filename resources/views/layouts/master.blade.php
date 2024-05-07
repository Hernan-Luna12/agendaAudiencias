<!DOCTYPE html>
<html class="semi-dark-layout" lang="es" data-layout="semi-dark-layout" data-textdirection="ltr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width,initial-scale=1.0,user-scalable=0,minimal-ui">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <meta name="description" content="Sistema de Documentos">
    <meta name="author" content="Poder Judical del Estado de Veracruz">
    <title>{{ config('app.name') }}</title>
    <link rel="shortcut icon" type="image/x-icon" href="{{ asset('public/img/favicon.ico') }}">

    <!-- Fonts -->
    <link rel="stylesheet" type="text/css" href="{{ asset('public/assets/fonts/fontawesome-free-6.5.1-web/css/all.min.css') }}">

    <!-- BEGIN: Vendor CSS-->
    <link rel="stylesheet" type="text/css" href="{{ asset('public/assets/vendors/css/vendors.min.css') }}">
    <link rel="stylesheet" type="text/css" href="{{ asset('public/assets/vendors/css/forms/select/select2.min.css') }}">
    <link rel="stylesheet" type="text/css" href="{{ asset('public/assets/vendors/css/tables/datatable/dataTables.bootstrap5.min.css') }}">
    <link rel="stylesheet" type="text/css" href="{{ asset('public/assets/vendors/css/tables/datatable/responsive.bootstrap5.min.css') }}">
    <link rel="stylesheet" type="text/css" href="{{ asset('public/assets/vendors/css/tables/datatable/buttons.bootstrap5.min.css') }}">
    {{-- <link rel="stylesheet" type="text/css" href="{{ asset('public/assets/vendors/css/tables/datatable/rowGroup.bootstrap5.min.css') }}"> --}}

    <!-- BEGIN: Theme CSS-->
    <link rel="stylesheet" type="text/css" href="{{ asset('public/assets/css/bootstrap.css') }}">
    <link rel="stylesheet" type="text/css" href="{{ asset('public/assets/css/bootstrap-extended.css') }}">
    <link rel="stylesheet" type="text/css" href="{{ asset('public/assets/css/colors.css') }}">
    <link rel="stylesheet" type="text/css" href="{{ asset('public/assets/css/components.css') }}">
    <link rel="stylesheet" type="text/css" href="{{ asset('public/assets/css/themes/dark-layout.css') }}">
    <link rel="stylesheet" type="text/css" href="{{ asset('public/assets/css/themes/bordered-layout.css') }}">
    <link rel="stylesheet" type="text/css" href="{{ asset('public/assets/css/themes/semi-dark-layout.css') }}">

    <!-- BEGIN: Page CSS-->
    <link rel="stylesheet" type="text/css" href="{{ asset('public/assets/css/core/menu/menu-types/vertical-menu.css') }}">
    
    <style>
        @font-face {
            font-family: 'Nunito';
            src: url({{ asset('public/assets/fonts/nunito/static/Nunito-Regular.ttf') }});
        }
    </style>

    <style type="text/css" media="screen">
        .bg-topbar {
            background-color: #3b996d !important;
        }

        .bg-sidebar {
            background-color: #226344;
        }

        .bg-personal-green {
            background: #0c3422 !important;
        }

        .bg-personal-red {
            background: #5a1325 !important;
        }

        .text-green-like-menu {
            color: #0c3422 !important;
        }

        body, span, h1, h2, h3, h4, h5, h6, label, a, button, li, ul, p {
            font-family: 'Nunito', sans-serif !important;
        }

        .select2-container--classic .select2-selection--multiple .select2-selection__choice, .select2-container--default .select2-selection--multiple .select2-selection__choice {
            background-color: #388bff !important;
            border-color: #388bff !important;
        }

        label {
            font-weight: bold;
        }

        .table-responsive {
            padding-left: .5em;
            padding-right: .5em;
        }
    </style>
</head>
<body class="vertical-layout vertical-menu-modern" data-menu="vertical-menu-modern" data-asset-path="{{ url('/') }}" data-framework="laravel">
    <!-- BEGIN: Header-->
        @include('layouts.header')
    <!-- END: Header-->

    <!-- BEGIN: Main Menu-->
        @include('layouts.menu')
    <!-- END: Main Menu-->

    <!-- BEGIN: Content-->
    <div class="app-content content form-block ">
        <div class="content-overlay"></div>
        <div class="header-navbar-shadow"></div>
        <div class="content-wrapper">
            {{-- <div class="content-header row">
                @yield('title')
            </div> --}}
            <div class="content-body">
                @yield('content')
            </div>
        </div>
    </div>
    <!-- END: Content-->

    <!-- BEGIN: Footer-->
        @include('layouts.footer')
    <!-- END: Footer-->

    @include('layouts.modals')

    <!-- BEGIN: Vendor JS-->
    <script src="{{ asset('public/assets/vendors/js/vendors.min.js') }}"></script>
    <!-- BEGIN Vendor JS-->

    <!-- BEGIN: Page Vendor JS-->
    <script src="{{ asset('public/assets/vendors/js/extensions/sweetalert2.all.min.js') }}"></script>
    <script src="{{ asset('public/assets/vendors/js/forms/select/select2.full.min.js') }}"></script>
    <script src="{{ asset('public/assets/vendors/js/tables/datatable/jquery.dataTables.min.js') }}"></script>
    <script src="{{ asset('public/assets/vendors/js/tables/datatable/dataTables.bootstrap5.min.js') }}"></script>
    <script src="{{ asset('public/assets/vendors/js/tables/datatable/dataTables.responsive.min.js') }}"></script>
    <script src="{{ asset('public/assets/vendors/js/tables/datatable/responsive.bootstrap5.js') }}"></script>
    <script src="{{ asset('public/assets/vendors/js/tables/datatable/datatables.buttons.min.js') }}"></script>
    {{-- <script src="{{ asset('public/assets/vendors/js/tables/datatable/pdfmake.min.js') }}"></script> --}}
    <script src="{{ asset('public/assets/vendors/js/tables/datatable/buttons.html5.min.js') }}"></script>
    {{-- <script src="{{ asset('public/assets/vendors/js/tables/datatable/buttons.print.min.js') }}"></script> --}}
    {{-- <script src="{{ asset('public/assets/vendors/js/tables/datatable/dataTables.rowGroup.min.js') }}"></script> --}}
    {{-- <script src="{{ asset('public/assets/vendors/js/tables/datatable/jszip.min.js') }}"></script> --}}
    {{-- <script src="{{ asset('public/assets/vendors/js/tables/datatable/vfs_fonts.js') }}"></script> --}}
    <!-- END: Page Vendor JS-->

    <!-- BEGIN: Theme JS-->
    <script src="{{ asset('public/assets/js/core/app-menu.js') }}"></script>
    <script src="{{ asset('public/assets/js/core/app.js') }}"></script>
    <!-- END: Theme JS-->

    <!-- BEGIN: Page JS-->
    {{-- <script src="{{ asset('public/assets/js/scripts/extensions/ext-component-sweet-alerts.js') }}"></script> --}}
    {{-- <script src="{{ asset('public/assets/plugins/daterangepicker/js/moment.min.js') }}"></script> --}}
    <!-- END: Page JS-->

    <!-- Funciones generales -->
    <script src="{{ asset('public/assets/js/sistema/generales.js') }}"></script>

    <script>
        $(window).on('load', function() {
            if (feather) {
                feather.replace({
                    width: 14,
                    height: 14
                });
            }
        });
    </script>

    @yield('js')
</body>
</html>