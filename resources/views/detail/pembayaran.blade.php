 @extends('layouts.user.template')
 @section('contents')
     <div class="main-content">
         <section class="section">
             {{-- <div class="section-header">
                 <h1>Detail</h1>
                 <div class="section-header-breadcrumb">
                     <div class="breadcrumb-item"><a href="{{ url()->previous() }}" class="btn btn-primary">
                             < Kembali </a>
                     </div>
                 </div>
             </div> --}}
             <div class="section-body">
                 <div class="card shadow card-secondary">
                     <div class="card-header">
                         Choose your payment method
                     </div>
                 </div>
                 @foreach ($channels->data as $channel)
                     @if ($channel->active)
                         <form action="{{ route('pembayaranviewstore') }}" method="POST" class="cursor-pointer">
                             @csrf
                             <input type="hidden" name="method" value="{{ $channel->code }}">
                             <input type="hidden" name="id" value="{{ $id }}">
                             <div class="card shadow">
                                 <div class="card-header">
                                     <img src="{{ $channel->icon_url }}" style="width:100%;">
                                 </div>
                                 <div class="card-body">
                                     {{-- <p>Fee @rupiah($channel->total_fee['flat'])</p> --}}
                                     <input type="submit" class="btn btn-primary" value="Pay with {{ $channel->code }}">
                                 </div>
                             </div>
                         </form>
                     @endif
                 @endforeach
             </div>
         </section>
     </div>
 @endsection
