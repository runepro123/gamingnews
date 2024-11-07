<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <title>Log In</title>

  <!-- Google Font: Source Sans Pro -->
  <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Source+Sans+Pro:300,400,400i,700&display=fallback">
  <!-- Font Awesome -->
  <link rel="stylesheet" href="{{ asset('backend/plugins/fontawesome-free/css/all.min.css') }}">
  <!-- icheck bootstrap -->
  <link rel="stylesheet" href="{{ asset('backend/plugins/icheck-bootstrap/icheck-bootstrap.min.css') }}">
  <!-- Theme style -->
  <link rel="stylesheet" href="{{ asset('backend/dist/css/adminlte.min.css') }}">
  <style>
    body {
      background-image: url('{{ asset('backend/background.png') }}');
      background-size: cover;
      background-position: center;
      background-repeat: no-repeat;
      height: 100vh;
    }
    .card-primary.card-outline {
      border-top: none;
    }

    .card-header {
      border-bottom: none;
    } 

    .form-control,
    .form-control:focus,
    .icheck-primary input:checked {
      background-color: #242627;
      color: #fff;
    }

    .login-box-msg {
      color: #fff;
      text-transform: uppercase;
      letter-spacing: 2px;
      font-size: 1.3rem;
      font-weight: bold;
    }

    .sign-in-btn {
      border: 3px solid #EA722E;
      color: #EA722E;
    }

    .sign-in-btn:hover {
      background: #EA722E;
      color: #fff;
    }
  </style>
</head>
<body class="hold-transition login-page">
<div class="login-box"  >
  <!-- /.login-logo -->
  <div class="card card-outline card-primary" style="background: #242627; padding: 10px 10px 0px 10px;">
    <div class="card-header text-center">
      <img src="{{asset('backend/logo/logo.png')}}" alt="Logo" height="70" >
    </div>
    <div class="card-body">
      <p class="login-box-msg">Welcome to News App</p>

      @include('backend.message')

      <form action="{{ url('login') }}" method="post">
        @csrf
        <div class="input-group mb-3">
          <div class="w-100 d-flex">
            <input type="email" class="form-control" name="email" placeholder="Email">
            <div class="input-group-append">
              <div class="input-group-text">
                <span class="fas fa-envelope"></span>
              </div>
            </div>
          </div>
          <span class="text-danger">{{ $errors->has('email') ? $errors->first('email') : "" }}</span>
        </div>

        <div class="input-group mb-3">
          <div class="w-100 d-flex">
            <input type="password" class="form-control" name="password" placeholder="Password">
            <div class="input-group-append">
              <div class="input-group-text">
                <span class="fas fa-lock"></span>
              </div>
            </div>
          </div>
          <span class="text-danger">{{ $errors->has('password') ? $errors->first('password') : "" }}</span>
        </div>

        <div class="input-group mb-3">
            <div class="icheck-primary">
              <input type="checkbox" id="remember" name="remember">
              <label for="remember" class="text-white">
                Remember Me
              </label>
            </div>
        </div>
        <div class="input-group mb-3">
          <div class="w-100">
            <button type="submit" class="btn btn-block sign-in-btn">Sign In</button>
          </div>
        </div>
      </form>

      <p class="mt-3">
        <a href="{{ url('forgot-password') }}" class="text-white text-decoration-underline">I forgot my password</a>
      </p>
    </div>
    <!-- /.card-body -->
  </div>
  <!-- /.card -->
</div>
<!-- /.login-box -->

<!-- jQuery -->
<script src="{{ asset('backend/plugins/jquery/jquery.min.js') }}"></script>
<!-- Bootstrap 4 -->
<script src="{{ asset('backend/plugins/bootstrap/js/bootstrap.bundle.min.js') }}"></script>
<!-- AdminLTE App -->
<script src="{{ asset('backend/dist/js/adminlte.min.js') }}"></script>
</body>
</html>
