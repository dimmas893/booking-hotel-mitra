@extends('layouts.user.template')
@section('contents')
    <div class="main-content">
        <section class="section">
            <div class="section-header">
                <h1>Detail Pesanan</h1> {{-- <div class="section-header-breadcrumb">
                    <div class="breadcrumb-item active"><a href="{{ route('menu') }}">Menu</a></div>
                    <div class="breadcrumb-item active"><a href="{{ route('manage') }}">Manage</a></div>
                    <div class="breadcrumb-item">Jenjang</div>
                </div> --}}
            </div>
            <div class="section-body">
                <div class="row">
                    <div class="col-12 col-md-12 col-lg-12">
                        <div class="card shadow">
                            <div class="card-header">
                                <h4>{{ $booking->fasilitaskolam->mitra->namamitra }}</h4>
                            </div>
                            <div class="card-body">
                                <div id="carouselExampleIndicators" class="carousel slide" data-ride="carousel">
                                    <div class="carousel-inner">
                                        <div class="carousel-item active">
                                            <img class="d-block w-100"
                                                src="{{ asset('mitrafoto/' . $booking->fasilitaskolam->mitra->foto) }}"
                                                alt="First slide">
                                        </div>
                                        <div class="carousel-item">
                                            <img class="d-block w-100"
                                                src="{{ asset('mitrafoto/' . $booking->fasilitaskolam->mitra->foto) }}"
                                                alt="Second slide">
                                        </div>
                                        <div class="carousel-item">
                                            <img class="d-block w-100"
                                                src="{{ asset('mitrafoto/' . $booking->fasilitaskolam->mitra->foto) }}"
                                                alt="Third slide">
                                        </div>
                                    </div><br>
                                    <div>{{ $booking->fasilitaskolam->mitra->alamatmitralengkap }}</div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="row">
                    <div class="col-12 col-md-12 col-lg-12">
                        {{-- @foreach ($fasilitasmitra as $item) --}}
                        @php
                            $sop = \App\Models\Sop::where('idfasilmitra', $booking->fasilitaskolam->idfasilmitra)->get();
                            $fasilkolam = \App\Models\FasilitasKolangRenang::where('idfasilmitra', $booking->fasilitaskolam->idfasilmitra)->get();
                        @endphp
                        <div class="card shadow card-secondary">
                            <div class="card-header">
                                {{ $booking->fasilitaskolam->fasilmitra->fasilitas->jenisfasilitas->namajenisfasilitas }}
                                -
                                {{ $booking->fasilitaskolam->fasilmitra->fasilitas->namafasilitas }}</div>
                            <div class="card-body">
                                <p>{{ $booking->fasilitaskolam->fasilmitra->fasilitas->deskrispsifasilitas }}</p>
                                <p>{{ $booking->fasilitaskolam->fasilmitra->fasilitas->specfasilitasi }}</p>
                            </div>
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
                            {{-- {{ dd(count($fasilkolam)) }} --}}
                            {{-- @if (count($booking) > 0) --}}
                            <form action="{{ route('pembayaranview') }}" method="get">
                                @csrf
                                <div class="container">
                                    <div class="card shadow card-success">
                                        <div class="card-header">Harga sewa</div>
                                        <div class="card-body">
                                            <div>Rp. {{ number_format($booking->price) }} /
                                                {{ $booking->fasilitaskolam->unit->namaunit }} </div>
                                            <div>nomor order : {{ $booking->order_no }}</div>
                                            {{-- <a href="{{ route('pembayaranview') }}" class="btn btn-primary">Sewa</a> --}}
                                            @if (isset($admin))
                                                @if ($booking->status === 'unpaid')
                                                    <div class="mt-3"><a
                                                            href="{{ route('pembayaranadmin', $booking->order_no) }}"
                                                            class="btn btn-primary">Bayar via admin</a>
                                                        <a href="{{ route('pesananadmin') }}"
                                                            class="btn btn-success">Kembali
                                                        </a>
                                                    </div>
                                                @else
                                                    <div class="mt-3">
                                                        <label for="">Pembayaran status Paid</label><br>
                                                        <a href="{{ route('pesananadmin') }}" class="btn btn-success">
                                                            Kembali </a>
                                                    </div>
                                                @endif
                                            @elseif(isset($mitra))
                                                @if ($booking->status === 'unpaid')
                                                    <div class="mt-3"><a href="{{ $booking->link_pembayaran }}"
                                                            class="btn btn-primary">Bayar</a>
                                                        <a href="{{ url()->previous() }}" class="btn btn-success">Kembali
                                                        </a>
                                                    </div>
                                                @else
                                                    <div class="mt-3">
                                                        <label for="">Pembayaran status Paid</label><br>
                                                        <a href="{{ url()->previous() }}" class="btn btn-success">
                                                            Kembali </a>
                                                    </div>
                                                @endif
                                            @elseif(isset($customor))
                                                @if ($booking->status === 'unpaid')
                                                    <div class="mt-3"><a href="{{ $booking->link_pembayaran }}"
                                                            class="btn btn-primary">Bayar</a>
                                                        <a href="{{ url()->previous() }}" class="btn btn-success">Kembali
                                                        </a>
                                                    </div>
                                                @else
                                                    <div class="mt-3">
                                                        <label for="">Pembayaran status Paid</label><br>
                                                        <a href="{{ url()->previous() }}" class="btn btn-success">
                                                            Kembali </a>
                                                    </div>
                                                @endif
                                            @endif
                                        </div>
                                    </div>
                                </div>
                            </form>
                        </div>
                        {{-- @endforeach --}}
                    </div>
                </div>
            </div>
        </section>
    </div>
@endsection
