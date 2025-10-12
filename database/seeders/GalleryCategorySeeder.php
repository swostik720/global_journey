<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\GalleryCategory;

class GalleryCategorySeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $categories = [
            [
                'title' => 'Business Strategy',
                'description' => 'Images of strategic meetings and business planning sessions.'
            ],
            [
                'title' => 'Client Meetings',
                'description' => 'Gallery of client consultations and professional discussions.'
            ],
            [
                'title' => 'Workshops & Seminars',
                'description' => 'Snapshots from training workshops and consultancy-led seminars.'
            ],
        ];

        foreach ($categories as $category) {
            GalleryCategory::create([
                'title' => $category['title'],
                'description' => $category['description'],
            ]);
        }
    }
}
