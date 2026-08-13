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

        $this->call(PermissionsTableSeeder::class);
        $this->call(RolesTableSeeder::class);
        $this->call(PermissionRoleTableSeeder::class);
        $this->call(UsersTableSeeder::class);
        $this->call(PermissionUserTableSeeder::class);

        $this->call(SiteSettingsTableSeeder::class);
        $this->call(SmtpSettingsTableSeeder::class);
        $this->call(LegalPagesTableSeeder::class);
        $this->call(TestimonialsTableSeeder::class);
        $this->call(TeamsTableSeeder::class);
        $this->call(CountriesTableSeeder::class);
        $this->call(StudyAbroadsTableSeeder::class);
        $this->call(TestPreparationsTableSeeder::class);
        $this->call(CategoriesTableSeeder::class);
        $this->call(BlogAuthorsTableSeeder::class);
        $this->call(BlogsTableSeeder::class);
        $this->call(BranchesTableSeeder::class);

        $this->call(InterviewPreparationsTableSeeder::class);
        $this->call(DocumentChecklistTableSeeder::class);

        $this->call(WhyCountriesTableSeeder::class);
        $this->call(CollegeAndUniversitiesTableSeeder::class);
        $this->call(CountryGuidesTableSeeder::class);

        $this->call(GalleryCategoriesTableSeeder::class);
        $this->call(GalleriesTableSeeder::class);

        $this->call(FaqsTableSeeder::class);
        $this->call(ImageAltSeoSeeder::class);
    }
}
