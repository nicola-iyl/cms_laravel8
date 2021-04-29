<!DOCTYPE html>
<html lang="@yield('lang', config('app.locale', 'it'))">

<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="description" content="">
    <meta name="author" content="Tamburini Nicola">

    <title>@yield('title', config('app.name', 'CMS'))</title>

    <!-- CSRF Token -->
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <!-- Styles -->
    @section('styles')
        <link href="{{ mix('/css/all.css') }}" rel="stylesheet" >
        <link href="{{ mix('/css/style.css') }}" rel="stylesheet" >
        <link href="{{ mix('/css/custom.css') }}" rel="stylesheet" >
    @show

    <!-- HTML5 Shim and Respond.js IE8 support of HTML5 elements and media queries -->
    <!-- WARNING: Respond.js doesn't work if you view the page via file:// -->
    <!--[if lt IE 9]>
    <script src="https://oss.maxcdn.com/libs/html5shiv/3.7.3/html5shiv.js"></script>
    <script src="https://oss.maxcdn.com/libs/respond.js/1.4.2/respond.min.js"></script>
    <![endif]-->
    @stack('head')
</head>

<body class="gray-bg">
@yield('content')
@section('scripts')
    <script src="/js/jquery-3.1.1.min.js"></script>
@show
@yield('js_script')

@stack('body')
</body>

</html>
