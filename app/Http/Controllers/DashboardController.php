<?php

namespace App\Http\Controllers;

use App\Models\Booking;
use App\Models\FasilitasKolangRenang;
use App\Models\FasilitasMitra;
use App\Models\Mitra;
use App\Models\PendapatanMitra;
use App\Models\PerjanjianMitra;
use App\Models\Sop;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;

class DashboardController extends Controller
{
    public function index()
    {
        $tanggalhariini = Carbon::now()->Format('Y-m-d');

        $mitra = Mitra::where('id_user', Auth::user()->id)->first();
        // dd(Auth::user()->id);
        if ($mitra) {
            $perjanjianmitra = PerjanjianMitra::where('idmitra', $mitra->id)->where('tglawalberlaku', '<=', $tanggalhariini)->where('tglakhirberlaku', '>=', $tanggalhariini)->first();
            if ($perjanjianmitra != null) {
                $pendapatan = PendapatanMitra::where('idmitra', $mitra->id)->sum('nilaiuang');
                $paid = Booking::where('idmitra', $mitra->id)->where('status', 'paid')->count();
                $unpaid = Booking::where('idmitra', $mitra->id)->where('status', 'unpaid')->count();
                $fasilitasmitra = FasilitasMitra::where('idmitra', $mitra->id)->count();
                $fasilitaskolamrenang = FasilitasKolangRenang::where('idmitra', $mitra->id)->count();
                $totsop = [];
                foreach (FasilitasMitra::where('idmitra', $mitra->id)->get() as $fal) {
                    array_push($totsop, Sop::where('idfasilmitra', $fal->id)->count());
                }
                $totalsop = array_sum($totsop);
            } else {
                $paid = "Perjanjian Sudah Berakhir";
                $unpaid = "Perjanjian Sudah Berakhir";
                $pendapatan = "Perjanjian Sudah Berakhir";
                $fasilitasmitra = "Perjanjian Sudah Berakhir";
                $fasilitaskolamrenang = "Perjanjian Sudah Berakhir";
                $totalsop = "Perjanjian Sudah Berakhir";
            }
            return view('dashboard', compact('paid', 'unpaid', 'pendapatan', 'fasilitasmitra', 'fasilitaskolamrenang', 'totalsop', 'mitra'));
        } else {

            return view('dashboard');
        }
    }
    public function show_data(Request $request)
    {
        $customer_search = $request->name;

        if ($customer_search != '') {
            $output = '';
            $data = DB::table('mitra')
                ->where('namamitra', 'like', '%' . $customer_search . '%')
                ->orWhere('alamatmitralengkap', 'like', '%' . $customer_search . '%')
                ->orderBy('id', 'desc')
                ->get()->take(5);

            $row_data = count($data);
            if ($row_data > 0) {
                foreach ($data as $key => $row) {
                    $output .= '<div class="card shadow ml-3 mr-3"><div class="card-header">
                            <div><img class="mr-3 rounded" width="30" height="30" src="' . asset('mitrafoto/' . $row->foto) . '" alt="image"></div>
					         <div><a href="' . route('detailmitra', $row->id) . '"><b>' . $row->namamitra . '</b></a></div> &nbsp;
					         <div>' . $row->alamatmitralengkap . '</div>
					        </div> </div>';
                }
            } else {
                $output .= '<div class="card shadow ml-3 mr-3">
                                <div class="card-header">Pencarian tidak valid<div>
                            </div>';
            }
            echo $output;
        } else {
            $output = '';
            echo $output;
        }
    }
}
