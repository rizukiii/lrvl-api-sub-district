<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Http\Request;

class UserController extends Controller
{
    public function index(Request $request){
        $query = User::query();

        // Handle searching
        if ($request->has('search') && $request->search != '') {
            $search = $request->search;
            $query->where('name', 'like', "%$search%")
                ->orWhere('nik', 'like', "%$search%");
        }

        $user = $query->orderBy('name','desc')->paginate(5);

        return view('admin.user.index',compact('user'));
    }
}
