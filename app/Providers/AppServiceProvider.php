<?php

namespace App\Providers;

use App\Models\Role;
use App\Models\User;
use App\Models\Permission;
use App\Models\StudyAbroad;
use App\Models\Testimonial;
use App\Models\TestPreparation;
use App\Observers\RoleObserver;
use App\Observers\UserObserver;
use App\Observers\PermissionObserver;
use Illuminate\Support\ServiceProvider;

use Illuminate\Support\Facades\View;
use Illuminate\Support\Facades\Cache;

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
        View::composer(['frontend.*'], function ($view) {
            $testimonials = Cache::remember('global_testimonials', 3600, function () {
                return Testimonial::active()
                    ->select(['image', 'name', 'address', 'description', 'rating'])
                    ->latest()
                    ->take(10)
                    ->get();
            });

            $view->with('testimonials', $testimonials ?: collect());
        });
        View::composer(['frontend.layouts.includes.header', 'frontend.layouts.includes.footer'], function ($view) {
            $data = Cache::remember('global_header_footer_data', 3600, function () {
                return [
                    'studyabroads' => StudyAbroad::active()
                        ->select(['title', 'slug'])
                        ->orderBy('title', 'asc') // Alphabetically sorted
                        ->take(5)
                        ->get(),
                    'testpreparations' => TestPreparation::active()
                        ->select(['title', 'slug'])
                        ->latest()
                        ->take(5)
                        ->get(),
                ];
            });

            $view->with('studyabroads', $data['studyabroads'] ?? collect());
            $view->with('testpreparations', $data['testpreparations'] ?? collect());
        });

        Permission::observe(PermissionObserver::class);
        User::observe(UserObserver::class);
        Role::observe(RoleObserver::class);
    }
}
