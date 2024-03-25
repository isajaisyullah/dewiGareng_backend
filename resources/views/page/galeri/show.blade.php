@extends('layout.layout')

@section('title', 'Galeri Show | DewiGareng')
@section('page', 'Galeri Page')
@section('link', route('galeri.index'))
@section('route', 'Galeri')
@section('name', 'show')

@section('content')
<div class="card card-default mx-auto mt-3" style="width: 90%;">
    <div class="card-header">
        <div class="d-flex justify-content-between align-items-center">
            <div>
                <h1 class="card-title"><b>Detail data Galeri</b></h1>
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
            <form action="{{ route('galeri.update', $galeri->id) }}" method="POST" enctype="multipart/form-data">
            @csrf
            @method('PUT')

            <!-- Add your form fields based on your Toko model attributes -->
            <div class="form-group">
                <label for="title" class="form-label">Judul</label>
                <input type="text" class="form-control" id="title" name="title" placeholder="Masukan Judul Artikel" value="{{ old('title', $galeri->title) }}" disabled>
            </div>

            <div class="form-group">
                <label class="form-label">Deskripsi Artikel</label>
                <div class="card card-default"  style="max-height: 300px;background-color: rgb(235, 235, 235); overflow:auto; width: 100%; padding: 2%">
                    {!! $galeri->description !!}
                </div>
            </div>

            <div class="form-group">
                <label for="picture"class="form-label">Gambar Utama</label>
                <div class="mt-2">
                    @if($galeri->picture)
                        <img id="imagePreview" src="{{ asset($galeri->picture) }}" alt="picture Preview" class="img-thumbnail" style=" max-height:250px;">
                    @else
                        <div class="text-muted">Gambar Kosong</div>
                    @endif
                </div>
            </div>

            <div class="form-group">
                <label>Admin</label>
                <select class="form-control select2bs4" style="width: 100%;" id="users_id" name="users_id" disabled>
                    <option value="" selected>{{ $galeri->user->name }}</option>
                </select>
                {{-- <input type="hidden" name="users_id" value="{{ $user->id }}"> --}}
            </div>
        </form>
    </div>
    <!-- /.card-body -->

    <div class="card-footer">
        <a href="{{ route('galeri.edit', $galeri->id) }}" class="btn btn-warning btn-lg">Sunting</a>
        <form action="{{ route('galeri.destroy', $galeri->id) }}" method="POST" style="display: inline;">
            @csrf
            @method('DELETE')
            <button type="submit" class="btn btn-danger btn-lg" onclick="return confirm('Apakah anda yakin?')">Hapus</button>
        </form>
    </form>
    </div>
  </div>

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
@endsection
