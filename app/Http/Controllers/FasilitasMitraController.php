<?php

namespace App\Http\Controllers;

use App\Models\Fasilitas;
use App\Models\FasilitasKolangRenang;
use App\Models\FasilitasMitra;
use App\Models\JadwalFasilitasKolam;
use App\Models\Mitra;
use App\Models\PerjanjianMitra;
use App\Models\Sop;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class FasilitasMitraController extends Controller
{
    public function index($idperjanjian)
    {
        $tanggalhariini = Carbon::now()->Format('Y-m-d');
        // dd($mitra);
        $perjanjianmitra = PerjanjianMitra::where('id', $idperjanjian)->first();
        $mitra = Mitra::where('id', $perjanjianmitra->idmitra)->first();
        // dd($tanggalhariini);
        // dd($perjanjianmitra);
        // $idmitra = $perjanjianmitra->idmitra;
        if ($perjanjianmitra != null) {
            $fasilitas = Fasilitas::where('idjenisfasilitas', $mitra->idjenismitra)->get();
            return view('fasilitasmitra.index', compact('idperjanjian', 'mitra', 'fasilitas', 'perjanjianmitra'));
        } else {
            $fasilitas = Fasilitas::where('idjenisfasilitas', $mitra->idjenismitra)->get();
            return view('fasilitasmitra.index', compact('idperjanjian', 'mitra', 'fasilitas'));
            // return 'error';
        }
    }



    public function all($idperjanjian)
    {
        // <td><img src="/storage/images/' . $emp->image . '" width="50" class="img-thumbnail rounded-circle"></td>
        $tanggalhariini = Carbon::now()->Format('Y-m-d');
        $perjanjianmitra = PerjanjianMitra::where('id', $idperjanjian)->where('tglawalberlaku', '<=', $tanggalhariini)->where('tglakhirberlaku', '>=', $tanggalhariini)->first();
        if ($perjanjianmitra != null) {
            $emps = FasilitasMitra::where('idperjanjianmitra', $idperjanjian)->get();
            $output = '';
            $p = 1;
            if ($emps->count() > 0) {
                $output .= '<table class="table table-bordered table-md display nowrap" style="width:100%">
            <thead>
              <tr>
                <th>No</th>
                <th>Jenis Fasilitas</th>
                <th>Deskripsi</th>
                <th>Spesifikasi</th>
                <th>Sop Fasilitas</th>
                <th>Jadwal Buka</th>
                <th>Harga Sepakat</th>
                <th>Action</th>
              </tr>
            </thead>
            <tbody>';
                foreach ($emps as $emp) {
                    // $perjanjianmitra = PerjanjianMitra::where('id', $idperjanjian)->where('tglawalberlaku', '<=', $tanggalhariini)->where('tglakhirberlaku', '>=', $tanggalhariini)->first();

                    $output .= '<tr>
                <td>' . $p++ . '</td>
                <td>' . $emp->fasilitas->namafasilitas . ' / ' . $emp->fasilitas->jenisfasilitas->namajenisfasilitas . '</td>
                <td>' . $emp->deskrispsifasilitas . '</td>
                <td>' . $emp->specfasilitasi . '</td>';
                    $output .= ' <td> (' . Sop::where('idfasilmitra', $emp->id)->count() . ') <a href="' . route('sop', $emp->id) . '" class="badge badge-info" >Lihat</a></td>';
                    $output .= '<td>(' . JadwalFasilitasKolam::where('idfasilmitra', $emp->id)->count() . ') <a href="' . route('jadwalfasilitaskolam', $emp->id) . '" class="badge badge-info">Lihat</a></td>';
                    if ($perjanjianmitra != null) {
                        $output .= ' <td> (' . FasilitasKolangRenang::where('idperjanjianmitra', $idperjanjian)->where('idfasilmitra', $emp->id)->count() . ') <a href="' . route('fasilitas-kolam-renang', $emp->id) . '" class="badge badge-info">Lihat</a></td>';
                    } else {

                        $output .= ' <td>Perjanjian Mitra sudah Tidak berlaku <a href="' . route('fasilitas-kolam-renang', $emp->id) . '" class="badge badge-info">Lihat</a></td>';
                    }
                    $output .= ' <td>
                  <a href="#" id="' . $emp->id . '" class="text-success mx-1 editIcon" data-toggle="modal" data-target="#editTUModal"><i class="ion-edit h4" data-pack="default" data-tags="on, off"></i></a>
                  <a href="#" id="' . $emp->id . '" class="text-danger mx-1 deleteIcon"><i class="ion-trash-a h4" data-pack="default" data-tags="on, off"></i></a>
                </td>
              </tr>';
                }
                $output .= '</tbody></table>';
                echo $output;
            } else {
                echo '<h1 class="text-center text-secondary my-5">No record present in the database!</h1>';
            }
        } else {
            $output = '<h3>Perjanjian Mitra Sudah Berakhir</h3>';

            echo $output;
        }
    }
    public function indexmitra($idperjanjian)
    {
        $tanggalhariini = Carbon::now()->Format('Y-m-d');
        // dd($mitra);
        $perjanjianmitra = PerjanjianMitra::where('id', $idperjanjian)->where('tglakhirberlaku', $tanggalhariini)->first();
        if ($perjanjianmitra != null) {
            $mitra = Mitra::where('id', $perjanjianmitra->idmitra)->first();
            $fasilitas = Fasilitas::where('idjenisfasilitas', $mitra->idjenismitra)->get();
            return view('fasilitasmitra.indexmitra', compact('idperjanjian', 'mitra', 'fasilitas', 'perjanjianmitra'));
        } else {
            // $fasilitas = Fasilitas::where('idjenisfasilitas', $mitra->idjenismitra)->get();
            $mitra = Mitra::where('id_user', Auth::user()->id)->first();
            return view('fasilitasmitra.indexmitra', compact('idperjanjian', 'mitra'));
        }
    }



    public function allmitra($idperjanjian)
    {
        $tanggalhariini = Carbon::now()->Format('Y-m-d');
        $perjanjianmitra = PerjanjianMitra::where('id', $idperjanjian)->where('tglawalberlaku', '<=', $tanggalhariini)->where('tglakhirberlaku', '>=', $tanggalhariini)->first();
        if ($perjanjianmitra != null) {
            $emps = FasilitasMitra::where('idperjanjianmitra', $idperjanjian)->get();
            $output = '';
            $p = 1;
            if ($emps->count() > 0) {
                $output .= '<table class="table table-bordered table-md display nowrap" style="width:100%">
            <thead>
              <tr>
                <th>No</th>
                <th>Jenis Fasilitas</th>
                <th>Deskripsi</th>
                <th>Spesifikasi</th>
                <th>Sop Fasilitas</th>
                <th>Jadwal Buka</th>
                <th>Harga Sepakat</th>
              </tr>
            </thead>
            <tbody>';
                foreach ($emps as $emp) {
                    // $perjanjianmitra = PerjanjianMitra::where('id', $idperjanjian)->where('tglawalberlaku', '<=', $tanggalhariini)->where('tglakhirberlaku', '>=', $tanggalhariini)->first();

                    $output .= '<tr>
                <td>' . $p++ . '</td>
                <td>' . $emp->fasilitas->namafasilitas . ' / ' . $emp->fasilitas->jenisfasilitas->namajenisfasilitas . '</td>
                <td>' . $emp->deskrispsifasilitas . '</td>
                <td>' . $emp->specfasilitasi . '</td>';
                    $output .= ' <td> (' . Sop::where('idfasilmitra', $emp->id)->count() . ') <a href="' . route('sopmitra', $emp->id) . '" class="badge badge-info" >Lihat</a></td>';
                    $output .= '<td>(' . JadwalFasilitasKolam::where('idfasilmitra', $emp->id)->count() . ') <a href="' . route('jadwalfasilitaskolammitra', $emp->id) . '" class="badge badge-info">Lihat</a></td>';
                    if ($perjanjianmitra != null) {
                        $output .= ' <td> (' . FasilitasKolangRenang::where('idperjanjianmitra', $idperjanjian)->where('idfasilmitra', $emp->id)->count() . ') <a href="' . route('fasilitas-kolam-renangmitra', $emp->id) . '" class="badge badge-info">Lihat</a></td>';
                    } else {

                        $output .= ' <td>Perjanjian Mitra sudah Tidak berlaku <a href="' . route('fasilitas-kolam-renangmitra', $emp->id) . '" class="badge badge-info">Lihat</a></td>';
                    }
                    $output .= '</tr>';
                }
                $output .= '</tbody></table>';
                echo $output;
            } else {
                echo '<h1 class="text-center text-secondary my-5">No record present in the database!</h1>';
            }
        } else {
            $output = '<h3>Perjanjian Mitra Sudah Berakhir</h3>';

            echo $output;
        }
    }

    public function indexriwayat($idperjanjian)
    {
        $tanggalhariini = Carbon::now()->Format('Y-m-d');
        // dd($mitra);
        $perjanjianmitra = PerjanjianMitra::where('id', $idperjanjian)->first();
        $mitra = Mitra::where('id', $perjanjianmitra->idmitra)->first();
        return view('fasilitasmitra.indexriwayat', compact('mitra', 'perjanjianmitra', 'idperjanjian'));
    }

    public function allriwayat($idperjanjian)
    {
        $perjanjianmitra = PerjanjianMitra::where('id', $idperjanjian)->first();
        $emps = FasilitasMitra::where('idperjanjianmitra', $perjanjianmitra->id)->get();
        $output = '';
        $p = 1;
        if ($emps->count() > 0) {
            $output .= '<table class="table table-bordered table-md display nowrap" style="width:100%">
            <thead>
              <tr>
                <th>No</th>
                <th>Jenis Fasilitas</th>
                <th>Deskripsi</th>
                <th>Spesifikasi</th>
                <th>Sop Fasilitas</th>
                <th>Jadwal Buka</th>
                <th>Harga Sepakat</th>
              </tr>
            </thead>
            <tbody>';
            foreach ($emps as $emp) {

                $output .= '<tr>
                <td>' . $p++ . '</td>
                <td>' . $emp->fasilitas->namafasilitas . '</td>
                <td>' . $emp->deskrispsifasilitas . '</td>
                <td>' . $emp->specfasilitasi . '</td>';
                $output .= ' <td> (' . Sop::where('idfasilmitra', $emp->id)->count() . ') <a href="' . route('sop-riwayat', $emp->id) . '" class="badge badge-info" >Lihat</a></td>';
                $output .= '<td>(' . JadwalFasilitasKolam::where('idfasilmitra', $emp->id)->count() . ') <a href="' . route('jadwalfasilitaskolam-riwayat', $emp->id) . '" class="badge badge-info">Lihat</a></td>';
                if ($perjanjianmitra != null) {
                    $output .= ' <td> (' . FasilitasKolangRenang::where('idperjanjianmitra', $idperjanjian)->where('idfasilmitra', $emp->id)->count() . ') <a href="' . route('fasilitas-kolam-renang-riwayat', $emp->id) . '" class="badge badge-info">Lihat</a></td>';
                } else {

                    $output .= ' <td>Perjanjian Mitra sudah Tidak berlaku <a href="' . route('fasilitas-kolam-renang', $emp->id) . '" class="badge badge-info">Lihat</a></td>';
                }
                $output .= '</tr>';
            }
            $output .= '</tbody></table>';
            echo $output;
        } else {
            echo '<h1 class="text-center text-secondary my-5">No record present in the database!</h1>';
        }
    }

    // handle insert a new Tu ajax request
    public function store(Request $request)
    {
        $tanggalhariini = Carbon::now()->Format('Y-m-d');
        $perjanjianmitra = PerjanjianMitra::where('idmitra', $request->idmitra)->where('tglawalberlaku', '<=', $tanggalhariini)->where('tglakhirberlaku', '>=', $tanggalhariini)->first();
        $empData = [
            'idmitra' => $request->idmitra,
            'idperjanjianmitra' => $perjanjianmitra->id,
            'idfasilitas' => $request->idfasilitas,
            'deskrispsifasilitas' => $request->deskrispsifasilitas,
            'specfasilitasi' => $request->specfasilitasi
        ];
        FasilitasMitra::create($empData);
        return response()->json([
            'status' => 200,
        ]);
    }

    // handle edit an Tu ajax request
    public function edit(Request $request)
    {
        // dd($request->all());
        $id = $request->id;
        $emp = FasilitasMitra::where('id', $id)->first();
        return response()->json($emp);
    }

    // handle update an Tu ajax request
    public function update(Request $request)
    {
        $emp = FasilitasMitra::Find($request->id);
        $empData = [
            'idfasilitas' => $request->idfasilitas,
            'deskrispsifasilitas' => $request->deskrispsifasilitas,
            'specfasilitasi' => $request->specfasilitasi
        ];
        $emp->update($empData);
        return response()->json([
            'status' => 200,
        ]);
    }

    // handle delete an Tu ajax request
    public function delete(Request $request)
    {
        $id = $request->id;
        FasilitasMitra::destroy($id);
    }
}
