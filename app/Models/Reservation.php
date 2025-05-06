<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Reservation extends Model
{
    protected $fillable = [
        'user_id',
        'facility_id',
        'date',
        'time_start',
        'time_end',
        'purpose',
        'status',
        'approved_by',
        'final_approved_by',
        'letter_image',
    ];

    // Relasi ke Facility yang dipinjam
    public function facility()
    {
        return $this->belongsTo(Facility::class);
    }

    // Relasi ke Admin yang memverifikasi peminjaman
    public function approver()
    {
        return $this->belongsTo(User::class, 'approved_by');
    }

    // Relasi ke Superadmin yang menyetujui peminjaman final
    public function finalApprover()
    {
        return $this->belongsTo(User::class, 'final_approved_by');
    }
}
