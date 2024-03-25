@extends('layout.layout')

@section('title', 'Product Data | DewiGareng')
@section('page', 'Product Page')

@can('view_all')
    @section('link', route('product.index'))
@else
    @section('link', route('productUser.index'))
@endcan

@section('route', 'Product')
@section('name', 'index')

@section('content')
    <div class="col-lg-12 grid-margin stretch-card">

        <div>
            @can('view_all')
                <form action="{{ route('product.index') }}" method="get">
            @else
                <form action="{{ route('productUser.index') }}" method="get">
            @endcan
            @csrf
                <div class="col-md-2 ml-auto">
                {{-- <div class="col-md-10 offset-md-1"> --}}
                    <div class="form-group">
                        <div class="input-group input-group-sm">
                            <input type="search" name="search" class="form-control form-control-lg" placeholder="search..." value="{{ request('search') }}">
                            <div class="input-group-append">
                                <button type="submit" class="btn btn-lg btn-default">
                                    <i class="fa fa-search"></i>
                                </button>
                            </div>
                        </div>
                    </div>
                </div>
            </form>
        </div>

    @if (!$umkm)
    <div class="card">
        <div class="card-header" style="height: 100px">
            <div class="d-flex align-items-center mt-3">
                <div style="margin: auto;">
                    <h2 class="card-title text-center"><b>UMKM kosong, Buat data UMKM terlebih dahulu untuk melanjutkan</b></h2>
                </div>

            <div style="width: 30%" class="mr-5">
                @cannot('view_all')
                <a href="{{ route('storeUser.index') }}">
                @else
                <a href="{{ route('store.index') }}">
                @endcannot
                    <button type="button" class="btn btn-dark btn-block btn-rounded" style="height: 50px">
                        <i class="nav-icon fas fa-store-alt mr-2"></i>Pindah ke halaman UMKM
                    </button>
                </a>
            </div>
            </div>
        </div>
    </div>

    @else


        <div class="card">
            <div class="card-header">
                <div class="d-flex justify-content-between align-items-center">
                <div>
                    <h2 class="card-title"><b>Produk</b></h2>
                </div>

                <div>
                    @cannot('view_all')
                    <a href="{{ route('productUser.create') }}">
                    @else
                    <a href="{{ route('product.create') }}">
                    @endcannot
                        <button type="button" class="btn btn-dark btn-block btn-rounded">
                            <i class="fas fa-plus-circle mr-2"></i>TAMBAH DATA
                        </button>
                    </a>
                </div>
                </div>
            </div>

            <div class="card-body pt-0 pb-0">
                @if (count($products) > 0)
                <div class="table-responsive pt-3">
                <table class="table table-bordered text-center mt-0 mb-0">
                    <thead>
                        <tr>
                            <th style="width: 10px;">No.</th>
                        @can('view_all')
                            <th style="width: 15%;">Nama UMKM</th>
                        @endcan
                            <th style="width: 20%;">Nama Barang</th>
                            <th style="width: 8%;">Kategori</th>
                            <th style="width: 2%;">Stok</th>
                            <th style="width: 7%;">Harga</th>
                            <th>Deskripsi</th>
                            <th style="width: 10%;">Gambar</th>
                            <th style="width: 200px; text-align: center;">Action</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($products as $product)
                            <tr>
                                <td style="text-align: center;">{{ ($products->currentPage() - 1) * $products->perPage() + $loop->index + 1 }}</td>
                            @can('view_all')
                                <td style="text-align: left">{{ $product->umkm->name }}</td>
                            @endcan
                                <td style="text-align: left">{{ $product->name }}</td>
                                <td>{{ $product->category->name }}</td>
                                <td>{{ $product->stock }}1000</td>
                                <td>Rp{{ $product->price }}</td>
                                <td style="text-align: left">{{ $product->description }}</td>
                                <td class="text-center" style="max-width:80px;">
                                    @if($product->picture)
                                        <img src="{{ asset($product->picture) }}" alt="Picture" style="max-width:100%; max-height: 100px">
                                    @else
                                        Gambar Kosong
                                    @endif
                                </td>
                                <!-- Add other columns as needed -->
                                <td class="text-center align-middle">
                                    @cannot('view_all')
                                        <a href="{{ route('productUser.show', $product->id) }}"> <button class="btn btn-info btn-icon"> <i class="fas fa-eye"></i> </button></a>
                                        <a href="{{ route('productUser.edit', $product->id) }}"> <button class="btn btn-warning btn-icon"> <i class="fas fa-edit"></i> </button></a>
                                        <!-- Add delete button if you want to allow deletion -->
                                        <!-- Form for deleting using DELETE method -->
                                        <form action="{{ route('productUser.destroy', $product->id) }}" method="POST" style="display: inline;">
                                            @csrf
                                            @method('DELETE')
                                            <button type="submit" class="btn btn-danger btn-icon" onclick="return confirm('Apakah anda yakin?')"><i class="fas fa-trash-alt"></i> </button>
                                        </form>
                                    @else
                                        <a href="{{ route('product.show', $product->id) }}"> <button class="btn btn-primary btn-icon"> <i class="fas fa-eye"></i> </button></a>
                                        <a href="{{ route('product.edit', $product->id) }}"> <button class="btn btn-warning btn-icon"> <i class="fas fa-edit"></i> </button></a>
                                        <!-- Add delete button if you want to allow deletion -->
                                        <!-- Form for deleting using DELETE method -->
                                        <form action="{{ route('product.destroy', $product->id) }}" method="POST" style="display: inline;">
                                            @csrf
                                            @method('DELETE')
                                            <button type="submit" class="btn btn-danger btn-icon" onclick="return confirm('Apakah anda yakin?')"> <i class="fas fa-trash-alt"></i> </button>
                                        </form>
                                    @endcannot

                            </td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
                <br>
                <div class="d-flex pagination-l mt-0">
                    {{-- <div class="card-footer clearfix">--}}
                    {{ $products->links() }} <!-- This line adds the pagination links -->
                </div>

                </div>
                @else
                    <p class="pt-2">Tidak ada data yang ditemukan.</p>
                @endif

            </div>
        </div>

    @endif
    </div>

@endsection
