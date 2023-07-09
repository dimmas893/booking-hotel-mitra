    <!-- General JS Scripts -->
    <script src="{{ asset('assets/modules/jquery.min.js') }}"></script>
    <script src="{{ asset('assets/modules/popper.js') }}"></script>
    <script src="{{ asset('assets/modules/tooltip.js') }}"></script>
    <script src="{{ asset('assets/modules/bootstrap/js/bootstrap.min.j') }}s"></script>
    <script src="{{ asset('assets/modules/nicescroll/jquery.nicescroll.min.js') }}"></script>
    <script src="{{ asset('assets/modules/moment.min.js') }}"></script>
    <script src="{{ asset('assets/js/stisla.js') }}"></script>

    <!-- JS Libraies -->
    <script src="{{ asset('assets/modules/simple-weather/jquery.simpleWeather.min.js') }}"></script>

    <script src="{{ asset('assets/modules/jquery-pwstrength/jquery.pwstrength.min.js') }}"></script>
    <script src="{{ asset('assets/modules/jquery-selectric/jquery.selectric.min.js') }}"></script>
    <script src="{{ asset('assets/modules/chart.min.js') }}"></script>
    <script src="{{ asset('assets/modules/jqvmap/dist/jquery.vmap.min.js') }}"></script>
    <script src="{{ asset('assets/modules/jqvmap/dist/maps/jquery.vmap.world.js') }}"></script>
    <script src="{{ asset('assets/modules/summernote/summernote-bs4.js') }}"></script>
    <script src="{{ asset('assets/modules/chocolat/dist/js/jquery.chocolat.min.js') }}"></script>

    <!-- Page Specific JS File -->
    {{-- <script src="{{ asset('assets/js/page/index-0.js"></script> --}}

    <!-- Template JS File -->
    <script src="{{ asset('assets/js/scripts.js') }}"></script>
    <script src="{{ asset('assets/js/custom.js') }}"></script>
    <script type="text/javascript" src="https://cdn.datatables.net/1.13.1/js/jquery.dataTables.min.js"></script>
    <script type="text/javascript" src="https://cdn.datatables.net/1.13.1/js/dataTables.bootstrap4.min.js"></script>
    <script type="text/javascript" src="https://cdn.datatables.net/responsive/2.4.0/js/dataTables.responsive.min.js">
    </script>
    <script type="text/javascript" src="https://cdn.datatables.net/responsive/2.4.0/js/responsive.bootstrap4.min.js">
    </script>


    <script src="//cdn.jsdelivr.net/npm/sweetalert2@11"></script>
    @if (session('perjanjianbelum'))
        <script type="text/javascript">
            Swal.fire(
                'Upss!!',
                'Belum Kerja Sama Dengan Mitra Tersebut!',
                'info'
            )
        </script>
    @endif
    @if (session('unitsudahada'))
        <script type="text/javascript">
            Swal.fire(
                'Ada Sesuatu Yang Salah',
                'Unit di kesepakatan ini sudah ada!',
                'info'
            )
        </script>
    @endif
    @if (session('emailsama'))
        <script type="text/javascript">
            Swal.fire(
                'Email Sudah Ada!',
                'Harap Ganti Alamat Email!',
                'error'
            )
        </script>
    @endif
    @if (session('loginsalah'))
        <script type="text/javascript">
            Swal.fire(
                'Upsss!',
                'Email / Password Salah!',
                'error'
            )
        </script>
    @endif
    @if (session('perjanjianberakhir'))
        <script type="text/javascript">
            Swal.fire(
                'Upssss!',
                'Perjanjian Sudah tidak Berlaku!',
                'info'
            )
        </script>
    @endif
    @if (session('unitsudahadaberhasil'))
        <script type="text/javascript">
            Swal.fire(
                'Selamat!!',
                'Berhasil Menambahkan Harga di kesepakatan!',
                'success'
            )
        </script>
    @endif
    @if (session('perjanjianbelum'))
        <script type="text/javascript">
            Swal.fire(
                'Upss!!',
                'Belum Kerja Sama Dengan Mitra Tersebut!',
                'info'
            )
        </script>
    @endif

    @yield('js')
