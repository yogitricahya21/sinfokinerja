@extends('layouts.admin') @section('content')

    <div class="iq-navbar-header" style="height: 160px;">
        <div class="container-fluid iq-container">
            <div class="row">
                <div class="col-md-12">
                    <div class="flex-wrap d-flex justify-content-between align-items-center">
                        <div>
                            <h1>Kelola Kinerja</h1>
                            <p>Manajemen data Kinerja Satuan.</p>
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
    <div class="py-0 mt-0 container-fluid content-inner">
        <div class="row">
            <div class="col-md-12">
                <div class="card">
                    <div class="card-header d-flex justify-content-between">
                        <div class="header-title">
                            <h4 class="card-title">Manajemen Bukti Kinerja</h4>
                        </div>
                    </div>
                    <div class="card-body">

                        {{-- 1. KHUSUS ROLE PERSONEL: TAMPILKAN FORM INPUT --}}
                        @if (auth()->user()->role == 'personel')
                            <div class="mb-4">
                                <button type="button" class="btn btn-primary" data-bs-toggle="modal"
                                    data-bs-target="#modalTambahKinerja">
                                    <i class="fas fa-plus me-2"></i>Unggah Bukti Baru
                                </button>
                            </div>

                            <div class="modal fade" id="modalTambahKinerja" tabindex="-1"
                                aria-labelledby="exampleModalLabel" aria-hidden="true">
                                <div class="modal-dialog modal-lg">
                                    <div class="modal-content">
                                        <div class="modal-header">
                                            <h5 class="modal-title" id="exampleModalLabel">Unggah Bukti Kegiatan</h5>
                                            <button type="button" class="btn-close" data-bs-dismiss="modal"
                                                aria-label="Close"></button>
                                        </div>
                                        <form action="{{ route(auth()->user()->role . '.kinerja.store') }}" method="POST"
                                            enctype="multipart/form-data">
                                            @csrf
                                            <div class="row">
                                                <div class="mb-3 col-md-6">
                                                    <label class="form-label">Sub Satker / Subdis</label>
                                                    <select name="sub_satker_id" class="form-control" required>
                                                        <option value="">-- Pilih Sub Satker --</option>
                                                        @foreach ($subSatkers as $sub)
                                                            <option value="{{ $sub->id }}">{{ $sub->nama_subdis }}
                                                            </option>
                                                        @endforeach
                                                    </select>
                                                </div>

                                                <div class="mb-3 col-md-6">
                                                    <label class="form-label">Judul Kegiatan Utama</label>
                                                    <input type="text" name="judul_kegiatan" class="form-control"
                                                        placeholder="Contoh: Operasi Zebra 2026" required>
                                                </div>

                                                <div class="mb-3 col-md-6">
                                                    <label class="form-label">Tanggal Kegiatan</label>
                                                    <input type="date" name="tanggal_kegiatan" class="form-control"
                                                        value="{{ date('Y-m-d') }}" required>
                                                </div>
                                                <div class="mb-3 col-md-6">
                                                    <label class="form-label">Status Kegiatan</label>
                                                    <select name="status" class="form-control" required>
                                                        <option value="progres">Sedang Berjalan</option>
                                                        <option value="selesai">Selesai</option>
                                                        <option value="pending">Pending</option>
                                                    </select>
                                                </div>

                                                <div class="mb-3 col-md-12">
                                                    <label class="form-label">Deskripsi Detail Kegiatan</label>
                                                    <textarea name="deskripsi" class="form-control" rows="2" placeholder="Jelaskan detail kegiatan ini secara umum..."
                                                        required></textarea>
                                                </div>

                                                <hr>
                                                <div class="mb-3 col-md-6">
                                                    <label class="form-label">Foto Bukti (Maks 2MB)</label>
                                                    <input type="file" name="foto_kegiatan" class="form-control"
                                                        accept="image/*" required>
                                                </div>

                                                <div class="mb-3 col-md-6">
                                                    <label class="form-label">Anggota Kelompok</label>
                                                    <select name="anggota_ids[]" class="form-control select2-multiple"
                                                        multiple="multiple">
                                                        @foreach ($allPersonel as $p)
                                                            <option value="{{ $p->id }}">{{ $p->name }}</option>
                                                        @endforeach
                                                    </select>
                                                </div>

                                                <div class="mb-3 col-md-12">
                                                    <label class="form-label">Catatan Hasil/Status (Laporan Hari
                                                        Ini)</label>
                                                    <textarea name="catatan" class="form-control" rows="2" placeholder="Jelaskan apa hasil yang dicapai hari ini..."
                                                        required></textarea>
                                                </div>

                                                <div class="col-md-12">
                                                    <button type="submit" class="btn btn-primary w-100">Kirim Laporan &
                                                        Buat Kegiatan</button>
                                                </div>
                                            </div>
                                        </form>
                                    </div>
                                </div>
                            </div>
                        @endif

                        {{-- 2. TABEL MONITORING (ADMIN/KADIS LIHAT SEMUA, PERSONEL LIHAT MILIK SENDIRI) --}}
                        @if (auth()->user()->role != 'personel')
                            <div class="mt-4 table-responsive">
                                <h5>Riwayat Bukti Kinerja</h5>
                                <table class="table mt-3 table-striped">
                                    <thead>
                                        <tr>
                                            <th>No</th>
                                            <th>Nama Personel</th>
                                            <th>Satker / Sub Satker</th>
                                            <th>Kegiatan</th>
                                            <th>Tanggal</th>
                                            <th>Foto</th>
                                            <th>Catatan</th>
                                            <th>Status</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        @forelse($evidences as $index => $item)
                                            <tr>
                                                <td>{{ $index + 1 }}</td>
                                                <td>
                                                    <strong>{{ $item->user->name }}</strong>
                                                    <span class="badge rounded-pill bg-info text-dark"
                                                        style="font-size: 0.7rem;">Ketua</span>

                                                    @if ($item->users->count() > 1)
                                                        <div class="mt-1">
                                                            <small class="text-muted">
                                                                <i class="fas fa-users me-1"></i>Anggota:
                                                                @foreach ($item->users as $anggota)
                                                                    @if ($anggota->id !== $item->user_id)
                                                                        <span
                                                                            class="text-secondary">{{ $anggota->name }}</span>{{ !$loop->last ? ',' : '' }}
                                                                    @endif
                                                                @endforeach
                                                            </small>
                                                        </div>
                                                    @endif
                                                </td>

                                                <td>
                                                    <span
                                                        class="badge bg-primary">{{ $item->kegiatan->satker->nama_satker ?? '-' }}</span><br>
                                                    <small
                                                        class="text-muted">{{ $item->kegiatan->subSatker->nama_subdis ?? '-' }}</small>
                                                </td>
                                                <td>{{ $item->kegiatan->judul_kegiatan }}</td>
                                                <td>{{ $item->created_at->format('d M Y') }}</td>
                                                <td>
                                                    <a href="{{ asset('storage/' . $item->foto_kegiatan) }}"
                                                        target="_blank">
                                                        <img src="{{ asset('storage/' . $item->foto_kegiatan) }}"
                                                            width="50" class="rounded shadow-sm">
                                                    </a>
                                                </td>
                                                <td>{{ $item->catatan }}</td>
                                                <td> {{-- TAG TD JANGAN LUPA GES --}}
                                                    @if ($item->kegiatan->status == 'aktif')
                                                        <span class="badge bg-success">Berjalan</span>
                                                    @else
                                                        <span class="badge bg-secondary">Selesai</span>
                                                    @endif
                                                </td>
                                            </tr>
                                        @empty
                                            <tr>
                                                <td colspan="8" class="text-center text-muted">Belum ada bukti kinerja
                                                    yang
                                                    diunggah.</td>
                                            </tr>
                                        @endforelse
                                    </tbody>
                                </table>
                            </div>
                        @endif
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
@push('scripts')
    <link href="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/css/select2.min.css" rel="stylesheet" />
    <script src="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/js/select2.min.js"></script>

    <style>
        /* Biar Select2 tampil ganteng di tema Hope UI */
        .select2-container--default .select2-selection--multiple {
            border: 1px solid #eee;
            border-radius: 0.5rem;
            padding: 5px;
        }

        .select2-container .select2-selection--multiple .select2-selection__choice {
            background-color: #3a57e8;
            border: none;
            color: white;
            border-radius: 4px;
            padding: 2px 10px;
        }

        .select2-container .select2-selection--multiple .select2-selection__choice__remove {
            color: white;
            margin-right: 5px;
        }
    </style>

    <script>
        $(document).ready(function() {
            // Inisialisasi Select2 pada class .select2-multiple
            $('.select2-multiple').select2({
                placeholder: "  Cari nama personel...",
                allowClear: true,
                width: '100%',
                dropdownParent: $('#modalTambahKinerja') // Ganti ID ini sesuai ID Modal kamu gess!
            });
        });
    </script>
@endpush
