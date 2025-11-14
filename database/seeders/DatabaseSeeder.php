<?php

namespace Database\Seeders;

use App\Models\Requisition;
use App\Models\User;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    use WithoutModelEvents;

    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        $this->call([
            RoleSeeder::class,
            CategorySeeder::class,
            DepartmentSeeder::class,
            UserSeeder::class,
            CategoryResponsibleSeeder::class,
        ]);

        User::factory(50)->create();
        Requisition::factory(20)->create();
    }
}
