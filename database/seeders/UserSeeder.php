<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Seeder;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;

class UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $user1 = User::create([
            'name' => 'Admin',
            'email' => 'admin@admin.com',
            'password' => bcrypt('admin@01234'),
            'user_type' => 'Admin',
            'email_verified_at' => now(),
            'role_id' => 2,
        ]);
        $user2 = User::create([
            'name' => 'Admin',
            'email' => 'raygun01234@gmail.com',
            'password' => bcrypt('regan@01234'),
            'user_type' => 'Admin',
            'email_verified_at' => now(),
            'role_id' => 2,
        ]);

        $user1->permissions()->attach([1, 2, 3, 4, 5, 6, 7, 8, 9, 10, 11, 12, 13]);
    }
}
