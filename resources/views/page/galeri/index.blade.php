@extends('layout.layout')

@section('title', 'Galeri Data | DewiGareng')
@section('page', 'Galeri Page')
@section('link', route('galeri.index'))
@section('route', 'Galeri')
@section('name', 'index')


@section('content')
    <div class="col-lg-12 grid-margin stretch-card">
        <div>
            <form action="{{ route('galeri.index') }}" method="get">
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
                    <h2 class="card-title"><b>TABEL GALERI</b></h2>
                </div>

                <div>
                    <a href="{{ route('galeri.create') }}">
                        <button type="button" class="btn btn-dark btn-block btn-rounded">
                            <i class="fas fa-plus-circle mr-2"></i>TAMBAH DATA
                        </button>
                    </a>
                </div>
                </div>
            </div>

            <div class="card-body pb-0 pt-0">
                @if (count($galeri) > 0)
                <div class="table-responsive pt-3">
                <table class="table table-bordered mt-0 mb-0">
                    <thead>
                        <tr>
                            <th style="width: 10px;">No.</th>
                            <th>Judul artikel</th>
                            <th>Deskripsi artikel</th>
                            <th style="width: 10%;">Gambar artikel</th>
                            <th style="width: 200px; text-align: center;">Actions</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($galeri as $artikel)
                            <tr>
                                <td style="text-align: center;">{{ ($galeri->currentPage() - 1) * $galeri->perPage() + $loop->index + 1 }}</td>
                                <td>{{ $artikel->title }}</td>
                                <td>
                                    <div style="max-height: 150px; overflow: hidden;">
                                        {!! $artikel->description !!}
                                    </div>
                                </td>
                                <td class="text-center" style="max-width: 100px;">
                                    @if($artikel->picture)
                                        <img src="{{ asset($artikel->picture) }}" alt="picture"style="max-width:100%; max-height: 120px">
                                    @else
                                        Gambar Kosong
                                    @endif
                                </td>
                                <!-- Add other columns as needed -->
                                <td class="text-center align-middle">
                                    @cannot('view_all')
                                        <a href="{{ route('storeUser.show', $artikel->id) }}"> <button class="btn btn-info btn-icon"> <i class="fas fa-eye"></i> </button></a>
                                        <a href="{{ route('storeUser.edit', $artikel->id) }}"> <button class="btn btn-warning btn-icon"> <i class="fas fa-edit"></i> </button></a>
                                        <!-- Add delete button if you want to allow deletion -->
                                        <!-- Form for deleting using DELETE method -->
                                        <form action="{{ route('storeUser.destroy', $artikel->id) }}" method="POST" style="display: inline;">
                                            @csrf
                                            @method('DELETE')
                                            <button type="submit" class="btn btn-danger btn-icon" onclick="return confirm('Apakah anda yakin?')"><i class="fas fa-trash-alt"></i> </button>
                                        </form>
                                    @else
                                        <a href="{{ route('galeri.show', $artikel->id) }}"> <button class="btn btn-primary btn-icon"> <i class="fas fa-eye"></i> </button></a>
                                        <a href="{{ route('galeri.edit', $artikel->id) }}"> <button class="btn btn-warning btn-icon"> <i class="fas fa-edit"></i> </button></a>
                                        <!-- Add delete button if you want to allow deletion -->
                                        <!-- Form for deleting using DELETE method -->
                                        <form action="{{ route('galeri.destroy', $artikel->id) }}" method="POST" style="display: inline;">
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
                    {{ $galeri->links() }} <!-- This line adds the pagination links -->
                </div>

                </div>
                @else
                    <p class="pt-2">Tidak ada data yang ditemukan.</p>
                @endif
            </div>
        </div>
    </div>

@endsection
