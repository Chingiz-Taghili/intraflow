<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class RequisitionImage extends Model
{
    use HasFactory;

    protected $fillable = ['requisition_id', 'path', 'sort_order',];

    public function requisition(): BelongsTo
    {
        return $this->belongsTo(Requisition::class);
    }
}
