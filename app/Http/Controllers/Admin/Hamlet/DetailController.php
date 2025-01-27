<?php

namespace App\Http\Controllers\Admin\Hamlet;

use App\Http\Controllers\Controller;
use App\Models\Hamlet\Detail;
use App\Models\Hamlet;
use Illuminate\Http\Request;

class DetailController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index($id)
    {
        $hamlet = Hamlet::findOrFail($id);
        $hamlet_id = $hamlet->id;
        $details = Detail::where('hamlets_id', $id)->orderBy('id', 'desc')->paginate(5);

        return view('admin.hamlet.detail.index', [
            'hamlet' => $hamlet,
            'hamlet_id' => $hamlet_id,  // Add this line
            'details' => $details
        ]);
    }


    /**
     * Show the form for creating a new resource.
     */
    public function create($id)
    {
        $hamlet = Hamlet::findOrFail($id); // Ambil semua data hamlet
        return view('admin.hamlet.detail.create', compact('hamlet')); // Pass data hamlet ke view
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request, $id)
    {
        $hamlet = Hamlet::findOrFail($id);
        // Validasi data yang dikirim dari form
        $request->validate([
            'latitude' => 'required|numeric',
            'longitude' => 'required|numeric',
        ], [
            'latitude.required' => 'Latitude harus diisi!',
            'longitude.required' => 'Longitude harus diisi!',
        ]);

        // Ambil data yang dikirim dari form
        $data = $request->only(['latitude', 'longitude']);
        $data['hamlets_id'] = $hamlet->id;

        // Simpan data ke tabel hamlet_details
        if (Detail::create($data)) {
            return redirect()->route('hamlet_detail.index', $hamlet->id)->withSuccess('Hamlet Detail Berhasil Ditambahkan');
        }

        // Jika terjadi kesalahan, kembali dengan pesan error
        return back()->withInput()->withErrors('Hamlet Detail Gagal Ditambahkan');
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit($id, $detail_id)
    {
        // Find the Hamlet and HamletDetail based on the parameters
        $hamlet = Hamlet::findOrFail($id);
        $detail = Detail::findOrFail($detail_id);

        // Return the edit view with the hamlet and detail
        return view('admin.hamlet.detail.edit', compact('hamlet', 'detail'));
    }


    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, $id, $detail_id)
    {
        $hamlet = Hamlet::findOrFail($id);
        // Ambil data hamlet_detail yang akan diupdate
        $hamlet_detail = Detail::findOrFail($detail_id);

        // Validasi data yang dikirim dari form
        $request->validate([
            'latitude' => 'required|numeric',
            'longitude' => 'required|numeric',
        ]);


        // Ambil data yang dikirim dari form
        $data = $request->all();

        // Update data ke tabel hamlet_details
        if ($hamlet_detail->update($data)) {
            return redirect()->route('hamlet_detail.index', $hamlet->id)->withSuccess('Hamlet Detail Berhasil Diubah');
        }

        // Jika terjadi kesalahan, kembali dengan pesan error
        return back()->withInput()->withErrors('Hamlet Detail Gagal Diubah');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy($id, $detail_id)
    {
        $hamlet = Hamlet::findOrFail($id);
        // Ambil data hamlet_detail yang akan dihapus berdasarkan ID
        $hamlet_detail = Detail::findOrFail($detail_id);

        // Hapus data hamlet_detail
        if ($hamlet_detail->delete()) {
            return redirect()->route('hamlet_detail.index', $hamlet->id)->withSuccess('Hamlet Detail Berhasil Dihapus!');
        }

        // Jika terjadi kesalahan, kembali dengan pesan error
        return back()->route('hamlet_detail.index', $hamlet->id)->withErrors('Hamlet Detail Gagal Dihapus!');
    }
}
