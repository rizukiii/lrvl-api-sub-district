<?php

namespace App\Http\Controllers;

use App\Models\Hamlet;
use Illuminate\Http\Request;

class HamletController extends Controller
{
   /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $query = Hamlet::query();
        $hamlet = $query->orderBy('name', 'desc')->paginate(5);

        return view('admin.hamlet.index',compact('hamlet'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('admin.hamlet.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required|string',
            'title' => 'required|string',
            'image' => 'required|image',

        ]);

        $data = $request->only('name', 'number', 'rt', 'rw', 'village');

        if (HamletNumber::create($data)) {
            return redirect()->route('hamlet.index')->withSuccess('Hamlet Number Berhasil Ditambahkan');
        }

        return back()->withInput()->withErrors('Hamlet Gagal Ditambahkan');
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit($id)
    {
        $hamlet = HamletNumber::findOrFail($id);

        return view('admin.hamlet.edit',compact('hamlet'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, $id)
    {
        $request->validate([
            'name' => 'required|string',
            'number' => 'required|numeric',
            'rt' => 'required|numeric',
            'rw' => 'required|numeric',
            'village' => 'required|string',
        ]);

        $data = $request->only('name', 'number', 'rt', 'rw', 'village');


        $hamletNumber = HamletNumber::findOrFail($id);

        if ($hamletNumber->update($data)) {
            return redirect()->route('hamlet.index')->withSuccess('Hamlet Number Berhasil Diubah');
        }

        return back()->withInput()->withErrors('Hamlet Number Gagal Diubah');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy($id)
    {

        $hamlets_number = HamletNumber::findOrFail($id);

        if ($hamlets_number->delete()) {
            return back()->withSuccess('Hamlet Number Berhasil Di Hapus!');
        } else {
            return back()->withErrors('Hamlet Number Gagal Di Hapus!');
        }
    }
}
