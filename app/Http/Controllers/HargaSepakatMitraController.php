<?php

namespace App\Http\Controllers;

use App\Models\HargaSepakatMitra;
use Illuminate\Http\Request;

class HargaSepakatMitraController extends Controller
{
    // set index page view
    public function index()
    {
        return view('jenismitra.index');
    }

    // handle fetch all eamployees ajax request
    public function all()
    {

        // <td><img src="/storage/photos/' . $emp->photo . '" width="50" class="img-thumbnail rounded-circle"></td>
        $emps = HargaSepakatMitra::get();
        $output = '';
        $p = 1;
        if ($emps->count() > 0) {
            $output .= '<table class="table table-bordered table-md display nowrap" style="width:100%">
            <thead>
              <tr>
                <th>No</th>
                <th>Nama Jenis Mitra</th>
                <th>Keterangan</th>
                <th>Action</th>
              </tr>
            </thead>
            <tbody>';
            foreach ($emps as $emp) {
                $output .= '<tr>
                <td>' . $p++ . '</td>
                <td>' . $emp->namajenismitra . '</td>
                <td>' . $emp->keterangan . '</td>
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

    // handle insert a new Tu ajax request
    public function store(Request $request)
    {
        // dd($request->all());
        $cek = HargaSepakatMitra::where('idperjanjianmitra', $request->idperjanjianmitra)->where('idfasilitas', $request->idfasilitas)->where('idunit', $request->idunit)->first();
        if ($cek === null) {
            $empData = [
                'idperjanjianmitra' => $request->idperjanjianmitra,
                'idfasilitas' => $request->idfasilitas,
                'idunit' => $request->idunit,
                'hargaperorang' => $request->hargaperorang
            ];
            HargaSepakatMitra::create($empData);
            return back()->with('unitsudahadaberhasil', 'd');
        } else {
            return back()->with('unitsudahada', 'd');
        }
    }

    // handle edit an Tu ajax request
    public function edit(Request $request)
    {
        // dd($request->all());
        $id = $request->id;
        $emp = HargaSepakatMitra::where('id', $id)->first();
        return response()->json($emp);
    }

    // handle update an Tu ajax request
    public function update(Request $request)
    {
        // dd($request->idhargakesepakatanmitra);
        $emp = HargaSepakatMitra::Find($request->idhargakesepakatanmitra);
        $empData = [
            'idunit' => $request->idunit,
            'hargaperorang' => $request->hargaperorang
        ];
        $emp->update($empData);
        return response()->json([
            'status' => 200,
        ]);
    }

    public function delete(Request $request)
    {
        $id = $request->id;
        $admin = HargaSepakatMitra::where('id', $id)->first();
        $admin->delete();
        // Admin::destroy($id);
    }
}
