<?php

namespace App\Http\Controllers\Admin\User;

use App\Http\Controllers\Controller;
use App\Models\User\Address;
use Illuminate\Http\Request;

class AddressController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $query = Address::query();
        $hamlet_number = $query->orderBy('street', 'desc')->paginate(5);

        return view('admin.user.number.index',compact('hamlet_number'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('admin.user.number.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $request->validate([
            'street' => 'required|string',
            'number' => 'required|numeric',
            'rt' => 'required|numeric',
            'rw' => 'required|numeric',
            'village' => 'required|string',
        ]);

        $data = $request->only('street', 'number', 'rt', 'rw', 'village');

        if (Address::create($data)) {
            return redirect()->route('hamlet_number.index')->withSuccess('Hamlet Number Berhasil Ditambahkan');
        }

        return back()->withInput()->withErrors('Hamlet Gagal Ditambahkan');
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit($id)
    {
        $hamlet_number = Address::findOrFail($id);

        return view('admin.user.number.edit',compact('hamlet_number'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, $id)
    {
        $hamletNumber = Address::findOrFail($id);

        $request->validate([
            'street' => 'required|string',
            'number' => 'required|numeric',
            'rt' => 'required|numeric',
            'rw' => 'required|numeric',
            'village' => 'required|string',
        ]);

        $data = $request->only('street', 'number', 'rt', 'rw', 'village');

        if ($hamletNumber->update($data)) {
            return redirect()->route('hamlet_number.index')->withSuccess('Hamlet Number Berhasil Diubah');
        }

        return back()->withInput()->withErrors('Hamlet Number Gagal Diubah');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy($id)
    {

        $hamlets_number = Address::findOrFail($id);

        if ($hamlets_number->delete()) {
            return back()->withSuccess('Hamlet Number Berhasil Di Hapus!');
        } else {
            return back()->withErrors('Hamlet Number Gagal Di Hapus!');
        }
    }
}
