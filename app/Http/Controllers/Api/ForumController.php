<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Http\Resources\JsonResponses;
use App\Models\Forum;
use App\Models\User;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\Validator;
use Symfony\Component\HttpFoundation\Response;

class ForumController extends Controller
{
    public function all()
    {
        try {
            // Ambil semua data forum dengan pengecekan jumlah data
            $forums = Forum::all()->load('user');

            // if ($forums->isEmpty()) {
            //     return response()->json([
            //         'status' => 200,
            //         'message' => 'Tidak ada data forum yang tersedia.',
            //         'data' => []
            //     ], 200);
            // }

            $forums->transform(function ($item) {
                $item->image = url('/') . Storage::url($item->image);
                return $item;
            });

            return new JsonResponses(Response::HTTP_OK,"Data Berhasil di Dapatkan!",$forums);
        } catch (\Illuminate\Database\QueryException $e) {
            // Tangani kesalahan terkait database
            return response()->json([
                'status' => 500,
                'message' => 'Kesalahan database terjadi.',
                'error' => $e->getMessage()
            ], 500);
        } catch (\Exception $e) {
            // Tangani kesalahan umum lainnya
            return response()->json([
                'status' => 500,
                'message' => 'Terjadi kesalahan pada server.',
                'error' => $e->getMessage()
            ], 500);
        }
    }

    public function show($id)
    {
        try {
            // Validasi bahwa ID harus berupa angka
            if (!is_numeric($id)) {
                return response()->json([
                    'status' => 400,
                    'message' => 'ID tidak valid. Harus berupa angka.',
                    'data' => null
                ], 400);
            }

            // Cari forum berdasarkan ID
            $forum = Forum::find($id)->load('user');

            // Jika forum tidak ditemukan, kembalikan respons 404
            if (!$forum) {
                return response()->json([
                    'status' => 404,
                    'message' => 'Forum tidak ditemukan.',
                    'data' => null
                ], 404);
            }

            $forum->image = url('/') . Storage::url($forum->image);

            // Jika forum ditemukan, kembalikan data
            return response()->json([
                'status' => 200,
                'message' => 'Data forum berhasil didapatkan!',
                'data' => $forum
            ], 200);
        } catch (\Illuminate\Database\QueryException $e) {
            // Tangani kesalahan query database
            return response()->json([
                'status' => 500,
                'message' => 'Kesalahan database terjadi.',
                'error' => $e->getMessage()
            ], 500);
        } catch (\Exception $e) {
            // Tangani error umum lainnya
            return response()->json([
                'status' => 500,
                'message' => 'Terjadi kesalahan pada server.',
                'error' => $e->getMessage()
            ], 500);
        }
    }

    public function store(Request $request)
    {
        try {
            // Validasi input dengan aturan tambahan
            $validator = Validator::make($request->all(), [
                'user_id' => 'required|exists:users,name',
                'image' => 'nullable|image',
                'description' => 'required|string'
            ]);

            if ($validator->fails()) {
                return response()->json([
                    'status' => 422,
                    'message' => 'Validasi gagal.',
                    'errors' => $validator->errors()
                ], 422);
            }

            // Cek apakah user di tabel users ada
            $user = User::where('name', $request->user_id)->first();
            if (!$user) {
                return response()->json([
                    'status' => 404,
                    'message' => 'User tidak ditemukan.',
                    'data' => null
                ], 404);
            }

            // Proses upload gambar
            $imagePath = null;
            if ($request->hasFile('image')) {
                $imagePath = $request->file('image')->store('images/forum', 'public');
            }

            // Simpan data forum ke database
            $forum = Forum::create([
                'user_id' => $user->id,
                'image' => $imagePath,
                'description' => $request->description
            ]);

            // Cek apakah data berhasil disimpan
            if ($forum) {
                return response()->json([
                    'status' => 201,
                    'message' => 'Data Forum Berhasil Ditambahkan!',
                    'data' => $forum
                ], 201);
            } else {
                return response()->json([
                    'status' => 500,
                    'message' => 'Data Forum Gagal Ditambahkan!',
                    'data' => null
                ], 500);
            }
        } catch (\Illuminate\Database\QueryException $e) {
            return response()->json([
                'status' => 500,
                'message' => 'Kesalahan database saat menyimpan data.',
                'error' => $e->getMessage()
            ], 500);
        } catch (\Throwable $e) {
            return response()->json([
                'status' => 500,
                'message' => 'Terjadi kesalahan pada server.',
                'error' => $e->getMessage()
            ], 500);
        }
    }

