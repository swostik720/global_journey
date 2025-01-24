<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class SmtpSettingsTableSeeder extends Seeder
{

    /**
     * Auto generated seed file
     *
     * @return void
     */
    public function run()
    {


        DB::table('smtp_settings')->delete();

        DB::table('smtp_settings')->insert(array (
            0 =>
            array (
                'id' => 1,
                'mail_mailer' => 'smtp',
                'mail_host' => 'smtp.gmail.com',
                'mail_port' => 587,
                'mail_username' => 'raygun01234@gmail.com',
                'mail_password' => 'itsflfbqnzhglrpm',
                'mail_encryption' => 'tls',
                'mail_from_address' => 'info@project.com',
                'mail_from_name' => 'Project',
                'created_at' => '2024-09-13 13:22:28',
                'updated_at' => '2024-09-13 13:24:25',
            ),
        ));

    }
}
