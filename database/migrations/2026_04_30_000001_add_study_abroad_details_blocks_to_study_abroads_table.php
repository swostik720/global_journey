<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::table('study_abroads', function (Blueprint $table) {
            $table->json('quick_info_items')->nullable()->after('faqs');
            $table->json('key_highlights')->nullable()->after('quick_info_items');
            $table->string('cta_title')->nullable()->after('key_highlights');
            $table->text('cta_description')->nullable()->after('cta_title');
            $table->string('cta_button_text')->nullable()->after('cta_description');
            $table->string('cta_button_url')->nullable()->after('cta_button_text');
        });
    }

    public function down(): void
    {
        Schema::table('study_abroads', function (Blueprint $table) {
            $table->dropColumn([
                'quick_info_items',
                'key_highlights',
                'cta_title',
                'cta_description',
                'cta_button_text',
                'cta_button_url',
            ]);
        });
    }
};
