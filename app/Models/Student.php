<?php

namespace App\Models;

use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Student extends Authenticatable
{
    use HasFactory, Notifiable;

    /*
    |--------------------------------------------------------------------------
    | Mass Assignable Fields
    |--------------------------------------------------------------------------
    */
    protected $fillable = [
        'name',
        'email',
        'password',
        'phone',
        'gender',
        'room_id',
        'admission_date',
        'parent_phone',
        'address',
        'photo',
    ];

    /*
    |--------------------------------------------------------------------------
    | Hidden Fields
    |--------------------------------------------------------------------------
    */
    protected $hidden = [
        'password',
        'remember_token',
    ];

    /*
    |--------------------------------------------------------------------------
    | Casts
    |--------------------------------------------------------------------------
    */
    protected $casts = [
        'admission_date' => 'date',
    ];

    /* ================= RELATIONSHIPS ================= */

    // Student belongs to a Room
    public function room()
    {
        return $this->belongsTo(Room::class);
    }

    // Room change history
    public function roomHistories()
    {
        return $this->hasMany(RoomChangeHistory::class);
    }

    // IN / OUT movements
    public function movements()
    {
        return $this->hasMany(RoomMovement::class);
    }

    // Fees
    public function fees()
    {
        return $this->hasMany(Fee::class);
    }

    /* ================= STATUS LOGIC ================= */

    /**
     * Check if student is currently OUT
     */
    public function isCurrentlyOut(): bool
    {
        $lastMovement = $this->movements()
            ->latest('moved_at')
            ->first();

        return $lastMovement && $lastMovement->movement_type === 'OUT';
    }

    /**
     * Check if student is currently IN
     */
    public function isCurrentlyIn(): bool
    {
        $lastMovement = $this->movements()
            ->latest('moved_at')
            ->first();

        // no movement = IN (default)
        return ! $lastMovement || $lastMovement->movement_type === 'IN';
    }
}
