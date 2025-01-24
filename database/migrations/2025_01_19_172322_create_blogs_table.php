<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateBlogsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up(): void
    {
        Schema::create('blogs', function (Blueprint $table) {
            $table->id();
            $table->string('image')->nullable();
            $table->foreignId('user_id')->nullable()->default(null)->constrained('users')->nullOnDelete();
            $table->foreignId('category_id')->nullable()->default(null)->constrained('categories')->nullOnDelete();
            $table->string('title');
            $table->string('slug')->unique()->nullable();
            $table->date('blog_date');
            $table->text('short_description')->nullable();
            $table->longText('description');
            $table->boolean('status')->default(1);

            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down() : void
    {
        Schema::dropIfExists('blogs');
    }
}
