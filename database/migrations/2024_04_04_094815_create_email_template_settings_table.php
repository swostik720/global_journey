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
        Schema::create('email_template_settings', function (Blueprint $table) {
            $table->id();
            $table->string('email_title');
            $table->longText('normal_msg')->nullable();
            $table->text('upper_body_msg')->nullable();
            $table->text('lower_body_msg')->nullable();
            $table->text('btn_link')->nullable();
            $table->text('normal_link')->nullable();
            $table->softDeletes();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('email_template_settings');
    }
};
