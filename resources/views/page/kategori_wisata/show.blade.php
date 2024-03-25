@extends('layout.layout')

@section('title', 'Wisata Show | DewiGareng')
@section('page', 'Wisata Page')
@section('link', route('wisata.index'))
@section('route', 'wisata')
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
            <form action="#" method="POST" enctype="multipart/form-data">
            @csrf
            @method('PUT')

            <!-- Add your form fields based on your Toko model attributes -->
            <div class="form-group">
                <label for="name" class="form-label">Nama Wisata</label>
                <input type="text" class="form-control" id="name" name="name" placeholder="Masukan Nama Wisata" value="{{ old('name', $wisata->name) }}" disabled>
            </div>

            <div class="form-group">
                <label>Admin</label>
                <select class="form-control select2bs4" style="width: 100%;" id="users_id" name="users_id" disabled>
                    <option value="" selected>{{ $wisata->user->name }}</option>
                </select>
            </div>
        </form>
    </div>
    <!-- /.card-body -->

    <div class="card-footer">
        <a href="{{ route('wisataKategori.edit', $wisata->id) }}" class="btn btn-warning btn-lg">Sunting</a>
        <form action="{{ route('wisataKategori.destroy', $wisata->id) }}" method="POST" style="display: inline;">
            @csrf
            @method('DELETE')
            <button type="submit" class="btn btn-danger btn-lg" onclick="return confirm('Apakah anda yakin?')">Hapus</button>
        </form>
    </form>
    </div>
  </div>
@endsection
