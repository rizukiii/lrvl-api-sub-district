<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Http\Resources\JsonResponses;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;
use Symfony\Component\HttpFoundation\Response;
use Tymon\JWTAuth\Exceptions\JWTException;
use Tymon\JWTAuth\Facades\JWTAuth;

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
        return new JsonResponses(Response::HTTP_OK, "Berhasil Registrasi, Silahkan Login", $user);
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
        // Auth::login($user);
        $credentials = $request->only('nik', 'password');
        try {
            if (!$token = JWTAuth::attempt($credentials)) {
                return response()->json([
                    'success' => false,
                    'message' => 'Invalid username or password'
                ], 401);
            }
        } catch (JWTException $e) {
            return response()->json([
                'success' => false,
                'message' => 'Could not create token'
            ], 500);
        }
        $user->token = $token;

        return new JsonResponses(Response::HTTP_OK, "Berhasil Login", $user);
    }

    // Logout
    public function logout(Request $request)
    {
        // Logout dari session
        return new JsonResponses(Response::HTTP_OK, "Berhasil Logout", Auth::logout());
    }

    // Get user info (hanya jika sudah login)
    public function user(Request $request)
    {
        return new JsonResponses(Response::HTTP_OK, "Berhasil Logout", ['user' => Auth::user()]);
    }
}
