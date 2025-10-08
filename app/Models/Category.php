<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Support\Str;

class Category extends Model
{
    use HasFactory, SoftDeletes;

    protected $fillable = ['name', 'description'];

    public function subcategories()
    {
        return $this->hasMany(Subcategory::class);
    }

    public function categoryResponsibles()
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
            $slug = Str::slug($category->name);
            $original = $slug;
            $count = 1;
            $existingSlugs = Category::where('slug', 'like', $original . '%')->pluck('slug')->toArray();
            while (in_array($slug, $existingSlugs)) {
                $slug = $original . '-' . $count++;
            }
            $category->slug = $slug;
        });
    }
}
