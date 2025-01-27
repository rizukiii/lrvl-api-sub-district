<?php

namespace App\Http\Controllers\Admin\Gallery;

use App\Http\Controllers\Controller;
use App\Models\Gallery\Detail;
use App\Models\Gallery;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class DetailController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(Request $request, $id)
    {
        $gallery = Gallery::findOrFail($id);
        $album = Detail::where('gallery_id', $id)->paginate(5);
        $galleries = Gallery::all(); // Add this line to fetch all galleries

        return view('admin.gallery.details.index', compact('album', 'gallery', 'galleries'));
    }


    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request, $id)
    {
        $request->validate([
            'image' => 'required|image', // Validasi gambar
        ]);

        // Proses penyimpanan gambar
        $data = ['gallery_id' => $id]; // Menggunakan id galeri yang dikirim dari modal

        if ($request->hasFile('image')) {
            $data['image'] = $request->file('image')->store('images/album', 'public');
        }

        $album = Detail::create($data);

        if ($album) {
            return redirect()->route('album.index', $id)->with('success', 'Album berhasil ditambahkan.');
        } else {
            return back()->withInput()->withErrors('Album gagal ditambah!');
        }
    }

    
    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Detail $id)
    {
        $request->validate([
            'image' => 'nullable|image', // Validasi gambar
        ]);

        $data = $request->only('gallery_id'); // Pastikan data gallery_id dikirim

        // Jika ada gambar baru
        if ($request->hasFile('image')) {
            // Hapus gambar lama jika ada
            if ($id->image && Storage::exists($id->image)) {
                Storage::delete($id->image);
            }
            // Simpan gambar baru
            $data['image'] = $request->file('image')->store('images/album', 'public');
        }

        // Update data album
        if ($id->update($data)) {
            return redirect()->route('album.index', $id->gallery_id)->withSuccess('Album berhasil diubah!');
        } else {
            return back()->withInput()->withErrors('Album gagal diubah!');
        }
    }


    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Detail $id)
    {
        if ($id->image && Storage::exists($id->image)) {
            Storage::delete($id->image);
        }

        if ($id->delete()) {
            return back()->withSuccess('Album Berhasil Di Hapus');
        } else {
            return back()->withErrors('Album Gagal Di Hapus!');
        }
    }
}
