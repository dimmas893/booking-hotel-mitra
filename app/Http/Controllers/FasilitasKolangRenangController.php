<?php

namespace App\Http\Controllers;

use App\Models\Fasilitas;
use App\Models\FasilitasKolangRenang;
use App\Models\FasilitasMitra;
use App\Models\HargaSepakatMitra;
use App\Models\PerjanjianMitra;
use App\Models\UnitSewaFasilitas;
use Carbon\Carbon;
use Illuminate\Http\Request;

class FasilitasKolangRenangController extends Controller
{
    // set index page view
    public function index($fasilitaskolamrenangid)
    {

        $tanggalhariini = Carbon::now()->Format('Y-m-d');
        $fasilitasmitra = FasilitasMitra::where('id', $fasilitaskolamrenangid)->first();
        $sepakatmitra = HargaSepakatMitra::where('idperjanjianmitra', $fasilitasmitra->idperjanjianmitra)->get();
        $unit = UnitSewaFasilitas::get();
        $fasilitas = Fasilitas::get();
        return view('fasilitaskolamrenang.index', compact('fasilitaskolamrenangid', 'fasilitasmitra', 'sepakatmitra', 'unit', 'fasilitas'));
    }
    public function all($fasilitaskolamrenangid)
    {
        $fasilitasmitra = FasilitasMitra::where('id', $fasilitaskolamrenangid)->first();
        $emps = FasilitasKolangRenang::where('idfasilmitra', $fasilitasmitra->id)->get();
        $output = '';
        $p = 1;
        if ($emps->count() > 0) {
            $output .= '<table class="table table-bordered table-md display nowrap" style="width:100%">
            <thead>
              <tr>
                <th>No</th>
                <th>Harga Kesepakatan</th>
                <th>Unit</th>
                <th>Action</th>
              </tr>
            </thead>
            <tbody>';
            foreach ($emps as $emp) {
                $output .= '<tr>
                <td>' . $p++ . '</td>
                <td>Rp. ' . number_format($emp->biayaperorang) . '</td>
                <td>' . $emp->unit->namaunit . '</td>
                <td>
                  <a href="#" id="' . $emp->id . '" class="text-danger mx-1 deleteIcon"><i class="ion-trash-a h4" data-pack="default" data-tags="on, off"></i></a>
                </td>
              </tr>';
            }
            $output .= '</tbody></table>';
            echo $output;
        } else {
            echo '<h1 class="text-center text-secondary my-5">No record present in the database!</h1>';
        }
    }

    public function indexmitra($fasilitaskolamrenangid)
    {

        $tanggalhariini = Carbon::now()->Format('Y-m-d');
        $fasilitasmitra = FasilitasMitra::where('id', $fasilitaskolamrenangid)->first();
        $sepakatmitra = HargaSepakatMitra::where('idperjanjianmitra', $fasilitasmitra->idperjanjianmitra)->get();
        $unit = UnitSewaFasilitas::get();
        $fasilitas = Fasilitas::get();
        return view('fasilitaskolamrenang.indexmitra', compact('fasilitaskolamrenangid', 'fasilitasmitra', 'sepakatmitra', 'unit', 'fasilitas'));
    }
    public function allmitra($fasilitaskolamrenangid)
    {
        $fasilitasmitra = FasilitasMitra::where('id', $fasilitaskolamrenangid)->first();
        $emps = FasilitasKolangRenang::where('idfasilmitra', $fasilitasmitra->id)->get();
        $output = '';
        $p = 1;
        if ($emps->count() > 0) {
            $output .= '<table class="table table-bordered table-md display nowrap" style="width:100%">
            <thead>
              <tr>
                <th>No</th>
                <th>Harga Kesepakatan</th>
                <th>Unit</th>
              </tr>
            </thead>
            <tbody>';
            foreach ($emps as $emp) {
                $output .= '<tr>
                <td>' . $p++ . '</td>
                <td>Rp. ' . number_format($emp->biayaperorang) . '</td>
                <td>' . $emp->unit->namaunit . '</td>
              </tr>';
            }
            $output .= '</tbody></table>';
            echo $output;
        } else {
            echo '<h1 class="text-center text-secondary my-5">No record present in the database!</h1>';
        }
    }

