@extends('layout.layout')

@section('title', 'Detail Product | DewiGareng')
@section('page', 'Product Page')

@can('view_all')
    @section('link', route('product.index'))
@else
    @section('link', route('productUser.index'))
@endcan

@section('route', 'Product')
@section('name', 'show')

@section('content')
    <div class="card card-default mx-auto mt-3" style="width: 90%;">
        <div class="card-header">
            <div class="d-flex justify-content-between align-items-center">
                <div>
                    <h1 class="card-title"><b>Detail Produk</b></h1>
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

                <div class="form-group">
                    <label for="name" class="form-label">Nama Produk</label>
                    <input type="text" class="form-control" id="name" name="name" placeholder="Masukan Nama Product" value="{{ old('name', $product->name) }}" disabled>
                </div>

                <div class="form-group">
                    <label>Kategori Produk</label>
                    <select class="form-control select2bs4" style="width: 100%;" id="category_id" name="category_id" disabled>
                        <option value="{{ $product->category_id }}" {{ old('category_id') == $product->category_id ? 'selected' : '' }}>
                            {{ $product->category->name }}
                        </option>
                    </select>
                </div>

                <div class="form-group">
                    <label for="price" class="form-label">Banyak Produk</label>
                    <input type="number" class="form-control" id="stock" name="stock" value="{{ old('stock', $product->stock) }}" disabled>
                </div>

                <div class="form-group">
                    <label for="price" class="form-label">Harga Produk</label>
                    <input type="number" class="form-control" id="price" name="price" value="{{ old('price', $product->price) }}" disabled>
                </div>

                <div class="form-group">
                    <label class="form-label">Deskripsi Produk</label>
                    <textarea class="form-control" rows="3" id="description" name="description" placeholder="Masukan Deskripsi Product" disabled>{{ old('description', $product->description) }}</textarea>
                </div>

                <div class="form-group">
                    <label for="picture"class="form-label">Gambar Produk</label>
                    <div class="">
                        @if($product->picture)
                        <img id="imagePreview" src="{{ asset($product->picture) }}" alt="picture Preview" class="img-thumbnail" style="max-height:250px;">
                        @else
                            <div class="text-muted">Gambar Kosong</div>
                        @endif
                    </div>
                </div>
                <hr>
                <h1 class="card-title ml-1"><b>Detail UMKM</b></h1>
                <br>
                <div class="d-flex mt-1">
                    <div style="width: 50%">
                        <table class="table table-bordered" style="width: 100%">
                            <tbody>
                                <tr>
                                    <td style="width: 150px"><b>Nama UMKM</b></td>
                                    <td>{{ $product->umkm->name }}</td>

                                </tr>
                                <tr>
                                    <td><b>Alamat</b></td>
                                    <td>{{ $product->umkm->address }}</td>

                                </tr>
                                <tr>
                                    <td><b>Deskripsi</b></td>
                                    <td>{{ $product->umkm->description }}</td>
                                </tr>
                                <tr>
                                    <td><b>Pemilik</b></td>
                                    <td>{{ $product->umkm->user->name }}</td>
                                </tr>
                            </tbody>
                        </table>
                    </div>

                    <div style="width: 50%; padding-left: 5%">
                        @if($product->umkm->logo)
                            <img id="imagePreview" src="{{ asset($product->umkm->logo) }}" alt="picture Preview" class="img-thumbnail" style="max-height:200px;">
                        @else
                            <div class="text-muted">Logo Kosong</div>
                        @endif
                    </div>


                </div>
                <hr>
                <h1 class="card-title ml-1"><b>Admin UMKM</b></h1>
                <br>
                <div class="form-group mt-1">
                    <table class="table table-bordered" style="width: 50%">
                        <tbody>
                            <tr>
                                <td style="width: 150px"><b>Nama</b></td>
                                <td>{{ $product->umkm->user->name }}</td>

                            </tr>
                            <tr>
                                <td><b>Email</b></td>
                                <td>{{ $product->umkm->user->email }}</td>

                            </tr>
                            <tr>
                                <td><b>No. Telepon</b></td>
                                <td>{{ $product->umkm->user->phone }}</td>
                            </tr>

                        </tbody>
                    </table>
                </div>
        </div>

        <div class="card-footer">
            @can('view_all')
                <a href="{{ route('product.edit', $product->id) }}" class="btn btn-warning btn-lg">Sunting</a>
                <form action="{{ route('product.destroy', $product->id) }}" method="POST" style="display: inline;">
                    @csrf
                    @method('DELETE')
                    <button type="submit" class="btn btn-danger btn-lg" onclick="return confirm('Apakah anda yakin')">Hapus</button>
                </form>
            @else
                <a href="{{ route('productUser.edit', $product->id) }}" class="btn btn-warning btn-lg">Sunting</a>
                <form action="{{ route('productUser.destroy', $product->id) }}" method="POST" style="display: inline;">
                    @csrf
                    @method('DELETE')
                    <button type="submit" class="btn btn-danger btn-lg" onclick="return confirm('Apakah anda yakin')">Hapus</button>
                </form>
            @endcan

        </div>
    </div>
@endsection
