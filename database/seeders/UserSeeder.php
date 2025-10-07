<?php

namespace Database\Seeders;

use App\Models\Role;
use App\Models\User;
use Illuminate\Database\Seeder;

class UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $adminRole = Role::where('name', 'Admin')->first();

        // Test users
        $users = [
            [
                'name' => 'Çingiz',
                'surname' => 'Tağılı',
                'email' => 'cingiz@mail.com',
                'password' => bcrypt('12345678'),
            ],
            [
                'name' => 'Kənan',
                'surname' => 'Məmmədov',
                'email' => 'kenan@mail.com',
                'password' => bcrypt('12345678'),
            ],
            [
                'name' => 'Elvin',
                'surname' => 'Hüseynov',
                'email' => 'elvin@mail.com',
                'password' => bcrypt('12345678'),
            ],
        ];

        foreach ($users as $data) {
            $user = User::create(array_merge($data, ['email_verified_at' => now()]));
            $user->roles()->attach($adminRole->id);
        }
    }
}
