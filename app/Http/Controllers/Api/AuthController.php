<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class AuthController extends Controller
{
    public function login(Request $request){
        $validated = $request->validate([
            'nik' => 'required|numeric',
            'password' => 'required'
        ]);

    }

    public function register(){

    }
}
