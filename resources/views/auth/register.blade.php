<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <title>Register | DewiGareng</title>
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
<body class="hold-transition register-page">
<div class="register-box" style="width:auto;  box-shadow: 0 20px 25px -5px rgb(0 0 0 / 0.1), 0 8px 10px -6px rgb(0 0 0 / 0.1);">
  <div class="card card-outline card-primary responsive-card">
    <div class="card-header text-center">
        <h1><b>DewiGareng</b></h1>
        <h3>Administrator Website</h3>
    </div>
    <div class="card-body">
      <p class="login-box-msg">Masukan data untuk membuat akun baru</p>


      <form action="{{ route('register') }}" method="post">
        @csrf

        <div class="input-group mb-3">
          <input name="name" type="text" class="form-control @error('name')is-invalid @enderror" placeholder="Nama Lengkap" value="{{ old('name') }}" required>
          <div class="input-group-append">
            <div class="input-group-text" style="width:40px">
              <span class="fas fa-user"></span>
            </div>
          </div>
            @error('name')
            <span class="error invalid-feedback">{{ $message }}</span>
            @enderror
        </div>

        <div class="input-group mb-3">
          <input  name="email" type="email" class="form-control @error('email')is-invalid @enderror" placeholder="Email" value="{{ old('email') }}" required>
          <div class="input-group-append">
            <div class="input-group-text" style="width:40px">
              <span class="fas fa-envelope"></span>
            </div>
          </div>
          @error('email')
            <span class="error invalid-feedback">{{ $message }}</span>
          @enderror
        </div>

        <div class="input-group mb-3">
          <input  name="phone" type="text" class="form-control  @error('phone')is-invalid @enderror" placeholder="Nomor Telepon (ex:081264645858)" value="{{ old('phone') }}" required>
          <div class="input-group-append">
            <div class="input-group-text" style="width:40px">
              <span class="fas fa-phone"></span>
            </div>
          </div>
          @error('phone')
            <span class="error invalid-feedback">{{ $message }}</span>
          @enderror
        </div>

        <div class="input-group mb-3">
          <input name="password" type="password" class="form-control @error('password')is-invalid @enderror" placeholder="Kata Sandi" required>
          <div class="input-group-append">
            <div class="input-group-text" style="width:40px">
              <span class="fas fa-lock"></span>
            </div>
          </div>
          @error('password')
            <span class="error invalid-feedback">{{ $message }}</span>
          @enderror
        </div>

        <div class="input-group mb-3">
          <input name="password_confirmation" type="password" class="form-control @error('password_confirmation')is-invalid @enderror" placeholder="Ulangi Kata Sandi" required>
          <div class="input-group-append">
            <div class="input-group-text" style="width:40px">
              <span class="fas fa-lock"></span>
            </div>
          </div>
          @error('password_confirmation')
            <span class="error invalid-feedback">{{ $message }}</span>
          @enderror
        </div>

        <div class="row">
          <div class="col-8">
            <p class="mt-2 ml-2">
                Sudah memiliki akun? <a href="{{ route('login') }}" class="text-primary">Masuk</a>
            </p>
          </div>
          <!-- /.col -->
          <div class="col-4">
            <button type="submit" class="btn btn-primary btn-block">Daftar</button>
          </div>
          <!-- /.col -->
        </div>
      </form>

    </div>
    <!-- /.form-box -->
  </div><!-- /.card -->
</div>
<!-- /.register-box -->

<!-- jQuery -->
<script src="{{ asset('plugins/jquery/jquery.min.js') }}"></script>
<!-- Bootstrap 4 -->
<script src="{{ asset('plugins/bootstrap/js/bootstrap.bundle.min.js') }}"></script>
<!-- AdminLTE App -->
<script src="{{ asset('dist/js/adminlte.min.js') }}"></script>
</body>
</html>
