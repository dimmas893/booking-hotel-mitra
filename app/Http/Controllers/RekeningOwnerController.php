<?php

namespace App\Http\Controllers;

use App\Models\RekeningOWner;
use Illuminate\Http\Request;

class RekeningOwnerController extends Controller
{
    // set index page view
    public function index()
    {
        return view('rekeningowner.index');
    }

    // handle fetch all eamployees ajax request
    public function all()
    {

        // <td><img src="/storage/images/' . $emp->image . '" width="50" class="img-thumbnail rounded-circle"></td>
        $emps = RekeningOWner::all();
        $output = '';
        $p = 1;
        if ($emps->count() > 0) {
            $output .= '<table class="table table-bordered table-md display nowrap" style="width:100%">
            <thead>
              <tr>
                <th>No</th>
                <th>Nama Bank</th>
                <th>Atas Nama</th>
                <th>No Rekening</th>
                <th>Action</th>
              </tr>
            </thead>
            <tbody>';
            foreach ($emps as $emp) {
                $output .= '<tr>
                <td>' . $p++ . '</td>
                <td>' . $emp->bank_name . '</td>
                <td>' . $emp->atas_nama . '</td>
                <td>' . $emp->no_rekening . '</td>
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
        $empData = [
            'bank_name' => $request->bank_name,
            'atas_nama' => $request->atas_nama,
            'no_rekening' => $request->no_rekening
        ];
        RekeningOWner::create($empData);
        return response()->json([
            'status' => 200,
        ]);
    }

    // handle edit an Tu ajax request
    public function edit(Request $request)
    {
        $id = $request->id;
        $emp = RekeningOWner::find($id);
        return response()->json($emp);
    }

    // handle update an Tu ajax request
    public function update(Request $request)
    {
        $emp = RekeningOWner::Find($request->id);
        $empData = [
            'bank_name' => $request->bank_name,
            'atas_nama' => $request->atas_nama,
            'no_rekening' => $request->no_rekening
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
        RekeningOWner::destroy($id);
    }
}
