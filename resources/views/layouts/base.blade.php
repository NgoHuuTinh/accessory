<!DOCTYPE html>
<html lang="en">
<head>
    <meta http-equiv="content-type" content="text/html; charset=utf-8">
    <link rel="shortcut icon" href="{{ asset('/img/favicon.ico') }}">
    <title>@yield('title')</title>
    <link rel="stylesheet" type="text/css" href="{{ asset('/css/fontawesome/css/all.min.css') }}">
    <link rel="stylesheet" type="text/css" href="{{ asset('/css/adminlte.min.css') }}">
    <link rel="stylesheet" type="text/css" href="{{ asset('/css/bootstrap.min.css') }}">
    <link rel="stylesheet" type="text/css" href="{{ asset('/css/bootstrap-select.min.css') }}">
    <link rel="stylesheet" type="text/css" href="{{ asset('/css/AdminLTE.css') }}">
    <link rel="stylesheet" type="text/css" href="{{ asset('/css/site.css') }}">
    @yield('stylesheet')
</head>

<body class="skin-blue bg-default">
    <script type="text/javascript" src="{{ asset('/js/jquery.min.js') }}"></script>
    <script type="text/javascript" src="{{ asset('/js/bootstrap.min.js') }}"></script>
    <script type="text/javascript" src="{{ asset('/js/site.js') }}"></script>
    @yield('content')
    @yield('js')
</body>

</html>