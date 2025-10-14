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
        //$adminRole = Role::where('name', 'Admin')->first();

        // Test users
        $users = [
            [
                'name' => 'Çingiz',
                'surname' => 'Tağılı',
                'email' => 'cingiz@mail.com',
                'password' => bcrypt('12345678'),
                'profile_photo' => 'cingiz.png',
                'job_title' => 'Backend Developer',
                'phone_number' => '+99812345678',
            ],
            [
                'name' => 'Kənan',
                'surname' => 'Məmmədov',
                'email' => 'kenan@mail.com',
                'password' => bcrypt('12345678'),
                'profile_photo' => 'kenan.png',
                'job_title' => 'Mobile Developer',
                'phone_number' => '+99812345678',
            ],
            [
                'name' => 'Elvin',
                'surname' => 'Hüseynov',
                'email' => 'elvin@mail.com',
                'password' => bcrypt('12345678'),
                'profile_photo' => 'elvin.png',
                'job_title' => 'Frontend Developer',
                'phone_number' => '+99812345678',
            ],
            [
                'name' => 'Nicat',
                'surname' => 'Paşayev',
                'email' => 'nicat@mail.com',
                'password' => bcrypt('12345678'),
                'profile_photo' => 'nicat.png',
                'job_title' => 'SQL Developer',
                'phone_number' => '+99812345678',
            ],
        ];

        foreach ($users as $data) {
            $user = User::create(array_merge($data, ['email_verified_at' => now()]));
            //$user->roles()->attach($adminRole->id);
        }
    }
}
