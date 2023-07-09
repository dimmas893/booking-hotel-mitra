<?php

namespace App\Http\Controllers;

use App\Models\Admin;
use App\Models\PendapatanMitra;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Str;
use File;

class AdminController extends Controller
{
    // set index page view
    public function index()
    {
        return view('admin.index');
    }

    public function editpendapatan(Request $request)
    {
        $id = $request->id;
        $emp = PendapatanMitra::find($id);
        return response()->json($emp);
    }

    // handle fetch all eamployees ajax request
    public function all()
    {

        // <td><img src="/storage/photos/' . $emp->photo . '" width="50" class="img-thumbnail rounded-circle"></td>
        $emps = Admin::get();
        $output = '';
        $p = 1;
        if ($emps->count() > 0) {
            $output .= '<table class="table table-bordered table-md display nowrap" style="width:100%">
            <thead>
              <tr>
                <th>No</th>
                <th>Nama</th>
                <th>Email</th>
                <th>Foto</th>
                <th>Action</th>
              </tr>
            </thead>
            <tbody>';
            foreach ($emps as $emp) {
                $output .= '<tr>
                <td>' . $p++ . '</td>
                <td>' . $emp->user->name . '</td>
                <td>' . $emp->user->email . '</td>
                <td><img src="/foto/' . $emp->photo . '" width="50" class="img-thumbnail rounded-circle"></td>
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
        $lampiranFulltextFile = null;
        if ($request->hasFile('photo')) {
            $file = $request->file('photo');
            $file_extension = $file->getClientOriginalExtension();
            $lokasiFile = public_path() . '/foto';

            $this->lampiranFulltextFile = 'foto-' . $request->name . Str::random(5) . '.' . $file_extension;
            // $this->lampiranFulltextFile = $request->tahun_terbit.$request->singkatan_jenis.$kodeWilayah.$nomorPeraturan.'.'.$file_extension;
            $request->file('photo')->move($lokasiFile, $this->lampiranFulltextFile);
            $lampiranFulltextFile = $this->lampiranFulltextFile;
        } else {
            $lampiranFulltextFile = $this->lampiranFulltextFile;
        }
        $cek = User::where('email', $request->email)->first();
        if ($cek === null) {
            $empData = [
                'name' => $request->name,
                'role' => 'admin',
                'email' => $request->email,
                'password' => Hash::make('password'),
            ];
            $user = User::create($empData);
            $admin = [
                'id_user' => $user->id,
                'photo' => $lampiranFulltextFile
            ];
            Admin::create($admin);
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
        $id = $request->id;
        $emp = Admin::with('user')->where('id', $id)->first();
        return response()->json($emp);
    }

    // handle update an Tu ajax request
    public function update(Request $request)
    {
        // dd($request->all());
        $emp = Admin::Find($request->id);

        $lampiranFulltextFile = null;
        if ($request->hasFile('photo')) {
            if ($emp->photo) {
                File::delete(public_path('/foto/' . $emp->photo));
            }
            $file = $request->file('photo');
            $file_extension = $file->getClientOriginalExtension();
            $lokasiFile = public_path() . '/foto';

            $this->lampiranFulltextFile = 'foto-' . $request->name . Str::random(5) . '.' . $file_extension;
            // $this->lampiranFulltextFile = $request->tahun_terbit.$request->singkatan_jenis.$kodeWilayah.$nomorPeraturan.'.'.$file_extension;
            $request->file('photo')->move($lokasiFile, $this->lampiranFulltextFile);
            $lampiranFulltextFile = $this->lampiranFulltextFile;
        } else {
            $this->lampiranFulltextFile = $emp->photo;
            $lampiranFulltextFile = $this->lampiranFulltextFile;
        }

        $user = User::where('id', $emp->id_user)->first();
        $cek = User::where('email', $request->email)->first();
        if ($user->email === $request->email) {
            if ($request->password) {
                $empData = [
                    'name' => $request->name,
                    'email' => $request->email,
                    'password' => Hash::make($request->password),
                ];
            } else {
                $empData = [
                    'name' => $request->name,
                    'email' => $request->email
                ];
            }
            $user = User::where('id', $emp->id_user)->update($empData);
            $admin = [
                'photo' => $lampiranFulltextFile
            ];
            $emp->update($admin);
            return response()->json([
                'status' => 200,
            ]);
        } elseif ($cek === null) {
            if ($request->password) {
                $empData = [
                    'name' => $request->name,
                    'email' => $request->email,
                    'password' => Hash::make($request->password),
                ];
            } else {
                $empData = [
                    'name' => $request->name,
                    'email' => $request->email
                ];
            }
            $user = User::where('id', $emp->id_user)->update($empData);
            $admin = [
                'photo' => $lampiranFulltextFile
            ];
            $emp->update($admin);
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
        $admin = Admin::where('id', $id)->first();
        if ($admin->photo != null) {
            File::delete(public_path('/foto/' . $admin->photo));
        }
        User::where('id', $admin->id_user)->delete();
        $admin->delete();
        // Admin::destroy($id);
    }
}
