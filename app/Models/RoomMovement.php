<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class RoomMovement extends Model
{
    protected $fillable = [
        'room_id',
        'student_id',
        'movement_type',
        'moved_at',
        'reason',
    ];

    public function room()
    {
        return $this->belongsTo(Room::class);
    }

    public function student()
    {
        return $this->belongsTo(Student::class);
    }
}
