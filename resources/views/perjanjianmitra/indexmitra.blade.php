@extends('layouts.admin.template')
@section('content')
    <div class="main-content">
        <section class="section">
            <div class="section-header">
                <h1>Halaman Perjanjian Mitra</h1>
            </div>
            <div class="section-body">
                <div class="row">
                    <div class="col-lg-8 col-sm-12 col-md-12">
                        <div class="card shadow">
                            <div class="card-header bg-primary d-flex justify-content-between align-items-center">
                                <h3 class="text-light">Tabel Perjanjian Mitra</h3>
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
                    @php
                        $mitra = \App\Models\Mitra::where('id', $id)->first();
                    @endphp
                    <div class="col-lg-4 col-sm-12 col-md-12">
                        <div class="card shadow card-primary">
                            <img src="{{ asset('mitrafoto/' . $mitra->foto) }}" class="card-img-top" alt="...">
                            <div class="card-body">
                                <h5 class="card-title">{{ $mitra->namamitra }}</h5>
                                <p class="card-text">{{ $mitra->alamatmitralengkap }}</p>
                                {{-- <a href="#" class="btn btn-primary">Go somewhere</a> --}}
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
                    url: '{{ route('perjanjianmitra-allmitra', $id) }}',
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
