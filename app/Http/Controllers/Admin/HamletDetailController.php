<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Hamlet;
use App\Models\HamletDetail;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class HamletDetailController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $query = HamletDetail::query();
        $hamlet_detail = $query->orderBy('hamlets_id', 'desc')->paginate(5);

        return view('admin.hamlet_detail.index', compact('hamlet_detail'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $hamlet = Hamlet::all(); // Ambil semua data hamlet
        return view('admin.hamlet_detail.create', compact('hamlet')); // Pass data hamlet ke view
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        // Validasi data yang dikirim dari form
        $request->validate([
            'hamlets_id' => 'required|exists:hamlets,id|numeric', // Validasi bahwa hamlets_id ada di tabel hamlets
            'latitude' => 'required|numeric',
            'longitude' => 'required|numeric',
        ]);

        // Ambil data yang dikirim dari form
        $data = $request->all();

        // Simpan data ke tabel hamlet_details
        if (HamletDetail::create($data)) {
            return redirect()->route('hamlet_detail.index')->withSuccess('Hamlet Detail Berhasil Ditambahkan');
        }

        // Jika terjadi kesalahan, kembali dengan pesan error
        return back()->withInput()->withErrors('Hamlet Detail Gagal Ditambahkan');
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit($id)
    {
        // Ambil data hamlet_detail yang akan diedit berdasarkan ID
        $hamlet_detail = HamletDetail::findOrFail($id);
        $hamlet = Hamlet::all(); // Ambil semua data hamlet untuk dropdown
        return view('admin.hamlet_detail.edit', compact('hamlet_detail', 'hamlet'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, $id)
    {
        // Ambil data hamlet_detail yang akan diupdate
        $hamlet_detail = HamletDetail::findOrFail($id);

        // Validasi data yang dikirim dari form
        $request->validate([
            'hamlets_id' => 'required|exists:hamlets,id|numeric', // Validasi hamlets_id
            'latitude' => 'required|numeric',
            'longitude' => 'required|numeric',
        ]);

        // Ambil data yang dikirim dari form
        $data = $request->all();

        // Update data ke tabel hamlet_details
        if ($hamlet_detail->update($data)) {
            return redirect()->route('hamlet_detail.index')->withSuccess('Hamlet Detail Berhasil Diubah');
        }

        // Jika terjadi kesalahan, kembali dengan pesan error
        return back()->withInput()->withErrors('Hamlet Detail Gagal Diubah');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy($id)
    {
        // Ambil data hamlet_detail yang akan dihapus berdasarkan ID
        $hamlet_detail = HamletDetail::findOrFail($id);

        // Hapus data hamlet_detail
        if ($hamlet_detail->delete()) {
            return back()->withSuccess('Hamlet Detail Berhasil Dihapus!');
        }

        // Jika terjadi kesalahan, kembali dengan pesan error
        return back()->withErrors('Hamlet Detail Gagal Dihapus!');
    }
}
