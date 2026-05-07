<?php

use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\Artisan;
use Illuminate\Support\Facades\Mail;
use App\Http\Controllers\Front\AllController;
use App\Http\Controllers\Front\LegalPageController;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
*/

// Clear cache
Route::get('clear', function () {
    Artisan::call('config:cache');
    Artisan::call('cache:clear');
    Artisan::call('view:clear');
    Artisan::call('optimize:clear');
    echo "Success !!";
});

Route::get('/', [AllController::class, 'index'])->name('home');
Route::get('about-us', [AllController::class, 'aboutIndex'])->name('about-us');
Route::get('study-abroad', [AllController::class, 'studyAbroadIndex'])->name('study-abroad');
Route::get('/study-abroad/{slug}', [AllController::class, 'studyAbroadDetails'])->name('study-abroad.details');

Route::get('contact-us', [AllController::class, 'contactUsIndex'])->name('contact-us');
Route::post('contact-store', [AllController::class, 'storeContact'])->name('contact.store');

Route::get('enrollNow', [AllController::class, 'enrollNowIndex'])->name('enrollNow');
Route::post('enrollNow-store', [AllController::class, 'storeEnrollNow'])->name('enrollNow.store');

Route::get('test-preparation', [AllController::class, 'testPreparationIndex'])->name('test-preparation');
Route::get('/test-preparation/{slug}', [AllController::class, 'testPreparationDetails'])->name('test-preparation.details');

Route::get('blogs', [AllController::class, 'blogIndex'])->name('blogs');
Route::get('/blogs/author/{authorSlug}', [AllController::class, 'blogProfile'])->name('blog.profile');
Route::get('/blogs/{slug}', [AllController::class, 'blogDetails'])->name('blog.details');

Route::post('subscribe-store', [AllController::class, 'storeSubscribe'])->name('subscribe.store');

Route::post('enquiry-store', [AllController::class, 'storeEnquiry'])->name('enquiry.store');

Route::get('terms-and-conditions', [LegalPageController::class, 'terms'])->name('terms-and-conditions');
Route::get('privacy-policy', [LegalPageController::class, 'privacy'])->name('privacy-policy');

// Interview Preparation Frontend
Route::get('interview-preparation', [AllController::class, 'interviewPreparationIndex'])->name('interview-preparation');
Route::get('interview-preparation/{slug}', [AllController::class, 'interviewPreparationDetails'])->name('interview-preparation.details');

// Gallery
Route::get('/galleries', [AllController::class, 'galleryIndex'])->name('galleries.index');
Route::get('/gallery/{id}', [AllController::class, 'galleryDetails'])->name('gallery.details');

// Study Abroad extra pages
Route::get('study-abroad/{country}/document-checklist', [AllController::class, 'documentChecklist'])->name('frontend.study_abroad.document_checklist');
Route::get('study-abroad/{country}/college-and-university', [AllController::class, 'collegeAndUniversity'])->name('frontend.study_abroad.college_and_university');
Route::get('study-abroad/{country}/why-country', [AllController::class, 'whyCountry'])->name('frontend.study_abroad.why_country');
Route::get('study-abroad/{country}/country-guide', [AllController::class, 'countryGuide'])->name('frontend.study_abroad.country_guide');

Auth::routes(['register' => false]);
Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');

Route::get('/test-mail', function () {
    Mail::raw('This is a test email', function ($message) {
        $message->to('hunter.swostik@gmail.com')
                ->subject('Test Mail');
    });

    return 'Email sent!';
});

Route::get('/test', function () {
    return phpinfo();
});
