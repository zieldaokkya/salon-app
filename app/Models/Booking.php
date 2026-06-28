<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Booking extends Model
{
    protected $fillable = [
        'customer_id',
        'salon_id',
        'layanan_id',
        'status',
        'tanggal',
        'jam',
        'metode',
        'pembayaran',
        'total'
    ];

    // 🔥 RELASI KE CUSTOMER (USER)
    public function customer()
    {
        return $this->belongsTo(User::class, 'customer_id');
    }

    // 🔥 RELASI KE LAYANAN
    public function layanan()
    {
        return $this->belongsTo(Layanan::class, 'layanan_id');
    }

    // 🔥 RELASI KE SALON (opsional tapi bagus)
    public function salon()
    {
        return $this->belongsTo(Salon::class, 'salon_id');
    }
}