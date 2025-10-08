<?php

namespace Database\Seeders;

use App\Models\Requisition;
use App\Models\User;
// use Illuminate\Database\Console\Seeds\WithoutModelEvents;
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
            UserSeeder::class,
            CategoryResponsibleSeeder::class,
        ]);

        Requisition::factory()->count(20)->create();
    }
}
