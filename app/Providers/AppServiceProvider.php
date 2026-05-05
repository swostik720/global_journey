<?php

namespace App\Providers;

use App\Models\Role;
use App\Models\User;
use App\Models\Branch;
use App\Models\Country;
use App\Models\Permission;
use App\Models\StudyAbroad;
use App\Models\Testimonial;
use App\Models\TestPreparation;
use App\Models\InterviewPreparation;
use App\Observers\RoleObserver;
use App\Observers\UserObserver;
use App\Observers\PermissionObserver;
use Illuminate\Support\ServiceProvider;

use Illuminate\Support\Facades\View;
use Illuminate\Support\Facades\Cache;
use Illuminate\Support\Facades\URL;


class AppServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     */
    public function register(): void
    {
        //
    }

    /**
     * Bootstrap any application services.
     */
    public function boot(): void
    {
        // Optional ngrok override for local tunneling.
        // Only applies when the request actually comes through an ngrok tunnel.
        $ngrokUrl = trim((string) env('NGROK_URL', ''));
        if ($ngrokUrl !== '') {
            $ngrokUrl = rtrim($ngrokUrl, '/');
            $host = request()->getHost();
            if (str_contains($host, 'ngrok')) {
                URL::forceRootUrl($ngrokUrl);

                $scheme = parse_url($ngrokUrl, PHP_URL_SCHEME);
                if (is_string($scheme) && $scheme !== '') {
                    URL::forceScheme($scheme);
                }
            }
        }

        View::composer(['frontend.*'], function ($view) {
            $testimonials = Cache::remember('global_testimonials', 3600, function () {
                return Testimonial::active()
                    ->select(['image', 'name', 'address', 'description', 'rating'])
                    ->latest()
                    ->take(10)
                    ->get();
            });

            $branches = Cache::remember('global_frontend_branches_v1', 3600, function () {
                return Branch::active()
                    ->select(['name', 'email', 'phone', 'contact_address', 'working_hours'])
                    ->orderBy('name', 'asc')
                    ->get();
            });

            $view->with('testimonials', $testimonials ?: collect());
            $view->with('branches', $branches ?: collect());
        });
        View::composer(['frontend.layouts.includes.header', 'frontend.layouts.includes.footer'], function ($view) {
            $data = Cache::remember('global_header_footer_data_v3', 3600, function () {
                $footerCountryIds = StudyAbroad::active()
                    ->whereNotNull('country_id')
                    ->distinct()
                    ->pluck('country_id')
                    ->filter()
                    ->values();

                return [
                    'branches' => Branch::active()
                        ->select(['name'])
                        ->orderBy('name', 'asc')
                        ->take(5)
                        ->get(),
                    'footerCountries' => Country::query()
                        ->whereIn('id', $footerCountryIds)
                        ->select(['id', 'name'])
                        ->orderBy('name', 'asc')
                        ->get(),
                    'studyabroads' => StudyAbroad::active()
                        ->select(['id', 'title', 'slug', 'country_id'])
                        ->with('country:id,name')
                        ->orderBy('title', 'asc') // Alphabetically sorted
                        ->take(5)
                        ->get(),
                    'testpreparations' => TestPreparation::active()
                        ->select(['title', 'slug'])
                        ->latest()
                        ->take(5)
                        ->get(),
                    'interviewPreparations' => InterviewPreparation::active()
                        ->select(['title', 'slug', 'country_id'])
                        ->with('country:id,name') // Eager load country relationship
                        ->latest()
                        ->take(5)
                        ->get(),
                ];
            });

            $view->with('branches', $data['branches'] ?? collect());
            $view->with('footerCountries', $data['footerCountries'] ?? collect());
            $view->with('studyabroads', $data['studyabroads'] ?? collect());
            $view->with('testpreparations', $data['testpreparations'] ?? collect());
            $view->with('interviewPreparations', $data['interviewPreparations'] ?? collect());
        });

        Permission::observe(PermissionObserver::class);
        User::observe(UserObserver::class);
        Role::observe(RoleObserver::class);

    }
}
