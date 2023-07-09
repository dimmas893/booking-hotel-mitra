<?php

namespace App\Http\Controllers;

use App\Models\Fasilitas;
use App\Models\FasilitasMitra;
use App\Models\HargaSepakatMitra;
use App\Models\Mitra;
use App\Models\PerjanjianMitra;
use App\Models\UnitSewaFasilitas;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Str;

class PerjanjianMitraController extends Controller
{
    public function index($id)
    {
        $mitra = Mitra::find($id);
        $unit = UnitSewaFasilitas::get();
        $id = $id;
        $fasilitas = Fasilitas::get();
        $fasilitas = Fasilitas::where('idjenisfasilitas', $mitra->idjenismitra)->get();
        return view('perjanjianmitra.index', compact('id', 'unit', 'fasilitas'));
    }

    // handle fetch all eamployees ajax request
    public function all($id)
    {
        // <td><img src="/storage/images/' . $emp->image . '" width="50" class="img-thumbnail rounded-circle"></td>
        $tanggalhariini = Carbon::now()->Format('Y-m-d');
        $emps = PerjanjianMitra::where('idmitra', $id)->get();
        $output = '';
        $p = 1;
        if ($emps->count() > 0) {
            $output .= '<table class="table table-bordered table-md display nowrap" style="width:100%">
            <thead>
              <tr>
                <th>No</th>
                <th>Nomor Perjanjian</th>
                <th>Tanggal Awal Berlaku</th>
                <th>Tanggal Akhir Berlaku</th>
                <th>Tanggal Di Tandatangani</th>
                <th>Nama Pihak Owner 1</th>
                <th>Nama Pihak Owner 2</th>
                <th>Nama Pihak Mitra 1</th>
                <th>Nama Pihak Mitra 2</th>
                <th>Harga Sepakat Mitra</th>
                <th>Fasilitas</th>
                <th>Action</th>
              </tr>
            </thead>
            <tbody>';
            foreach ($emps as $emp) {
                $fasilitascount = FasilitasMitra::where('idperjanjianmitra', $emp->id)->count();
                $hargasepakatmitracount = HargaSepakatMitra::where('idperjanjianmitra', $emp->id)->count();
                $hargasepakatmitraget = HargaSepakatMitra::where('idperjanjianmitra', $emp->id)->get();
                $unitsewa = UnitSewaFasilitas::count();
                $output .= '<tr>
                <td>' . $p++ . '</td>
                <td>' . $emp->noperjanjian . '</td>
                <td>' . $emp->tglawalberlaku . '</td>
                <td>' . $emp->tglakhirberlaku . '</td>
                <td>' . $emp->tglditandatangani . '</td>
                <td>' . $emp->namapihakowner1 . '</td>
                <td>' . $emp->namapihakowner2 . '</td>
                <td>' . $emp->namapihakmitra1 . '</td>
                <td>' . $emp->namapihakmitra2 . '</td>';
                if ($emp->tglakhirberlaku < $tanggalhariini) {
                    $output .= '<td>';
                    foreach ($hargasepakatmitraget as $get) {
                        $output .= '<p>Rp. ' . $get->hargaperorang . ' / ' . UnitSewaFasilitas::where('id', $get->idunit)->first()->namaunit . '</p>';
                    }
                    // dd($tanggalhariini);
                    $output .= '</td>';
                    $output .= '<td>Perjanjian sudah tidak berlaku (' . $fasilitascount . ' Fasilitas) <a href="' . route('fasilitas-mitra-riwayat', $emp->id) . '" class="badge badge-info">Lihat Riwayat</a></td>';
                } else {
                    $output .= '<td>';
                    foreach ($hargasepakatmitraget as $get) {
                        $output .= '<p>' . $get->fasilitas->namafasilitas . ' / ' . $get->fasilitas->jenisfasilitas->namajenisfasilitas . ' Rp. ' . number_format($get->hargaperorang) . ' / ' . UnitSewaFasilitas::where('id', $get->idunit)->first()->namaunit . '<a href="#" id="' . $get->id . '" class="badge badge-primary mx-1 edithargaperjanjianmitra" data-toggle="modal" data-target="#edithargaperjanjianmitramodal">Edit Harga</a></p>';
                    }

                    $output .= '<p><a href="#" id="' . $emp->id . '" class="badge badge-primary mx-1 editIcon_harga" data-toggle="modal" data-target="#add_TU_modal_harga">Tambah Harga Perjanjian</a></p>';

                    // dd($tanggalhariini);
                    $output .= '</td>';
                    $output .= '<td>(' . $fasilitascount . ' Fasilitas) Perjanjian Masih Berlaku</td>';
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
    }
    public function indexmitra($id)
    {
        $mitra = Mitra::find($id);
        // dd($mitra);
        $unit = UnitSewaFasilitas::get();
        $id = $id;
        return view('perjanjianmitra.indexmitra', compact('id', 'unit'));
    }

    // handle fetch all eamployees ajax request
    public function allmitra($id)
    {
        // <td><img src="/storage/images/' . $emp->image . '" width="50" class="img-thumbnail rounded-circle"></td>
        $tanggalhariini = Carbon::now()->Format('Y-m-d');
        $emps = PerjanjianMitra::where('idmitra', $id)->get();
        $output = '';
        $p = 1;
        if ($emps->count() > 0) {
            $output .= '<table class="table table-bordered table-md display nowrap" style="width:100%">
            <thead>
              <tr>
                <th>No</th>
                <th>Nomor Perjanjian</th>
                <th>Tanggal Awal Berlaku</th>
                <th>Tanggal Akhir Berlaku</th>
                <th>Tanggal Di Tandatangani</th>
                <th>Nama Pihak Owner 1</th>
                <th>Nama Pihak Owner 2</th>
                <th>Nama Pihak Mitra 1</th>
                <th>Nama Pihak Mitra 2</th>
                <th>Harga Sepakat Mitra</th>
                <th>Fasilitas</th>
              </tr>
            </thead>
            <tbody>';
            foreach ($emps as $emp) {
                $fasilitascount = FasilitasMitra::where('idperjanjianmitra', $emp->id)->count();
                $hargasepakatmitracount = HargaSepakatMitra::where('idperjanjianmitra', $emp->id)->count();
                $hargasepakatmitraget = HargaSepakatMitra::where('idperjanjianmitra', $emp->id)->get();
                $unitsewa = UnitSewaFasilitas::count();
                $output .= '<tr>
                <td>' . $p++ . '</td>
                <td>' . $emp->noperjanjian . '</td>
                <td>' . $emp->tglawalberlaku . '</td>
                <td>' . $emp->tglakhirberlaku . '</td>
                <td>' . $emp->tglditandatangani . '</td>
                <td>' . $emp->namapihakowner1 . '</td>
                <td>' . $emp->namapihakowner2 . '</td>
                <td>' . $emp->namapihakmitra1 . '</td>
                <td>' . $emp->namapihakmitra2 . '</td>';
                if ($emp->tglakhirberlaku < $tanggalhariini) {
                    $output .= '<td>';
                    foreach ($hargasepakatmitraget as $get) {
                        $output .= '<p>Rp. ' . $get->hargaperorang . ' / ' . UnitSewaFasilitas::where('id', $get->idunit)->first()->namaunit . '</p>';
                    }
                    // dd($tanggalhariini);
                    $output .= '</td>';
                    $output .= '<td>Perjanjian sudah tidak berlaku (' . $fasilitascount . ' Fasilitas) <a href="' . route('fasilitas-mitra-riwayat', $emp->id) . '" class="badge badge-info">Lihat Riwayat</a></td>';
                } else {
                    $output .= '<td>';
                    foreach ($hargasepakatmitraget as $get) {
                        $output .= '<p>' . $get->fasilitas->namafasilitas . ' / ' . $get->fasilitas->jenisfasilitas->namajenisfasilitas . ' Rp. ' . number_format($get->hargaperorang) . ' / ' . UnitSewaFasilitas::where('id', $get->idunit)->first()->namaunit . '</p>';
                    }
                    // dd($tanggalhariini);
                    $output .= '</td>';
                    $output .= '<td><p>(' . $fasilitascount . 'Fasilitas) Perjanjian Masih Berlaku</p></td>';
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
        $empData = [
            'idmitra' => $request->idmitra,
            'noperjanjian' => 'perjanjian' . Str::random(5),
            'tglawalberlaku' => $request->tglawalberlaku,
            'tglakhirberlaku' => $request->tglakhirberlaku,
            'tglditandatangani' => $request->tglditandatangani,
            'namapihakowner1' => $request->namapihakowner1,
            'namapihakowner2' => $request->namapihakowner2,
            'namapihakmitra1' => $request->namapihakmitra1,
            'namapihakmitra2' => $request->namapihakmitra2,
        ];
        PerjanjianMitra::create($empData);
        return response()->json([
            'status' => 200,
        ]);
    }

    // handle update an Tu ajax request
    public function update(Request $request)
    {
        // dd($request->all());
        $emp = PerjanjianMitra::Find($request->id);
        $empData = [
            'tglawalberlaku' => $request->tglawalberlaku,
            'tglakhirberlaku' => $request->tglakhirberlaku,
            'tglditandatangani' => $request->tglditandatangani,
            'namapihakowner1' => $request->namapihakowner1,
            'namapihakowner2' => $request->namapihakowner2,
            'namapihakmitra1' => $request->namapihakmitra1,
            'namapihakmitra2' => $request->namapihakmitra2,
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
        HargaSepakatMitra::where('idperjanjianmitra', $id)->delete();
        PerjanjianMitra::destroy($id);
    }
}
