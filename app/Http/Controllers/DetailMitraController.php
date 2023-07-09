<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Payment\TripayController;
use App\Models\Admin;
use App\Models\Booking;
use App\Models\Customor;
use App\Models\FasilitasKolangRenang;
use App\Models\FasilitasMitra;
use App\Models\Mitra;
use App\Models\Pencarian;
use App\Models\PerjanjianMitra;
use App\Models\User;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class DetailMitraController extends Controller
{
    public function detail($idmitra)
    {
        $cek = Pencarian::where('mitra_id', $idmitra)->first();
        // dd($cek);
        if ($cek === null) {
            Pencarian::create([
                'mitra_id' => $idmitra,
                'pencarian' => 1
            ]);
        } else {
            $cek->update([
                'pencarian' => $cek->pencarian + 1
            ]);
        }
        $tanggalhariini = Carbon::now()->Format('Y-m-d');
        $perjanjianmitra = PerjanjianMitra::where('idmitra', $idmitra)->where('tglawalberlaku', '<=', $tanggalhariini)->where('tglakhirberlaku', '>=', $tanggalhariini)->first();
        if ($perjanjianmitra) {
            $mitraget = Mitra::get();
            $mitra = Mitra::where('id', $perjanjianmitra->idmitra)->first();
            $fasilitasmitra = FasilitasMitra::where('idmitra', $mitra->id)->get();
            return view('detail.mitra', compact('mitra', 'fasilitasmitra', 'mitraget'));
        } else {
            return back()->with('perjanjianbelum', 'ds');
        }
    }

    public function pembayaran(Request $request)
    {
        $tripay = new TripayController();
        $channels = $tripay->getPaymentChannels();
        $kolamrenang = FasilitasKolangRenang::where('id', $request->id)->first();
        $id = $request->id;
        // dd($channels);
        return view('detail.pembayaran', compact('kolamrenang', 'channels', 'id'));
    }
    public function store(Request $request)
    {
        $tanggalhariini = Carbon::now()->Format('Y-m-d');
        $tambah1 = Carbon::now()->addDays(1)->Format('Y-m-d');
        // dd($tambah1);
        // $book = Book::where('id', $request->book_id)->first();
        $kolamrenang = FasilitasKolangRenang::where('id', $request->id)->first();
        // dd($kolamrenang);
        $tripay = new TripayController();
        $method = $request->method;
        $user = User::where('id', Auth::user()->id)->first();
        $detail = $tripay->requestTransaction($kolamrenang, $method, $user);
        // dd($detail);
        Booking::create([
            'idfasilkolam' => $kolamrenang->id,
            'id_user' => $user->id,
            'order_no' => $detail->data->reference,
            'booking_date' => $tanggalhariini,
            'batas_bayar' => $tambah1,
            'price' => $kolamrenang->biayaperorang,
            'status' => 'unpaid',
            'link_pembayaran' => $detail->data->checkout_url,
        ]);

        return redirect()->route('detail.silahkanbayar', [
            'reference' => $detail->data->reference
        ]);
    }
    public function reference($reference)
    {
        $booking = Booking::where('order_no', $reference)->first();
        $kolamrenang = FasilitasKolangRenang::where('id', $booking->idfasilkolam)->first();
        return view('detail.silahkanbayar', compact('booking', 'kolamrenang'));
    }



    public function cekpesananviewdetail($reference)
    {
        $admin = Admin::where('id_user', Auth::user()->id)->first();
        $customor = Customor::where('id_user', Auth::user()->id)->first();
        $mitra = Mitra::where('id_user', Auth::user()->id)->first();
        if ($admin != null) {
            $booking = Booking::where('order_no', $reference)->first();
            return view('detail.detailpesanan', compact('booking', 'admin'));
        }
        if ($customor != null) {
            $booking = Booking::where('order_no', $reference)->first();
            return view('detail.detailpesanan', compact('booking', 'customor'));
        }
        if ($mitra != null) {
            $booking = Booking::where('order_no', $reference)->first();
            return view('detail.detailpesanan', compact('booking', 'mitra'));
        }
    }

    public function cekpesananviewdetailmitra($reference)
    {
        $admin = Admin::where('id_user', Auth::user()->id)->first();
        $customor = Customor::where('id_user', Auth::user()->id)->first();
        $mitra = Mitra::where('id_user', Auth::user()->id)->first();
        if ($admin != null) {
            $booking = Booking::where('order_no', $reference)->first();
            return view('detail.detailpesananmitra', compact('booking', 'admin'));
        }
        if ($customor != null) {
            $booking = Booking::where('order_no', $reference)->first();
            return view('detail.detailpesananmitra', compact('booking', 'customor'));
        }
        if ($mitra != null) {
            $booking = Booking::where('order_no', $reference)->first();
            return view('detail.detailpesananmitra', compact('booking', 'mitra'));
        }
    }

    public function cekpesananview()
    {
        return view('detail.cekpesanan');
    }
    public function cekpesanan()
    {
        $user = Auth::user()->id;
        $emps = Booking::where('id_user', $user)->get();
        $output = '';
        $p = 1;
        if ($emps->count() > 0) {
            $output .= '<table class="table table-bordered table-md display nowrap" style="width:100%">
            <thead>
              <tr>
                <th>No</th>
                <th>Booking Date</th>
                <th>Batas Bayar</th>
                <th>Order No</th>
                <th>Penyedia Fasilitas</th>
                <th>Fasilitas Pesanan</th>
                <th>Status</th>
                <th>Price</th>
                <th>Action</th>
              </tr>
            </thead>
            <tbody>';
            foreach ($emps as $emp) {
                $output .= '<tr>
                <td>' . $p++ . '</td>
                <td>' . $emp->booking_date . '</td>
                <td>' . $emp->batas_bayar . '</td>
                <td>' . $emp->order_no . '</td>
                <td>' . Mitra::where('id',  $emp->fasilitaskolam->idmitra)->first()->namamitra . '</td>
                <td>' . $emp->fasilitaskolam->fasilmitra->fasilitas->jenisfasilitas->namajenisfasilitas . ' - ' . $emp->fasilitaskolam->fasilmitra->fasilitas->namafasilitas . '</td>
                <td>' . $emp->status . '</td>
                <td> Rp. ' . number_format($emp->price) . '</td>
                <td>';
                if ($emp->status === 'unpaid') {
                    $output .= '<a class="btn btn-info mr-2" href="' . $emp->link_pembayaran . '">Bayar</a>';
                    $output .= '<a class="btn btn-success" href="' . route('cekpesananviewdetail', $emp->order_no) . '">Detail</a>';
                } else {
                    $output .= '<a class="btn btn-success" href="' . route('cekpesananviewdetail', $emp->order_no) . '">Detail</a>';
                }
                $output .= '</td>
              </tr>';
            }
            $output .= '</tbody></table>';
            echo $output;
        } else {
            echo '<h1 class="text-center text-secondary my-5">No record present in the database!</h1>';
        }
    }

    public function cekpesananviewmitra()
    {
        return view('detail.cekpesananmitra');
    }
    public function cekpesananmitra()
    {
        $user = Auth::user()->id;
        $mitra = Mitra::where('id_user', $user)->first();
        $emps = Booking::where('idmitra', $mitra->id)->get();
        $output = '';
        $p = 1;
        if ($emps->count() > 0) {
            $output .= '<table class="table table-bordered table-md display nowrap" style="width:100%">
            <thead>
              <tr>
                <th>No</th>
                <th>Booking Date</th>
                <th>Batas Bayar</th>
                <th>Order No</th>
                <th>Penyedia Fasilitas</th>
                <th>Fasilitas Pesanan</th>
                <th>Status</th>
                <th>Price</th>
                <th>Action</th>
              </tr>
            </thead>
            <tbody>';
            foreach ($emps as $emp) {
                $output .= '<tr>
                <td>' . $p++ . '</td>
                <td>' . $emp->booking_date . '</td>
                <td>' . $emp->batas_bayar . '</td>
                <td>' . $emp->order_no . '</td>
                <td>' . Mitra::where('id',  $emp->fasilitaskolam->idmitra)->first()->namamitra . '</td>
                <td>' . $emp->fasilitaskolam->fasilmitra->fasilitas->jenisfasilitas->namajenisfasilitas . ' - ' . $emp->fasilitaskolam->fasilmitra->fasilitas->namafasilitas . '</td>
                <td>' . $emp->status . '</td>
                <td> Rp. ' . number_format($emp->price) . '</td>
                <td>';
                if ($emp->status === 'unpaid') {
                    $output .= '<a class="btn btn-success" href="' . route('cekpesananviewdetailmitra', $emp->order_no) . '">Detail</a>';
                } else {
                    $output .= '<a class="btn btn-success" href="' . route('cekpesananviewdetailmitra', $emp->order_no) . '">Detail</a>';
                }
                $output .= '</td>
              </tr>';
            }
            $output .= '</tbody></table>';
            echo $output;
        } else {
            echo '<h1 class="text-center text-secondary my-5">No record present in the database!</h1>';
        }
    }
}
