<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <title>Log in | DewiGareng</title>
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
<div class="login-box" style="width:auto; box-shadow: 0 20px 25px -5px rgb(0 0 0 / 0.1), 0 8px 10px -6px rgb(0 0 0 / 0.1);">
  <!-- /.login-logo -->
  <div class="card card-outline card-primary responsive-card">
    <div class="card-header text-center">
        <h1><b>DewiGareng</b></h1>
        <h3>Administrator Website</h3>
    </div>
    <div class="card-body">
        @if (session('resent'))
        <div class="alert alert-success" role="alert">
            {{ __('Link Verifikasi baru telah dikirimkan ke email anda') }}
        </div>
    @endif

    {{ __('Sebelum Melanjutkan, Silahkan cek email anda untuk verifikasi email') }}
    {{ __('Jika tidak mendapatkan email') }},
    <form class="d-inline" method="POST" action="{{ route('verification.resend') }}">
        @csrf
        <button type="submit" class="btn btn-link p-0 m-0 align-baseline">{{ __('klik disini untuk mengirimkan ulang') }}</button>.
    </form>

    <hr>

    {{ __('Jika sudah verifikasi email') }},
    <form class="d-inline" method="post" action="{{ route('logout') }}">
        @csrf
        <button type="submit" class="btn btn-link p-0 m-0 align-baseline">{{ __('ke halaman Login') }}</button>.
    </form>
    

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
