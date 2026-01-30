<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class GatePass extends Model
{
    use HasFactory;

    // ===============================
    // MASS ASSIGNABLE FIELDS
    // ===============================
    protected $fillable = [
        'student_id',
        'reason',
        'from_time',
        'to_time',
        'status',
        'approved_by',
    ];

    // ===============================
    // STUDENT RELATION
    // ===============================
    public function student()
    {
        return $this->belongsTo(Student::class, 'student_id');
    }
}