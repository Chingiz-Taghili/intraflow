<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Requisition extends Model
{
    use HasFactory, SoftDeletes;

    protected $fillable = [
        'category_id', 'subcategory_id', 'item_name', 'notes', 'parent_request_id',
    ];

    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function category()
    {
        return $this->belongsTo(Category::class);
    }

    public function subcategory()
    {
        return $this->belongsTo(Subcategory::class);
    }

    public function parent()
    {
        return $this->belongsTo(Requisition::class, 'parent_request_id');
    }

    public function children()
    {
        return $this->hasMany(Requisition::class, 'parent_request_id');
    }

    protected static function booted(): void
    {
        static::creating(function ($requisition) {
            $requisition->user_id = $requisition->user_id ?? auth()->id();
            $requisition->status = 'pending';
        });
    }
}
