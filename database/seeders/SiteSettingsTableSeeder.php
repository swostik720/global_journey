<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;

class SiteSettingsTableSeeder extends Seeder
{

    /**
     * Auto generated seed file
     *
     * @return void
     */
    public function run()
    {
        

        \DB::table('site_settings')->delete();
        
        \DB::table('site_settings')->insert(array (
            0 => 
            array (
                'id' => 1,
                'logo' => 'RXun1DXkrTYfSHzNi71vu9CU7FtEfdJAruk1Nbdm.png',
                'logo_alt' => 'Global Journey company logo',
                'favicon' => 'xZ7ICZyZJhfUcx72qX5Nk9lMGUAsH6H4Rz24wsr9.png',
                'favicon_alt' => 'Global Journey website favicon',
                'name' => 'Global Journey',
                'slug' => NULL,
                'email' => 'info@globaljourneyedu.com.np',
                'phone' => '01-4168345',
                'mobile' => '+977 9705427840',
                'contact_address' => 'Putalisadak, Kathmandu, Nepal',
                'map_url' => 'https://www.google.com/maps/place/Global+Journey+Education/@27.7024961,85.3218979,62m/data=!3m1!1e3!4m6!3m5!1s0x39eb19a857567ae1:0xd1450b2f18a91a6f!8m2!3d27.7024996!4d85.3219403!16s%2Fg%2F11f3qx1xp_?entry=ttu&amp;amp;g_ep=EgoyMDI2MDUwMi4wIKXMDSoASAFQAw%3D%3D',
                'working_hours' => 'Sun-Fri',
                'copyright_text' => '© 2024 Global journeys - All Rights Reserved | Maintained by',
                'fb_link' => 'https://www.facebook.com/Globaljourney2018',
                'twitter_link' => 'https://www.tiktok.com/@globalljourney',
                'instagram_link' => 'https://www.instagram.com/globaljourneyeducation/',
                'linkedIn_link' => 'https://www.linkedin.com/company/global-journey-education-services-pvt-ltd/',
                'description' => 'Based in Nepal, Global Journey Education Services is a leading education consultant committed to helping professionals and students fulfill their academic and professional goals.',
                'created_at' => '2024-12-27 12:00:12',
                'updated_at' => '2026-07-11 13:44:44',
            ),
        ));
        
        
    }
}