    public function update(Request $request, $id)
    {
        try {
            // Validasi ID agar valid (harus berupa angka)
            if (!is_numeric($id)) {
                return response()->json([
                    'status' => 400,
                    'message' => 'ID tidak valid. Harus berupa angka.',
                    'data' => null
                ], 400);
            }

            // Validasi input yang diterima
            $validator = Validator::make($request->all(), [
                'image' => 'nullable|image',
                'description' => 'nullable|string'
            ]);

            if ($validator->fails()) {
                return response()->json([
                    'status' => 422,
                    'message' => 'Validasi gagal.',
                    'errors' => $validator->errors()
                ], 422);
            }

            // Mencari forum berdasarkan ID
            $forum = Forum::find($id);
            if (!$forum) {
                return response()->json([
                    'status' => 404,
                    'message' => 'Forum tidak ditemukan.',
                    'data' => null
                ], 404);
            }

            // Pengecekan hak akses: hanya pemilik forum yang bisa memperbarui (opsional)
            // if ($request->user()->id !== $forum->user_id) {
            //     return response()->json([
            //         'status' => 403,
            //         'message' => 'Anda tidak memiliki izin untuk memperbarui forum ini.',
            //         'data' => null
            //     ], 403);
            // }

            // Proses upload gambar jika ada
            if ($request->hasFile('image')) {
                // Hapus gambar lama jika ada
                if (!empty($forum->image) && Storage::disk('public')->exists($forum->image)) {
                    Storage::disk('public')->delete($forum->image);
                }

                // Simpan gambar baru
                $forum->image = $request->file('image')->store('images/forum', 'public');
            }

            // Proses pembaruan deskripsi jika diisi
            if ($request->filled('description')) {
                $forum->description = $request->description;
            }

            // Simpan data ke database
            if ($forum->save()) {
                return response()->json([
                    'status' => 200,
                    'message' => 'Forum berhasil diperbarui!',
                    'data' => $forum
                ], 200);
            } else {
                return response()->json([
                    'status' => 500,
                    'message' => 'Forum gagal diperbarui, silakan coba lagi.',
                    'data' => null
                ], 500);
            }
        } catch (\Illuminate\Database\QueryException $e) {
            return response()->json([
                'status' => 500,
                'message' => 'Kesalahan database saat memperbarui forum.',
                'error' => $e->getMessage()
            ], 500);
        } catch (\Throwable $e) {
            return response()->json([
                'status' => 500,
                'message' => 'Terjadi kesalahan pada server.',
                'error' => $e->getMessage()
            ], 500);
        }
    }

    public function destroy(Request $request, $id)
    {
        try {
            // Validasi ID harus berupa angka
            if (!is_numeric($id)) {
                return response()->json([
                    'status' => 400,
                    'message' => 'ID tidak valid. Harus berupa angka.',
                    'data' => null
                ], 400);
            }

            // Cari forum berdasarkan ID
            $forum = Forum::find($id);

            // Cek apakah forum ditemukan
            if (!$forum) {
                return response()->json([
                    'status' => 404,
                    'message' => 'Forum tidak ditemukan.',
                    'data' => null
                ], 404);
            }

            // Cek apakah pengguna memiliki izin untuk menghapus forum ini (opsional)
            // if ($request->user()->id !== $forum->user_id) {
            //     return response()->json([
            //         'status' => 403,
            //         'message' => 'Anda tidak memiliki izin untuk menghapus forum ini.',
            //         'data' => null
            //     ], 403);
            // }

            // Hapus gambar terkait jika ada
            if (!empty($forum->image) && Storage::disk('public')->exists($forum->image)) {
                Storage::disk('public')->delete($forum->image);
            }

            // Hapus forum dari database
            if ($forum->delete()) {
                return response()->json([
                    'status' => 200,
                    'message' => 'Forum berhasil dihapus.',
                    'data' => null
                ], 200);
            } else {
                return response()->json([
                    'status' => 500,
                    'message' => 'Forum gagal dihapus.',
                    'data' => null
                ], 500);
            }
        } catch (\Illuminate\Database\QueryException $e) {
            return response()->json([
                'status' => 500,
                'message' => 'Terjadi kesalahan saat menghapus data di database.',
                'error' => $e->getMessage()
            ], 500);
        } catch (\Throwable $e) {
            return response()->json([
                'status' => 500,
                'message' => 'Terjadi kesalahan pada server.',
                'error' => $e->getMessage()
            ], 500);
        }
    }
}
