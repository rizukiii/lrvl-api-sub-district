<?php

namespace App\Http\Controllers\Admin\Hamlet;

use App\Http\Controllers\Controller;
use App\Models\Hamlet\Gallery;
use App\Models\HamletDetail;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class GalleryController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index($id)
    {
        $hamlet_detail = HamletDetail::findOrFail($id);
        $album = Gallery::where('hamlet_detail_id', $id)->paginate(5);
        $hamlet_detail_all = HamletDetail::all();

        return view('admin.hamlet_detail.gallery.index',compact('hamlet_detail','album','hamlet_detail_all'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create($id)
    {
        $hamlet_detail = HamletDetail::findOrFail($id); // Dapatkan detail hamlet berdasarkan ID
        return view('admin.hamlet_detail.gallery.create', compact('hamlet_detail'));
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
        $data = ['hamlet_detail_id' => $id]; // Menggunakan id galeri yang dikirim dari modal
        if ($request->hasFile('image')) {
            $data['image'] = $request->file('image')->store('images/hamlet_images', 'public');
        }

        $album = Gallery::create($data);
        if($album){
            return redirect()->route('hamlet_gallery.index', $id)->with('success', 'Hamlet Galeri berhasil ditambahkan.');
        } else {
            return back()->route('hamlet_gallery.index', $id)->withErrors('Hamlet Galeri Gagal ditambahkan.');
        }
    }

    public function edit($id)
    {
        // Ambil data album berdasarkan ID
        $album = Gallery::findOrFail($id);

        // Ambil detail hamlet berdasarkan ID album
        $hamlet_detail = HamletDetail::findOrFail($album->hamlet_detail_id);

        // Kembalikan data ke view untuk ditampilkan
        return view('admin.hamlet_detail.gallery.edit', compact('hamlet_detail', 'album'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request,Gallery $id)
    {
        $request->validate([
            'image' => 'required|image', // Validasi gambar
        ]);

        // Proses penyimpanan gambar
        $data = $request->only('hamlet_detail_id'); // Menggunakan id galeri yang dikirim dari modal

        if ($request->hasFile('image')) {
            // Hapus gambar lama jika ada
            if ($id->image && Storage::exists($id->image)) {
                Storage::delete($id->image);
            }
            // Simpan gambar baru
            $data['image'] = $request->file('image')->store('images/hamlet_images', 'public');
        }

        // Update data album
        if ($id->update($data)) {
            return redirect()->route('hamlet_gallery.index', $id)->withSuccess('Gambar berhasil diubah!');
        }
        return back()->withInput()->withErrors('Gambar gagal diubah!');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy($id)
    {
        // Find the gallery record by its ID
        $album = Gallery::findOrFail($id);

        // Delete the image from storage if it exists
        if ($album->image && Storage::exists($album->image)) {
            Storage::delete($album->image); // Delete the image from the storage
        }

        // Delete the gallery record
        if ($album->delete()) {
            return redirect()->route('hamlet_gallery.index', $album->hamlet_detail_id)
                            ->with('success', 'Hamlet Gallery successfully deleted.');
        }

        return back()->withErrors('Failed to delete Hamlet Gallery.');
    }

}
