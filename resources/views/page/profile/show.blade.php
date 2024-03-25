@extends('layout.layout')

@section('title', 'Profile Admin | DewiGareng')
@section('page', 'Profile Page')
@section('link', route('dashboard.index'))
@section('route', 'Home')
@section('name', 'profile')

@section('content')
    <div class="card card-solid col-12 col-md-7 mx-auto">
        <div class="card-body pb-1">
            <div class="card bg-light d-flex flex-fill">
                <div class="card-header text-muted border-bottom-1 pb-1">
                    Administrator
                </div>
                <div class="card-body pt-2">
                    <div class="col-12 col-md-5 mx-auto text-center">
                        <img src="{{ asset('dist/img/user1.png') }}" alt="user-avatar" class="img-circle img-fluid mx-auto" height="150" width="150">
                    </div>

                    <div class="col-12 col-md-7 mt-3 mx-auto text-center">
                        <h2 class="lead"><b>{{ $user->name }}</b></h2>
                        <ul class="list-unstyled text-muted">
                            <li class="small">Email: {{ $user->email }}</li>
                            <li class="small">Telepon: {{ $user->phone }}</li>
                        </ul>
                    </div>
                </div>
                <div class="card-footer">
                    <div class="d-flex justify-content-between align-items-center">
                        <div>
                            <a href="{{ route('dashboard.index') }}">
                                <button type="button" class="btn btn-outline-dark btn-roundedbtn">
                                    <i class="fas fa-arrow-alt-circle-left mr-2"></i>Beranda
                                </button>
                            </a>
                        </div>

                        <div>
                            @can('view_all')
                                <a href="{{ route('profileAll.edit', $user->id) }}" class="btn btn-roundedbtn btn-primary">
                                    <i class="fas fa-user mr-2"></i> Sunting Profil
                                </a>
                            @else
                                <a href="{{ route('profile.edit', $user->id) }}" class="btn btn-roundedbtn btn-primary">
                                    <i class="fas fa-user mr-2"></i> Sunting Profil
                                </a>
                            @endcan
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <div class="col-12 grid-margin stretch-card">
        <div class="card">

            <div class="card-header">
                <div class="d-flex justify-content-between align-items-center">
                    <div>
                        <h2 class="card-title"><b>Data UMKM admin</b></h2>
                    </div>

                    {{-- <div>
                        @cannot('view_all')
                        <a href="{{ route('storeUser.create') }}">
                        @else
                        <a href="{{ route('store.create') }}">
                        @endcannot
                            <button type="button" class="btn btn-dark btn-block btn-rounded">
                                <i class="fas fa-plus-circle mr-2"></i>ADD DATA
                            </button>
                        </a>
                    </div> --}}
                </div>
            </div>

            <div class="card-body">
                @if (count($store) > 0)
                    <div class="table-responsive pt-3">
                        <table class="table table-bordered">
                            <thead>
                                <tr>
                                    <th style="width: 10px;">No.</th>
                                    <th>Nama Toko</th>
                                    <th>Alamat Toko</th>
                                    <th>Deskripsi Toko</th>
                                    <th style="max-width: 300px;">Logo Toko</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach ($store as $toko)
                                    <tr>
                                        <td style="text-align: center;">{{ ($store->currentPage() - 1) * $store->perPage() + $loop->index + 1 }}</td>
                                        <td>{{ $toko->name }}</td>
                                        <td>{{ $toko->address }}</td>
                                        <td>{{ $toko->description }}</td>
                                        <td class="text-center">
                                            @if($toko->logo)
                                                <img src="{{ asset($toko->logo) }}" alt="Logo" style="max-height:70px">
                                            @else
                                                Logo Kosong
                                            @endif
                                        </td>
                                    </tr>
                                @endforeach
                            </tbody>
                        </table>
                        <br>
                        <div class="d-flex justify-content-center">
                            {{ $store->links() }} <!-- This line adds the pagination links -->
                        </div>
                    </div>
                @else
                    <p>Tidak ada data yang ditemukan.</p>
                @endif
            </div>
        </div>
    </div>
@endsection
