@extends('layouts.admin')

@section('content')
    <div class="iq-navbar-header" style="height: 160px;">
        <div class="container-fluid iq-container">
            <div class="row">
                <div class="col-md-12">
                    <div class="flex-wrap d-flex justify-content-between align-items-center">
                        <div>
                            <h1>Kelola Satker</h1>
                            <p>Manajemen data Satuan Kerja organisasi Anda.</p>
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
            <div class="col-sm-12">
                <div class="card">
                    <div class="card-header d-flex justify-content-between">
                        <div class="header-title">
                            <h4 class="card-title">Daftar Satuan Kerja</h4>
                        </div>
                        <div>
                            <button type="button" class="btn btn-primary" data-bs-toggle="modal"
                                data-bs-target="#modalTambahSatker">
                                Tambah Satker
                            </button>
                        </div>
                    </div>
                    <div class="card-body">
                        <p>Berikut adalah daftar seluruh satuan kerja yang terdaftar dalam sistem.</p>
                        <div class="table-responsive">
                            <table id="datatable" class="table table-striped" data-toggle="data-table">
                                <thead>
                                    <tr>
                                        <th>No</th>
                                        <th>Nama Satker</th>
                                        <th>Kode Satker</th>
                                        <th>Aksi</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach ($satkers as $key => $item)
                                        <tr>
                                            <td>{{ $key + 1 }}</td>
                                            <td>{{ $item->nama_satker }}</td>
                                            <td>{{ $item->kode_satker }}</td>
                                            <td>
                                                <div class="flex align-items-center list-user-action">
                                                    <button type="button" class="btn btn-sm btn-icon btn-warning"
                                                        onclick="openEditModal({{ $item->id }}, '{{ $item->nama_satker }}', '{{ $item->kode_satker }}')"
                                                        data-bs-toggle="tooltip" title="Edit">
                                                        <span class="btn-inner">
                                                            <svg class="icon-20" width="20" viewBox="0 0 24 24"
                                                                fill="none" xmlns="http://www.w3.org/2000/svg">
                                                                <path opacity="0.4"
                                                                    d="M19.9927 18.9534H14.2984C13.7429 18.9534 13.291 19.4124 13.291 19.9767C13.291 20.5422 13.7429 21.0001 14.2984 21.0001H19.9927C20.5483 21.0001 21.0001 20.5422 21.0001 19.9767C21.0001 19.4124 20.5483 18.9534 19.9927 18.9534Z"
                                                                    fill="currentColor"></path>
                                                                <path
                                                                    d="M10.309 6.90385L15.7049 11.2639C15.835 11.3682 15.8573 11.5596 15.7557 11.6929L9.35874 20.0282C8.95662 20.5431 8.36402 20.8344 7.72908 20.8452L4.23696 20.8882C4.05071 20.8903 3.88775 20.7613 3.84542 20.5764L3.05175 17.1258C2.91419 16.4915 3.05175 15.8358 3.45388 15.3306L9.88256 6.95545C9.98627 6.82108 10.1778 6.79743 10.309 6.90385Z"
                                                                    fill="currentColor"></path>
                                                                <path opacity="0.4"
                                                                    d="M18.1208 8.66544L17.0806 9.96401C16.9758 10.0962 16.7874 10.1177 16.6573 10.0124C15.3927 8.98901 12.1545 6.36285 11.2561 5.63509C11.1249 5.52759 11.1069 5.33625 11.2127 5.20295L12.2159 3.95706C13.126 2.78534 14.7133 2.67784 15.9938 3.69906L17.4647 4.87078C18.0679 5.34377 18.47 5.96726 18.6076 6.62299C18.7663 7.3443 18.597 8.0527 18.1208 8.66544Z"
                                                                    fill="currentColor"></path>
                                                            </svg>
                                                        </span>
                                                    </button>
                                                    <button type="button" class="btn btn-sm btn-icon btn-danger"
                                                        onclick="confirmDelete('{{ $item->id }}', '{{ $item->nama_satker }}')"
                                                        data-bs-toggle="tooltip" title="Delete">
                                                        <span class="btn-inner">
                                                            <svg class="icon-20" width="20" viewBox="0 0 24 24"
                                                                fill="none" xmlns="http://www.w3.org/2000/svg">
                                                                <path opacity="0.4"
                                                                    d="M19.643 9.48851C19.643 9.5565 19.11 16.2973 18.8056 19.1342C18.615 20.8751 17.4927 21.9311 15.8092 21.9611C14.5157 21.9901 13.2494 22.0001 12.0036 22.0001C10.6809 22.0001 9.38741 21.9901 8.13185 21.9611C6.50477 21.9221 5.38147 20.8451 5.20057 19.1342C4.88741 16.2873 4.36418 9.5565 4.35445 9.48851C4.34473 9.28351 4.41086 9.08852 4.54507 8.93053C4.67734 8.78453 4.86796 8.69653 5.06831 8.69653H18.9388C19.1382 8.69653 19.3191 8.78453 19.4621 8.93053C19.5953 9.08852 19.6624 9.28351 19.643 9.48851Z"
                                                                    fill="currentColor"></path>
                                                                <path
                                                                    d="M21 5.97686C21 5.56588 20.6761 5.24389 20.2871 5.24389H17.3714C16.7781 5.24389 16.2627 4.8219 16.1304 4.22692L15.967 3.49795C15.7385 2.61698 14.9498 2 14.0647 2H9.93624C9.0415 2 8.26054 2.61698 8.02323 3.54595L7.87054 4.22792C7.7373 4.8219 7.22185 5.24389 6.62957 5.24389H3.71385C3.32386 5.24389 3 5.56588 3 5.97686V6.35685C3 6.75783 3.32386 7.08982 3.71385 7.08982H20.2871C20.6761 7.08982 21 6.75783 21 6.35685V5.97686Z"
                                                                    fill="currentColor"></path>
                                                            </svg>
                                                        </span>
                                                    </button>

                                                    <form id="delete-form-{{ $item->id }}"
                                                        action="{{ route('admin.satker.destroy', $item->id) }}"
                                                        method="POST" style="display: none;">
                                                        @csrf
                                                        @method('DELETE')
                                                    </form>
                                                </div>
                                            </td>
                                        </tr>
                                    @endforeach
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <div class="modal fade" id="modalTambahSatker" tabindex="-1" aria-hidden="true">
        <div class="modal-dialog">
            <form action="{{ route('admin.satker.store') }}" method="POST" class="modal-content">
                @csrf
                <div class="modal-header">
                    <h5 class="modal-title">Tambah Satuan Kerja Baru</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <div class="form-group">
                        <label class="form-label">Nama Satuan Kerja</label>
                        <input type="text" name="nama_satker" class="form-control" required
                            placeholder="Contoh: Biro SDM">
                    </div>
                    <div class="form-group">
                        <label class="form-label">Kode Satker</label>
                        <input type="text" name="kode_satker" class="form-control" required
                            placeholder="Contoh: B-SDM-01">
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Batal</button>
                    <button type="submit" class="btn btn-primary">Simpan</button>
                </div>
            </form>
        </div>
    </div>

    <div class="modal fade" id="satkerEditModal" tabindex="-1" aria-labelledby="satkerModalLabel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="satkerModalLabel">Edit Satker</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <form id="satkerForm" method="POST">
                    @csrf
                    <div id="methodField"></div>
                    <div class="modal-body">
                        <div class="form-group">
                            <label class="form-label">Nama Satker</label>
                            <input type="text" name="nama_satker" id="nama_satker" class="form-control" required>
                        </div>
                        <div class="mt-3 form-group">
                            <label class="form-label">Kode Satker</label>
                            <input type="text" name="kode_satker" id="kode_satker" class="form-control" required>
                        </div>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Batal</button>
                        <button type="submit" class="btn btn-primary">Simpan</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
