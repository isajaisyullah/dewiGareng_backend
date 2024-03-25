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
<div class="login-box" style="width:auto; box-shadow: 0 20px 25px -5px rgb(0 0 0 / 0.1), 0 8px 10px -6px rgb(0 0 0 / 0.1);">
  <!-- /.login-logo -->
  <div class="card card-outline card-primary responsive-card">
    <div class="card-header text-center">
        <h3><i class="fa  fa-user-secret fa-4x"></i></h3>
        <h2 class="text-center responsive-card-title">Ubah Kata Sandi</h2>
        <p class="mb-0">Anda bisa merubah kata sandi disini, dan jangan lupa diingat!</p>
    </div>
    <div class="card-body">
      <form action="{{ route('reset.password.post') }}" role="form" autocomplete="off" class="form" method="POST">
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
            <input value="{{ $email }}" type="email" class="form-control" pattern="[a-zA-Z0-9._%+-]+@[a-zA-Z0-9.-]+\.[a-zA-Z]{2,}" required disabled>
            <div class="input-group-append">
              <div class="input-group-text" style="width:40px">
                <span class="fas fa-envelope"></span>
              </div>
            </div>
        </div>

        <div class="input-group mb-3">
          <input name="password" id="password-field" type="password" class="form-control" placeholder="Kata sandi Baru" required>
          <div class="input-group-append">
            <div class="input-group-text" style="width:40px">
              <span class="fas fa-lock"></span>
            </div>
          </div>
        </div>

        <div class="input-group mb-3">
            <input name="password_confirmation" id="password_confirmation" type="password" class="form-control" placeholder="Konfirmasi Kata Sandi" required>
            <div class="input-group-append">
              <div class="input-group-text" style="width:40px">
                <span class="fas fa-lock"></span>
              </div>
            </div>
        </div>

        <div class="mx-auto col-8">
            <button name="submit" type="submit" class="btn btn-lg btn-primary btn-block responsive-font-h mt-5 mb-2">Ganti Kata Sandi</button>
        </div>
        <input type="text" hidden class="hide" name="token" id="token" value="{{ $token }}">
        <input type="text" hidden class="hide" name="email" id="email" value="{{ $email }}">
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
