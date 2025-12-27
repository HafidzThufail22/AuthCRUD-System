<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Kota extends Model
{
    use HasFactory;

    // Pastikan propinsi_id ada di sini
    protected $fillable = [
        'nama_kota',
        'propinsi_id'
    ];
}
