<?php

namespace Database\Seeders;

use App\Models\Role;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;

class RoleSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $roles = [
            [
                'name' => 'Super Admin',
                'slug' => 'super-admin'
            ],

            [
                'name' => 'Admin',
                'slug' => 'admin'
            ],

            [
                'name' => 'Staff',
                'slug' => 'staff'
            ],
        ];

        DB::table('roles')->insert($roles);

        Role::first()->permissions()->attach([1, 2, 3, 4, 5, 6, 7, 8, 9, 10, 11, 12, 13]);
        Role::skip(1)->first()->permissions()->attach([1, 2, 3, 4, 5, 6, 7, 8, 9, 10, 11, 12, 13]);

        Role::skip(2)->take(1)->first()->permissions()->attach([1, 2, 9, 13]);

    }
}
