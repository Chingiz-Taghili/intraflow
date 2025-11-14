<?php

namespace Database\Seeders;

use App\Models\Category;
use App\Models\Subcategory;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class CategorySeeder extends Seeder
{
    use WithoutModelEvents;

    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        // Categories
        $office = Category::create(['name' => 'Ofis Ləvazimatı', 'description' => 'Office related']);
        $repair = Category::create(['name' => 'Təmir Xidməti', 'description' => 'General repair']);
        $cleaning = Category::create(['name' => 'Təmizlik Xidməti', 'description' => 'Cleaning and hygiene']);

        // Subcategories
        Subcategory::create(['name' => 'Qələm', 'category_id' => $office->id, 'description' => 'Pens for office']);
        Subcategory::create(['name' => 'Qovluq', 'category_id' => $office->id, 'description' => 'Folders and files']);
        Subcategory::create(['name' => 'Pəncərə Təmiri', 'category_id' => $repair->id, 'description' => 'Window repair']);
        Subcategory::create(['name' => 'Təmizlik Məhsulları', 'category_id' => $cleaning->id, 'description' => 'Cleaning products']);
    }
}
