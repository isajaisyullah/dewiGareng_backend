@extends('layout.layout')

@section('title', 'UMKM Show | DewiGareng')
@section('page', 'UMKM Page')

@can('view_all')
    @section('link', route('store.index'))
@else
    @section('link', route('storeUser.index'))
@endcan

@section('route', 'Store')
@section('name', 'show')

@section('content')
    <div class="card card-default mx-auto mt-3" style="width: 90%;">
        <div class="card-header">
            <div class="d-flex justify-content-between align-items-center">
                <div>
                    <h1 class="card-title"><b>Detail UMKM</b></h1>
                </div>

                <div>
                    @cannot('view_all')
                    <a href="{{ route('storeUser.index') }}">
                    @else
                    <a href="{{ route('store.index') }}">
                    @endcannot

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
                @can('view_all')
                    <form action="{{ route('store.update', $store->id) }}" method="POST" enctype="multipart/form-data">
                @else
                    <form action="{{ route('storeUser.update', $store->id) }}" method="POST" enctype="multipart/form-data">
                @endcan
                @csrf
                @method('PUT')

                <!-- Add your form fields based on your Toko model attributes -->
                <div class="form-group">
                    <label for="name" class="form-label">Nama Toko</label>
                    <input type="text" class="form-control" id="name" name="name" placeholder="Masukan Nama Toko Anda" value="{{ old('name', $store->name) }}" disabled>
                </div>

                <div class="form-group">
                    <label for="address" class="form-label">Alamat Toko</label>
                    <input type="text" class="form-control" id="address" name="address" placeholder="Masukan Alamat Toko Anda" value="{{ old('address', $store->address) }}" disabled>
                </div>

                <div class="form-group">
                    <label class="form-label">Deskripsi Toko</label>
                    <textarea class="form-control" rows="3" id="description" name="description" placeholder="Masukan Deskripsi Toko Anda" disabled>{{ old('description', $store->description) }}</textarea>
                </div>

                <div class="form-group">
                    <label for="logo"class="form-label">Logo Toko</label>
                    <div class="">
                        @if($store->logo)
                            <img id="imagePreview" src="{{ asset($store->logo) }}" alt="Logo Preview" class="img-thumbnail" style=" max-height:250px;">
                        @else
                            <div class="text-muted">Logo Kosong</div>
                        @endif
                    </div>
                </div>

                <div class="form-group">
                    <label>Admin Toko</label>
                    <table class="table table-bordered" style="width: 40%">
                        <tbody>
                            <tr>
                                <td style="width: 30%"><b>Nama</b></td>
                                <td>{{ $store->user->name }}</td>

                            </tr>
                            <tr>
                                <td><b>Email</b></td>
                                <td>{{ $store->user->email }}</td>

                            </tr>
                            <tr>
                                <td><b>No Telepon</b></td>
                                <td>{{ $store->user->phone }}</td>
                            </tr>

                        </tbody>
                    </table>
                </div>

            </form>
        </div>
        <div class="card-footer">
            @can('view_all')
                <a href="{{ route('store.edit', $store->id) }}" class="btn btn-warning btn-lg">Sunting</a>
                <form action="{{ route('store.destroy', $store->id) }}" method="POST" style="display: inline;">
                    @csrf
                    @method('DELETE')
                    <button type="submit" class="btn btn-danger btn-lg" onclick="return confirm('Apakah anda yakin?')">Hapus</button>
                </form>
            @else
                <a href="{{ route('storeUser.edit', $store->id) }}" class="btn btn-warning btn-lg">Sunting</a>
                <form action="{{ route('storeUser.destroy', $store->id) }}" method="POST" style="display: inline;">
                    @csrf
                    @method('DELETE')
                    <button type="submit" class="btn btn-danger btn-lg" onclick="return confirm('Apakah anda yakin?')">Hapus</button>
                </form>
            @endcan
        </div>
    </div>
@endsection
