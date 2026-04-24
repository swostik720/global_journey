<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    public function up(): void
    {
        Schema::table('test_preparations', function (Blueprint $table) {
            if (!Schema::hasColumn('test_preparations', 'faqs')) {
                $table->json('faqs')->nullable()->after('description');
            }
        });
    }

    public function down(): void
    {
        Schema::table('test_preparations', function (Blueprint $table) {
            if (Schema::hasColumn('test_preparations', 'faqs')) {
                $table->dropColumn('faqs');
            }
        });
    }
};
