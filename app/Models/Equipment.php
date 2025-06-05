<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Equipment extends Model
{

    protected $fillable = [
        'name',
        'brand',
        'quantity',
        'image',
        'facility_id'
    ];

    public function facility()
    {
        return $this->belongsTo(Facility::class);
    }
}