    public function indexriwayat($idfasilitasmitra)
    {
        $tanggalhariini = Carbon::now()->Format('Y-m-d');
        $fasilitasmitra = FasilitasMitra::where('id', $idfasilitasmitra)->first();
        $perjanjianmitra = PerjanjianMitra::where('id', $fasilitasmitra->idperjanjianmitra)->first();

        $sepakatmitra = HargaSepakatMitra::where('idperjanjianmitra', $perjanjianmitra->id)->get();
        // dd($sepakatmitra);
        return view('fasilitaskolamrenang.indexriwayat', compact('idfasilitasmitra', 'fasilitasmitra', 'sepakatmitra'));
    }
    public function allriwayat($idfasilitasmitra)
    {
        $fasilitasmitra = FasilitasMitra::where('id', $idfasilitasmitra)->first();
        $emps = FasilitasKolangRenang::where('idperjanjianmitra', $fasilitasmitra->idperjanjianmitra)->get();
        $output = '';
        $p = 1;
        if ($emps->count() > 0) {
            $output .= '<table class="table table-bordered table-md display nowrap" style="width:100%">
            <thead>
              <tr>
                <th>No</th>
                <th>Harga Kesepakatan</th>
                <th>Unit</th>
              </tr>
            </thead>
            <tbody>';
            foreach ($emps as $emp) {
                $output .= '<tr>
                <td>' . $p++ . '</td>
                <td>Rp. ' . $emp->biayaperorang . '</td>
                <td>' . $emp->unit->namaunit . '</td>
              </tr>';
            }
            $output .= '</tbody></table>';
            echo $output;
        } else {
            echo '<h1 class="text-center text-secondary my-5">No record present in the database!</h1>';
        }
    }

    public function ajax(Request $request, $fasilitaskolamrenangid)
    {
        // dd($request->all());
        $tanggalhariini = Carbon::now()->Format('Y-m-d');
        $fasilitasmitra = FasilitasMitra::where('id', $fasilitaskolamrenangid)->first();
        // $perjanjianmitra = PerjanjianMitra::where('idmitra', $fasilitasmitra->idmitra)->where('tglawalberlaku', '<=', $tanggalhariini)->where('tglakhirberlaku', '>=', $tanggalhariini)->first();
        // dd($perjanjianmitra);
        $id = (int)$request->id;
        $emps = HargaSepakatMitra::where('idperjanjianmitra', $fasilitasmitra->idperjanjianmitra)->where('idfasilitas', $fasilitasmitra->idfasilitas)->where('idunit', $id)->get();
        // dd($emps);
        $output = '';
        if ($emps->count() > 0) {
            $output .= '<label>Harga Sewa</label>
            <select name="hargasepakatid" class="form-control">
						<option value="" selected disabled>---Pilih Harga Sewa---</option>
			';
            foreach ($emps as $emp) {
                $output .= '<option value="' . $emp->id . '" >Rp. ' . number_format($emp->hargaperorang) . '</option>';
            }
            $output .= '</select>';
            // $output .= '<input type="text" name="jurusan" class="form-control" placeholder="Masukan jurusan" required/>';
            echo $output;
        } else {
            $output .= '<label>Harga Sewa</label>
            <select name="hargasepakatid" class="form-control">
			';
            $output .= '<option value="belumtersedia" >Kesepakatan harga di unit ini belum tersedia</option>';
            $output .= '</select>';
            // $output .= '<input type="text" name="jurusan" class="form-control" placeholder="Masukan jurusan" required/>';
            echo $output;
        }
    }

    // handle insert a new Tu ajax request
    public function store(Request $request)
    {

        // dd($request->all());
        $emps = HargaSepakatMitra::where('id', $request->hargasepakatid)->first();

        if ($emps != null) {
            $cek = FasilitasKolangRenang::where('idmitra', $request->idmitra)
                ->where('idfasilmitra', $request->idfasilmitra)
                ->where('idsepakatmitra', $emps->id)
                ->where('biayaperorang', $emps->hargaperorang)
                ->where('idunit', $emps->idunit)
                ->first();
        }
        // dd($emps);
        if ($request->hargasepakatid === 'belumtersedia') {
            return response()->json([
                'status' => 300,
            ]);
        } else {
            if ($cek === null) {
                $admin = [
                    'idperjanjianmitra' => $emps->idperjanjianmitra,
                    'idmitra' => $request->idmitra,
                    'idfasilmitra' => $request->idfasilmitra,
                    'idsepakatmitra' => $emps->id,
                    'biayaperorang' => $emps->hargaperorang,
                    'idunit' => $emps->idunit,
                ];
                FasilitasKolangRenang::create($admin);
                return response()->json([
                    'status' => 200,
                ]);
            } else {
                return response()->json([
                    'status' => 400,
                ]);
            }
        }
    }


    // handle edit an Tu ajax request
    public function edit(Request $request)
    {
        $id = $request->id;
        $emp = FasilitasKolangRenang::with('user')->where('id', $id)->first();
        return response()->json($emp);
    }

    // handle update an Tu ajax request
    public function update(Request $request)
    {
        // dd($request->all());
        $emp = FasilitasKolangRenang::Find($request->id);
        $empData = [
            'name' => $request->name,
            'email' => $request->email
        ];
        $emp->update($empData);
        return response()->json([
            'status' => 200,
        ]);
    }

    public function delete(Request $request)
    {
        $id = $request->id;
        $admin = FasilitasKolangRenang::where('id', $id)->first();
        $admin->delete();
        // Admin::destroy($id);
    }
}
