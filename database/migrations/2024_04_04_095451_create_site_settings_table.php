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
        Schema::create('site_settings', function (Blueprint $table) {
            $table->id();
            $table->string('logo')->nullable();
            $table->string('favicon')->nullable();
            $table->string('name')->nullable();
            $table->string('slug')->unique()->nullable();
            $table->string('email',100)->nullable();
            $table->string('phone',16)->nullable();
            $table->string('mobile',16)->nullable();
            $table->string('contact_address')->nullable();
            $table->text('map_url')->nullable();
            $table->string('working_hours')->nullable();
            $table->string('copyright_text')->nullable();
            // $table->string('primary1_color')->nullable();
            // $table->string('secondary1_color')->nullable();
            // $table->string('primary2_color')->nullable();
            // $table->string('secondary2_color')->nullable();
            $table->text('fb_link')->nullable();
            $table->text('twitter_link')->nullable();
            $table->text('instagram_link')->nullable();
            $table->text('linkedIn_link')->nullable();
            $table->text('description')->nullable();

            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('site_settings');
    }
};
