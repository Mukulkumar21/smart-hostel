<?php

namespace App\Models;

use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Warden extends Authenticatable
{
    use HasFactory, Notifiable;

    /**
     * Table name (IMPORTANT)
     */
    protected $table = 'wardens';

    /**
     * Mass assignable fields
     */
    protected $fillable = [
        'name',
        'email',
        'password',
    ];

    /**
     * Hidden fields
     */
    protected $hidden = [
        'password',
        'remember_token',
    ];

    /**
     * Casts
     */
    protected $casts = [
        'email_verified_at' => 'datetime',
        'password' => 'hashed', // 🔥 Laravel 10+ best practice
    ];
}