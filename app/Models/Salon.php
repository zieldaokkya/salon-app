<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Salon extends Model
{
    protected $fillable = [

        'user_id',

        'nama_salon',

        'alamat',

        'kota',

        'deskripsi',

        'foto'

    ];
}