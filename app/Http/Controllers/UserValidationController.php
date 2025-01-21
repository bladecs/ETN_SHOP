<?php

namespace App\Http\Controllers;

use App\Models\UserValidation;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Facades\Hash;

class UserValidationController extends Controller
{
    public function index(Request $request)
    {
        // Validasi input
        $request->validate(
            [
                'username' => 'required|string',
                'password' => 'required|string',
            ],
            [
                'username.required' => 'Username wajib diisi',
                'password.required' => 'Password wajib diisi',
            ]
        );

        // Cari user berdasarkan username
        $userValidation = UserValidation::where('username', $request->username)->first();

        // Jika user tidak ditemukan
        if (!$userValidation) {
            return back()->with('error', 'Username tidak ditemukan');
        }

        // Verifikasi password
        if (!Hash::check($request->password, $userValidation->password)) {
            return back()->with('error', 'Password salah');
        }

        // Simpan username ke dalam session
        Session::put('username', $userValidation->username);

        // Redirect ke dashboard dengan pesan sukses
        return redirect()->route('produk.index')->with('success', 'Berhasil login sebagai ' . $userValidation->username);
    }
    public function register(Request $request)
    {
        try {
            // Validasi input
            $request->validate(
                [
                    'username' => 'required|string|unique:user,username',
                    'email' => 'required|string|email|unique:user,email',
                    'password' => 'required|string|min:8',
                ],
                [
                    'username.required' => 'Username wajib diisi',
                    'username.unique' => 'Username sudah terdaftar',
                    'email.required' => 'Email wajib diisi',
                    'email.email' => 'Format email tidak valid',
                    'email.unique' => 'Email sudah terdaftar',
                    'password.required' => 'Password wajib diisi',
                    'password.min' => 'Password minimal 8 karakter',
                ]
            );

            // Simpan data ke database
            UserValidation::create([
                'id' => uniqid(),
                'username'=> $request->username,
                'email'=> $request->email,
                'password'=> bcrypt($request->password),
            ]);

            // Redirect atau response setelah berhasil register
            return redirect()->route('login')->with('success', 'Registrasi berhasil, silakan login.');
        } catch (\Exception $e) {
            // Menangkap error dan mengembalikan pesan error
            return back()->withErrors(['message' => 'Terjadi kesalahan saat registrasi.'])->withInput();
        }
    }

    public function logout(Request $request){
        Session()->forget('username');
        return redirect()->route('login');
    }
}
