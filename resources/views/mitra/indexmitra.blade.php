@extends('layouts.admin.template')
@section('content')
    <div class="main-content">
        <section class="section">
            <div class="section-header">
                <h1>Halaman Profil</h1>
                {{-- <div class="section-header-breadcrumb">
                    <div class="breadcrumb-item active"><a href="{{ url()->previous() }}" class="btn btn-success"> Kembali </a>
                    </div>
                </div> --}}
            </div>
            <div class="section-body">
                @if (isset($perjanjian))
                    {{-- {{ $perjanjian }} --}}
                    <div class="row">
                        <div class="col-lg-4 col-sm-12 col-md-12">
                            <div class="card shadow card-primary">
                                {{-- <img src="{{ asset('mitrafoto/' . $mitra->foto) }}" class="card-img-top" alt="..."> --}}
                                <div class="card-body">
                                    <h5 class="card-title">Perjanjian Yang Berlaku</h5>
                                    <p class="card-text">{{ $perjanjian->tglawalberlaku }} sampai
                                        {{ $perjanjian->tglakhirberlaku }}</p>
                                </div>
                            </div>
                        </div>
                        <div class="col-lg-4 col-sm-12 col-md-12">
                            <div class="card shadow card-primary">
                                {{-- <img src="{{ asset('mitrafoto/' . $mitra->foto) }}" class="card-img-top" alt="..."> --}}
                                <div class="card-body">
                                    <h5 class="card-title">Penanda Tangan Owner</h5>
                                    <p class="card-text">{{ $perjanjian->namapihakowner1 }} dan
                                        {{ $perjanjian->namapihakowner2 }}</p>
                                </div>
                            </div>
                        </div>
                        <div class="col-lg-4 col-sm-12 col-md-12">
                            <div class="card shadow card-primary">
                                {{-- <img src="{{ asset('mitrafoto/' . $mitra->foto) }}" class="card-img-top" alt="..."> --}}
                                <div class="card-body">
                                    <h5 class="card-title">Penanda Tangan Mitra</h5>
                                    <p class="card-text">{{ $perjanjian->namapihakmitra1 }} dan
                                        {{ $perjanjian->namapihakmitra2 }}</p>
                                </div>
                            </div>
                        </div>
                    </div>
                @endif

                @if (empty($perjanjian))
                    <div class="row">
                        <div class="col-12">
                            <div class="card shadow card-primary">
                                {{-- <img src="{{ asset('mitrafoto/' . $mitra->foto) }}" class="card-img-top" alt="..."> --}}
                                <div class="card-body">
                                    <h5 class="card-title">Masa Perjanjian Sudah Berakhir</h5>
                                    <p class="card-text">Silahkan Hubungi Pihak Terkait Untuk Memperpanjang</p>
                                </div>
                            </div>
                        </div>
                    </div>
                @endif
                <div class="row">
                    <div class="col-12 col-md-12 col-lg-12">
                        <div class="card shadow">
                            <div class="card-header">
                                <h4>{{ $mitra->namamitra }}</h4>
                            </div>
                            <div class="card-body">
                                <div id="carouselExampleIndicators" class="carousel slide" data-ride="carousel">
                                    <div class="carousel-inner">
                                        <div class="carousel-item active">
                                            <img class="d-block w-100" src="{{ asset('mitrafoto/' . $mitra->foto) }}"
                                                alt="First slide">
                                        </div>
                                        <div class="carousel-item">
                                            <img class="d-block w-100" src="{{ asset('mitrafoto/' . $mitra->foto) }}"
                                                alt="Second slide">
                                        </div>
                                        <div class="carousel-item">
                                            <img class="d-block w-100" src="{{ asset('mitrafoto/' . $mitra->foto) }}"
                                                alt="Third slide">
                                        </div>
                                    </div><br>
                                    <div>{{ $mitra->alamatmitralengkap }}</div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="row my-5">
                    <div class="col-lg-12">
                        <div class="card shadow">
                            <div class="card-header bg-primary d-flex justify-content-between align-items-center">
                                <h3 class="text-light">Data Mitra</h3>
                            </div>
                            <div>
                                <div class="card-body" id="TU_all">
                                    <h1 class="text-secondary my-5 text-center">
                                        <div class="load-3">
                                            <div class="line"></div>
                                            <div class="line"></div>
                                            <div class="line"></div>
                                        </div>
                                    </h1>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </section>
    </div>
@endsection

@section('js')
    <script>
        $(function() {
            TU_all();

            function TU_all() {
                $.ajax({
                    url: '{{ route('mitra-allmitra') }}',
                    method: 'get',
                    success: function(response) {
                        $("#TU_all").html(response);
                        $("table").DataTable({
                            destroy: true,
                            responsive: true
                        });
                    }
                });
            }
        });
    </script>
@endsection
