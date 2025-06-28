<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class facilityTariff extends Model
{
    protected $fillable = [
        'facility_id',
        'rental_type',
        'day_type',
        'time_type',
        'price',
    ];

    public function facility()
    {
        return $this->belongsTo(Facility::class);
    }

    public function tariffs()
    {
        return $this->hasMany(FacilityTariff::class);
    }
}
