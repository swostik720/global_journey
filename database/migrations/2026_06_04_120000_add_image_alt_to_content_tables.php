<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::table('study_abroads', function (Blueprint $table) {
            $table->string('image_alt')->nullable()->after('image');
        });

        Schema::table('test_preparations', function (Blueprint $table) {
            $table->string('image_alt')->nullable()->after('image');
        });

        Schema::table('interview_preparations', function (Blueprint $table) {
            $table->string('image_alt')->nullable()->after('image');
        });

        Schema::table('blogs', function (Blueprint $table) {
            $table->string('image_alt')->nullable()->after('image');
        });

        Schema::table('teams', function (Blueprint $table) {
            $table->string('image_alt')->nullable()->after('image');
        });

        Schema::table('testimonials', function (Blueprint $table) {
            $table->string('image_alt')->nullable()->after('image');
        });

        Schema::table('blog_authors', function (Blueprint $table) {
            $table->string('profile_picture_alt')->nullable()->after('profile_picture');
        });

        Schema::table('college_and_universities', function (Blueprint $table) {
            $table->string('image_alt')->nullable()->after('image');
        });

        Schema::table('galleries', function (Blueprint $table) {
            $table->string('image_alt')->nullable()->after('images');
        });

        Schema::table('site_settings', function (Blueprint $table) {
            $table->string('logo_alt')->nullable()->after('logo');
            $table->string('favicon_alt')->nullable()->after('favicon');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('study_abroads', function (Blueprint $table) {
            $table->dropColumn('image_alt');
        });

        Schema::table('test_preparations', function (Blueprint $table) {
            $table->dropColumn('image_alt');
        });

        Schema::table('interview_preparations', function (Blueprint $table) {
            $table->dropColumn('image_alt');
        });

        Schema::table('blogs', function (Blueprint $table) {
            $table->dropColumn('image_alt');
        });

        Schema::table('teams', function (Blueprint $table) {
            $table->dropColumn('image_alt');
        });

        Schema::table('testimonials', function (Blueprint $table) {
            $table->dropColumn('image_alt');
        });

        Schema::table('blog_authors', function (Blueprint $table) {
            $table->dropColumn('profile_picture_alt');
        });

        Schema::table('college_and_universities', function (Blueprint $table) {
            $table->dropColumn('image_alt');
        });

        Schema::table('galleries', function (Blueprint $table) {
            $table->dropColumn('image_alt');
        });

        Schema::table('site_settings', function (Blueprint $table) {
            $table->dropColumn(['logo_alt', 'favicon_alt']);
        });
    }
};
