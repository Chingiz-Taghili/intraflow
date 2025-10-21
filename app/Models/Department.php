<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Support\Str;

class Department extends Model
{
    use HasFactory, SoftDeletes;

    protected $fillable = ['name', 'leader_id'];

    public function leader(): BelongsTo
    {
        return $this->belongsTo(User::class, 'leader_id');
    }

    public function users(): HasMany
    {
        return $this->hasMany(User::class);
    }

    public function getRouteKeyName(): string
    {
        return 'slug';
    }

    protected static function booted(): void
    {
        static::creating(function ($department) {
            $baseSlug = Str::slug($department->name);
            $slug = $baseSlug;
            $count = 1;
            $existingSlugs = Department::where('slug', 'like', $baseSlug . '%')->pluck('slug')->toArray();
            while (in_array($slug, $existingSlugs)) {
                $slug = $baseSlug . '-' . $count++;
            }
            $department->slug = $slug;
        });

        static::deleting(function (Department $department) {
            //Default department cannot be deleted
            if ($department->id === 1) {
                return false;
            }
            User::where('department_id', $department->id)->update(['department_id' => 1]);
        });
    }
}
