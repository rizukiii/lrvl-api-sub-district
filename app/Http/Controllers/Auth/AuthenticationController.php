<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Symfony\Component\HttpFoundation\RedirectResponse;

class AuthenticationController extends Controller
{
    public function login()
    {
        return view('auth.login');
    }

    public function authenticate(Request $request)
    {
        $request->validate([
            'name' => 'required|string',
            'password' => 'required|'
        ]);

        if ($user = User::where('name', $request->name)->first()) {
            if (!Hash::check($request->password, $user->password)) {
                return back()->withErrors([
                    'password' => 'Password Anda Salah!'
                ])->onlyInput('password');
            }

            Auth::login($user, $request->remember);
            return redirect()->intended(route('dashboard'));
        }

        return back()->withErrors(['name' => 'Nama Yang Anda Masukan Salah!'])->onlyInput('name');
    }

    public function logout(Request $request): RedirectResponse
    {
        Auth::logout();

        $request->session()->invalidate();

        $request->session()->regenerateToken();

        return redirect()->route('login');
    }

    public function regis(Request $request)
    {
        $request->validate([
            'name' => 'required|string|unique:users,name',
            'password' => 'required|string',
            'konfirmasi_password' => 'required|string'
        ]);

        if ($request->konfirmasi_password != $request->password) {
            return back()->withErrors(['konfirmasi_password' => 'Konfirmasi Password Tidak Sesuai Dengan Password!']);
        }

        $user = User::create([
            'nik' => null,
            'name' => $request->name,
            'password' => Hash::make($request->password),
            'is_admin' => false,
        ]);

        if ($user) {
            return redirect()->route('login')->withSuccess('Berhasil Register Silahkan Login!');
        }
        return back()->withErrors('Gagal register!');
    }

    public function register()
    {
        return view('auth.register');
    }
}
