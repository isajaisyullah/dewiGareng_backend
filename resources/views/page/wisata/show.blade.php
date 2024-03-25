@extends('layout.layout')

@section('title', 'Detail Wisata | DewiGareng')
@section('page', 'Wisata Page')
@section('link', route('wisata.index'))
@section('route', 'Wisata')
@section('name', 'show')

@section('content')
    <div class="card card-default mx-auto mt-3" style="width: 90%;">
        <div class="card-header">
            <div class="d-flex justify-content-between align-items-center">
                <div>
                    <h1 class="card-title"><b>Detail Wisata</b></h1>
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

             <!-- Edit store form -->
                    <form action="#" method="POST" enctype="multipart/form-data">
                @csrf
                @method('PUT')

                <div class="form-group">
                    <label>Daftar Wisata</label>
                    <input type="text" class="form-control" value="{{ implode(', ', $paket->wisata->pluck('name')->toArray()) }}" disabled>
                </div>


                <div class="form-group">
                    <label for="name" class="form-label">Nama Paket Wisata</label>
                    <input type="text" class="form-control" id="name" name="name" placeholder="Masukan Nama Wisata" value="{{ old('name', $paket->name) }}" disabled>
                </div>

                <div class="form-group">
                    <label class="form-label">Deskripsi Paket Wisata</label>
                    <textarea class="form-control" rows="3" id="description" name="description" placeholder="Masukan Deskripsi Wisata Anda" disabled>{{ old('description', $paket->description) }}</textarea>
                </div>

                <div class="form-group">
                    <label for="price" class="form-label">Harga Paket Wisata</label>
                    <input type="number" class="form-control" id="price" name="price" placeholder="Masukan Harga Wisata" value="{{ old('price', $paket->price) }}" disabled>
                </div>

                <div class="form-group">
                    <label for="picture"class="form-label">Gambar Paket Wisata</label>
                    <div class="">
                        @if($paket->picture)
                            <img id="imagePreview" src="{{ asset($paket->picture) }}" alt="Picture Preview" class="img-thumbnail" style=" max-height:250px;">
                        @else
                            <div class="text-muted">Gambar Kosong</div>
                        @endif
                    </div>
                </div>
            </form>
        </div>
        <div class="card-footer">
                <a href="{{ route('wisata.edit', $paket->id) }}" class="btn btn-warning btn-lg">Sunting</a>
                <form action="{{ route('wisata.destroy', $paket->id) }}" method="POST" style="display: inline;">
                    @csrf
                    @method('DELETE')
                    <button type="submit" class="btn btn-danger btn-lg" onclick="return confirm('Apakah anda yakin?')">Hapus</button>
                </form>
        </div>
    </div>
@endsection
