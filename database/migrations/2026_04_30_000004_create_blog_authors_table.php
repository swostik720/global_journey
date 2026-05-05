<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('blog_authors', function (Blueprint $table) {
            $table->id();
            $table->string('profile_picture')->nullable();
            $table->string('name');
            $table->string('title')->nullable();
            $table->string('email')->nullable();
            $table->string('linkedin_url')->nullable();
            $table->string('x_url')->nullable();
            $table->string('facebook_url')->nullable();
            $table->string('instagram_url')->nullable();
            $table->string('amazon_url')->nullable();
            $table->string('website')->nullable();
            $table->string('education')->nullable();
            $table->string('expertise')->nullable();
            $table->string('favourite_tool')->nullable();
            $table->string('company')->nullable();
            $table->longText('about_author')->nullable();
            $table->boolean('status')->default(1);
            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('blog_authors');
    }
};
