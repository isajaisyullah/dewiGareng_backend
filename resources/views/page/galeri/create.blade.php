@extends('layout.layout')

@section('title', 'Galeri Create | DewiGareng')
@section('page', 'Galeri Page')
@section('link', route('galeri.index'))
@section('route', 'Galeri')
@section('name', 'create')

@section('AdditionalLink')
  <!-- summernote -->
  <link rel="stylesheet" href="{{ asset('plugins/summernote/summernote-bs4.min.css') }}">
@endsection

@section('content')
<div class="card card-default mx-auto mt-3" style="width: 90%;">
    <div class="card-header">
        <div class="d-flex justify-content-between align-items-center">
            <div>
                <h1 class="card-title"><b>Buat Data Galeri</b></h1>
            </div>

            <div>
                <a href="{{ route('galeri.index') }}">
                    <button type="button" class="btn btn-dark btn-icon-text">
                        <i class="fas fa-arrow-alt-circle-left mr-2"></i>Kembali
                    </button>
                </a>
            </div>

        </div>

    </div>
    <!-- /.card-header -->
    <div class="card-body">

        <!-- Display validation errors if there are any -->
        @if ($errors->any())
            <div class="alert alert-danger">
                <ul>
                    @foreach ($errors->all() as $error)
                        <li>{{ $error }}</li>
                    @endforeach
                </ul>
            </div>
        @endif

        <!-- Create store form -->
            <form action="{{ route('galeri.store') }}" method="POST" enctype="multipart/form-data">
            @csrf

            <!-- Add your form fields based on your Toko model attributes -->
            <div class="form-group">
                <label for="title" class="form-label">Judul</label>
                <input type="text" class="form-control" id="title" name="title" placeholder="Masukan Judul Artikel" value="{{ old('title') }}" required>
            </div>

            <div class="form-group">
                <label class="form-label">Deskripsi Artikel</label>
                <textarea class="form-control" id="summernote" name="description" placeholder="Masukan isi Artikel" required>{{ old('description') }}</textarea>
            </div>

            <div class="form-group">
                <label for="picture"class="form-label">Gambar Utama</label>
                <div class="input-group">
                  <div class="custom-file">
                    <input type="file" class="custom-file-input" id="picture" name="picture" onchange="previewImage()">
                    <label class="custom-file-label" for="exampleInputFile">Pilih file</label>
                  </div>
                </div>
                <div class="mt-2">
                    <img id="imagePreview" src="#" alt="picture Preview" class="img-thumbnail" style="display: none; max-height:250px;">
                </div>
            </div>

            <div class="form-group">
                <label>Admin</label>
                <select class="form-control select2bs4" style="width: 100%;" id="users_id" name="users_id" disabled>
                    <option value="{{ $user->id }}" selected>{{ $user->name }}</option>
                </select>
                <input type="hidden" name="users_id" value="{{ $user->id }}">
            </div>

    </div>
    <!-- /.card-body -->

    <div class="card-footer">
        <button type="submit" class="btn btn-primary btn-lg">Simpan</button>
    </form>
    </div>
  </div>
@endsection

@section('AdditionalScript')
<!-- Summernote -->
  <script src="{{ asset('plugins/summernote/summernote-bs4.min.js') }}"></script>

  <script>
      function previewImage() {
          var input = document.getElementById('picture');
          var preview = document.getElementById('imagePreview');

          var file = input.files[0];
          var reader = new FileReader();

          reader.onloadend = function () {
              preview.src = reader.result;
              preview.style.display = 'block';
          };

          if (file) {
              reader.readAsDataURL(file);
          } else {
              preview.src = '';
              preview.style.display = 'none';
          }
      }
  </script>

  <script>
      $(function () {
      // Summernote
      $('#summernote').summernote(
          {
              height: 200,
              toolbar: [
              ['style', ['style']],
              ['font', ['bold', 'italic', 'underline', 'clear']],
              ['fontsize', ['fontsize', 'fontname', 'color']],
              ['para', ['ul', 'ol', 'paragraph', 'height']],
              ['insert', ['link']],
              ['view', ['fullscreen', 'codeview']],
          ],
          }
      );
      });
  </script>
@endsection
