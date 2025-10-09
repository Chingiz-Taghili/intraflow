<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Support\Str;

class Subcategory extends Model
{
    use HasFactory, SoftDeletes;

    protected $fillable = ['category_id', 'name', 'description'];

    public function category()
    {
        return $this->belongsTo(Category::class);
    }

    public function getRouteKeyName(): string
    {
        return 'slug';
    }

    protected static function booted(): void
    {
        static::creating(function ($subcategory) {
            $baseSlug = Str::slug($subcategory->name);
            $slug = $baseSlug;
            $count = 1;
            $existingSlugs = Subcategory::where('slug', 'like', $baseSlug . '%')->pluck('slug')->toArray();
            while (in_array($slug, $existingSlugs)) {
                $slug = $baseSlug . '-' . $count++;
            }
            $subcategory->slug = $slug;
        });
    }
}
