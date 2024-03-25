@extends('layout.layout')

@section('title', 'UMKM Data | DewiGareng')
@section('page', 'UMKM Page')

@can('view_all')
    @section('link', route('store.index'))
@else
    @section('link', route('storeUser.index'))
@endcan

@section('route', 'Store')
@section('name', 'index')

@section('content')
    <div class="col-lg-12 grid-margin stretch-card">
        <div>
            @can('view_all')
                <form action="{{ route('store.index') }}" method="get">
            @else
                <form action="{{ route('storeUser.index') }}" method="get">
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

        <div class="card">

            <div class="card-header">
                <div class="d-flex justify-content-between align-items-center">
                <div>
                    <h2 class="card-title"><b>UMKM (Toko)</b></h2>
                </div>

                <div>
                    @cannot('view_all')
                    <a href="{{ route('storeUser.create') }}">
                    @else
                    <a href="{{ route('store.create') }}">
                    @endcannot
                        <button type="button" class="btn btn-dark btn-block btn-rounded">
                            <i class="fas fa-plus-circle mr-2"></i>TAMBAH DATA
                        </button>
                    </a>
                </div>
                </div>
            </div>

            <div class="card-body pb-0 pt-0">
                @if (count($store) > 0)
                <div class="table-responsive pt-3">
                <table class="table table-bordered mt-0 mb-0">
                    <thead>
                        <tr>
                            <th style="width: 10px;">No.</th>
                            <th>Nama Toko</th>
                            @can('view_all')
                                <th>Admin Toko</th>
                            @endcan
                            <th>Alamat</th>
                            <th>Deskripsi</th>
                            <th style="width: 10%;">Logo</th>
                            <th style="width: 200px; text-align: center;">Action</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($store as $toko)
                            <tr>
                                <td style="text-align: center;">{{ ($store->currentPage() - 1) * $store->perPage() + $loop->index + 1 }}</td>
                                <td>{{ $toko->name }}</td>
                                @can('view_all')
                                    <td>{{ $toko->user->name }}</td>
                                @endcan
                                <td>{{ $toko->address }}</td>
                                <td>{{ $toko->description }}</td>
                                <td class="text-center" style="max-width: 100px;">
                                    @if($toko->logo)
                                        <img src="{{ asset($toko->logo) }}" alt="Logo" style="max-width:100%; max-height: 120px">
                                    @else
                                        Logo Kosong
                                    @endif
                                </td>
                                <!-- Add other columns as needed -->
                                <td class="text-center align-middle">
                                    @cannot('view_all')
                                        <a href="{{ route('storeUser.show', $toko->id) }}"> <button class="btn btn-info btn-icon"> <i class="fas fa-eye"></i> </button></a>
                                        <a href="{{ route('storeUser.edit', $toko->id) }}"> <button class="btn btn-warning btn-icon"> <i class="fas fa-edit"></i> </button></a>
                                        <!-- Add delete button if you want to allow deletion -->
                                        <!-- Form for deleting using DELETE method -->
                                        <form action="{{ route('storeUser.destroy', $toko->id) }}" method="POST" style="display: inline;">
                                            @csrf
                                            @method('DELETE')
                                            <button type="submit" class="btn btn-danger btn-icon" onclick="return confirm('Apakah anda yakin?')"><i class="fas fa-trash-alt"></i> </button>
                                        </form>
                                    @else
                                        <a href="{{ route('store.show', $toko->id) }}"> <button class="btn btn-primary btn-icon"> <i class="fas fa-eye"></i> </button></a>
                                        <a href="{{ route('store.edit', $toko->id) }}"> <button class="btn btn-warning btn-icon"> <i class="fas fa-edit"></i> </button></a>
                                        <!-- Add delete button if you want to allow deletion -->
                                        <!-- Form for deleting using DELETE method -->
                                        <form action="{{ route('store.destroy', $toko->id) }}" method="POST" style="display: inline;">
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
                <div class="d-flex pagination-l">
                    {{-- <div class="card-footer clearfix"> --}}
                    {{ $store->links() }} <!-- This line adds the pagination links -->
                </div>

                </div>
                @else
                    <p class="pt-2">Tidak ada data yang ditemukan.</p>
                @endif
            </div>
        </div>
    </div>

@endsection
