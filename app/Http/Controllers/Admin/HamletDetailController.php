<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\HamletDetail;
use Illuminate\Http\Request;

class HamletDetailController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $query = HamletDetail::query();
        $hamlet_detail = $query->orderBy('name', 'desc')->paginate(5);

        return view('admin.hamlet_detail.index', compact('hamlet_detail'));
    }

    public function create()
    {
        return view('admin.hamlet_detail.create');
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
            'rt' => 'required|numeric',
        ]);

        $data = $request->only('name', 'title', 'rt');

        // Proses file gambar
        if ($request->hasFile('image')) {
            $data['image'] = $request->file('image')->store('images/hamlet_detail', 'public');
        }

        if (HamletDetail::create($data)) {
            return redirect()->route('hamlet_detail.index')->withSuccess('HamletDetail Berhasil Ditambahkan');
        }

        return back()->withInput()->withErrors('HamletDetail Gagal Ditambahkan');
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit($id)
    {
        $hamlet_detail = HamletDetail::findOrFail($id);

        return view('admin.hamlet_detail.edit', compact('hamlet_detail'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, $id)
    {

        $hamlet_detail = HamletDetail::findOrFail($id);

        $request->validate([
            'name' => 'required|string',
            'title' => 'required|string',
            'image' => 'nullable|image',
            'rt' => 'required|numeric',
        ]);

        $data = $request->only('name', 'title', 'rt');
        dd($data['title']);

        // Proses file gambar
        if ($request->hasFile('image')) {
            // Hapus gambar lama jika ada
            if ($hamlet_detail->image && Storage::exists($hamlet_detail->image)) {
                Storage::delete($hamlet_detail->image);
            }
            $data['image'] = $request->file('image')->store('images/hamlet_detail', 'public');
        }


        if ($hamlet_detail->update($data)) {
            return redirect()->route('hamlet_detail.index')->withSuccess('HamletDetail Berhasil Diubah');
        }

        return back()->withInput()->withErrors('HamletDetail Gagal Diubah');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy($id)
    {
        // Mendapatkan objek hamlet_detail berdasarkan id
        $hamlet_detail = HamletDetail::findOrFail($id);

        // Hapus gambar jika ada
        if ($hamlet_detail->image && Storage::exists($hamlet_detail->image)) {
            Storage::delete($hamlet_detail->image);
        }

        // Hapus data hamlet_detail
        if ($hamlet_detail->delete()) {
            return back()->withSuccess('HamletDetail Berhasil Di Hapus!');
        } else {
            return back()->withErrors('HamletDetail Gagal Di Hapus!');
        }
    }
}
