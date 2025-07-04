<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Reservation extends Model
{
    protected $fillable = [
        'user_id',
        'facility_id',
        'facility_tariff_id',
        'selected_tariff_price',
        'extra_image',
        'total_payment',
        'time_start',
        'time_end',
        'purpose',
        'status',
        'approved_by',
        'final_approved_by',
        'image',
        'letter'
    ];
    public function user()
    {
        return $this->belongsTo(User::class);
    }
    public function facility()
    {
        return $this->belongsTo(Facility::class);
    }

    public function facilityTariff()
    {
        return $this->belongsTo(FacilityTariff::class);
    }

    public function approver()
    {
        return $this->belongsTo(User::class, 'approved_by');
    }

    public function finalApprover()
    {
        return $this->belongsTo(User::class, 'final_approved_by');
    }

    public function approvedBy()
    {
        return $this->belongsTo(User::class, 'approved_by');
    }
}
