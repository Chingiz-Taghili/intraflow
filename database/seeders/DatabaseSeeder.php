<?php

namespace Database\Seeders;

use App\Models\Requisition;
use App\Models\User;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
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

        User::factory()->count(5)->create();
        Requisition::factory()->count(20)->create();
    }
}
