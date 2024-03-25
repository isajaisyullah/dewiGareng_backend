@extends('layout.layout')

@section('title', 'Profile Admin | DewiGareng')
@section('page', 'Profile Page')
@section('link', route('dashboard.index'))
@section('link', route('dashboard.index'))
@section('route', 'Home')
@section('name', 'profile')

@section('content')
    <div class="card card-solid col-12 col-md-7 mx-auto">
        <div class="card-body pb-1">
            <div class="card bg-light d-flex flex-fill">
                <div class="card-header text-muted border-bottom-1 pb-1">
                    @if ($user->name == 'Superadmin') {{-- Fix the condition --}}
                        Super Administrator
                    @else
                        Regular Administrator
                    @endif
                </div>
                <div class="card-body pt-2">
                    <div class="col-12 col-md-5 mx-auto text-center">
                        <img src="{{ asset('dist/img/user1.png') }}" alt="user-avatar" class="img-circle img-fluid mx-auto" height="150" width="150">
                    </div>

                    <div class="col-12 col-md-7 mt-3 mx-auto text-center">
                        <h2 class="lead"><b>{{ $user->nama }}</b></h2>
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

    @can('view_all')
        <hr>

        <div class="card card-solid">
            <div class="card-body pb-0">
                <div class="row">
                    @foreach ($users as $user)
                        @if($loop->index >= 1)
                            <div class="col-12 col-sm-6 col-md-4 d-flex align-items-stretch flex-column">
                                <a href="{{ route('profileAll.show', $user->id) }}">
                                    <div class="card bg-light d-flex flex-fill">
                                        <div class="card-header text-muted border-bottom-1 pb-1">
                                            Administrator
                                        </div>
                                        <div class="card-body pt-2">
                                            <div class="row">
                                                <div class="col-7">
                                                    <h2 class="lead"><b>{{ $user->name }}</b></h2>
                                                    <ul class="mt-3 mb-0 fa-ul text-muted">
                                                        <li class="small mb-2"><span class="fa-li mb"><i class="mr-2 fas fa-envelope"></i></span>Email: {{ $user->email }}</li>
                                                        <li class="small"><span class="fa-li"><i class="mr-2 fas fa-phone-square"></i></span>Phone #: {{ $user->phone }}</li>
                                                    </ul>
                                                </div>
                                                <div class="col-5 text-center">
                                                    <img src="{{ asset('dist/img/user1.png') }}" alt="user-avatar" class="img-circle img-fluid" height="100" width="100">
                                                </div>
                                            </div>
                                        </div>
                                        <div class="card-footer">
                                            <div class="text-right">
                                                <a href="{{ route('profileAll.edit', $user->id) }}" class="btn btn-sm btn-outline-dark btn-roundedbtn">
                                                    <i class="fas fa-edit mt-1"></i>
                                                </a>
                                            </div>
                                        </div>
                                    </div>
                                </a>
                            </div>
                        @endif
                    @endforeach
                </div>
            </div>
        </div>
    @endcan

@endsection
