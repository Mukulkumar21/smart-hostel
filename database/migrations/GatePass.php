<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class GatePass extends Model
{
    protected $fillable = [
        'student_id',
        'reason',
        'from_time',
        'to_time',
        'status',
        'approved_by'
    ];

    public function student()
    {
        return $this->belongsTo(Student::class);
    }
}