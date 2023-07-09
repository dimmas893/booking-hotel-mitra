<?php

namespace App\Http\Controllers;

use App\Models\FasilitasKolangRenang;
use App\Models\FasilitasMitra;
use App\Models\HargaSepakatMitra;
use App\Models\JadwalFasilitasKolam;
use App\Models\JenisMitra;
use App\Models\Mitra;
use App\Models\PendapatanMitra;
use App\Models\PerjanjianMitra;
use App\Models\Sop;
use App\Models\User;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Str;
use File;
use Illuminate\Support\Facades\Auth;

class MitraController extends Controller
{
    public function editkolam(Request $request)
    {
        dd($request->all());
        $id = $request->id;
        $emp = JadwalFasilitasKolam::where('id', $id)->first();
        return response()->json($emp);
    }
    // set index page view
    public function index()
    {
        $jenismitra = JenisMitra::get();
        return view('mitra.index', compact('jenismitra'));
    }

    // handle fetch all eamployees ajax request
    public function all()
    {
        $tanggalhariini = Carbon::now()->Format('Y-m-d');
        $emps = Mitra::get();
        $output = '';
        $p = 1;
        if ($emps->count() > 0) {
            $output .= '<table class="table table-bordered table-md display nowrap" style="width:100%">
            <thead>
              <tr>
                <th>No</th>
                <th>Nama Mitra</th>
                <th>Email</th>
                <th>Longitude</th>
                <th>Latitude</th>
                <th>Alamat</th>
                <th>foto</th>
                <th>Jenis Mitra</th>
                <th>Fasilitas</th>
                <th>Perjanjian</th>
                <th>Pendapatan</th>
                <th>Action</th>
              </tr>
            </thead>
            <tbody>';
            foreach ($emps as $emp) {
                $perjanjianmitra = PerjanjianMitra::where('idmitra', $emp->id)->where('tglawalberlaku', '<=', $tanggalhariini)->where('tglakhirberlaku', '>=', $tanggalhariini)->first();

                // dd($perjanjianmitra->id);
                $id = $perjanjianmitra;
                $fasilitascount = FasilitasMitra::where('idmitra', $emp->id)->count();
                $output .= '<tr>
                <td>' . $p++ . '</td>
                <td>' . $emp->namamitra . '</td>
                <td>' . $emp->user->email . '</td>
                <td>' . $emp->longitude . '</td>
                <td>' . $emp->latitude . '</td>
                <td>' . $emp->alamatmitralengkap . '</td>
                <td><img src="' . asset('mitrafoto/' . $emp->foto) . '" width="50" class="img-thumbnail rounded-circle"></td>
                <td>' . $emp->jenismitra->namajenismitra . '</td>';
                if ($perjanjianmitra != null) {
                    $output .= ' <td> (' . $fasilitascount . ' Fasilitas)<a href="' . route('fasilitas-mitra', $id) . '" class="badge badge-info">Lihat</a></td>';
                } else {
                    $output .= '<td>Tidak ada perjanjian aktif</td>';
                }
                $output .= '<td> (' . PerjanjianMitra::where('idmitra', $emp->id)->count() . ' Perjanjian) <a href="' . route('perjanjianmitra', $emp->id) . '" class="badge badge-info mx-1">Lihat</a> </td>
                <td> (' . PendapatanMitra::where('idmitra', $emp->id)->count() . ' kali) <a href="' . route('pendapatanmitra', $emp->id) . '" class="badge badge-info mx-1">Lihat</a> </td>
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

    public function indexmitra()
    {
        $tanggalhariini = Carbon::now()->Format('Y-m-d');

        $mitra = Mitra::where('id_user', Auth::user()->id)->first();
        $cek = PerjanjianMitra::where('idmitra', $mitra->id)->where('tglawalberlaku', '<=', $tanggalhariini)->where('tglakhirberlaku', '>=', $tanggalhariini)->first();
        if ($cek != null) {
            $perjanjian = PerjanjianMitra::where('idmitra', $mitra->id)->where('tglawalberlaku', '<=', $tanggalhariini)->where('tglakhirberlaku', '>=', $tanggalhariini)->first();
            $pendapatan = PendapatanMitra::where('idmitra', $mitra->id)->sum('nilaiuang');
            $fasilitasmitra = FasilitasMitra::where('idmitra', $mitra->id)->count();
            $fasilitaskolamrenang = FasilitasKolangRenang::where('idmitra', $mitra->id)->count();
            $totsop = [];
            foreach (FasilitasMitra::where('idmitra', $mitra->id)->get() as $fal) {
                array_push($totsop, Sop::where('idfasilmitra', $fal->id)->count());
            }
            $totalsop = array_sum($totsop);
        } else {
            $pendapatan = "Perjanjian Sudah Berakhir";
            $fasilitasmitra = "Perjanjian Sudah Berakhir";
            $fasilitaskolamrenang = "Perjanjian Sudah Berakhir";
            $totalsop = "Perjanjian Sudah Berakhir";
        }
        return view('mitra.indexmitra', compact('pendapatan', 'fasilitasmitra', 'fasilitaskolamrenang', 'totalsop', 'mitra', 'perjanjian'));
    }

    // handle fetch all eamployees ajax request
    public function allmitra()
    {
        $tanggalhariini = Carbon::now()->Format('Y-m-d');

        $user = User::where('id', Auth::user()->id)->first();
        $emps = Mitra::where('id_user', $user->id)->get();
        $output = '';
        $p = 1;
        if ($emps->count() > 0) {
            $output .= '<table class="table table-bordered table-md display nowrap" style="width:100%">
            <thead>
              <tr>
                <th>Fasilitas</th>
                <th>Perjanjian</th>
                <th>Pendapatan</th>
              </tr>
            </thead>
            <tbody>';
            foreach ($emps as $emp) {
                $perjanjianmitra = PerjanjianMitra::where('idmitra', $emp->id)->where('tglawalberlaku', '<=', $tanggalhariini)->where('tglakhirberlaku', '>=', $tanggalhariini)->first();

                $id = $perjanjianmitra;
                $fasilitascount = FasilitasMitra::where('idmitra', $emp->id)->count();
                $output .= '<tr>';
                if ($perjanjianmitra != null) {
                    $output .= ' <td> (' . $fasilitascount . ' Fasilitas)<a href="' . route('fasilitas-mitramitra', $id) . '" class="badge badge-info">Lihat</a></td>';
                } else {
                    $output .= '<td>Tidak ada perjanjian aktif</td>';
                }
                $output .= '<td> (' . PerjanjianMitra::where('idmitra', $emp->id)->count() . ' Perjanjian) <a href="' . route('perjanjianmitramitra', $emp->id) . '" class="badge badge-info mx-1">Lihat</a> </td>
                <td> (' . PendapatanMitra::where('idmitra', $emp->id)->count() . ' kali) <a href="' . route('mitrapendapatan', $emp->id) . '" class="badge badge-info mx-1">Lihat</a> </td>

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
        $lampiranFulltextFile = null;
        if ($request->hasFile('foto')) {
            $file = $request->file('foto');
            $file_extension = $file->getClientOriginalExtension();
            $lokasiFile = public_path() . '/mitrafoto';

            $this->lampiranFulltextFile = 'foto-mitra-' . Str::random(5) . '.' . $file_extension;
            // $this->lampiranFulltextFile = $request->tahun_terbit.$request->singkatan_jenis.$kodeWilayah.$nomorPeraturan.'.'.$file_extension;
            $request->file('foto')->move($lokasiFile, $this->lampiranFulltextFile);
            $lampiranFulltextFile = $this->lampiranFulltextFile;
        } else {
            $lampiranFulltextFile = $this->lampiranFulltextFile;
        }

        $cek = User::where('email', $request->email)->first();
        if ($cek === null) {
            $empData = [
                'name' => $request->namamitra,
                'email' => $request->email,
                'role' => 'mitra',
                'password' => Hash::make('password'),
            ];
            $user = User::create($empData);
            $empData = [
                'id_user' => $user->id,
                'idjenismitra' => $request->idjenismitra,
                'namamitra' => $request->namamitra,
                'longitude' => $request->longitude,
                'latitude' => $request->latitude,
                'alamatmitralengkap' => $request->alamatmitralengkap,
                'foto' => $lampiranFulltextFile
            ];
            Mitra::create($empData);
            return response()->json([
                'status' => 200,
            ]);
        } else {
            return response()->json([
                'status' => 400,
            ]);
        }
    }

    // handle edit an Tu ajax request
    public function edit(Request $request)
    {
        // dd($request->all());
        // dd($request->all());
        $id = $request->id;
        $emp = Mitra::with('user')->where('id', $id)->first();
        return response()->json($emp);
    }

    // handle edit an Tu ajax request
    public function perjanjianmitra(Request $request)
    {
        // dd($request->all());
        $id = $request->id;
        $emp = PerjanjianMitra::where('id', $id)->first();
        return response()->json($emp);
    }
    public function hargasepakatmitra(Request $request)
    {
        // dd($request->all());
        $id = $request->id;
        $emp = HargaSepakatMitra::where('id', $id)->first();
        return response()->json($emp);
    }

    // handle update an Tu ajax request
    public function update(Request $request)
    {
        // dd($request->all());
        $emp = Mitra::Find($request->id);
        $lampiranFulltextFile = null;
        if ($request->hasFile('foto')) {
            if ($emp->foto) {
                File::delete(public_path(asset('mitrafoto/' . $emp->foto)));
            }
            $file = $request->file('foto');
            $file_extension = $file->getClientOriginalExtension();
            $lokasiFile = public_path() . '/mitrafoto';
            $this->lampiranFulltextFile = 'foto-mitra-' . Str::random(5) . '.' . $file_extension;
            // $this->lampiranFulltextFile = $request->tahun_terbit.$request->singkatan_jenis.$kodeWilayah.$nomorPeraturan.'.'.$file_extension;
            $request->file('foto')->move($lokasiFile, $this->lampiranFulltextFile);
            $lampiranFulltextFile = $this->lampiranFulltextFile;
        } else {
            $this->lampiranFulltextFile = $emp->foto;
            $lampiranFulltextFile = $this->lampiranFulltextFile;
        }
        $user = User::where('id', $emp->id_user)->first();
        $cek = User::where('email', $request->email)->first();
        if ($user->email === $request->email) {
            if ($request->password) {
                $useruser = [
                    'name' => $request->namamitra,
                    'email' => $request->email,
                    'password' => Hash::make($request->password),
                ];
            } else {
                $useruser = [
                    'name' => $request->namamitra,
                    'email' => $request->email
                ];
            }
            $user = User::where('id', $emp->id_user)->update($useruser);
            $empData = [
                'idjenismitra' => $request->idjenismitra,
                'namamitra' => $request->namamitra,
                'longitude' => $request->longitude,
                'latitude' => $request->latitude,
                'alamatmitralengkap' => $request->alamatmitralengkap,
                'foto' => $lampiranFulltextFile
            ];
            $emp->update($empData);
            return response()->json([
                'status' => 200,
            ]);
        } elseif ($cek === null) {
            if ($request->password) {
                $datauser = [
                    'name' => $request->namamitra,
                    'email' => $request->email,
                    'password' => Hash::make($request->password),
                ];
            } else {
                $datauser = [
                    'name' => $request->namamitra,
                    'email' => $request->email
                ];
            }
            $user = User::where('id', $emp->id_user)->update($datauser);
            $empData = [
                'idjenismitra' => $request->idjenismitra,
                'namamitra' => $request->namamitra,
                'longitude' => $request->longitude,
                'latitude' => $request->latitude,
                'alamatmitralengkap' => $request->alamatmitralengkap,
                'foto' => $lampiranFulltextFile
            ];
            $emp->update($empData);
            return response()->json([
                'status' => 200,
            ]);
        } else {
            return response()->json([
                'status' => 400,
            ]);
        }
    }

    public function delete(Request $request)
    {
        $id = $request->id;
        $admin = Mitra::where('id', $id)->first();
        if ($admin->foto) {
            File::delete(public_path(asset('mitrafoto/' . $admin->foto)));
        }
        User::where('id', $admin->id_user)->delete();
        $admin->delete();
        // Admin::destroy($id);
    }
}
