<?php

use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\Artisan;
use App\Http\Controllers\Auth\LoginController;
use App\Http\Controllers\Front\AllController;

Route::get('clear', function () {
    Artisan::call('config:cache');
    Artisan::call('cache:clear');
    Artisan::call('view:clear');
    Artisan::call('optimize:clear');
    echo "Success !!";
});

Route::get('/', [AllController::class, 'index']);
Route::get('about-us', [AllController::class, 'aboutIndex'])->name('about-us');
Route::get('study-abroad', [AllController::class, 'studyAbroadIndex'])->name('study-abroad');
Route::get('/study-abroad/{slug}', [AllController::class, 'studyAbroadDetails'])->name('study-abroad.details');

Route::get('contact-us', [AllController::class, 'contactUsIndex'])->name('contact-us');
Route::post('contact-store', [AllController::class, 'storeContact'])->name('contact.store');

Route::get('test-preparation', [AllController::class, 'testPreparationIndex'])->name('test-preparation');
Route::get('/test-preparation/{slug}', [AllController::class, 'testPreparationDetails'])->name('test-preparation.details');

Route::get('blogs', [AllController::class, 'blogIndex'])->name('blogs');
Route::get('/blogs/{slug}', [AllController::class, 'blogDetails'])->name('blog.details');

Route::post('subscribe-store', [AllController::class, 'storeSubscribe'])->name('subscribe.store');

Route::get('enquiry-us', [AllController::class, 'enquiryUsIndex'])->name('enquiry-us');
Route::post('enquiry-store', [AllController::class, 'storeEnquiry'])->name('enquiry.store');


Auth::routes(['register' => false]);

Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');

