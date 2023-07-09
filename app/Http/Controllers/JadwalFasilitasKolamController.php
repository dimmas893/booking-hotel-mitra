<?php

namespace App\Http\Controllers;

use App\Models\FasilitasMitra;
use App\Models\JadwalFasilitasKolam;
use Illuminate\Http\Request;

class JadwalFasilitasKolamController extends Controller
{
    // set index page view
    public function dimmas()
    {
        dd('dsd');
    }

    public function indexriwayat($idfasilitas)
    {
        $fasilitasmitra = FasilitasMitra::where('id', $idfasilitas)->first();
        return view('jadwalfasilitaskolam.indexriwayat', compact('idfasilitas', 'fasilitasmitra'));
    }
    public function allriwayat($idfasilitas)
    {

        // <td><img src="/storage/photos/' . $emp->photo . '" width="50" class="img-thumbnail rounded-circle"></td>
        $emps = JadwalFasilitasKolam::where('idfasilmitra', $idfasilitas)->get();
        $output = '';
        $p = 1;
        if ($emps->count() > 0) {
            $output .= '<table class="table table-bordered table-md display nowrap" style="width:100%">
            <thead>
              <tr>
                <th>No</th>
                <th>Tanggal Buka</th>
                <th>Jam Buka</th>
                <th>Jam Tutup</th>
              </tr>
            </thead>
            <tbody>';
            foreach ($emps as $emp) {
                $output .= '<tr>
                <td>' . $p++ . '</td>
                <td>' . $emp->tanggalbuka . '</td>
                <td>' . substr($emp->jambuka, 0, 5) . '</td>
                <td>' . substr($emp->jamtutup, 0, 5) . '</td>
              </tr>';
            }
            $output .= '</tbody></table>';
            echo $output;
        } else {
            echo '<h1 class="text-center text-secondary my-5">No record present in the database!</h1>';
        }
    }
    public function index($idfasilitas)
    {
        $fasilitasmitra = FasilitasMitra::where('id', $idfasilitas)->first();
        return view('jadwalfasilitaskolam.index', compact('idfasilitas', 'fasilitasmitra'));
    }
    // handle fetch all eamployees ajax request
    public function all($idfasilitas)
    {

        // <td><img src="/storage/photos/' . $emp->photo . '" width="50" class="img-thumbnail rounded-circle"></td>
        $emps = JadwalFasilitasKolam::where('idfasilmitra', $idfasilitas)->get();
        $output = '';
        $p = 1;
        if ($emps->count() > 0) {
            $output .= '<table class="table table-bordered table-md display nowrap" style="width:100%">
            <thead>
              <tr>
                <th>No</th>
                <th>Tanggal Buka</th>
                <th>Jam Buka</th>
                <th>Jam Tutup</th>
                <th>Action</th>
              </tr>
            </thead>
            <tbody>';
            foreach ($emps as $emp) {
                $output .= '<tr>
                <td>' . $p++ . '</td>
                <td>' . $emp->tanggalbuka . '</td>
                <td>' . substr($emp->jambuka, 0, 5) . '</td>
                <td>' . substr($emp->jamtutup, 0, 5) . '</td>
                <td>
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

    public function indexmitra($idfasilitas)
    {
        $fasilitasmitra = FasilitasMitra::where('id', $idfasilitas)->first();
        return view('jadwalfasilitaskolam.indexmitra', compact('idfasilitas', 'fasilitasmitra'));
    }
    // handle fetch all eamployees ajax request
    public function allmitra($idfasilitas)
    {
        $emps = JadwalFasilitasKolam::where('idfasilmitra', $idfasilitas)->get();
        $output = '';
        $p = 1;
        if ($emps->count() > 0) {
            $output .= '<table class="table table-bordered table-md display nowrap" style="width:100%">
            <thead>
              <tr>
                <th>No</th>
                <th>Tanggal Buka</th>
                <th>Jam Buka</th>
                <th>Jam Tutup</th>
              </tr>
            </thead>
            <tbody>';
            foreach ($emps as $emp) {
                $output .= '<tr>
                <td>' . $p++ . '</td>
                <td>' . $emp->tanggalbuka . '</td>
                <td>' . substr($emp->jambuka, 0, 5) . '</td>
                <td>' . substr($emp->jamtutup, 0, 5) . '</td>
              </tr>';
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
        // dd($request->all());

        $fasilitasmitra = FasilitasMitra::where('id', $request->idfasilitasmitra)->first();
        $empData = [
            'idfasilmitra' => $request->idfasilitasmitra,
            'idmitra' => $fasilitasmitra->idmitra,
            'tanggalbuka' => $request->tanggalbuka,
            'jambuka' => $request->jambuka,
            'jamtutup' => $request->jamtutup
        ];
        JadwalFasilitasKolam::create($empData);
        return response()->json([
            'status' => 200,
        ]);
    }

    // handle edit an Tu ajax request
    public function edit(Request $request)
    {
        $id = $request->id;
        $emp = JadwalFasilitasKolam::where('id', $id)->first();
        return response()->json($emp);
    }
    public function testing(Request $request)
    {
        $id = $request->id;
        dd($id);
        $emp = JadwalFasilitasKolam::where('id', $id)->first();
        return response()->json($emp);
    }

    // handle update an Tu ajax request
    public function update(Request $request)
    {
        // dd($request->all());
        $emp = JadwalFasilitasKolam::Find($request->id);
        $empData = [
            'tanggalbuka' => $request->tanggalbuka,
            'jambuka' => $request->jambuka,
            'jamtutup' => $request->jamtutup
        ];
        $emp->update($empData);
        return response()->json([
            'status' => 200,
        ]);
    }

    public function delete(Request $request)
    {
        $id = $request->id;
        $admin = JadwalFasilitasKolam::where('id', $id)->first();
        $admin->delete();
        // Admin::destroy($id);
    }
}
