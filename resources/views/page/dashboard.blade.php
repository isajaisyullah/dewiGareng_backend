@extends('layout.layout')

@section('title', 'Dashboard')

@section('content')
<div class="col-lg-12 grid-margin stretch-card">
    {{-- WELCOME TEXT --}}
    <div class="card text-center mb-3">
        <h1 class="card-header responsive-card-title" style="background-color: rgb(80, 202, 250)">
            Selamat Datang <b>{{ $adminUser->name }}</b>!
        </h1>
    </div>
    {{-- END-OF-WELCOME-TEXT --}}


    {{-- CONTENT WIDGET & ADMIN DATA --}}
    <div class="grid-margin stretch-card">
        <div class="d-flex flex-wrap justify-content-center" style=" gap: 12px;">

            {{-- widget --}}
            <div class="responsive-card-lg">
                <div class="row">
                    <div class="col-6">
                        <!-- small card -->
                        <div class="small-box bg-info">
                          <div class="inner ml-3">
                            @can('view_all')
                                <h3>{{ count($allProducts) }}</h3>
                            @else
                                <h3>{{ count($productUser) }}</h3>
                            @endcan

                            <p>Total Produk</p>
                          </div>
                          <div class="icon">
                            <i class="fas fa-boxes"></i>
                          </div>
                          @can('view_all')
                            <a href="{{ route('product.index') }}" class="small-box-footer">
                                Selengkapnya <i class="fas fa-arrow-circle-right"></i>
                            </a>
                          @else
                            <a href="{{ route('productUser.index') }}" class="small-box-footer">
                                Selengkapnya <i class="fas fa-arrow-circle-right"></i>
                            </a>
                          @endcan

                        </div>
                    </div>
                      <!-- ./col -->
                    <div class="col-6">
                        <!-- small card -->
                        <div class="small-box bg-success">
                          <div class="inner ml-3">
                            @can('view_all')
                                <h3>{{ count($allStores) }}</h3>
                            @else
                                <h3>{{ count($storeUser) }}</h3>
                            @endcan


                            <p>Total UMKM</p>
                          </div>
                          <div class="icon">
                            <i class="fas fa-store-alt"></i>
                          </div>
                          @can('view_all')
                            <a href="{{ route('store.index') }}" class="small-box-footer">
                                Selengkapnya <i class="fas fa-arrow-circle-right"></i>
                            </a>
                          @else
                            <a href="{{ route('storeUser.index') }}" class="small-box-footer">
                                Selengkapnya <i class="fas fa-arrow-circle-right"></i>
                            </a>
                          @endcan

                        </div>
                    </div>

                    @can('view_all')
                    <div class="col-6">
                        <!-- small card -->
                        <div class="small-box bg-warning">
                          <div class="inner ml-3">
                            <h3>{{ count($allUsers) }}</h3>

                            <p>Admin Terdaftar</p>
                          </div>
                          <div class="icon">
                            <i class="fas fa-user-plus"></i>
                          </div>
                          <a href="{{ route('profileAll.index') }}" class="small-box-footer">
                            Selengkapnya <i class="fas fa-arrow-circle-right"></i>
                          </a>
                        </div>
                    </div>
                      <!-- ./col -->
                    <div class="col-6">
                        <!-- small card -->
                        <div class="small-box bg-danger">
                          <div class="inner ml-3">
                            <h3>{{ count($allGaleri) }}</h3>

                            <p>Artikel</p>
                          </div>
                          <div class="icon">
                            <i class="fas fa-book-reader"></i>
                          </div>
                          <a href="{{ route('galeri.index') }}" class="small-box-footer">
                            Selengkapnya <i class="fas fa-arrow-circle-right"></i>
                          </a>
                        </div>
                    </div>
                    @endcan

                </div>
            </div>
            {{-- END-OF-WIDGET --}}

            {{-- table Admin--}}
            <div class="responsive-card-lg">
                <div class="card">
                    <div class="card-header text-center">
                        <div class="d-flex align-items-center mt-2 mb-2" style="height:30px">
                            <div class="text-center mx-auto">
                                <h2 class="card-title"><b>DATA ADMIN</b></h2>
                            </div>
                        </div>
                    </div>
                    <div class="card-body">
                        <div class="table-responsive text-center">
                            <table class="table table-bordered mt-2">
                                <thead>
                                    <tr>
                                        <th style="width: 33%">Nama</th>
                                        <th style="width: 33%">Email</th>
                                        <th style="width: 33%">Telepon</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <tr>
                                        <td>{{ $adminUser->name }}</td>
                                        <td>{{ $adminUser->email }}</td>
                                        <td>{{ $adminUser->phone }}</td>
                                    </tr>
                                </tbody>
                            </table>
                        </div>
                        <div class="mx-auto text-center mb-3 mt-3">
                            @can('view_all')
                            <a href="{{ route('profileAll.edit', $adminUser->id) }}">
                            @else
                            <a href="{{ route('profile.edit', $adminUser->id) }}">
                            @endcan
                                <button type="button" class="btn btn-block btn-outline-dark btn-rounded">
                                    <i class="fas fa-wrench mr-2"></i>Sunting
                                </button>
                            </a>
                        </div>
                    </div>
                </div>
            </div>
            {{-- END-OF-TABLE --}}

        </div>
    </div>
    {{-- END-OF-WIDGET-ADMIN --}}


    @can('view_all')
    {{-- ADMIN LIST TABLE --}}
    <div class="grid-margin stretch-card">
        <div class="card">
            <div class="card-header">
                <div class="d-flex justify-content-between align-items-center" style="height:30px">
                    <div>
                        <h2 class="card-title"><b>Admin Website</b></h2>
                    </div>
                    <div class="pagination-l mt-3">
                            {{-- {{ $users->links() }} <!-- This line adds the pagination links --> --}}
                            {{ $users->appends(['user_page' => $users->currentPage()])->links() }}
                    </div>
                </div>
            </div>
            <div class="card-body pb-0">
                @if (count($users) > 0)
                <div class="table-responsive">
                    <table class="table table-bordered">
                        <thead>
                            <tr>
                                <th style="width: 10px;">No.</th>
                                <th>Nama admin</th>
                                <th>Email</th>
                                <th style="width: 100px; text-align: center;">Action</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($users as $user)
                            <tr>
                                <td style="text-align: center;">{{ ($users->currentPage() - 1) * $users->perPage() + $loop->index + 1 }}</td>
                                <td>{{ $user->name }}</td>
                                <td>{{ $user->email }}</td>
                                <!-- Add other columns as needed -->
                                <td class="text-center">
                                    <a href="{{ route('profileAll.show', $user->id) }}" class="btn btn-sm btn-primary btn-rounded">
                                        <i class="fas fa-eye"></i>
                                    </a>
                                </td>
                            </tr>
                            @endforeach
                        </tbody>
                    </table>

                </div>
                @else
                <p>Tidak ada data yang ditemukan.</p>
                @endif
            </div>
        </div>
    </div>
    {{-- END-OF-ADMIN-LIST-TABLE --}}
    @endcan


</div>
@endsection
