<?php

namespace App\Models;

// use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Laravel\Sanctum\HasApiTokens;

class User extends Authenticatable
{
    use HasFactory, Notifiable, HasApiTokens, SoftDeletes;

    protected $fillable = [
        'name', 'surname', 'email', 'password',
        'profile_photo', 'job_title', 'phone_number',
    ];

    protected $hidden = ['password', 'remember_token',];

    public function categoryResponsibles()
    {
        return $this->hasMany(CategoryResponsible::class);
    }

    public function requisitions()
    {
        return $this->hasMany(Requisition::class);
    }

    protected function casts(): array
    {
        return [
            'email_verified_at' => 'datetime',
            'password' => 'hashed',
        ];
    }
}
