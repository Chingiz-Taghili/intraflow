<?php

namespace Database\Seeders;

use App\Models\Category;
use App\Models\CategoryResponsible;
use App\Models\User;
use Illuminate\Database\Seeder;

class CategoryResponsibleSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $users = User::all();

        // Kateqoriyaları sabit götür
        $office = Category::where('name', 'Ofis Ləvazimatı')->first();
        $repair = Category::where('name', 'Təmir/Xidmət')->first();
        $cleaning = Category::where('name', 'Təmizlik')->first();

        // Məsuliyyətləri əl ilə təyin et
        CategoryResponsible::create([
            'user_id' => $users[0]->id,
            'category_id' => $office->id,
            'assigned_by' => $users[0]->id, // admin
        ]);

        CategoryResponsible::create([
            'user_id' => $users[0]->id,
            'category_id' => $repair->id,
            'assigned_by' => $users[0]->id, // admin
        ]);

        CategoryResponsible::create([
            'user_id' => $users[1]->id,
            'category_id' => $cleaning->id,
            'assigned_by' => $users[0]->id, // admin
        ]);

        CategoryResponsible::create([
            'user_id' => $users[2]->id,
            'category_id' => $office->id,
            'assigned_by' => $users[0]->id, // admin
        ]);
    }
}
