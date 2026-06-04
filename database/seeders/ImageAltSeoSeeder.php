<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class ImageAltSeoSeeder extends Seeder
{
    /**
     * Seed SEO-friendly alt text defaults for existing records where alt is empty.
     */
    public function run(): void
    {
        DB::table('study_abroads')
            ->whereNotNull('image')
            ->where(function ($query) {
                $query->whereNull('image_alt')->orWhere('image_alt', '');
            })
            ->select(['id', 'title'])
            ->orderBy('id')
            ->chunkById(200, function ($rows) {
                foreach ($rows as $row) {
                    DB::table('study_abroads')->where('id', $row->id)->update([
                        'image_alt' => trim(($row->title ?: 'Study abroad') . ' study abroad guidance image'),
                    ]);
                }
            });

        DB::table('test_preparations')
            ->whereNotNull('image')
            ->where(function ($query) {
                $query->whereNull('image_alt')->orWhere('image_alt', '');
            })
            ->select(['id', 'title'])
            ->orderBy('id')
            ->chunkById(200, function ($rows) {
                foreach ($rows as $row) {
                    DB::table('test_preparations')->where('id', $row->id)->update([
                        'image_alt' => trim(($row->title ?: 'Test preparation') . ' test preparation image'),
                    ]);
                }
            });

        DB::table('interview_preparations')
            ->whereNotNull('image')
            ->where(function ($query) {
                $query->whereNull('image_alt')->orWhere('image_alt', '');
            })
            ->select(['id', 'title'])
            ->orderBy('id')
            ->chunkById(200, function ($rows) {
                foreach ($rows as $row) {
                    DB::table('interview_preparations')->where('id', $row->id)->update([
                        'image_alt' => trim(($row->title ?: 'Interview preparation') . ' interview preparation image'),
                    ]);
                }
            });

        DB::table('blogs')
            ->whereNotNull('image')
            ->where(function ($query) {
                $query->whereNull('image_alt')->orWhere('image_alt', '');
            })
            ->select(['id', 'title'])
            ->orderBy('id')
            ->chunkById(200, function ($rows) {
                foreach ($rows as $row) {
                    DB::table('blogs')->where('id', $row->id)->update([
                        'image_alt' => trim(($row->title ?: 'Blog post') . ' blog cover image'),
                    ]);
                }
            });

        DB::table('teams')
            ->whereNotNull('image')
            ->where(function ($query) {
                $query->whereNull('image_alt')->orWhere('image_alt', '');
            })
            ->select(['id', 'name'])
            ->orderBy('id')
            ->chunkById(200, function ($rows) {
                foreach ($rows as $row) {
                    DB::table('teams')->where('id', $row->id)->update([
                        'image_alt' => trim(($row->name ?: 'Team member') . ' team profile image'),
                    ]);
                }
            });

        DB::table('testimonials')
            ->whereNotNull('image')
            ->where(function ($query) {
                $query->whereNull('image_alt')->orWhere('image_alt', '');
            })
            ->select(['id', 'name'])
            ->orderBy('id')
            ->chunkById(200, function ($rows) {
                foreach ($rows as $row) {
                    DB::table('testimonials')->where('id', $row->id)->update([
                        'image_alt' => trim(($row->name ?: 'Student') . ' testimonial photo'),
                    ]);
                }
            });

        DB::table('blog_authors')
            ->whereNotNull('profile_picture')
            ->where(function ($query) {
                $query->whereNull('profile_picture_alt')->orWhere('profile_picture_alt', '');
            })
            ->select(['id', 'name'])
            ->orderBy('id')
            ->chunkById(200, function ($rows) {
                foreach ($rows as $row) {
                    DB::table('blog_authors')->where('id', $row->id)->update([
                        'profile_picture_alt' => trim(($row->name ?: 'Author') . ' blog author profile picture'),
                    ]);
                }
            });

        DB::table('college_and_universities')
            ->whereNotNull('image')
            ->where(function ($query) {
                $query->whereNull('image_alt')->orWhere('image_alt', '');
            })
            ->select(['id', 'name'])
            ->orderBy('id')
            ->chunkById(200, function ($rows) {
                foreach ($rows as $row) {
                    DB::table('college_and_universities')->where('id', $row->id)->update([
                        'image_alt' => trim(($row->name ?: 'College') . ' campus image'),
                    ]);
                }
            });

        DB::table('galleries')
            ->whereNotNull('images')
            ->where(function ($query) {
                $query->whereNull('image_alt')->orWhere('image_alt', '');
            })
            ->select(['id', 'title'])
            ->orderBy('id')
            ->chunkById(200, function ($rows) {
                foreach ($rows as $row) {
                    DB::table('galleries')->where('id', $row->id)->update([
                        'image_alt' => trim(($row->title ?: 'Gallery') . ' gallery image'),
                    ]);
                }
            });

        DB::table('site_settings')
            ->where(function ($query) {
                $query->whereNull('logo_alt')->orWhere('logo_alt', '');
            })
            ->update(['logo_alt' => 'Global Journey company logo']);

        DB::table('site_settings')
            ->where(function ($query) {
                $query->whereNull('favicon_alt')->orWhere('favicon_alt', '');
            })
            ->update(['favicon_alt' => 'Global Journey website favicon']);
    }
}
