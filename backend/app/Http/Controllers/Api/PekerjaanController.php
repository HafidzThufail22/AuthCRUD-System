<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\Pekerjaan;
use Illuminate\Http\Request;

class PekerjaanController extends Controller
{
    // GET - Tampilkan semua pekerjaan
    public function index()
    {
        $pekerjaan = Pekerjaan::all();
        return response()->json([
            'status' => true,
            'message' => 'Data pekerjaan berhasil diambil',
            'data' => $pekerjaan
        ]);
    }

    // POST - Tambah pekerjaan baru
    public function store(Request $request)
    {
        $request->validate([
            'pekerjaan' => 'required|string|max:100'
        ]);

        $pekerjaan = Pekerjaan::create([
            'pekerjaan' => $request->pekerjaan
        ]);

        return response()->json([
            'status' => true,
            'message' => 'Pekerjaan berhasil ditambahkan',
            'data' => $pekerjaan
        ], 201);
    }

    // GET - Tampilkan pekerjaan berdasarkan ID
    public function show($id)
    {
        $pekerjaan = Pekerjaan::find($id);

        if (!$pekerjaan) {
            return response()->json([
                'status' => false,
                'message' => 'Pekerjaan tidak ditemukan'
            ], 404);
        }

        return response()->json([
            'status' => true,
            'message' => 'Detail pekerjaan',
            'data' => $pekerjaan
        ]);
    }

    // PUT - Update pekerjaan
    public function update(Request $request, $id)
    {
        $pekerjaan = Pekerjaan::find($id);

        if (!$pekerjaan) {
            return response()->json([
                'status' => false,
                'message' => 'Pekerjaan tidak ditemukan'
            ], 404);
        }

        $request->validate([
            'pekerjaan' => 'required|string|max:100'
        ]);

        $pekerjaan->update([
            'pekerjaan' => $request->pekerjaan
        ]);

        return response()->json([
            'status' => true,
            'message' => 'Pekerjaan berhasil diupdate',
            'data' => $pekerjaan
        ]);
    }

    // DELETE - Hapus pekerjaan
    public function destroy($id)
    {
        $pekerjaan = Pekerjaan::find($id);

        if (!$pekerjaan) {
            return response()->json([
                'status' => false,
                'message' => 'Pekerjaan tidak ditemukan'
            ], 404);
        }

        $pekerjaan->delete();

        return response()->json([
            'status' => true,
            'message' => 'Pekerjaan berhasil dihapus'
        ]);
    }
}
