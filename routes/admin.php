<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Admin\BlogController;
use App\Http\Controllers\Admin\TeamController;
use App\Http\Controllers\Admin\BranchController;
use App\Http\Controllers\Admin\ContactController;
use App\Http\Controllers\Admin\CountryController;
use App\Http\Controllers\Admin\EnquiryController;
use App\Http\Controllers\Admin\ProfileController;
use App\Http\Controllers\Admin\CategoryController;
use App\Http\Controllers\Admin\SubscribeController;
use App\Http\Controllers\Admin\StudyAbroadController;
use App\Http\Controllers\Admin\TestimonialController;
use App\Http\Controllers\Admin\TestPreparationController;
use App\Http\Controllers\Admin\RolePermission\RoleController;
use App\Http\Controllers\Admin\Settings\SiteSettingController;
use App\Http\Controllers\Admin\Settings\SmtpSettingController;
use App\Http\Controllers\Admin\RolePermission\AdminUserController;
use App\Http\Controllers\Admin\RolePermission\PermissionController;
use App\Http\Controllers\Admin\RolePermission\RolePermissionController;

Route::middleware(['is_member'])->group(function () {

    Route::get('get-role-based-permissions', RolePermissionController::class);
    Route::resource('permissions', PermissionController::class);
    Route::resource('roles', RoleController::class);
    Route::resource('users', AdminUserController::class);

    Route::get('profile', [ProfileController::class, 'index'])->name('profiles.index');
    Route::patch('profile-update', [ProfileController::class, 'update'])->name('profiles.update');

    //----------------------------------------SETTING-----------------------------------------------------------
    Route::prefix('setting')->name('setting.')->group(function () {
        //----------------------------------------SITE SETTING--------------------------------------------------
        Route::get('/company-setting', [SiteSettingController::class, 'index'])->name('company');
        Route::put('/company/update/{id?}', [SiteSettingController::class, 'update'])->name('company.update');

        //-------------------------- SMTP SETTING --------------------------------------
        Route::get('/smtp-setting', [SmtpSettingController::class, 'index'])->name('smtp');
        Route::put('/smtp/update/{id?}', [SmtpSettingController::class, 'update'])->name('smtp.update');
    });

    Route::resource('contacts', ContactController::class);
    Route::post('contacts-inside-stauts/{id}', [ContactController::class, 'contactInsideStatusChange'])->name('contact-status-change');
    Route::post('contacts/bulk-delete', [ContactController::class, 'bulkDelete'])->name('contacts.bulk-delete');

    Route::get('status-change-testimonial', [TestimonialController::class, 'changeStatus'])->name('status-change-testimonial');
    Route::resource('testimonials', TestimonialController::class);
    Route::post('testimonial/bulk-delete', [TestimonialController::class, 'bulkDelete'])->name('testimonials.bulk-delete');

    Route::get('status-change-team', [TeamController::class, 'changeStatus'])->name('status-change-team');
    Route::resource('teams', TeamController::class);
    Route::post('teams/re-order', [TeamController::class, 'rowReOrder'])->name('teams.reorder');
    Route::post('teams/bulk-delete', [TeamController::class, 'bulkDelete'])->name('teams.bulk-delete');


    Route::get('status-change-country', [CountryController::class, 'changeStatus'])->name('status-change-country');
    Route::resource('countries', CountryController::class);
    Route::post('countries/bulk-delete', [CountryController::class, 'bulkDelete'])->name('countries.bulk-delete');

    Route::get('status-change-study_abroad', [StudyAbroadController::class, 'changeStatus'])->name('status-change-study_abroad');
    Route::resource('study-abroads', StudyAbroadController::class);
    Route::post('study-abroads/bulk-delete', [StudyAbroadController::class, 'bulkDelete'])->name('study-abroads.bulk-delete');

    Route::get('status-change-test_preparation', [TestPreparationController::class, 'changeStatus'])->name('status-change-test_preparation');
    Route::resource('test-preparations', TestPreparationController::class);
    Route::post('test-preparations/bulk-delete', [TestPreparationController::class, 'bulkDelete'])->name('test-preparations.bulk-delete');

    Route::get('status-change-category', [CategoryController::class, 'changeStatus'])->name('status-change-category');
    Route::resource('categories', CategoryController::class);
    Route::post('categories/bulk-delete', [CategoryController::class, 'bulkDelete'])->name('categories.bulk-delete');

    Route::get('status-change-blog', [BlogController::class, 'changeStatus'])->name('status-change-blog');
    Route::resource('blogs', BlogController::class);
    Route::post('blogs/bulk-delete', [BlogController::class, 'bulkDelete'])->name('blogs.bulk-delete');

    Route::resource('subscribes', SubscribeController::class);

    Route::get('status-change-branch', [BranchController::class, 'changeStatus'])->name('status-change-branch');
    Route::resource('branches', BranchController::class);
    Route::post('branches/bulk-delete', [BranchController::class, 'bulkDelete'])->name('branches.bulk-delete');

    Route::post('enquiries-inside-stauts/{id}', [EnquiryController::class, 'enquiryInsideStatusChange'])->name('enquiry-status-change');
    Route::resource('enquiries', EnquiryController::class);
    Route::post('enquiries/bulk-delete', [EnquiryController::class, 'bulkDelete'])->name('enquiries.bulk-delete');
});
