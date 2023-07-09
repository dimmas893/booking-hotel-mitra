@extends('layouts.user.template')
@section('contents')
    <div class="main-content">
        <section class="section">
            <div class="section-header">
                <h1>Detail {{ $mitra->namamitra }}</h1>
            </div>
            <div class="section-body">
                <div class="row">
                    {{-- <div class="row"> --}}
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
                    {{-- </div> --}}
                    <div class="col-12 col-md-12 col-lg-12">
                        @foreach ($fasilitasmitra as $item)
                            @php
                                $sop = \App\Models\Sop::where('idfasilmitra', $item->id)->get();
                                $fasilkolam = \App\Models\FasilitasKolangRenang::where('idfasilmitra', $item->id)->get();
                            @endphp
                            <tr>
                                <td>
                                    <div class="card shadow card-secondary">
                                        <div class="card-header">{{ $item->fasilitas->jenisfasilitas->namajenisfasilitas }}
                                            -
                                            {{ $item->fasilitas->namafasilitas }}</div>
                                        <div class="card-body">
                                            <p>{{ $item->deskrispsifasilitas }}</p>
                                            <p>{{ $item->specfasilitasi }}</p>
                                        </div>
                                        @if (count($sop) > 0)
                                            <div class="container">
                                                <div class="card shadow card-warning">
                                                    <div class="card-header">Peraturan</div>
                                                    <div class="card-body">
                                                        @foreach ($sop as $so)
                                                            <p>{{ $loop->iteration }}. {{ $so->namasop }}</p>
                                                            <p>-{{ $so->deskripsisop }}</p>
                                                        @endforeach
                                                    </div>
                                                </div>
                                            </div>
                                        @else
                                            <div class="container">
                                                <div class="card shadow card-warning">
                                                    <div class="card-header">Peraturan</div>
                                                    <div class="card-body">
                                                        <p>Peraturan tidak ada</p>
                                                    </div>
                                                </div>
                                            </div>
                                        @endif
                                        @if (count($fasilkolam) > 0)
                                            <form action="{{ route('pembayaranview') }}" method="get">
                                                @csrf
                                                <div class="container">
                                                    <div class="card shadow card-success">
                                                        <div class="card-header">Harga sewa</div>
                                                        <div class="card-body">
                                                            @foreach ($fasilkolam as $p => $fasil)
                                                                <div class="form-group">
                                                                    <div class="form-check">
                                                                        <input class="form-check-input" type="radio"
                                                                            name="id"
                                                                            value="{{ $fasil->id }}">{{ $fasil->unit->namaunit }}
                                                                        /
                                                                        Rp. {{ number_format($fasil->biayaperorang) }}
                                                                    </div>
                                                                </div>
                                                            @endforeach

                                                            <input type="submit" class="btn btn-primary" value="Sewa">
                                                        </div>
                                                    </div>
                                                </div>
                                            </form>
                                        @else
                                            <div class="container">
                                                <div class="card shadow card-success">
                                                    <div class="card-header">Harga sewa</div>
                                                    <div class="card-body">
                                                        <p>Harga belum tersedia</p>
                                                    </div>
                                                </div>
                                            </div>
                                        @endif
                                    </div>
                                </td>
                            </tr>
                        @endforeach
                    </div>
                </div>
            </div>
        </section>
    </div>
@endsection
