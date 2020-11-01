<!DOCTYPE html>
<html>
<head>
  <meta charset="utf-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <title>@yield('title', 'No title') | {{ config('app.name') }}</title>
  <meta name="viewport" content="width=device-width, initial-scale=1">

  <link rel="stylesheet" href="{{ url('adminlte/plugins/fontawesome-free/css/all.min.css') }}">
  <link rel="stylesheet" href="https://code.ionicframework.com/ionicons/2.0.1/css/ionicons.min.css">
  <link rel="stylesheet" href="{{ url('adminlte/dist/css/adminlte.min.css') }}">
  <link href="https://fonts.googleapis.com/css?family=Source+Sans+Pro:300,400,400i,700" rel="stylesheet">

</head>
<body class="hold-transition sidebar-mini layout-navbar-fixed">

<div class="wrapper">
  @include('admin.layouts.navbar')
  @include('admin.layouts.main-sidebar')
  <div class="content-wrapper">
    @hasSection ('title')
      <section class="content-header">
        <div class="container-fluid">
          <div class="row mb-2">
            <div class="col-sm-6">
              <h1>@yield('title')</h1>
            </div>
          </div>
        </div>
      </section>
    @endif

    <div class="content">
      <div class="container-fluid">
        @error('message')
          <div class="row">
            <div class="alert alert-danger alert-dismissible">
              <button type="button" class="close" data-dismiss="alert" aria-hidden="true">×</button>
              <h5><i class="icon fas fa-ban"></i>{{ __('lang.error') }}</h5>
              {{ $message }}
            </div>
          </div>
        @enderror
        @if (session('message.success'))
        <div class="row">
          <div class="callout callout-success">
            <h5>{{ session('message.success') }}</h5>
          </div>
        </div>
        @endif
    </div>
      @yield('content')
    </div>
  </div>
  <aside class="control-sidebar control-sidebar-dark"></aside>
</div>

<script src="{{ url('adminlte/plugins/jquery/jquery.min.js') }}"></script>
<script src="{{ url('adminlte/plugins/bootstrap/js/bootstrap.bundle.min.js') }}"></script>
<script src="{{ url('adminlte/dist/js/adminlte.min.js') }}"></script>
@yield('script')
</body>
</html>
