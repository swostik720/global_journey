<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;

class PermissionSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $permissions = [
            [//1
                'name' => 'Access Dashboard',
                'slug' => 'access-dashboard'
            ],

            [//2
                'name' => 'Access User Page',
                'slug' => 'access-user-page'
            ],

            [//3
                'name' => 'Add User',
                'slug' => 'add-user'
            ],

            [//4
                'name' => 'Delete User',
                'slug' => 'delete-user'
            ],

            [//5
                'name' => 'Edit User',
                'slug' => 'edit-user'
            ],
            [ //6
                'name' => 'Add Permission',
                'slug' => 'add-permission'
            ],

            [//7
                'name' => 'Edit Permission',
                'slug' => 'edit-permission'
            ],

            [//8
                'name' => 'Delete Permission',
                'slug' => 'delete-permission'
            ],

            [//9
                'name' => 'Access Permission Page',
                'slug' => 'access-permission-page'
            ],

            [//10
                'name' => 'Add Role',
                'slug' => 'add-role'
            ],

            [//11
                'name' => 'Edit Role',
                'slug' => 'edit-role'
            ],

            [//12
                'name' => 'Delete Role',
                'slug' => 'delete-role'
            ],

            [//13
                'name' => 'Access Roles Page',
                'slug' => 'access-role-page'
            ],
        ];

        DB::table('permissions')->insert($permissions);
    }
}
