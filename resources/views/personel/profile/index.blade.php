@extends('layouts.admin')

@section('content')
    <div class="iq-navbar-header" style="height: 160px;">
        <div class="container-fluid iq-container">
            <div class="row">
                <div class="col-md-12">
                    <div class="flex-wrap text-white d-flex justify-content-between align-items-center">
                        <div>
                            <h1>Profil Saya</h1>
                            <p>Lengkapi data diri, pangkat, dan jabatan kamu di sini gess.</p>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="iq-header-img">
            <img src="{{ asset('template/') }}/assets/images/dashboard/top-header.png" alt="header"
                class="theme-color-default-img img-fluid w-100 h-100 animated-scaleX">
        </div>
    </div>

    <div class="container-fluid content-inner mt-n5">
        <div class="row">
            <div class="col-lg-4">
                <div class="card">
                    <div class="card-body">
                        <div class="text-center">
                            <div class="user-profile">
                                @if ($user->profile && $user->profile->foto_personel)
                                    <img src="{{ asset('storage/foto_personel/' . $user->profile->foto_personel) }}"
                                        alt="User-Profile"
                                        class="theme-color-default-img img-fluid rounded-pill avatar-130">
                                @else
                                    <img src="{{ asset('template/assets/images/avatars/01.png') }}" alt="User-Profile"
                                        class="theme-color-default-img img-fluid rounded-pill avatar-130">
                                @endif
                            </div>
                            <div class="mt-3">
                                <h3 class="d-inline-block">{{ $user->name }}</h3>
                                <p class="text-muted">{{ $user->profile->pangkat ?? '-' }} |
                                    {{ $user->profile->nip_nrp ?? 'NIP/NRP Belum Diisi' }}</p>
                                <p class="mb-0 text-primary">{{ strtoupper($user->role) }}</p>
                            </div>
                        </div>
                        <hr>
                        <div class="mt-2">
                            <h6 class="mb-1">Penempatan :</h6>
                            <p class="text-muted">{{ $user->subSatker->satker->nama_satker ?? '-' }}</p>
                            <h6 class="mb-1">Sub Bagian :</h6>
                            <p class="text-muted">{{ $user->subSatker->nama_subdis ?? '-' }}</p>
                            <h6 class="mb-1">Jabatan :</h6>
                            <p class="text-muted">{{ $user->profile->jabatan ?? '-' }}</p>
                        </div>
                    </div>
                </div>
            </div>

            <div class="col-lg-8">
                <div class="card">
                    <div class="card-header d-flex justify-content-between">
                        <div class="header-title">
                            <h4 class="card-title">Edit Biodata Personel</h4>
                        </div>
                    </div>
                    <div class="card-body">
                        <form action="{{ route('profile.update') }}" method="POST" enctype="multipart/form-data">
                            @csrf
                            @method('PUT')

                            <div class="row">
                                <h5 class="mb-3">Informasi Akun</h5>
                                <div class="mb-3 form-group col-md-6">
                                    <label class="form-label">Nama Lengkap</label>
                                    <input type="text" name="name" class="form-control" value="{{ $user->name }}"
                                        required>
                                </div>
                                <div class="mb-3 form-group col-md-6">
                                    <label class="form-label">Email</label>
                                    <input type="email" name="email" class="form-control" value="{{ $user->email }}"
                                        required>
                                </div>

                                <hr class="my-4">
                                <h5 class="mb-3">Biodata Personel</h5>

                                <div class="mb-3 form-group col-md-6">
                                    <label class="form-label">NIP / NRP</label>
                                    <input type="text" name="nip_nrp" class="form-control"
                                        value="{{ $user->profile->nip_nrp ?? '' }}">
                                </div>
                                <div class="mb-3 form-group col-md-6">
                                    <label class="form-label">Pangkat</label>
                                    <input type="text" name="pangkat" class="form-control"
                                        value="{{ $user->profile->pangkat ?? '' }}">
                                </div>
                                <div class="mb-3 form-group col-md-6">
                                    <label class="form-label">Jabatan di Unit</label>
                                    <input type="text" name="jabatan" class="form-control"
                                        value="{{ $user->profile->jabatan ?? '' }}">
                                </div>
                                <div class="mb-3 form-group col-md-6">
                                    <label class="form-label">No. HP (WhatsApp)</label>
                                    <input type="text" name="no_hp" class="form-control"
                                        value="{{ $user->profile->no_hp ?? '' }}">
                                </div>
                                <div class="mb-3 form-group col-md-12">
                                    <label class="form-label">Alamat Lengkap</label>
                                    <textarea name="alamat" class="form-control" rows="3">{{ $user->profile->alamat ?? '' }}</textarea>
                                </div>
                                <div class="mb-3 form-group col-md-12">
                                    <label class="form-label">Upload Foto Profil (Format: JPG/PNG, Max 2MB)</label>
                                    <input type="file" name="foto_personel" class="form-control">
                                </div>
                            </div>

                            <div class="mt-3">
                                <button type="submit" class="btn btn-primary">Simpan Perubahan</button>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
