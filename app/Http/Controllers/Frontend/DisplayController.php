<?php

namespace App\Http\Controllers\Frontend;

use App\Http\Controllers\Controller;
use App\Models\Hamlet\Program;
use Illuminate\Http\Request;

class DisplayController extends Controller
{
    public function profil(){
        return view('FrontEnd.profil');
    }

    public function pejabat(){
        return view('FrontEnd.pejabat');
    }

    public function pkk(){
        return view('FrontEnd.pkk');
    }

    public function rukun(){
        return view('FrontEnd.rukun');
    }

    public function linmas(){
        return view('FrontEnd.linmas');
    }

    public function lpmkal(){
        return view('FrontEnd.lpmkal');
    }

    public function program(){
        $program = Program::all();
        return view('FrontEnd.program',compact('program'));
    }

    public function privacypolicy(){
        return view('FrontEnd.privacyPolice');
    }

    public function lupapassword(){
        return view('FrontEnd.lupapassword');
    }

    public function ulasan(){
        return view('FrontEnd.ulasan');
    }
}
