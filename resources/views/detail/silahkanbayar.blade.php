@extends('layouts.user.template')
@section('contents')
    <div class="main-content">
        <section class="section">
            <div class="section-header">
                <h1>Batas pembayaran tanggal {{ $booking->batas_bayar }}</h1>
            </div>
            <div class="section-body">
                <div class="row mt-sm-4">
                    <div class="col-12 col-md-12 col-lg-12">
                        <div class="container">
                            <div class="card shadow card-success">
                                <div class="card-header">Silahkan Melakukan Pembayaran</div>
                                <div class="card-body">
                                    {{-- {{ $kolamrenang }} --}}
                                    <p>Bayar dengan nominal Rp. {{ number_format($kolamrenang->biayaperorang) }}</p>
                                    {{-- <input type="submit" class="btn btn-primary" value="Bayar"> --}}
                                    <a href="{{ $booking->link_pembayaran }}" class="btn btn-primary">Bayar</a>
                                    <a href="{{ route('cekpesananview') }}" class="btn btn-info">Cek Pesanan</a>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </section>
    </div>
@endsection
