<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Facility extends Model
{
    protected $fillable = [
        'name',
        'description',
        'location',
        'type',
        'capacity',
        'price',
        'account_name',
        'account_number',
        'bank_name',
        'images',
        'banner',
        'user_id',
    ];

    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function equipment()
    {
        return $this->hasMany(Equipment::class);
    }


    public function reservations()
    {
        return $this->hasMany(Reservation::class);
    }
}
