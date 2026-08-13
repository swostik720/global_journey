<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        $prefix = Schema::getConnection()->getTablePrefix();

        DB::statement(
            "ALTER TABLE `{$prefix}contacts` MODIFY `interested_country` " .
                "ENUM('USA','Canada','UK','Australia','New Zealand','Japan') NULL"
        );
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        $prefix = Schema::getConnection()->getTablePrefix();

        DB::statement(
            "ALTER TABLE `{$prefix}contacts` MODIFY `interested_country` " .
                "ENUM('USA','Canada','UK','Australia','New Zealand') NULL"
        );
    }
};
