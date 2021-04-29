<!DOCTYPE html>
<html lang="@yield('lang', config('app.locale', 'it'))">

<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="description" content="">
    <meta name="robots" content="noindex" />
    <title>@yield('title', config('cms.name', 'CMS'))</title>

    <!-- CSRF Token -->
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <!-- Styles -->
    @section('styles')
        <link href="{{ mix('/css/all.css') }}" rel="stylesheet" >
        <link href="{{ mix('/css/style.css') }}" rel="stylesheet" >
        <link href="{{ mix('/css/font-awesome.css') }}" rel="stylesheet" >
        <link href="{{ mix('/css/custom.css') }}" rel="stylesheet" >
    @show

    @stack('head')
</head>

<body>
<div id="wrapper">

    @if(Auth::guard('cms')->user()->role->name == 'admin')
        @include('layouts.admin_sidebar')
    @else
        @include('layouts.shop_sidebar')
    @endif


    <div id="page-wrapper" class="gray-bg">
        @include('layouts.header')
        @include('layouts.breadcrumbs')
        @include('layouts.flash_message')

        <div class="wrapper wrapper-content">
            @yield('content')
        </div>

        @include('layouts.footer')
    </div>

</div>

<!-- MODALE -->
<div class="modal inmodal fade" id="myModal" tabindex="-1" role="dialog"  aria-hidden="true"></div>
<!-- FINE MODALE -->

@include('layouts.loader')
@include('layouts.popup')

@section('scripts')
    <script src="{{ env('APP_ROOT') }}js/jquery-3.1.1.min.js"></script>
    <script src="{{ env('APP_ROOT') }}js/popper.min.js"></script>
    <script src="{{ env('APP_ROOT') }}js/bootstrap.js"></script>
    <script src="{{ env('APP_ROOT') }}js/plugins/metisMenu/jquery.metisMenu.js"></script>
    <script src="{{ env('APP_ROOT') }}js/plugins/slimscroll/jquery.slimscroll.min.js"></script>
    <script src="{{ env('APP_ROOT') }}js/plugins/dataTables/datatables.min.js"></script>
    <script src="{{ env('APP_ROOT') }}js/plugins/dataTables/dataTables.bootstrap4.min.js"></script>
    <script src="{{ env('APP_ROOT') }}js/plugins/summernote/summernote-bs4.js"></script>
    <script src="{{ env('APP_ROOT') }}js/plugins/validate/jquery.validate.min.js"></script>
    <script src="{{ env('APP_ROOT') }}js/plugins/dropzone/dropzone.js"></script>
    <script src="{{ env('APP_ROOT') }}js/plugins/blueimp/jquery.blueimp-gallery.min.js"></script>
    <script src="{{ env('APP_ROOT') }}js/plugins/sweetalert/sweetalert.min.js"></script>
    <script src="{{ env('APP_ROOT') }}js/plugins/select2/select2.full.min.js"></script>
    <script src="{{ env('APP_ROOT') }}js/plugins/datapicker/bootstrap-datepicker.js"></script>

    <!-- Custom and plugin javascript -->
    <script src="{{ env('APP_ROOT') }}js/inspinia.js"></script>
    <script src="{{ env('APP_ROOT') }}js/plugins/pace/pace.min.js"></script>

    <!-- Sparkline -->
    <script src="{{ env('APP_ROOT') }}js/plugins/sparkline/jquery.sparkline.min.js"></script>

    <script src="{{ env('APP_ROOT') }}js/cms.js"></script>
@show
@yield('js_script')
@stack('body')

</body>

</html>
