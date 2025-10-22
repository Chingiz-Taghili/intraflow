<?php

namespace App\Models;

use App\Enums\RequisitionStatus;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\SoftDeletes;

class Requisition extends Model
{
    use HasFactory, SoftDeletes;

    protected $fillable = [
        'category_id', 'subcategory_id', 'item_name', 'notes',
        'status', 'reviewed_by', 'parent_request_id',
    ];

    public function user(): BelongsTo
    {
        return $this->belongsTo(User::class);
    }

    public function category(): BelongsTo
    {
        return $this->belongsTo(Category::class);
    }

    public function subcategory(): BelongsTo
    {
        return $this->belongsTo(Subcategory::class);
    }

    public function images(): HasMany
    {
        return $this->hasMany(RequisitionImage::class)->orderBy('sort_order');
    }

    public function reviewedBy(): BelongsTo
    {
        return $this->belongsTo(User::class, 'reviewed_by');
    }

    public function parent(): BelongsTo
    {
        return $this->belongsTo(Requisition::class, 'parent_request_id');
    }

    public function children(): HasMany
    {
        return $this->hasMany(Requisition::class, 'parent_request_id');
    }

    protected function casts(): array
    {
        return ['status' => RequisitionStatus::class];
    }

    protected static function booted(): void
    {
        static::creating(function ($requisition) {
            $requisition->user_id = $requisition->user_id ?? auth()->id();
            $requisition->status = $requisition->status ?? RequisitionStatus::DRAFT->value;
        });
    }
}
