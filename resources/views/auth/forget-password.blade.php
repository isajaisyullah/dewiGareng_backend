<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <title>Foget Password | DewiGareng</title>
  <link rel="icon" type="image/x-icon" href="{{ asset('dist\img\DewiGarengLogo.png') }}">

  <!-- Google Font: Source Sans Pro -->
  <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Source+Sans+Pro:300,400,400i,700&display=fallback">
  <!-- Font Awesome -->
  <link rel="stylesheet" href="{{ asset('plugins/fontawesome-free/css/all.min.css') }}">
  <!-- icheck bootstrap -->
  <link rel="stylesheet" href="{{ asset('plugins/icheck-bootstrap/icheck-bootstrap.min.css') }}">
  <!-- Theme style -->
  <link rel="stylesheet" href="{{ asset('dist/css/adminlte.min.css') }}">
  <!-- Customized Style -->
  <link rel="stylesheet" href="{{ asset('dist/css/custome.css') }}">
</head>
<body class="hold-transition login-page">
<div class="login-box" style="width:auto;  box-shadow: 0 20px 25px -5px rgb(0 0 0 / 0.1), 0 8px 10px -6px rgb(0 0 0 / 0.1);">
  <!-- /.login-logo -->
  <div class="card card-outline card-primary responsive-card">
    <div class="card-header text-center">
        <h1 class="responsive-card-title"><b>Lupa Kata Sandi?</b></h1>
        <h5>reset kata sandi disini.</h5>
    </div>
    <div class="card-body">
      <form action="{{ route('forget.password.post') }}" id="register-form" role="form" autocomplete="off" class="form" method="post">
        @csrf

        @php
            $messageTypes = ['warning', 'success', 'error'];
        @endphp
        @foreach($messageTypes as $type)
            @if(session($type))
                <div class="alert alert-{{ $type }}">
                    {{ session($type) }}
                </div>
            @endif
        @endforeach

        <div class="input-group mb-3">
          <input id="email" name="email" type="email" class="form-control" placeholder="Masukkan Email Anda" pattern="[a-zA-Z0-9._%+-]+@[a-zA-Z0-9.-]+\.[a-zA-Z]{2,}" required>
          <div class="input-group-append">
            <div class="input-group-text" style="width:40px">
              <span class="fas fa-envelope"></span>
            </div>
          </div>
        </div>

          <div class="mx-auto col-6">
            <button name="recover-submit" type="submit" class="btn btn-primary btn-block responsive-font-h">Reset Kata Sandi</button>
          </div>
      </form>

      <hr>

      <p class="text-center">
        Sudah memiliki akun? <a href="{{ route('login') }}" class="text-primary">Masuk</a>
      </p>

    </div>

    </div>
    <!-- /.card-body -->
  </div>
  <!-- /.card -->
</div>
<!-- /.login-box -->

<!-- jQuery -->
<script src="{{ asset('plugins/jquery/jquery.min.js') }}"></script>
<!-- Bootstrap 4 -->
<script src="{{ asset('plugins/bootstrap/js/bootstrap.bundle.min.js') }}"></script>
<!-- AdminLTE App -->
<script src="{{ asset('dist/js/adminlte.min.js') }}"></script>
<script>
    function togglePassword() {
      var x = document.getElementById("password-field");
      if (x.type === "password") {
        x.type = "text";
      } else {
        x.type = "password";
      }
    }
  </script>
</body>
</html>
