<?php

namespace App\Models;

// use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Laravel\Sanctum\HasApiTokens;
use Spatie\Permission\Traits\HasRoles;

class User extends Authenticatable
{
    use HasFactory, Notifiable, HasApiTokens, SoftDeletes, HasRoles;

    protected $fillable = [
        'name', 'surname', 'email', 'password', 'profile_photo',
        'department_id', 'job_title', 'phone_number',
    ];

    protected $hidden = ['password', 'remember_token',];

    public function department(): BelongsTo
    {
        return $this->belongsTo(Department::class);
    }

    public function leadingDepartments(): HasMany
    {
        return $this->hasMany(Department::class, 'leader_id');
    }

    public function isLeader(): bool
    {
        return $this->leadingDepartments()->exists();
    }

    public function isLeaderOf(Department $department): bool
    {
        return $department->leader_id === $this->id;
    }

    public function departmentLeader()
    {
        return $this->department?->leader();
    }

    public function categoryResponsibles(): HasMany
    {
        return $this->hasMany(CategoryResponsible::class);
    }

    public function requisitions(): HasMany
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
