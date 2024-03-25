@extends('layout.layout')

@section('title', 'Create Wisata | DewiGareng')
@section('page', 'Wisata Page')
@section('link', route('wisata.index'))
@section('route', 'Wisata')
@section('name', 'create')

@section('AdditionalLink')
<!-- Select2 -->
<link rel="stylesheet" href="{{ asset('plugins/select2/css/select2.min.css') }}">
<link rel="stylesheet" href="{{ asset('plugins/select2-bootstrap4-theme/select2-bootstrap4.min.css') }}">
@endsection

@section('content')
<div class="card card-default mx-auto mt-3" style="width: 90%;">
    <div class="card-header">
        <div class="d-flex justify-content-between align-items-center">
            <div>
                <h1 class="card-title"><b>Buat data Paket Wisata</b></h1>
            </div>

            <div>
                <a href="{{ route('wisata.index') }}">
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
            <form action="{{ route('wisata.store') }}" method="POST" enctype="multipart/form-data">
            @csrf

            <div class="form-group">
                <label>Daftar Wisata</label>
                <select class="form-control select2bs4" multiple="multiple" data-placeholder="Pilih ragam wisata" style="width: 100%;" id="wisata_id" name="wisata_ids[]" required>
                    @foreach($wisata as $wisat)
                        <option value="{{ $wisat->id }}" {{ old('wisata_id') == $wisat->id ? 'selected' : '' }}>
                            {{ $wisat->name }}
                        </option>
                    @endforeach
                </select>
            </div>

            <!-- Add your form fields based on your Paket model attributes -->
            <div class="form-group">
                <label for="name" class="form-label">Nama Paket Wisata</label>
                <input type="text" class="form-control" id="name" name="name" placeholder="Masukan Nama Wisata" value="{{ old('name') }}" required>
            </div>

            <div class="form-group">
                <label class="form-label">Deskripsi Paket Wisata</label>
                <textarea class="form-control" rows="3" id="description" name="description" placeholder="Masukan Deskripsi Wisata Anda" required>{{ old('description') }}</textarea>
            </div>

            <div class="form-group">
                <label for="price" class="form-label">Harga Paket Wisata</label>
                <input type="number" step="100" min="0" oninput="this.value = Math.max(0, this.value);"
                class="form-control" id="price" name="price" placeholder="Masukan Harga Wisata" value="{{ old('price') }}" required>
            </div>

            <div class="form-group">
                <label for="picture"class="form-label">Gambar Paket Wisata</label>
                <div class="input-group">
                  <div class="custom-file">
                    <input type="file" class="custom-file-input" id="picture" name="picture" onchange="previewImage()">
                    <label class="custom-file-label" for="exampleInputFile">Choose file</label>
                  </div>
                </div>
                <div class="mt-2">
                    <img id="imagePreview" src="#" alt="picture Preview" class="img-thumbnail" style="display: none; max-height:250px;">
                </div>
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
<!-- Select2 -->
<script src="{{ asset('plugins/select2/js/select2.full.min.js') }}"></script>

<script>
    //Initialize Select2 Elements
    $('.select2bs4').select2({
      theme: 'bootstrap4'
    })

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
@endsection
