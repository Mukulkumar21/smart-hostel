<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\RoomMovement;
use App\Models\Student;

class Room extends Model
{
    use HasFactory;

    /**
     * Mass assignable fields
     */
    protected $fillable = [
        'room_number',
        'capacity',
    ];

    /**
     * A room has many students
     */
    public function students()
    {
        return $this->hasMany(Student::class);
    }

    /**
     * A room has many movements
     */
    public function movements()
    {
        return $this->hasMany(RoomMovement::class);
    }

    /**
     * Get current occupancy count
     */
    public function getOccupiedAttribute()
    {
        return $this->students()->count();
    }

    /**
     * Check if room is full
     */
    public function getIsFullAttribute()
    {
        return $this->occupied >= $this->capacity;
    }
    public function lock()
{
    $this->update(['status' => 'LOCKED']);
}

public function unlock()
{
    $this->update(['status' => 'OPEN']);
}

}
