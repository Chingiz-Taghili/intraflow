<?php

namespace Database\Seeders;

use App\Models\Requisition;
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

        Requisition::factory()->count(10)->create();
    }
}
