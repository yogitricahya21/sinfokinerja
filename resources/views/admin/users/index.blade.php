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

    <div class="py-0 mt-0 container-fluid content-inner">
        <div class="row">
            <div class="col-sm-12">
                <div class="card">
                    <div class="card-header d-flex justify-content-between">
                        <div class="header-title">
                            <h4 class="card-title">Daftar Personel</h4>
                        </div>
                        <div>
                            <button type="button" class="btn btn-primary" data-bs-toggle="modal"
                                data-bs-target="#modalTambahUser">
                                Tambah Personel
                            </button>
                        </div>
                    </div>
                    <div class="card-body">
                        <div class="table-responsive">
                            <table id="datatable" class="table table-striped" data-toggle="data-table">
                                <thead>
                                    <tr>
                                        <th>No</th>
                                        <th>Foto</th>
                                        <th>Nama Personel</th>
                                        <th>Email</th>
                                        <th>Satker</th>
                                        <th>Jabatan</th>
                                        <th>Sub Satker (Unit)</th>
                                        <th>Aksi</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach ($users as $key => $user)
                                        <tr>
                                            <td>{{ $key + 1 }}</td>
                                            <td>
                                                @if ($user->profile && $user->profile->foto_personel)
                                                    <img src="{{ asset('storage/foto_personel/' . $user->profile->foto_personel) }}"
                                                        alt="Foto" class="rounded-pill avatar-40"
                                                        style="object-fit: cover;">
                                                @else
                                                    <img src="{{ asset('template/assets/images/avatars/01.png') }}"
                                                        alt="Default" class="rounded-pill avatar-40">
                                                @endif
                                            </td>
                                            <td>{{ $user->name }}</td>
                                            <td>{{ $user->email }}</td>
                                            <td>
                                                <span class="badge bg-primary">
                                                    {{ $user->subSatker->satker->nama_satker ?? 'Tidak Terdeteksi' }}
                                                </span>
                                            </td>
                                            <td>
                                                @if ($user->role == 'kadis')
                                                    <span class="shadow-sm badge bg-warning text-dark">Kadis</span>
                                                @elseif($user->role == 'admin')
                                                    <span class="shadow-sm badge bg-danger">Admin</span>
                                                @else
                                                    <span class="shadow-sm badge bg-secondary">Personel</span>
                                                @endif
                                            </td>
                                            <td>
                                                <span class="badge bg-info">
                                                    {{ $user->subSatker->nama_subdis ?? '-' }}
                                                </span>
                                            </td>
                                            <td>
                                                <div class="flex align-items-center list-user-action">
                                                    <button type="button" class="btn btn-sm btn-info"
                                                        data-bs-toggle="modal"
                                                        data-bs-target="#userDetail{{ $user->id }}" title="view">
                                                        <svg class="icon-20" width="20" viewBox="0 0 24 24"
                                                            fill="none" xmlns="http://www.w3.org/2000/svg">
                                                            <path
                                                                d="M22.4541 11.3918C22.7819 11.7385 22.7819 12.2615 22.4541 12.6082C21.0124 14.1335 16.8768 18 12 18C7.12317 18 2.98759 14.1335 1.54586 12.6082C1.21811 12.2615 1.21811 11.7385 1.54586 11.3918C2.98759 9.86647 7.12317 6 12 6C16.8768 6 21.0124 9.86647 22.4541 11.3918Z"
                                                                fill="#130F26" fill-opacity="0.4" stroke="#130F26"></path>
                                                            <circle cx="12" cy="12" r="5" stroke="#130F26">
                                                            </circle>
                                                            <circle cx="12" cy="12" r="3" fill="#130F26">
                                                            </circle>
                                                            <mask mask-type="alpha" maskUnits="userSpaceOnUse" x="9" y="9"
                                                                width="6" height="6">
                                                                <circle cx="12" cy="12" r="3" fill="#130F26">
                                                                </circle>
                                                            </mask>
                                                            <circle opacity="0.53" cx="13.5" cy="10.5" r="1.5"
                                                                fill="white"></circle>
                                                        </svg>
                                                    </button>

                                                    <div class="modal fade" id="userDetail{{ $user->id }}"
                                                        tabindex="-1" aria-labelledby="exampleModalLabel"
                                                        aria-hidden="true">
                                                        <div class="modal-dialog modal-lg">
                                                            <div class="modal-content">
                                                                <div class="modal-header">
                                                                    <h5 class="modal-title" id="exampleModalLabel">Biodata:
                                                                    </h5>
                                                                    <button type="button" class="btn-close"
                                                                        data-bs-dismiss="modal" aria-label="Close"></button>
                                                                </div>
                                                                <div class="modal-body">
                                                                    <div class="col-md-8">
                                                                        @if ($user->profile && $user->profile->foto_personel)
                                                                            <img src="{{ asset('storage/foto_personel/' . $user->profile->foto_personel) }}"
                                                                                alt="Foto"
                                                                                class="rounded-pill avatar-130"
                                                                                style="object-fit: cover;">
                                                                        @else
                                                                            <img src="{{ asset('template/assets/images/avatars/01.png') }}"
                                                                                alt="Default"
                                                                                class="rounded-pill avatar-130">
                                                                        @endif
                                                                        <table class="table table-borderless">
                                                                            <tr>
                                                                                <th width="35%">Nama</th>
                                                                                <td>: {{ $user->name }}</td>
                                                                            </tr>
                                                                            <tr>
                                                                                <th>NIP / NRP</th>
                                                                                <td>: {{ $user->profile->nip_nrp ?? '-' }}
                                                                                </td>
                                                                            </tr>
                                                                            <tr>
                                                                                <th>Pangkat</th>
                                                                                <td>: {{ $user->profile->pangkat ?? '-' }}
                                                                                </td>
                                                                            </tr>
                                                                            <tr>
                                                                                <th>Jabatan</th>
                                                                                <td>: {{ $user->profile->jabatan ?? '-' }}
                                                                                </td>
                                                                            </tr>
                                                                            <tr>
                                                                                <th>Email</th>
                                                                                <td>: {{ $user->email }}</td>
                                                                            </tr>
                                                                            <tr>
                                                                                <th>WhatsApp</th>
                                                                                <td>: {{ $user->profile->no_hp ?? '-' }}
                                                                                </td>
                                                                            </tr>
                                                                            <tr>
                                                                                <th>Satker</th>
                                                                                <td>:
                                                                                    {{ $user->subSatker->satker->nama_satker ?? '-' }}
                                                                                </td>
                                                                            </tr>
                                                                            <tr>
                                                                                <th>Sub Satker</th>
                                                                                <td>:
                                                                                    {{ $user->subSatker->nama_subdis ?? '-' }}
                                                                                </td>
                                                                            </tr>
                                                                            <tr>
                                                                                <th>Alamat</th>
                                                                                <td>: {{ $user->profile->alamat ?? '-' }}
                                                                                </td>
                                                                            </tr>
                                                                        </table>
                                                                    </div>
                                                                </div>
                                                                <div class="modal-footer">
                                                                    <a href="{{ route('admin.users.pdf', $user->id) }}"
                                                                        class="btn btn-danger">
                                                                        <i class="fas fa-file-pdf"></i> Cetak PDF
                                                                    </a>
                                                                    <button type="button" class="btn btn-secondary"
                                                                        data-bs-dismiss="modal">Tutup</button>
                                                                </div>
                                                            </div>
                                                        </div>
                                                    </div>

                                                    <button type="button" class="btn btn-sm btn-icon btn-warning"
                                                        onclick="editUser({{ $user->toJson() }})"
                                                        data-bs-toggle="tooltip" title="Edit">
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
                                                    </button>

                                                    <button type="button" class="btn btn-sm btn-icon btn-danger"
                                                        onclick="confirmDelete('{{ $user->id }}', '{{ $user->name }}')"
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
                                                    <form id="delete-form-{{ $user->id }}"
                                                        action="{{ route('admin.users.destroy', $user->id) }}"
                                                        method="POST" style="display: none;">
                                                        @csrf @method('DELETE')
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

    <div class="modal fade" id="modalTambahUser" tabindex="-1" aria-hidden="true">
        <div class="modal-dialog modal-lg">
            <form action="{{ route('admin.users.store') }}" method="POST" class="modal-content">
                @csrf
                <div class="modal-header">
                    <h5 class="modal-title">Tambah Pegawai Baru</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <div class="row">
                        <div class="mb-3 col-md-6">
                            <label class="form-label">Nama Lengkap</label>
                            <input type="text" name="name" class="form-control" required
                                placeholder="Nama sesuai KTP">
                        </div>
                        <div class="mb-3 col-md-6">
                            <label class="form-label">Alamat Email</label>
                            <input type="email" name="email" class="form-control" required
                                placeholder="pegawai@instansi.go.id">
                        </div>
                        <div class="mb-3 col-md-12">
                            <label class="form-label">Password Sementara</label>
                            <input type="password" name="password" class="form-control" required
                                placeholder="Minimal 8 karakter">
                        </div>

                        <div class="col-md-12">
                            <div class="alert alert-info" role="alert">
                                Tentukan penempatan kerja personel di bawah ini:
                            </div>
                        </div>

                        <div class="mb-3 col-md-12">
                            <label class="form-label">Role / Jabatan</label>
                            <select name="role" class="form-control" required>
                                <option value="pegawai">Personel</option>
                                <option value="kadis">Kepala Dinas (Kadis)</option>
                            </select>
                        </div>

                        <div class="mb-3 col-md-6">
                            <label class="form-label">Pilih Satker</label>
                            <select name="current_satker_id" id="add-satker" class="form-select" required>
                                <option value="">-- Pilih Satker --</option>
                                @foreach ($satkers as $s)
                                    <option value="{{ $s->id }}">{{ $s->nama_satker }}</option>
                                @endforeach
                            </select>
                        </div>

                        <div class="mb-3 col-md-6">
                            <label class="form-label">Pilih Sub Satker (Unit)</label>
                            <select name="current_sub_satker_id" id="add-subsatker" class="form-select" disabled
                                required>
                                <option value="">-- Pilih Satker Dulu --</option>
                            </select>
                        </div>
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Batal</button>
                    <button type="submit" class="btn btn-primary">Daftarkan Personel</button>
                </div>
            </form>
        </div>
    </div>

    <div class="modal fade" id="modalEditUser" tabindex="-1" aria-hidden="true">
        <div class="modal-dialog modal-lg">
            <form id="edit-form" method="POST" class="modal-content">
                @csrf @method('PUT')
                <div class="modal-header">
                    <h5 class="modal-title">Edit / Mutasi Pegawai</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
                </div>
                <div class="modal-body">
                    <div class="row">
                        <div class="mb-3 col-md-6">
                            <label>Nama Lengkap</label>
                            <input type="text" name="name" id="edit-name" class="form-control" required>
                        </div>
                        <div class="mb-3 col-md-6">
                            <label>Role</label>
                            <select name="role" id="edit-role" class="form-select">
                                <option value="pegawai">Pegawai</option>
                                <option value="kadis">Kadis</option>
                            </select>
                        </div>
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="submit" class="btn btn-primary">Simpan Perubahan</button>
                </div>
            </form>
        </div>
    </div>
