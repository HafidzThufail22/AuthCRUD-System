<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\Propinsi;
use Illuminate\Http\Request;

class PropinsiController extends Controller
{
    public function index()
    {
        // Mengambil semua data provinsi untuk dropdown
        return response()->json(Propinsi::all());
    }
}
