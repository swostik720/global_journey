<?php

use Illuminate\Foundation\Inspiring;
use Illuminate\Support\Facades\Artisan;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Schema;

Artisan::command('inspire', function () {
    $this->comment(Inspiring::quote());
})->purpose('Display an inspiring quote')->hourly();

Artisan::command('content:decode-entities {--dry-run : Preview changes only without writing to database}', function () {
    $dryRun = (bool) $this->option('dry-run');

    $excludedTables = [
        'migrations',
        'failed_jobs',
        'jobs',
        'job_batches',
        'cache',
        'cache_locks',
        'sessions',
        'password_reset_tokens',
        'personal_access_tokens',
    ];

    $tables = array_values(array_filter(Schema::getTableListing(), function ($table) use ($excludedTables) {
        return !in_array((string) $table, $excludedTables, true);
    }));

    $decodeValue = static function ($value) {
        if (!is_string($value) || $value === '') {
            return $value;
        }

        // Normalize malformed numeric entities like &#039 (without trailing semicolon).
        $normalized = preg_replace('/&#(x?[0-9A-Fa-f]+)(?!;)/', '&#$1;', $value);
        if (!is_string($normalized)) {
            $normalized = $value;
        }

        return html_entity_decode($normalized, ENT_QUOTES | ENT_HTML5, 'UTF-8');
    };

    $shouldSkipColumn = static function (string $column): bool {
        return (bool) preg_match(
            '/(^id$|_id$|_at$|_on$|^status$|^sort$|^order$|^position$|^rank$|^count$|^year$|^month$|^day$|^is_|^has_|password|token|remember|email_verified|slug|url|link|image|icon|file|path|phone|mobile|fax|lat|lng|longitude|latitude|ip|uuid|json|payload|settings|meta|metadata|quick_info_items|key_highlights|faqs|permissions|roles)/i',
            $column,
        );
    };

    $totalChangedRows = 0;
    $totalUpdatedCells = 0;

    foreach ($tables as $table) {
        if (!Schema::hasColumn($table, 'id')) {
            continue;
        }

        $columns = Schema::getColumnListing($table);
        $candidateColumns = array_values(array_filter($columns, function ($column) use ($shouldSkipColumn) {
            return !$shouldSkipColumn((string) $column);
        }));

        if (empty($candidateColumns)) {
            continue;
        }

        $changedRows = 0;
        $changedCells = 0;

        DB::table($table)
            ->orderBy('id')
            ->chunkById(200, function ($rows) use (
                $table,
                $candidateColumns,
                $decodeValue,
                $dryRun,
                &$changedRows,
                &$changedCells,
            ) {
                foreach ($rows as $row) {
                    $updates = [];

                    foreach ($candidateColumns as $column) {
                        $raw = $row->{$column} ?? null;

                        if (!is_string($raw) || $raw === '' || strpos($raw, '&') === false) {
                            continue;
                        }

                        $decoded = $decodeValue($raw);
                        if ($decoded !== $raw) {
                            $updates[$column] = $decoded;
                        }
                    }

                    if (!empty($updates)) {
                        $changedRows++;
                        $changedCells += count($updates);

                        if (!$dryRun) {
                            DB::table($table)->where('id', $row->id)->update($updates);
                        }
                    }
                }
            }, 'id');

        if ($changedRows > 0) {
            $totalChangedRows += $changedRows;
            $totalUpdatedCells += $changedCells;
            $this->info("{$table}: {$changedRows} row(s), {$changedCells} cell(s) " . ($dryRun ? 'would be updated' : 'updated'));
        }
    }

    if ($totalChangedRows === 0) {
        $this->comment('No entity-encoded content found in scanned columns.');
        return;
    }

    $summaryVerb = $dryRun ? 'would change' : 'changed';
    $this->newLine();
    $this->info("Done. {$summaryVerb} {$totalChangedRows} row(s) across {$totalUpdatedCells} value(s).");
})->purpose('Decode HTML entities in content fields for better frontend readability');
