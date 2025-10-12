<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class RequisitionImage extends Model
{
    use HasFactory;

    protected $fillable = ['requisition_id', 'path', 'sort_order',];

    public function requisition()
    {
        return $this->belongsTo(Requisition::class);
    }
}
