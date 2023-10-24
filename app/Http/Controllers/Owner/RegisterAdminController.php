<?php

namespace App\Http\Controllers\Owner;

use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;
use Laravel\Jetstream\Jetstream;

class RegisterAdminController extends Controller
{
    public function createUserAndBooking(Request $request)
    {
        // Validasi data pengguna
        $userData = $request->all();
        $validator = Validator::make($userData, [
            'name' => ['required', 'string', 'max:255'],
            'phone' => ['required', 'string', 'max:13'],
            'email' => ['required', 'string', 'email', 'max:255', 'unique:users'],
            'password' => ['required', 'string', 'max:255'],
            'terms' => Jetstream::hasTermsAndPrivacyPolicyFeature() ? ['accepted', 'required'] : '',
        ]);

        if ($validator->fails()) {
            return redirect()->back()->withErrors($validator)->withInput();
        }

        // Cek apakah pengguna saat ini adalah OWNER
        $isOwner = false;

        if (auth()->check() && auth()->user()->roles == 'OWNER') {
            $isOwner = true;
        }

        // Setel peran berdasarkan apakah pengguna adalah owner
        $role = $isOwner ? 'ADMIN' : 'USER';

        // Buat pengguna dengan peran yang ditentukan
        $user = User::create([
            'name' => $userData['name'],
            'phone' => $userData['phone'],
            'email' => $userData['email'],
            'password' => Hash::make($userData['password']),
            'roles' => 'ADMIN',
        ]);

        return redirect()->back()->with('success', 'Pengguna dan booking berhasil dibuat');
    }
}
