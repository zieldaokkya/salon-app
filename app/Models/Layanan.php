<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Layanan extends Model
{
    protected $fillable = [

        'salon_id',

        'nama_layanan',

        'harga',

        'varian',

        'durasi',

        'deskripsi',

        'foto'

    ];
}