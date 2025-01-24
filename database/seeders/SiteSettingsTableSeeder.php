<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class SiteSettingsTableSeeder extends Seeder
{

    /**
     * Auto generated seed file
     *
     * @return void
     */
    public function run()
    {
        DB::table('site_settings')->delete();

        DB::table('site_settings')->insert(array(
            0 =>
            array(
                'id' => 1,
                'logo' => 'JhJ4cs9AG0bFY2MpmzEYAoGspMScRnWqlctkj20F.png',
                'favicon' => 'xZ7ICZyZJhfUcx72qX5Nk9lMGUAsH6H4Rz24wsr9.png',
                'name' => 'Global Journey',
                'slug' => NULL,
                'email' => 'raygun01234@gmail.com',
                'phone' => '+01-84856938',
                'mobile' => '+977-9843215204',
                'contact_address' => 'Putalisadak, Kathmandu Nepal',
                'map_url' => 'https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d56516.31713620462!2d85.28493288341947!3d27.708954252167064!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x39eb198a307baabf%3A0xb5137c1bf18db1ea!2sKathmandu%2044600%2C%20Nepal!5e0!3m2!1sen!2sae!4v1736960829129!5m2!1sen!2sae',
                'working_hours' => 'Sun-Fri',
                'copyright_text' => '© 2024 Global journeys - All Rights Reserved | Maintained by',
                'fb_link' => 'https://www.facebook.com/globaljourney',
                'twitter_link' => 'https://www.twitter.com/globaljourney',
                'instagram_link' => 'https://www.instagram.com/globaljourney',
                'linkedIn_link' => 'https://www.linkedin.com/globaljourney',
                'description' => 'Based in Nepal, Global Journey Education Services is a leading education consultant committed to helping professionals and students fulfill their academic and professional goals.',
                'created_at' => '2024-12-27 12:00:12',
                'updated_at' => '2025-01-15 18:29:54',
            ),
        ));
    }
}
