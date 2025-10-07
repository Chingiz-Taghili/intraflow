<?php

namespace Database\Seeders;

use App\Models\Category;
use App\Models\Subcategory;
use Illuminate\Database\Seeder;

class CategorySeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        // Categories
        $office = Category::create(['name' => 'Ofis Ləvazimatı']);
        $repair = Category::create(['name' => 'Təmir/Xidmət']);
        $cleaning = Category::create(['name' => 'Təmizlik']);

        // Subcategories
        Subcategory::create(['name' => 'Qələm', 'category_id' => $office->id]);
        Subcategory::create(['name' => 'Qovluq', 'category_id' => $office->id]);
        Subcategory::create(['name' => 'Qapı-Pəncərə Təmir', 'category_id' => $repair->id]);
        Subcategory::create(['name' => 'Təmizlik Məhsulları', 'category_id' => $cleaning->id]);
    }
}
