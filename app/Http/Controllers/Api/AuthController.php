<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Http\Resources\JsonResponses;
use App\Models\flutterUser;
use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;

class AuthController extends Controller
{
    public function login(Request $request)
    {
        $validated = $request->validate([
            'nik' => 'required|numeric',
        ]);

        if (Auth::attempt(['nik' => $validated['nik']])) {
            $user = Auth::user();
            return new JsonResponses(Response::HTTP_OK, "Login Sukses", $user);
        } else {
            return new JsonResponses(Response::HTTP_BAD_REQUEST, "Login Gagal!", null);
        }
    }

    public function register(Request $request)
    {
        $validated = $request->validate([
            'fullname' => 'required|string|max:255',
            'nik',
            'password' => 'required|min:3',
        ]);

        $user = flutterUser::create([
            'fullname' => $validated['fullname'],
            'nik',
            'password' => Hash::make($validated['password']),
        ]);

        if ($user) {
            return new JsonResponses(Response::HTTP_OK, "Daftar Sukses", $user);
        } else {
            return new JsonResponses(Response::HTTP_BAD_REQUEST, "Daftar Gagal!", null);
        }
    }
}
