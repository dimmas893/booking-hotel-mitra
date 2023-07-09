<?php

namespace App\Http\Controllers;

use App\Models\Booking;
use App\Models\Mitra;
use Illuminate\Http\Request;

class PesananAdminController extends Controller
{
    public function pembayaranadmin($order_no)
    {
        $booking = Booking::where('order_no', $order_no)->first();
        $booking->update(['status' => 'paid']);
        return back();
    }
    public function pesananadmin()
    {
        return view('pesanan.pesananadmin');
    }
    public function pesananadminajax()
    {
        $emps = Booking::get();
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
