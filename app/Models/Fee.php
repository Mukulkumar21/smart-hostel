<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Fee extends Model
{
    protected $fillable = [
        'student_id',
        'total_fees',
        'paid_fees',
        'pending_fees',
        'payment_date',
        'status',
    ];

    // ✅ IMPORTANT FIX (DATE CASTING)
    protected $casts = [
        'payment_date' => 'datetime',
    ];

    public function student()
    {
        return $this->belongsTo(Student::class);
    }
}
