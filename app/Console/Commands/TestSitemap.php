<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use App\Http\Controllers\SitemapController;

class TestSitemap extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'sitemap:test';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Test and display the generated sitemap';

    /**
     * Execute the console command.
     */
    public function handle()
    {
        $this->info('Generating sitemap...');

        try {
            $controller = new SitemapController();
            $response = $controller->index();

            $sitemap = $response->getContent();

            // Count URLs in sitemap
            $urlCount = substr_count($sitemap, '<url>');

            $this->line("\n✅ Sitemap generated successfully!");
            $this->line("📊 Total URLs in sitemap: " . $urlCount);
            $this->line("💾 Sitemap size: " . round(strlen($sitemap) / 1024, 2) . " KB");

            $this->info("\n🔗 Access your sitemap at: https://www.globaljourneyedu.com.np/sitemap.xml");
            $this->info("   or locally at: http://localhost:8000/sitemap.xml");

            // Show first few URLs as sample
            $this->line("\n📋 Sample URLs (first 5):");
            if (preg_match_all('/<loc>(.*?)<\/loc>/', $sitemap, $matches)) {
                $urls = array_slice($matches[1], 0, 5);
                foreach ($urls as $index => $url) {
                    $this->line("  " . ($index + 1) . ". " . $url);
                }
            }

            return 0;
        } catch (\Exception $e) {
            $this->error('❌ Error generating sitemap: ' . $e->getMessage());
            return 1;
        }
    }
}
