<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateTestPreparationsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up(): void
    {
        Schema::create('test_preparations', function (Blueprint $table) {
            $table->id();
            $table->string('image')->nullable();
            $table->string('title');
            $table->string('slug')->unique()->nullable();
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
        Schema::dropIfExists('test_preparations');
    }
}
