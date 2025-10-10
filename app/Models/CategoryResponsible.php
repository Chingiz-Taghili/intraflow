<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class CategoryResponsible extends Model
{
    use HasFactory, SoftDeletes;

    protected $fillable = ['category_id', 'user_id'];

    public function category()
    {
        return $this->belongsTo(Category::class);
    }

    public function user(){
        return $this->belongsTo(User::class);
    }

    public function assignedBy()
    {
        return $this->belongsTo(User::class, 'assigned_by');
    }

    protected static function booted(): void
    {
        static::creating(function ($responsible) {
            $responsible->assigned_by = auth()->id();
            $responsible->assigned_at = now();
        });
    }
}
