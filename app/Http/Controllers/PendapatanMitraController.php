<?php

namespace App\Http\Controllers;

use App\Models\Mitra;
use App\Models\PendapatanMitra;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class PendapatanMitraController extends Controller
{
    // set index page view
    public function index($idmitra)
    {
        return view('pendapatanmitra.index', compact('idmitra'));
    }

    public function pendapatan()
    {
        return view('pendapatanmitra.pendapatan');
    }

    // handle fetch all eamployees ajax request
    public function all($idmitra)
    {

        // <td><img src="/storage/images/' . $emp->image . '" width="50" class="img-thumbnail rounded-circle"></td>
        $emps = PendapatanMitra::where('idmitra', $idmitra)->get();
        $output = '';
        $p = 1;
        if ($emps->count() > 0) {
            $output .= '<table class="table table-bordered table-md display nowrap" style="width:100%">
            <thead>
              <tr>
                <th>No</th>
                <th>Periode Awal</th>
                <th>Periode Akhir</th>
                <th>Nilai Uang</th>
                <th>Tanggal Diterima</th>
                <th>Action</th>
              </tr>
            </thead>
            <tbody>';
            foreach ($emps as $emp) {
                $output .= '<tr>
                <td>' . $p++ . '</td>
                <td>' . $emp->periodeawal . '</td>
                <td>' . $emp->periodeakhir . '</td>
                <td>Rp. ' . number_format($emp->nilaiuang) . '</td>
                <td>' . $emp->tglditerima . '</td>
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

    public function pendapatanall()
    {
        $user = User::where('id', Auth::user()->id)->first();
        $mitra = Mitra::where('id_user', $user->id)->first();
        // dd($mitra);
        // <td><img src="/storage/images/' . $emp->image . '" width="50" class="img-thumbnail rounded-circle"></td>
        $emps = PendapatanMitra::where('idmitra', $mitra->id)->get();
        $output = '';
        $p = 1;
        if ($emps->count() > 0) {
            $output .= '<table class="table table-bordered table-md display nowrap" style="width:100%">
            <thead>
              <tr>
                <th>No</th>
                <th>Periode Awal</th>
                <th>Periode Akhir</th>
                <th>Nilai Uang</th>
                <th>Tanggal Diterima</th>
              </tr>
            </thead>
            <tbody>';
            foreach ($emps as $emp) {
                $output .= '<tr>
                <td>' . $p++ . '</td>
                <td>' . $emp->periodeawal . '</td>
                <td>' . $emp->periodeakhir . '</td>
                <td>Rp. ' . number_format($emp->nilaiuang) . '</td>
                <td>' . $emp->tglditerima . '</td>
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
            'idmitra' => $request->idmitra,
            'periodeawal' => $request->periodeawal,
            'periodeakhir' => $request->periodeakhir,
            'nilaiuang' => $request->nilaiuang,
            'tglditerima' => $request->tglditerima
        ];
        PendapatanMitra::create($empData);
        return response()->json([
            'status' => 200,
        ]);
    }


    // handle update an Tu ajax request
    public function update(Request $request)
    {
        $emp = PendapatanMitra::Find($request->id);
        $empData = [
            'periodeawal' => $request->periodeawal,
            'periodeakhir' => $request->periodeakhir,
            'nilaiuang' => $request->nilaiuang,
            'tglditerima' => $request->tglditerima
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
        PendapatanMitra::destroy($id);
    }
}
