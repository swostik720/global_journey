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
        Schema::table('contacts', function (Blueprint $table) {
            $table->string('address')->nullable();
            $table->enum('interested_country', ['USA', 'Canada', 'UK', 'Australia', 'New Zealand'])->nullable();
            $table->string('last_qualification')->nullable();
            $table->enum('test_preparation', ['IELTS', 'PTE'])->nullable();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('contacts', function (Blueprint $table) {
            $table->dropColumn('address');
            $table->dropColumn('interested_country');
            $table->dropColumn('last_qualification');
            $table->dropColumn('test_preparation');
        });
    }
};
