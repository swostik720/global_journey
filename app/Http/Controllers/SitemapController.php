<?php

namespace App\Http\Controllers;

use App\Models\StudyAbroad;
use App\Models\Blog;
use App\Models\TestPreparation;
use App\Models\InterviewPreparation;
use App\Models\Gallery;
use Illuminate\Support\Facades\Cache;
use Illuminate\Support\Facades\URL;

class SitemapController extends Controller
{
    /**
     * Generate dynamic sitemap
     */
    public function index()
    {
        $sitemap = Cache::remember('sitemap_xml', 3600, function () {
            return $this->generateSitemap();
        });

        return response($sitemap, 200, [
            'Content-Type' => 'application/xml; charset=utf-8',
            'Cache-Control' => 'public, max-age=3600',
        ]);
    }

    /**
     * Generate sitemap XML content
     */
    private function generateSitemap()
    {
        $urls = [];

        // Static pages with high priority
        $urls[] = $this->createSitemapEntry(
            URL::to('/'),
            now()->subDays(1),
            'daily',
            1.0
        );

        $urls[] = $this->createSitemapEntry(
            route('about-us'),
            now()->subDays(1),
            'weekly',
            0.9
        );

        $urls[] = $this->createSitemapEntry(
            route('study-abroad'),
            now()->subDays(1),
            'daily',
            0.9
        );

        $urls[] = $this->createSitemapEntry(
            route('test-preparation'),
            now()->subDays(1),
            'daily',
            0.9
        );

        $urls[] = $this->createSitemapEntry(
            route('interview-preparation'),
            now()->subDays(1),
            'weekly',
            0.8
        );

        $urls[] = $this->createSitemapEntry(
            route('blogs'),
            now()->subDays(1),
            'daily',
            0.9
        );

        $urls[] = $this->createSitemapEntry(
            route('galleries.index'),
            now()->subDays(1),
            'weekly',
            0.8
        );

        $urls[] = $this->createSitemapEntry(
            route('contact-us'),
            now()->subDays(1),
            'monthly',
            0.7
        );

        $urls[] = $this->createSitemapEntry(
            route('terms-and-conditions'),
            now()->subDays(1),
            'yearly',
            0.5
        );

        $urls[] = $this->createSitemapEntry(
            route('privacy-policy'),
            now()->subDays(1),
            'yearly',
            0.5
        );

        // Study Abroad destinations
        $studyAbroads = StudyAbroad::active()->select(['id', 'slug', 'updated_at'])->get();
        foreach ($studyAbroads as $study) {
            $urls[] = $this->createSitemapEntry(
                route('study-abroad.details', $study->slug),
                $study->updated_at,
                'weekly',
                0.85
            );

            // Study Abroad sub-pages (if enabled)
            if ($study->id) {
                $subPages = [
                    'frontend.study_abroad.document_checklist' => 0.7,
                    'frontend.study_abroad.college_and_university' => 0.7,
                    'frontend.study_abroad.why_country' => 0.75,
                    'frontend.study_abroad.country_guide' => 0.8,
                ];

                foreach ($subPages as $routeName => $priority) {
                    $urls[] = $this->createSitemapEntry(
                        route($routeName, $study->id),
                        $study->updated_at,
                        'monthly',
                        $priority
                    );
                }
            }
        }

        // Test Preparation
        $testPreps = TestPreparation::active()->select(['id', 'slug', 'updated_at'])->get();
        foreach ($testPreps as $test) {
            $urls[] = $this->createSitemapEntry(
                route('test-preparation.details', $test->slug),
                $test->updated_at,
                'weekly',
                0.8
            );
        }

        // Interview Preparation
        $interviews = InterviewPreparation::active()->select(['id', 'slug', 'updated_at'])->get();
        foreach ($interviews as $interview) {
            $urls[] = $this->createSitemapEntry(
                route('interview-preparation.details', $interview->slug),
                $interview->updated_at,
                'weekly',
                0.8
            );
        }

        // Blogs
        $blogs = Blog::active()->select(['id', 'slug', 'updated_at'])->get();
        foreach ($blogs as $blog) {
            $urls[] = $this->createSitemapEntry(
                route('blog.details', $blog->slug),
                $blog->updated_at,
                'weekly',
                0.8
            );
        }

        // Blog Authors (profiles)
        $blogAuthors = Blog::active()
            ->with('author:id,name')
            ->select(['id', 'blog_author_id', 'updated_at'])
            ->distinct('blog_author_id')
            ->get();

        $authorUrls = collect();
        foreach ($blogAuthors as $blog) {
            if ($blog->author && $blog->author->name && !$authorUrls->contains('author_id', $blog->author->id)) {
                $authorSlug = \Illuminate\Support\Str::slug($blog->author->name) . '-' . $blog->author->id;
                $urls[] = $this->createSitemapEntry(
                    route('blog.profile', $authorSlug),
                    $blog->updated_at ?? now(),
                    'weekly',
                    0.75
                );
                $authorUrls->push(['author_id' => $blog->author->id]);
            }
        }

        // Gallery
        $galleries = Gallery::select(['id', 'updated_at'])->get();
        foreach ($galleries as $gallery) {
            $urls[] = $this->createSitemapEntry(
                route('gallery.details', $gallery->id),
                $gallery->updated_at,
                'monthly',
                0.7
            );
        }

        return $this->renderSitemap($urls);
    }

    /**
     * Create sitemap entry array
     */
    private function createSitemapEntry($loc, $lastmod, $changefreq, $priority)
    {
        if (!$lastmod) {
            $lastmod = now();
        }

        return [
            'loc' => $loc,
            'lastmod' => $lastmod->format('Y-m-d'),
            'changefreq' => $changefreq,
            'priority' => number_format($priority, 1),
        ];
    }

    /**
     * Render sitemap XML
     */
    private function renderSitemap($urls)
    {
        $xml = '<?xml version="1.0" encoding="UTF-8"?>' . "\n";
        $xml .= '<urlset xmlns="http://www.sitemaps.org/schemas/sitemap/0.9">' . "\n";

        foreach ($urls as $url) {
            $xml .= "    <url>\n";
            $xml .= "        <loc>" . htmlspecialchars($url['loc'], ENT_XML1, 'UTF-8') . "</loc>\n";
            $xml .= "        <lastmod>" . $url['lastmod'] . "</lastmod>\n";
            $xml .= "        <changefreq>" . $url['changefreq'] . "</changefreq>\n";
            $xml .= "        <priority>" . $url['priority'] . "</priority>\n";
            $xml .= "    </url>\n";
        }

        $xml .= '</urlset>';

        return $xml;
    }
}
