@extends('layout.layout')

@section('title', 'Wisata Data | DewiGareng')
@section('page', 'Wisata Page')
@section('link', route('wisata.index'))
@section('route', 'Wisata')
@section('name', 'index')

@section('content')
    <div class="col-lg-12 grid-margin stretch-card">
        <div>
            <form action="{{ route('wisata.index') }}" method="get">
                @csrf
                <div class="col-md-2 ml-auto">
                {{-- <div class="col-md-10 offset-md-1"> --}}
                    <div class="form-group">
                        <div class="input-group input-group-sm">
                            <input type="search" name="searchWisata" class="form-control form-control-lg" placeholder="search..." value="{{ request('searchWisata') }}">
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

        <div class="card">

            <div class="card-header">
                <div class="d-flex justify-content-between align-items-center">
                <div>
                    <h2 class="card-title"><b>Daftar Wisata</b></h2>
                </div>

                <div>
                    <a href="{{ route('wisataKategori.create') }}">
                        <button type="button" class="btn btn-dark btn-block btn-rounded">
                            <i class="fas fa-plus-circle mr-2"></i>TAMBAH DATA
                        </button>
                    </a>
                </div>
                </div>
            </div>

            <div class="card-body pt-0 pb-0">
                @if (count($wisata) > 0)
                <div class="table-responsive pt-3">
                <table class="table table-bordered mb-0">
                    <thead>
                        <tr>
                            <th style="width: 10px;">No.</th>
                            <th>Nama Wisata</th>
                            @can('view_all')
                                <th>Admin Wisata</th>
                            @endcan
                            <th style="width: 200px; text-align: center;">Action</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($wisata as $wisat)
                            <tr>
                                <td style="text-align: center;">{{ ($wisata->currentPage() - 1) * $wisata->perPage() + $loop->index + 1 }}</td>
                                <td>{{ $wisat->name }}</td>
                                @can('view_all')
                                    <td>{{ $wisat->user->name }}</td>
                                @endcan
                                <!-- Add other columns as needed -->
                                <td class="text-center">
                                    <a href="{{ route('wisataKategori.show', $wisat->id) }}"> <button class="btn btn-primary btn-icon"> <i class="fas fa-eye"></i> </button></a>
                                    <a href="{{ route('wisataKategori.edit', $wisat->id) }}"> <button class="btn btn-warning btn-icon"> <i class="fas fa-edit"></i> </button></a>
                                    <!-- Add delete button if you want to allow deletion -->
                                    <!-- Form for deleting using DELETE method -->
                                    <form action="{{ route('wisataKategori.destroy', $wisat->id) }}" method="POST" style="display: inline;">
                                        @csrf
                                        @method('DELETE')
                                        <button type="submit" class="btn btn-danger btn-icon" onclick="return confirm('Apakah anda yakin?')"> <i class="fas fa-trash-alt"></i> </button>
                                    </form>
                            </td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
                <br>
                <div class="d-flex pagination-l">
                    {{ $wisata->appends([
                    'wisata_page' => $wisata->currentPage(),
                    'searchWisata' => request('searchWisata'),
                    'searchPaket' => request('searchPaket'),
                    'paket_page' => $paket->currentPage(),
                    ])->links() }}


                </div>

                </div>
                @else
                    <p class="pt-2">Tidak ada data yang ditemukan.</p>
                @endif
            </div>
        </div>
        <hr>

        <div>
            <form action="{{ route('wisata.index') }}" method="get">
                <div class="col-md-2 ml-auto">
                {{-- <div class="col-md-10 offset-md-1"> --}}
                    <div class="form-group">
                        <div class="input-group input-group-sm">
                            <input type="search" name="searchPaket" class="form-control form-control-lg" placeholder="search..." value="{{ request('searchPaket') }}">
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

        <div class="card">

            <div class="card-header">
                <div class="d-flex justify-content-between align-items-center">
                <div>
                    <h2 class="card-title"><b>Paket Wisata</b></h2>
                </div>

                <div>
                    @cannot('view_all')
                    <a href="{{ route('wisata.create') }}">
                    @else
                    <a href="{{ route('wisata.create') }}">
                    @endcannot
                        <button type="button" class="btn btn-dark btn-block btn-rounded">
                            <i class="fas fa-plus-circle mr-2"></i>TAMBAH DATA
                        </button>
                    </a>
                </div>
                </div>
            </div>

            <div class="card-body pt-0 pb-0">
                @if (count($paket) > 0)
                <div class="table-responsive pt-3">
                <table class="table table-bordered mb-0 text-center">
                    <thead>
                        <tr>
                            <th style="width: 10px;">No.</th>
                            <th style="width: 10%;">Nama Paket</th>
                            <th style="width: 7%;">Harga</th>
                            <th style="width: 25%;">Daftar Wisata</th>
                            <th>Deskripsi</th>
                            <th style="width: 10%;">Gambar</th>
                            <th style="width: 200px;">Action</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($paket as $wisat)
                            <tr>
                                <td>{{ ($paket->currentPage() - 1) * $paket->perPage() + $loop->index + 1 }}</td>
                                <td>{{ $wisat->name }}</td>
                                <td>Rp{{ $wisat->price }}</td>

                                <td style="text-align: left">
                                @foreach ($wisat->wisata as $w)
                                    {{ $w->name }}
                                    @if (!$loop->last)
                                        -
                                    @endif
                                @endforeach
                                </td>

                                <td style="text-align: left">{{ $wisat->description }}</td>
                                <td class="text-center" style="max-width:50px;">
                                    @if($wisat->picture)
                                        <img src="{{ asset($wisat->picture) }}" alt="Picture" style="max-width:100%; max-height: 100px">
                                    @else
                                        Gambar Kosong
                                    @endif
                                </td>
                                <!-- Add other columns as needed -->
                                <td class="text-center align-middle">
                                        <a href="{{ route('wisata.show', $wisat->id) }}"> <button class="btn btn-primary btn-icon"> <i class="fas fa-eye"></i> </button></a>
                                        <a href="{{ route('wisata.edit', $wisat->id) }}"> <button class="btn btn-warning btn-icon"> <i class="fas fa-edit"></i> </button></a>
                                        <!-- Add delete button if you want to allow deletion -->
                                        <!-- Form for deleting using DELETE method -->
                                        <form action="{{ route('wisata.destroy',  $wisat->id) }}" method="POST" style="display: inline;">
                                            @csrf
                                            @method('DELETE')
                                            <button type="submit" class="btn btn-danger btn-icon" onclick="return confirm('Apakah anda yakin?')"> <i class="fas fa-trash-alt"></i> </button>
                                        </form>
                                </td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
                <br>
                <div class="d-flex pagination-l">
                    {{ $paket->appends([
                        'wisata_page' => $wisata->currentPage(),
                        'paket_page' => $paket->currentPage(),
                        'searchWisata' => request('searchWisata'),
                        'searchPaket' => request('searchPaket'),
                        ])->links() }}
                </div>

                </div>
                @else
                    <p class="pt-2">Tidak ada data yang ditemukan.</p>
                @endif
            </div>
        </div>
    </div>

@endsection
