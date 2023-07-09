@extends('layouts.admin.template')
@section('content')
    <div class="main-content">
        <section class="section">
            <div class="section-header">
                <h1>Halaman Data Fasilitas Mitra</h1>
            </div>
            <div class="section-body">
                @if (isset($perjanjianmitra))
                    {{-- {{ $perjanjianmitra }} --}}
                    <div class="row">
                        <div class="col-lg-4 col-sm-12 col-md-12">
                            <div class="card shadow card-primary">
                                {{-- <img src="{{ asset('mitrafoto/' . $mitra->foto) }}" class="card-img-top" alt="..."> --}}
                                <div class="card-body">
                                    <h5 class="card-title">Perjanjian Yang Berlaku</h5>
                                    <p class="card-text">{{ $perjanjianmitra->tglawalberlaku }} sampai
                                        {{ $perjanjianmitra->tglakhirberlaku }}</p>
                                </div>
                            </div>
                        </div>
                        <div class="col-lg-4 col-sm-12 col-md-12">
                            <div class="card shadow card-primary">
                                {{-- <img src="{{ asset('mitrafoto/' . $mitra->foto) }}" class="card-img-top" alt="..."> --}}
                                <div class="card-body">
                                    <h5 class="card-title">Penanda Tangan Owner</h5>
                                    <p class="card-text">{{ $perjanjianmitra->namapihakowner1 }} dan
                                        {{ $perjanjianmitra->namapihakowner2 }}</p>
                                </div>
                            </div>
                        </div>
                        <div class="col-lg-4 col-sm-12 col-md-12">
                            <div class="card shadow card-primary">
                                {{-- <img src="{{ asset('mitrafoto/' . $mitra->foto) }}" class="card-img-top" alt="..."> --}}
                                <div class="card-body">
                                    <h5 class="card-title">Penanda Tangan Mitra</h5>
                                    <p class="card-text">{{ $perjanjianmitra->namapihakmitra1 }} dan
                                        {{ $perjanjianmitra->namapihakmitra2 }}</p>
                                </div>
                            </div>
                        </div>
                    </div>
                @endif

                @if (empty($perjanjianmitra))
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

                <div class="row my-2">
                    <div class="col-lg-8 col-sm-12 col-md-12">
                        <div class="card shadow">
                            <div class="card-header bg-primary d-flex justify-content-between align-items-center">
                                <h3 class="text-light">Tabel Fasilitas Mitra</h3>
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
                    @if (isset($mitra))
                        <div class="col-lg-4 col-sm-12 col-md-12">
                            <div class="card shadow card-primary">
                                <img src="{{ asset('mitrafoto/' . $mitra->foto) }}" class="card-img-top" alt="...">
                                <div class="card-body">
                                    <h5 class="card-title">{{ $mitra->namamitra }}</h5>
                                    <p class="card-text">{{ $mitra->alamatmitralengkap }}</p>
                                </div>
                            </div>
                        </div>
                    @endif
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
                    url: '{{ route('fasilitas-mitra-allmitra', $idperjanjian) }}',
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
