<?php

namespace App\Http\Controllers;

use App\Models\Sop;
use Illuminate\Http\Request;

class SOPController extends Controller
{
    public function indexriwayat($idfasilmitra)
    {
        return view('sop.indexriwayat', compact('idfasilmitra'));
    }
    public function index($idfasilmitra)
    {
        return view('sop.index', compact('idfasilmitra'));
    }
    public function all($idfasilmitra)
    {
        // <td><img src="/storage/images/' . $emp->image . '" width="50" class="img-thumbnail rounded-circle"></td>
        $emps = Sop::where('idfasilmitra', $idfasilmitra)->get();
        $output = '';
        $p = 1;
        if ($emps->count() > 0) {
            $output .= '<table class="table table-bordered table-md display nowrap" style="width:100%">
            <thead>
              <tr>
                <th>No</th>
                <th>Nama Sop</th>
                <th>Deskripsi Sop</th>
                <th>Tanggal Awal Sop Berlaku</th>
                <th>Tanggal Akhir Sop Berlaku</th>
                <th>Action</th>
              </tr>
            </thead>
            <tbody>';
            foreach ($emps as $emp) {
                $output .= '<tr>
                <td>' . $p++ . '</td>
                <td>' . $emp->namasop . '</td>
                <td>' . $emp->deskripsisop . '</td>
                <td>' . $emp->tglawalberlakusop . '</td>
                <td>' . $emp->tglakhirsop . '</td>
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
    public function indexmitra($idfasilmitra)
    {
        return view('sop.indexmitra', compact('idfasilmitra'));
    }
    public function allmitra($idfasilmitra)
    {
        // <td><img src="/storage/images/' . $emp->image . '" width="50" class="img-thumbnail rounded-circle"></td>
        $emps = Sop::where('idfasilmitra', $idfasilmitra)->get();
        $output = '';
        $p = 1;
        if ($emps->count() > 0) {
            $output .= '<table class="table table-bordered table-md display nowrap" style="width:100%">
            <thead>
              <tr>
                <th>No</th>
                <th>Nama Sop</th>
                <th>Deskripsi Sop</th>
                <th>Tanggal Awal Sop Berlaku</th>
                <th>Tanggal Akhir Sop Berlaku</th>
              </tr>
            </thead>
            <tbody>';
            foreach ($emps as $emp) {
                $output .= '<tr>
                <td>' . $p++ . '</td>
                <td>' . $emp->namasop . '</td>
                <td>' . $emp->deskripsisop . '</td>
                <td>' . $emp->tglawalberlakusop . '</td>
                <td>' . $emp->tglakhirsop . '</td>
              </tr>';
            }
            $output .= '</tbody></table>';
            echo $output;
        } else {
            echo '<h1 class="text-center text-secondary my-5">No record present in the database!</h1>';
        }
    }
    public function allriwayat($idfasilmitra)
    {
        // <td><img src="/storage/images/' . $emp->image . '" width="50" class="img-thumbnail rounded-circle"></td>
        $emps = Sop::where('idfasilmitra', $idfasilmitra)->get();
        $output = '';
        $p = 1;
        if ($emps->count() > 0) {
            $output .= '<table class="table table-bordered table-md display nowrap" style="width:100%">
            <thead>
              <tr>
                <th>No</th>
                <th>Nama Sop</th>
                <th>Deskripsi Sop</th>
                <th>Tanggal Awal Sop Berlaku</th>
                <th>Tanggal Akhir Sop Berlaku</th>
              </tr>
            </thead>
            <tbody>';
            foreach ($emps as $emp) {
                $output .= '<tr>
                <td>' . $p++ . '</td>
                <td>' . $emp->namasop . '</td>
                <td>' . $emp->deskripsisop . '</td>
                <td>' . $emp->tglawalberlakusop . '</td>
                <td>' . $emp->tglakhirsop . '</td>
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
        $empData = [
            'idfasilmitra' => $request->idfasilmitra,
            'namasop' => $request->namasop,
            'deskripsisop' => $request->deskripsisop,
            'tglawalberlakusop' => $request->tglawalberlakusop,
            'tglakhirsop' => $request->tglakhirsop
        ];
        Sop::create($empData);
        return response()->json([
            'status' => 200,
        ]);
    }

    // handle edit an Tu ajax request
    public function edit(Request $request)
    {
        $id = $request->id;
        $emp = Sop::find($id);
        return response()->json($emp);
    }

    // handle update an Tu ajax request
    public function update(Request $request)
    {
        $emp = Sop::Find($request->id);
        $empData = [
            'namasop' => $request->namasop,
            'deskripsisop' => $request->deskripsisop,
            'tglawalberlakusop' => $request->tglawalberlakusop,
            'tglakhirsop' => $request->tglakhirsop
        ];
        $emp->update($empData);
        return response()->json([
            'status' => 200,
        ]);
    }

    // handle delete an Tu ajax request
    public function delete(Request $request)
    {
        // dd('dsd');
        $id = $request->id;
        Sop::destroy($id);
    }
}
