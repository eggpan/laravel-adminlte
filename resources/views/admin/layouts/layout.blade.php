<!DOCTYPE html>
<html>
<head>
  <meta charset="utf-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <title>@yield('title')</title>
  <meta name="viewport" content="width=device-width, initial-scale=1">

  <link rel="stylesheet" href="{{ url('adminlte/plugins/fontawesome-free/css/all.min.css') }}">
  <link rel="stylesheet" href="https://code.ionicframework.com/ionicons/2.0.1/css/ionicons.min.css">
  <link rel="stylesheet" href="{{ url('adminlte/dist/css/adminlte.min.css') }}">
  <link href="https://fonts.googleapis.com/css?family=Source+Sans+Pro:300,400,400i,700" rel="stylesheet">

</head>
<body class="hold-transition sidebar-mini">

<div class="wrapper">
  @include('admin.layouts.navbar')
  @include('admin.layouts.main-sidebar')
  <div class="content-wrapper">
    @yield('content')
  </div>
  <aside class="control-sidebar control-sidebar-dark"></aside>
</div>

<script src="{{ url('adminlte/plugins/jquery/jquery.min.js') }}"></script>
<script src="{{ url('adminlte/plugins/bootstrap/js/bootstrap.bundle.min.js') }}"></script>
<script src="{{ url('adminlte/dist/js/adminlte.min.js') }}"></script>
</body>
</html>
