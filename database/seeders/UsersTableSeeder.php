<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;

class UsersTableSeeder extends Seeder
{

    /**
     * Auto generated seed file
     *
     * @return void
     */
    public function run()
    {
        

        \DB::table('users')->delete();
        
        \DB::table('users')->insert(array (
            0 => 
            array (
                'id' => 1,
                'name' => 'Admin',
                'email' => 'admin@admin.com',
                'email_verified_at' => '2025-10-08 09:14:05',
                'password' => '$2y$12$SnnQRBk0jIRA.QIRprXyDeCAcZYE493MoYBhB2VpiM6hV/HFa47IK',
                'role_id' => 2,
                'user_type' => 'Admin',
                'user_status' => 'Active',
                'image' => 'TN4Gp7woOMTiEqDYZ6sF07Ky1syGGBiRY12B3jmd.png',
                'email_verification_token' => NULL,
                'email_verification_token_expiry' => NULL,
                'remember_token' => NULL,
                'deleted_at' => NULL,
                'created_at' => '2025-10-08 09:14:05',
                'updated_at' => '2026-04-30 14:37:11',
            ),
            1 => 
            array (
                'id' => 2,
                'name' => 'Admin',
                'email' => 'info@globaljourneyedu.com.np',
                'email_verified_at' => '2025-10-08 09:14:05',
                'password' => '$2y$12$.vd2/T1j6hZdRVdPDNbw9eRc8xZqlgcptqWX7GJdcJ9KlZ.GbCwbe',
                'role_id' => 2,
                'user_type' => 'Admin',
                'user_status' => 'Active',
                'image' => NULL,
                'email_verification_token' => NULL,
                'email_verification_token_expiry' => NULL,
                'remember_token' => NULL,
                'deleted_at' => NULL,
                'created_at' => '2025-10-08 09:14:05',
                'updated_at' => '2025-10-13 11:17:04',
            ),
        ));
        
        
    }
}