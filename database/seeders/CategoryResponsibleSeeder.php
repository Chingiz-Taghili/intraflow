<?php

namespace Database\Seeders;

use App\Models\Category;
use App\Models\CategoryResponsible;
use App\Models\User;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class CategoryResponsibleSeeder extends Seeder
{
    use WithoutModelEvents;

    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $users = User::all();
        $office = Category::where('name', 'Ofis Ləvazimatı')->first();
        $repair = Category::where('name', 'Təmir Xidməti')->first();
        $cleaning = Category::where('name', 'Təmizlik Xidməti')->first();

        CategoryResponsible::create([
            'category_id' => $office->id, 'user_id' => $users[1]->id,
            'assigned_by' => $users[0]->id, 'assigned_at' => now()
        ]);
        CategoryResponsible::create([
            'category_id' => $repair->id, 'user_id' => $users[1]->id,
            'assigned_by' => $users[0]->id, 'assigned_at' => now()
        ]);
        CategoryResponsible::create([
            'category_id' => $cleaning->id, 'user_id' => $users[2]->id,
            'assigned_by' => $users[0]->id, 'assigned_at' => now()
        ]);
        CategoryResponsible::create([
            'category_id' => $office->id, 'user_id' => $users[3]->id,
            'assigned_by' => $users[0]->id, 'assigned_at' => now()
        ]);
    }
}
