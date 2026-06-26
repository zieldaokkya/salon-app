<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Layanan extends Model
{
    protected $table = 'layanans';

    protected $fillable = [
        'salon_id',
        'nama_layanan',
        'harga',
        'varian',
        'durasi',
        'deskripsi',
        'foto'
    ];
    
    public function salon()
    {
        return $this->belongsTo(Salon::class);
    }

    public function booking()
    {
        return $this->hasMany(Booking::class);
    }
}