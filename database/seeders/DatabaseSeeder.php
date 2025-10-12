<?php

namespace Database\Seeders;

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
        // User::factory(10)->create();

        // User::factory()->create([
        //     'name' => 'Test User',
        //     'email' => 'test@example.com',
        // ]);

        $this->call(PermissionSeeder::class);
        $this->call(RoleSeeder::class);
        $this->call(UserSeeder::class);

        $this->call(SiteSettingsTableSeeder::class);
        $this->call(SmtpSettingsTableSeeder::class);
        $this->call(TestimonialsTableSeeder::class);
        $this->call(TeamsTableSeeder::class);
        $this->call(CountriesTableSeeder::class);
        $this->call(StudyAbroadsTableSeeder::class);
        $this->call(TestPreparationsTableSeeder::class);
        $this->call(CategoriesTableSeeder::class);
        $this->call(BlogsTableSeeder::class);
        $this->call(BranchesTableSeeder::class);

        $this->call(InterviewPreparationTableSeeder::class);
        $this->call(DocumentChecklistTableSeeder::class);

        $this->call(WhyCountrySeeder::class);
        $this->call(CollegeAndUniversitySeeder::class);
        $this->call(CountryGuideSeeder::class);

        $this->call(GalleryCategorySeeder::class);
    }
}
