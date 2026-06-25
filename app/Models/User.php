<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use App\Models\Booking;

class User extends Authenticatable
{
    use HasFactory, Notifiable;


    protected $fillable = [

        'name',
        'email',
        'password',
        'role',
        'nama_salon'

    ];


    protected $hidden = [

        'password',
        'remember_token',

    ];


    protected $casts = [

        'email_verified_at' => 'datetime',
        'password' => 'hashed',

    ];



    // 🔥 RELASI USER KE BOOKING
    public function booking()
    {
        return $this->hasMany(Booking::class, 'customer_id');
    }

}