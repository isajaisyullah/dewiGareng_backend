@extends('layout.layout')

@section('title', 'Create Product | DewiGareng')
@section('page', 'Product Page')
@can('view_all')
    @section('link', route('product.index'))
@else
    @section('link', route('productUser.index'))
@endcan
@section('route', 'Product')
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
                <h1 class="card-title"><b>Buat data produk</b></h1>
            </div>

            <div>
                @cannot('view_all')
                <a href="{{ route('productUser.index') }}">
                @else
                <a href="{{ route('product.index') }}">
                @endcannot
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
        @can('view_all')
            <form action="{{ route('product.store') }}" method="POST" enctype="multipart/form-data">
        @else
            <form action="{{ route('productUser.store') }}" method="POST" enctype="multipart/form-data">
        @endcan
            @csrf

            <div class="form-group">
                <label for="name" class="form-label">Nama Produk</label>
                <input type="text" class="form-control" id="name" name="name" placeholder="Masukan Nama Product" value="{{ old('name') }}" required>
            </div>

            <div class="form-group">
                <label>Kategori Produk</label>
                <select class="form-control select2" style="width: 100%;" id="category_id" name="category_id" required>
                    <option value="" disabled selected>Pilih salah satu</option>
                    @foreach($categories as $category)
                        <option value="{{ $category->id }}" {{ old('category_id') == $category->id ? 'selected' : '' }}>
                            {{ $category->name }}
                        </option>
                    @endforeach
                </select>
            </div>

            <div class="form-group">
                <label for="stock" class="form-label">Banyak Produk</label>
                <input type="number" step="1" min="0" oninput="this.value = Math.max(0, this.value);"
                class="form-control" id="stock" name="stock" placeholder="Masukan Banyak Produk" value="{{ old('stock') }}" required>
            </div>

            <div class="form-group">
                <label for="price" class="form-label">Harga Produk</label>
                <input type="number" step="100" min="0" oninput="this.value = Math.max(0, this.value);"
                class="form-control" id="price" name="price" placeholder="Masukan Harga Produk" value="{{ old('price') }}" required>
            </div>

            <div class="form-group">
                <label class="form-label">Deskripsi Produk</label>
                <textarea class="form-control" rows="3" id="description" name="description" placeholder="Masukan Deskripsi Produk" required>{{ old('description') }}</textarea>
            </div>

            <div class="form-group">
                <label for="picture"class="form-label">Gambar Produk</label>
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
                <label>UMKM Penjual</label>
                @can('view_all')
                <select class="form-control select2bs4" style="width: 100%;" id="umkm_id" name="umkm_id" required>
                    <option value="" disabled selected>Pilih salah satu</option>
                    @foreach($umkm as $pemilik)
                        <option value="{{ $pemilik->id }}" {{ old('umkm_id') == $pemilik->id ? 'selected' : '' }}>
                            {{ $pemilik->name }}
                        </option>
                    @endforeach
                </select>
                @else
                    <select class="form-control select2bs4" style="width: 100%;" id="umkm_id" name="umkm_id" disabled>
                        <option value="{{ $umkm->id }}" selected>{{ $umkm->name }}</option>
                    </select>
                    <input type="hidden" name="umkm_id" value="{{ $umkm->id }}">
                @endcan
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
    $(function () {
        // Initialize Select2 Elements with Bootstrap 4 theme
        $('.select2bs4').select2({
            theme: 'bootstrap4'
        });
    });

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