@endsection

@push('scripts')
    <script>
        // Logika Chained Dropdown
        document.getElementById('add-satker').addEventListener('change', function() {
            let satkerId = this.value;
            let subSelect = document.getElementById('add-subsatker');

            subSelect.innerHTML = '<option value="">Memuat unit...</option>';
            subSelect.disabled = true;

            if (satkerId) {
                // Gunakan {{ url('/') }} agar alamatnya selalu benar dari root domain
                fetch("{{ url('admin/get-subsatker') }}/" + satkerId)
                    .then(response => {
                        if (!response.ok) throw new Error('Data tidak ditemukan (404)');
                        return response.json();
                    })
                    .then(data => {
                        subSelect.innerHTML = '<option value="">-- Pilih Unit (Sub Satker) --</option>';
                        data.forEach(item => {
                            // Pakai nama_subdis sesuai isi model & migrasi kamu
                            subSelect.innerHTML +=
                                `<option value="${item.id}">${item.nama_subdis}</option>`;
                        });
                        subSelect.disabled = false;
                    })
                    .catch(error => {
                        console.error('Fetch error:', error);
                        subSelect.innerHTML = '<option value="">Gagal memuat unit</option>';
                    });
            }
        });

        // Konfirmasi Hapus SweetAlert
        function confirmDelete(id, nama) {
            Swal.fire({
                title: 'Hapus Pegawai?',
                text: "Data " + nama + " akan dihapus. Akun ini tidak akan bisa login lagi!",
                icon: 'warning',
                showCancelButton: true,
                confirmButtonColor: '#3b8aff',
                cancelButtonColor: '#ea5455',
                confirmButtonText: 'Ya, Hapus!',
                cancelButtonText: 'Batal',
                buttonsStyling: false,
                customClass: {
                    confirmButton: 'btn btn-primary',
                    cancelButton: 'btn btn-danger ms-2'
                }
            }).then((result) => {
                if (result.isConfirmed) {
                    document.getElementById('delete-form-' + id).submit();
                }
            })
        }

        function editUser(user) {
            document.getElementById('edit-form').action = "/admin/users/" + user.id;
            document.getElementById('edit-name').value = user.name;
            document.getElementById('edit-role').value = user.role;

            // Untuk satker dan subsatker, kamu perlu trigger event change 
            // agar dropdown subsatker-nya juga ikut terisi via AJAX
            $('#modalEditUser').modal('show');
        }
    </script>
@endpush
