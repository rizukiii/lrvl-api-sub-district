<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;

class AuthController extends Controller
{
    // Register
    public function register(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'name' => 'required|string|max:255',
            'nik' => 'required|numeric|unique:users',  // Validasi NIK
            'password' => 'required|string|min:8',
        ]);

        if ($validator->fails()) {
            return response()->json(['error' => $validator->errors()], 400);
        }

        $user = User::create([
            'name' => $request->name,
            'nik' => $request->nik,  // Simpan NIK
            'password' => Hash::make($request->password),
            'is_admin' => false, // set default sebagai user biasa
        ]);

        // Tidak menggunakan token, hanya mengirim data user
        return response()->json([
            'user' => $user,
            'message' => 'User created successfully, please login.',
        ]);
    }

    // Login
    public function login(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'nik' => 'required|numeric',  // Validasi NIK
            'password' => 'required|string',
        ]);

        if ($validator->fails()) {
            return response()->json(['error' => $validator->errors()], 400);
        }

        $user = User::where('nik', $request->nik)->first();  // Cari user berdasarkan NIK

        if (!$user || !Hash::check($request->password, $user->password)) {
            return response()->json(['error' => 'Unauthorized'], 401);
        }

        // Login dan set session
        Auth::login($user);

        return response()->json([
            'user' => $user,
            'message' => 'Login successful',
        ]);
    }

    // Logout
    public function logout(Request $request)
    {
        Auth::logout();  // Logout dari session

        return response()->json(['message' => 'Successfully logged out']);
    }

    // Get user info (hanya jika sudah login)
    public function user(Request $request)
    {
        return response()->json(['user' => Auth::user()]);
    }
}
