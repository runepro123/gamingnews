<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <title>Forgot Password</title>

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
      padding: 0;
    }

    .forgot-password {
      border: 3px solid #EA722E;
      color: #EA722E;
    }

    .forgot-password:hover {
      background: #EA722E;
      color: #fff;
    }
  </style>
</head>
<body class="hold-transition login-page">
<div class="login-box">
  <!-- /.login-logo -->
  <div class="card card-outline card-primary" style="background: #242627; padding: 10px 10px 0px 10px;">
    <div class="card-header text-center">
      <p class="login-box-msg">Forgot Password</p>
    </div>
    <div class="card-body">
      @include('backend.message')
      <form action="{{ url('forgot-password') }}" method="post">
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
          <div class="w-100">
            <button type="submit" class="btn btn-block forgot-password">Forgot Password</button>
          </div>
        </div>
      </form>

      <p class="mt-3">
        <a href="{{ url('/') }}" class="text-white text-decoration-underline">Login</a>
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
