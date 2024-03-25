@extends('layout.layout')

@section('title', 'Profile Admin | DewiGareng')
@section('page', 'Profile Page')
@section('link', route('dashboard.index'))
@section('route', 'Home')
@section('name', 'profile')

@section('content')
<div class="card card-default mx-auto mt-3" style="width: 90%;">
    <div class="card-header">
        <div class="d-flex justify-content-between align-items-center">
            <div>
                <h1 class="card-title"><b>Sunting data Admin</b></h1>
            </div>

            <div>
                <a href="{{ route('dashboard.index') }}">
                    <button type="button" class="btn btn-dark btn-icon-text">
                        <i class="fas fa-arrow-alt-circle-left mr-2"></i>Beranda
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
                <form action="{{ route('profileAll.update', $user->id) }}" method="POST" enctype="multipart/form-data">
            @else
                <form action="{{ route('profile.update', $user->id) }}" method="POST" enctype="multipart/form-data">
            @endcan
            @csrf
            @method('PUT')

            <!-- Add your form fields based on your Toko model attributes -->
            <div class="form-group">
                <label for="name" class="form-label">Nama Admin</label>
                <input type="text" class="form-control" id="name" name="name" placeholder="Masukan Nama Anda" value="{{ old('name', $user->name) }}" required>
            </div>

            <div class="form-group">
                <label for="phone" class="form-label">Nomor Telepon</label>
                <input type="text" class="form-control" id="phone" name="phone" placeholder="Masukan Nomor Handphone Anda" value="{{ old('phone', $user->phone) }}" required>
            </div>

            <div class="form-group">
                <label for="email" class="form-label">Email</label>
                <input type="text" class="form-control" id="email" name="email" value="{{ old('phone', $user->email) }}" disabled>
            </div>
    </div>
    <!-- /.card-body -->

    <div class="card-footer">
        <button type="submit" class="btn btn-primary btn-lg">Simpan</button>
    </form>
    </div>
  </div>
@endsection
