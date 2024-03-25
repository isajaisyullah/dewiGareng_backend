@extends('layout.layout')

@section('title', 'UMKM Show | DewiGareng')
@section('page', 'UMKM Page')
@can('view_all')
    @section('link', route('store.index'))
@else
    @section('link', route('storeUser.index'))
@endcan
@section('route', 'Store')
@section('name', 'edit')

@section('AdditionalLink')
<!-- Select2 -->
<link rel="stylesheet" href="{{ asset('plugins/select2/css/select2.min.css') }}">
<link rel="stylesheet" href="{{ asset('plugins/select2-bootstrap4-theme/select2-bootstrap4.min.css') }}">
@endsection

@section('content')
    <div class="card card-default mx-auto mt-3" style="width: 90%;">

        <div class="card-header">
            <div class="d-flex justify-content-between align-items-center">
                <div>
                    <h1 class="card-title"><b>Sunting data UMKM</b></h1>
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
                    <input type="text" class="form-control" id="name" name="name" placeholder="Masukan Nama Toko Anda" value="{{ old('name', $store->name) }}" required>
                </div>

                <div class="form-group">
                    <label for="address" class="form-label">Alamat Toko</label>
                    <input type="text" class="form-control" id="address" name="address" placeholder="Masukan Alamat Toko Anda" value="{{ old('address', $store->address) }}" required>
                </div>

                <div class="form-group">
                    <label class="form-label">Deskripsi Toko</label>
                    <textarea class="form-control" rows="3" id="description" name="description" placeholder="Masukan Deskripsi Toko Anda" required>{{ old('description', $store->description) }}</textarea>
                </div>

                <div class="form-group">
                    <label for="logo"class="form-label">Logo Toko</label>
                    <div class="input-group">
                        <div class="custom-file">
                          <input type="file" class="custom-file-input" id="logo" name="logo" onchange="previewImage()">
                          <label class="custom-file-label" for="exampleInputFile">Pilih file</label>
                        </div>
                      </div>
                    <div class="mt-2">
                        @if($store->logo)
                            <img id="imagePreview" src="{{ asset($store->logo) }}" alt="Logo Preview" class="img-thumbnail" style=" max-height:250px;">
                        @else
                            <div class="text-muted" id="prevImage">Logo Kosong</div>
                            <img id="imagePreview" src="#" alt="picture Preview" class="img-thumbnail" style="display: none; max-height:250px;">
                        @endif
                    </div>
                </div>

                <div class="form-group">
                    <label>Admin Toko</label>
                    @can('view_all')
                    <select class="form-control select2bs4" style="width: 100%;" id="users_id" name="users_id" required>
                        <option value="" disabled selected>Pilih salah satu</option>
                        @foreach($users as $user)
                            <option value="{{ $user->id }}" {{ (old('users_id') == $user->id || $store->users_id == $user->id) ? 'selected' : '' }}>
                                {{ $user->name }}
                            </option>
                        @endforeach
                      </select>
                    @else
                        <select class="form-control select2bs4" style="width: 100%;" id="users_id" name="users_id" required disabled>
                            <option value="{{ $user->id }}" selected>{{ $user->name }}</option>
                        </select>
                        <input type="hidden" name="users_id" value="{{ $user->id }}">
                    @endcan
                </div>

        </div>
        <div class="card-footer">
            <button type="submit" class="btn btn-primary btn-lg">Simpan</button>
        </form>
        </div>
    </div>
@endsection

@section('AdditionalScript')
<!-- Select2 -->
<script src="{{ asset('plugins/select2/js/select2.full.min.js') }}"></script>

<script>
    $(function () {
        // Initialize Select2 Elements with Bootstrap 4 theme
        $('.select2bs4').select2({
            theme: 'bootstrap4'
        });
    });

    function previewImage() {
        var input = document.getElementById('logo');
        var preview = document.getElementById('imagePreview');
        var prevImage = document.getElementById('prevImage');

        var file = input.files[0];
        var reader = new FileReader();

        reader.onloadend = function () {
            preview.src = reader.result;
            preview.style.display = 'block';
            prevImage.style.display = 'none';
        };

        if (file) {
            reader.readAsDataURL(file);
        } else {
            preview.src = '';
            preview.style.display = 'none';
        }
    }
</script>
@endsection