@endsection
<script>
        function openEditModal(id, nama, kode) {
            // Ambil element form
            const form = document.getElementById('satkerForm');

            // Update URL form action secara dinamis
            // Mengarahkan ke route update (admin/satker/{id})
            form.action = '/admin/satker/' + id;

            // Isi field input di dalam modal
            document.getElementById('nama_satker').value = nama;
            document.getElementById('kode_satker').value = kode;

            // Tambahkan method PUT untuk Laravel di div methodField
            document.getElementById('methodField').innerHTML = '@method('PUT')';

            const Toast = Swal.mixin({
                toast: true,
                position: 'top-end',
                showConfirmButton: false,
                timer: 1000,
            });
            Toast.fire({
                icon: 'info',
                title: 'Menyiapkan data edit...'
            });

            // Munculkan modal (menggunakan ID modal yang sudah Anda buat)
            var myModal = new bootstrap.Modal(document.getElementById('satkerEditModal'));
            myModal.show();
        }

        function confirmDelete(id, nama) {
            Swal.fire({
                title: 'Hapus Satker?',
                text: "Kamu akan menghapus " + nama + ". Data yang dihapus tidak bisa dikembalikan!",
                icon: 'warning',
                showCancelButton: true,
                confirmButtonColor: '#3b8aff', // Warna biru Hope UI
                cancelButtonColor: '#ea5455', // Warna merah danger
                confirmButtonText: 'Ya, Hapus!',
                cancelButtonText: 'Batal',
                background: '#ffffff',
                customClass: {
                    confirmButton: 'btn btn-primary',
                    cancelButton: 'btn btn-danger ml-2'
                },
                buttonsStyling: false
            }).then((result) => {
                if (result.isConfirmed) {
                    // Submit form sesuai ID yang diklik
                    document.getElementById('delete-form-' + id).submit();
                }
            })
        }

        document.querySelectorAll('form').forEach(form => {
            form.addEventListener('submit', function() {
                Swal.fire({
                    title: 'Sedang Memproses...',
                    text: 'Tunggu sebentar ya gess',
                    allowOutsideClick: false,
                    didOpen: () => {
                        Swal.showLoading()
                    }
                });
            });
        });
    </script>
