<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::table('categories', fn (Blueprint $t) => $t->unique('slug'));
        Schema::table('subcategories', fn (Blueprint $t) => $t->unique('slug'));
    }

    public function down(): void
    {
        Schema::table('categories', fn (Blueprint $t) => $t->dropUnique('categories_slug_unique'));
        Schema::table('subcategories', fn (Blueprint $t) => $t->dropUnique('subcategories_slug_unique'));
    }
};
