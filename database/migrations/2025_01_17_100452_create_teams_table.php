<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateTeamsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up(): void
    {
        Schema::create('teams', function (Blueprint $table) {
            $table->id();
            $table->string('image')->nullable();
            $table->string('name', 50);
            $table->string('slug')->unique()->nullable();
            $table->string('email')->nullable();
            $table->string('phone')->nullable();
            $table->string('responsibility', 100);
            $table->string('experience')->nullable();
            $table->text('fb_link')->nullable();
            $table->text('twitter_link')->nullable();
            $table->text('linkedin_link')->nullable();
            $table->text('instagram_link')->nullable();
            $table->longText('details')->nullable();
            $table->unsignedInteger('rank')->nullable();
            $table->boolean('status')->default(1);

            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down(): void
    {
        Schema::dropIfExists('teams');
    }
}
