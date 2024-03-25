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
      <p class="login-box-msg responsive-font-h"><b>Masuk</b> untuk membuka halaman admin</p>

      <form action="{{ route('login') }}" method="post">
        @csrf

        @if ($errors->any())
            <div class="d-flex justify-content-center">
                <div class="alert alert-danger">
                    {{-- {{ __('auth.failed') }} --}}
                    email atau password salah!
                </div>
            </div>
        @endif

        <div class="input-group mb-3">
            @error('email')
                <span class="invalid-feedback">{{ $message }}</span>
             @enderror
          <input name="email" type="email" class="form-control" placeholder="Masukkan Email" value="{{ old('email') }}">
          <div class="input-group-append">
            <div class="input-group-text" style="width:40px">
              <span class="fas fa-envelope"></span>
            </div>
          </div>
        </div>
        <div class="input-group mb-3">
            @error('password')
                <span class="invalid-feedback">{{ $message }}</span>
            @enderror
          <input name="password" id="password-field" type="password" class="form-control" placeholder="Masukkan Kata Sandi">
          <div class="input-group-append">
            <div class="input-group-text" style="width:40px">
              <span class="fas fa-lock"></span>
            </div>
          </div>
        </div>
        <div class="row">
            <div class="col-7" >
              <input name="passwd" id="passwd" type="checkbox" class="ml-2" onclick="togglePassword()">
              <label class="responsive-font-md" for="passwd" style="font-weight: normal;"> Tampilkan Kata Sandi</label>

            </div>
            <!-- /.col -->
            <div class="col-5">
                <p class="text-right">
                    <a class="responsive-font-md" href="{{ route("forget.password") }}">Lupa Kata Sandi</a>
                  </p>
            </div>
            <!-- /.col -->
          </div>

          <div class="mx-auto col-6">
            <button type="submit" class="btn btn-primary btn-block">Masuk</button>
          </div>

      </form>

      <hr>

      <p class="text-center responsive-font-md">
        Tidak memiliki akun? <a href="{{ route('register') }}" class="text-primary">Buat akun</a>
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
