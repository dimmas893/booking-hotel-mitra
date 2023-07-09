<?php

namespace App\Http\Controllers;

use App\Models\Customor;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;

class CustomorController extends Controller
{
    public function register()
    {
        return view('register.index');
    }
    public function registersimpan(Request $request)
    {
        // dd($request->all());
        $cek = User::where('email', $request->email)->first();
        if ($cek === null) {
            $user = [
                'name' => $request->name,
                'email' => $request->email,
                'password' => Hash::make($request->password),
                'role' => 'customor',
            ];
            $us = User::create($user);

            $customor = [
                'id_user' => $us->id,
                'country' => $request->country,
                'city' => $request->city,
                'address' => $request->address,
                'phone' => $request->phone,
                'name' => $request->name
            ];
            Customor::create($customor);
            return redirect()->route('loginaplikasi');
        } else {
            return back()->with('emailsama', 'dsd');
        }
    }
}
