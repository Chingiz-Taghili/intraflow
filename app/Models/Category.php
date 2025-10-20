<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Support\Str;

class Category extends Model
{
    use HasFactory, SoftDeletes;

    protected $fillable = ['name', 'description'];

    public function subcategories(): HasMany
    {
        return $this->hasMany(Subcategory::class);
    }

    public function categoryResponsibles(): HasMany
    {
        return $this->hasMany(CategoryResponsible::class);
    }

    public function getRouteKeyName(): string
    {
        return 'slug';
    }

    protected static function booted(): void
    {
        static::creating(function ($category) {
            $baseSlug = Str::slug($category->name);
            $slug = $baseSlug;
            $count = 1;
            $existingSlugs = Category::where('slug', 'like', $baseSlug . '%')->pluck('slug')->toArray();
            while (in_array($slug, $existingSlugs)) {
                $slug = $baseSlug . '-' . $count++;
            }
            $category->slug = $slug;
        });
    }
}
