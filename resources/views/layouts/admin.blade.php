<!doctype html>
<html lang="en" dir="ltr">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <title>Disinfo | Kinerja </title>

    <!-- Favicon -->
    <link rel="shortcut icon" href="{{ asset('template/assets/images/favicon.ico') }}">

    <!-- Library / Plugin Css Build -->
    <link rel="stylesheet" href="{{ asset('template/assets/css/core/libs.min.css') }}">

    <!-- Aos Animation Css -->
    <link rel="stylesheet" href="{{ asset('template/assets/vendor/aos/dist/aos.css') }}">

    <!-- Hope Ui Design System Css -->
    <link rel="stylesheet" href="{{ asset('template/assets/css/hope-ui.min.css?v=4.0.0') }}">

    <!-- Custom Css -->
    <link rel="stylesheet" href="{{ asset('template/assets/css/custom.min.css?v=4.0.0') }}">

    <!-- Dark Css -->
    <link rel="stylesheet" href="{{ asset('template/assets/css/dark.min.css') }}">

    <!-- Customizer Css -->
    <link rel="stylesheet" href="{{ asset('template/assets/css/customizer.min.css') }}">

    <!-- RTL Css -->
    <link rel="stylesheet" href="{{ asset('template/assets/css/rtl.min.css') }}">


</head>

<body class="">
    <!-- loader Start -->
    <div id="loading">
        <div class="loader simple-loader">
            <div class="loader-body">
            </div>
        </div>
    </div>
    <!-- loader END -->

    @include('layouts.partials.sidebar')

    <main class="main-content">

        <!-- Header Section Start -->
        @include('layouts.partials.header')
        <!-- Header Section end -->

        <!-- Content Section start -->
        @yield('content')
        <!-- Content Section end -->

        <!-- Footer Section Start -->
        @include('layouts.partials.footer')
        <!-- Footer Section End -->

    </main>

    <!-- offcanvas start -->
    @include('layouts.partials.offcanvas')
    <!-- offcanvas end -->

    <!-- Library Bundle Script -->
    <script src="{{ asset('template/') }}/assets/js/core/libs.min.js"></script>

    <!-- External Library Bundle Script -->
    <script src="{{ asset('template/') }}/assets/js/core/external.min.js"></script>

    <!-- Widgetchart Script -->
    <script src="{{ asset('template/') }}/assets/js/charts/widgetcharts.js"></script>

    <!-- mapchart Script -->
    <script src="{{ asset('template/') }}/assets/js/charts/vectore-chart.js"></script>
    <script src="{{ asset('template/') }}/assets/js/charts/dashboard.js"></script>

    <!-- fslightbox Script -->
    <script src="{{ asset('template/') }}/assets/js/plugins/fslightbox.js"></script>

    <!-- Settings Script -->
    <script src="{{ asset('template/') }}/assets/js/plugins/setting.js"></script>

    <!-- Slider-tab Script -->
    <script src="{{ asset('template/') }}/assets/js/plugins/slider-tabs.js"></script>

    <!-- Form Wizard Script -->
    <script src="{{ asset('template/') }}/assets/js/plugins/form-wizard.js"></script>

    <!-- AOS Animation Plugin-->
    <script src="{{ asset('template/') }}/assets/vendor/aos/dist/aos.js"></script>

    <!-- App Script -->
    <script src="{{ asset('template/') }}/assets/js/hope-ui.js" defer></script>

    <!-- Allert Script -->
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>

    <script>
        @if (session('success'))
            Swal.fire({
                icon: 'success',
                title: 'Berhasil!',
                text: "{{ session('success') }}",
                timer: 3000,
                showConfirmButton: false
            });
        @endif

        @if (session('error'))
            Swal.fire({
                icon: 'error',
                title: 'Oops...',
                text: "{{ session('error') }}",
            });
        @endif
    </script>

    <script>
        function openEditModal(id, satker_id, nama) {
            const form = document.getElementById('editForm');
            form.action = '/admin/subsatker/' + id;

            document.getElementById('edit_satker_id').value = satker_id;
            document.getElementById('edit_nama_subdis').value = nama;

            var myModal = new bootstrap.Modal(document.getElementById('modalEditSubSatker'));
            myModal.show();
        }

        function confirmDelete(id, nama) {
            Swal.fire({
                title: 'Hapus Sub Satker?',
                text: "Anda akan menghapus " + nama + ". Aksi ini tidak bisa dibatalkan!",
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
    </script>
    @stack('scripts')
</body>

</html>
