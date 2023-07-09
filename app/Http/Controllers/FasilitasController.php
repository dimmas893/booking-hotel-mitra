<?php

namespace App\Http\Controllers;

use App\Models\Fasilitas;
use App\Models\FasilitasMitra;
use App\Models\JadwalFasilitasKolam;
use App\Models\JenisFasilitas;
use App\Models\PendapatanMitra;
use App\Models\Sop;
use Illuminate\Http\Request;

class FasilitasController extends Controller
{
    // set index page view
    public function index()
    {
        $jenis = JenisFasilitas::get();
        return view('fasilitas.index', compact('jenis'));
    }
    public function dimmas()
    {
        dd('ds');
        $jenis = JenisFasilitas::get();
        return view('fasilitas.index', compact('jenis'));
    }

    // handle fetch all eamployees ajax request
    public function all()
    {

        // <td><img src="/storage/images/' . $emp->image . '" width="50" class="img-thumbnail rounded-circle"></td>
        $emps = Fasilitas::get();
        $output = '';
        $p = 1;
        if ($emps->count() > 0) {
            $output .= '<table class="table table-bordered table-md display nowrap" style="width:100%">
            <thead>
              <tr>
                <th>No</th>
                <th>Jenis Fasilitas</th>
                <th>Nama Fasilitas</th>
                <th>Action</th>
              </tr>
            </thead>
            <tbody>';
            foreach ($emps as $emp) {
                $output .= '<tr>
                <td>' . $p++ . '</td>
                <td>' . $emp->jenisfasilitas->namajenisfasilitas . '</td>
                <td>' . $emp->namafasilitas . '</td>
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
            'idjenisfasilitas' => $request->idjenisfasilitas,
            'namafasilitas' => $request->namafasilitas
        ];
        Fasilitas::create($empData);
        return response()->json([
            'status' => 200,
        ]);
    }

    // handle edit an Tu ajax request
    public function edit(Request $request)
    {
        // dd($request->all());
        $id = $request->id;
        $emp = Fasilitas::find($id);
        return response()->json($emp);
    }

    public function editsop(Request $request)
    {
        // dd('ds');
        $id = $request->id;
        $emp = Sop::find($id);
        return response()->json($emp);
    }
    public function editpendapatan(Request $request)
    {
        dd('dsds');
        $id = $request->id;
        $emp = PendapatanMitra::find($id);
        return response()->json($emp);
    }
    public function editfasilitas(Request $request)
    {
        // dd($request->all());
        $id = $request->id;
        $emp = FasilitasMitra::where('id', $id)->first();
        return response()->json($emp);
    }
    public function editkolam(Request $request)
    {
        $id = $request->id;
        $emp = JadwalFasilitasKolam::where('id', $id)->first();
        return response()->json($emp);
    }
    // handle update an Tu ajax request
    public function update(Request $request)
    {
        $emp = Fasilitas::Find($request->id);
        $empData = [
            'idjenisfasilitas' => $request->idjenisfasilitas,
            'namafasilitas' => $request->namafasilitas
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
        Fasilitas::destroy($id);
    }
}
