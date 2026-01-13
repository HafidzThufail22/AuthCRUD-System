<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\Penduduk;
use Illuminate\Http\Request;

class PendudukController extends Controller
{
    // GET - Tampilkan semua penduduk dengan relasi pekerjaan
    public function index()
    {
        $penduduk = Penduduk::with('pekerjaan')->get();
        return response()->json([
            'status' => true,
            'message' => 'Data penduduk berhasil diambil',
            'data' => $penduduk
        ]);
    }

    // POST - Tambah penduduk baru
    public function store(Request $request)
    {
        $request->validate([
            'nik' => 'required|string|max:16|unique:penduduk,nik',
            'nama' => 'required|string|max:100',
            'jenis_kelamin' => 'required|in:L,P',
            'tempat_lahir' => 'required|string|max:100',
            'tanggal_lahir' => 'required|date',
            'alamat' => 'required|string',
            'agama' => 'required|string|max:20',
            'status_perkawinan' => 'required|string|max:20',
            'pekerjaan_id' => 'required|exists:pekerjaan,id'
        ]);

        $penduduk = Penduduk::create($request->all());

        return response()->json([
            'status' => true,
            'message' => 'Penduduk berhasil ditambahkan',
            'data' => $penduduk->load('pekerjaan')
        ], 201);
    }

    // GET - Tampilkan penduduk berdasarkan ID
    public function show($id)
    {
        $penduduk = Penduduk::with('pekerjaan')->find($id);

        if (!$penduduk) {
            return response()->json([
                'status' => false,
                'message' => 'Penduduk tidak ditemukan'
            ], 404);
        }

        return response()->json([
            'status' => true,
            'message' => 'Detail penduduk',
            'data' => $penduduk
        ]);
    }

    // PUT - Update penduduk
    public function update(Request $request, $id)
    {
        $penduduk = Penduduk::find($id);

        if (!$penduduk) {
            return response()->json([
                'status' => false,
                'message' => 'Penduduk tidak ditemukan'
            ], 404);
        }

        $request->validate([
            'nik' => 'required|string|max:16|unique:penduduk,nik,' . $id,
            'nama' => 'required|string|max:100',
            'jenis_kelamin' => 'required|in:L,P',
            'tempat_lahir' => 'required|string|max:100',
            'tanggal_lahir' => 'required|date',
            'alamat' => 'required|string',
            'agama' => 'required|string|max:20',
            'status_perkawinan' => 'required|string|max:20',
            'pekerjaan_id' => 'required|exists:pekerjaan,id'
        ]);

        $penduduk->update($request->all());

        return response()->json([
            'status' => true,
            'message' => 'Penduduk berhasil diupdate',
            'data' => $penduduk->load('pekerjaan')
        ]);
    }

    // DELETE - Hapus penduduk
    public function destroy($id)
    {
        $penduduk = Penduduk::find($id);

        if (!$penduduk) {
            return response()->json([
                'status' => false,
                'message' => 'Penduduk tidak ditemukan'
            ], 404);
        }

        $penduduk->delete();

        return response()->json([
            'status' => true,
            'message' => 'Penduduk berhasil dihapus'
        ]);
    }

    // GET - Tampilkan penduduk laki-laki
    // Dibuat oleh: Hafidz Thufail
    public function lakilaki()
    {
        $penduduk = Penduduk::with('pekerjaan')
            ->where('jenis_kelamin', 'L')
            ->get();

        return response()->json([
            'status' => true,
            'nama' => 'Hafidz Thufail',
            'message' => 'Data penduduk laki-laki berhasil diambil',
            'data' => $penduduk
        ]);
    }

    // GET - Tampilkan penduduk dengan pekerjaan Karyawan Swasta
    // Dibuat oleh: Hafidz Thufail
    public function karyawanSwasta()
    {
        $penduduk = Penduduk::with('pekerjaan')
            ->whereHas('pekerjaan', function ($query) {
                $query->where('pekerjaan', 'Karyawan Swasta');
            })
            ->get();

        return response()->json([
            'status' => true,
            'nama' => 'Hafidz Thufail',
            'message' => 'Data penduduk dengan pekerjaan Karyawan Swasta',
            'data' => $penduduk
        ]);
    }
}
