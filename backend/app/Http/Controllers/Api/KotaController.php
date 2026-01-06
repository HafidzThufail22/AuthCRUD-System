<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Kota;

class KotaController extends Controller
{
    // GET: Ambil semua data
    public function index()
    {
        return response()->json(Kota::all());
    }

    // POST: Tambah data
    public function store(Request $request)
    {
        $kota = Kota::create($request->all());
        return response()->json(['message' => 'Berhasil', 'data' => $kota]);
    }

    // GET: Ambil 1 data
    public function show($id)
    {
        return response()->json(Kota::find($id));
    }

    // PUT: Update data 
    public function update(Request $request, $id)
    {
        $kota = Kota::find($id);
        $kota->update($request->all());
        return response()->json(['message' => 'Berhasil Diubah', 'data' => $kota]);
    }

    // DELETE: Hapus data 
    public function destroy($id)
    {
        Kota::destroy($id);
        return response()->json(['message' => 'Berhasil Dihapus']);
    }
}
