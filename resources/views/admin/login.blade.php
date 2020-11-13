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
<body class="login-page" style="min-height: 512.391px;">
  <div class="login-box">
    @if (session('message.success'))
    <div class="row">
      <div class="callout callout-success">
        <h5>{{ session('message.success') }}</h5>
      </div>
    </div>
    @endif
    <div class="login-logo">
      <span><b>{{ __('lang.login') }}</b></span>
    </div>

    <!-- /.login-logo -->
    <div class="card">
      <div class="card-body login-card-body">

        <form action="{{ route('admin.login.post') }}" method="POST">
          @csrf

          <div class="input-group mb-3">
            <input name="email"
              type="email"
              class="form-control @error('email') is-invalid @enderror"
              placeholder="{{ __('lang.email') }}"
              value="{{ old('email') }}"
            />
            <div class="input-group-append">
              <div class="input-group-text">
                <span class="fas fa-envelope"></span>
              </div>
            </div>
            <div class="invalid-feedback">
              @error('email') {{ $message }} @enderror
            </div>
          </div>

          <div class="input-group mb-3">
            <input name="password"
              type="password"
              class="form-control @error('password') is-invalid @enderror"
              placeholder="{{ __('lang.password') }}"
            />
            <div class="input-group-append">
              <div class="input-group-text">
                <span class="fas fa-lock"></span>
              </div>
            </div>
            <div class="invalid-feedback">
              @error('password') {{ $message }} @enderror
            </div>
          </div>

          <div class="row">
            <div class="col-8">
              <div class="icheck-primary">
                <input name="remember" type="checkbox" id="remember" value="1">
                <label for="remember">
                  {{ __('lang.remember_me') }}
                </label>
              </div>
            </div>
            <!-- /.col -->
            <div class="col-4">
              <button type="submit" class="btn btn-primary btn-block">{{ __('lang.login') }}</button>
            </div>
            <!-- /.col -->
          </div>
        </form>

        <p class="mt-3 mb-1">
          <a href="{{ route('admin.password.request') }}">I forgot my password</a>
        </p>
      </div>
      <!-- /.login-card-body -->
    </div>
  </div>
</body>
