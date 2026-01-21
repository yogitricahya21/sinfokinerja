@extends('layouts.admin')

@section('content')
    <div class="iq-navbar-header" style="height: 160px;">
        <div class="container-fluid iq-container">
            <div class="row">
                <div class="col-md-12">
                    <div class="flex-wrap d-flex justify-content-between align-items-center">
                        <div>
                            <h1>Manajemen Personel</h1>
                            <p>Kelola data personel, akun login, dan penempatan unit kerja gess.</p>
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
    <div class="mt-5 container-fluid content-inner">
        <div class="row justify-content-center">
            <div class="col-lg-8">
                <div class="card">
                    <div class="card-header">
                        <h4>Pengaturan Keamanan Akun</h4>
                    </div>
                    <div class="card-body">
                        <form action="{{ route('admin.settings.privacy.update') }}" method="POST">
                            @csrf
                            @method('PUT')

                            <h5>Ganti Email</h5>
                            <div class="mb-3">
                                <label class="form-label">Email Aktif</label>
                                <input type="email" name="email" class="form-control" value="{{ $user->email }}">
                            </div>

                            <hr class="my-4">
                            <h5>Ganti Password</h5>
                            <p class="text-muted small">Kosongkan jika tidak ingin mengganti password.</p>

                            <div class="mb-3">
                                <label class="form-label">Password Lama</label>
                                <input type="password" name="current_password" class="form-control">
                            </div>
                            <div class="mb-3">
                                <label class="form-label">Password Baru</label>
                                <input type="password" name="new_password" class="form-control">
                            </div>
                            <div class="mb-3">
                                <label class="form-label">Konfirmasi Password Baru</label>
                                <input type="password" name="new_password_confirmation" class="form-control">
                            </div>

                            <button type="submit" class="btn btn-primary">Update Akun</button>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
