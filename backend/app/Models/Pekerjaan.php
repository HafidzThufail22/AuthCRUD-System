<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Pekerjaan extends Model
{
    protected $table = 'pekerjaan';

    protected $fillable = ['pekerjaan'];

    public function penduduk()
    {
        return $this->hasMany(Penduduk::class, 'pekerjaan_id');
    }
}
