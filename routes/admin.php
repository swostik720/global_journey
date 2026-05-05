<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Admin\BlogAuthorController;
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
use App\Http\Controllers\Admin\Settings\LegalPageSettingController;
use App\Http\Controllers\Admin\RolePermission\AdminUserController;
use App\Http\Controllers\Admin\RolePermission\PermissionController;
use App\Http\Controllers\Admin\RolePermission\RolePermissionController;
use App\Http\Controllers\Admin\InterviewPreparationController;
use App\Http\Controllers\Admin\DocumentChecklistController;
use App\Http\Controllers\Admin\CollegeAndUniversityController;
use App\Http\Controllers\Admin\WhyCountryController;
use App\Http\Controllers\Admin\CountryGuideController;
use App\Http\Controllers\Admin\EnrollNowController;
use App\Http\Controllers\Admin\GalleryCategoryController;
use App\Http\Controllers\Admin\GalleryController;
use App\Http\Controllers\Admin\FaqController;

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

        //-------------------------- LEGAL PAGES --------------------------------------
        Route::get('/legal-pages', [LegalPageSettingController::class, 'index'])->name('legal-pages');
        Route::put('/legal-pages/update', [LegalPageSettingController::class, 'update'])->name('legal-pages.update');
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

    Route::get('status-change-blog-author', [BlogAuthorController::class, 'changeStatus'])->name('status-change-blog-author');
    Route::resource('blog-authors', BlogAuthorController::class);
    Route::post('blog-authors/bulk-delete', [BlogAuthorController::class, 'bulkDelete'])->name('blog-authors.bulk-delete');

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

    Route::get('status-change-interview_preparation', [InterviewPreparationController::class, 'changeStatus'])->name('status-change-interview_preparation');
    Route::post('interview_preparation/bulk-delete', [InterviewPreparationController::class, 'bulkDelete'])->name('interview_preparation.bulk-delete');
    Route::resource('interview_preparation', InterviewPreparationController::class);

    Route::resource('document_checklist', DocumentChecklistController::class);
    Route::post('document_checklist/bulk-delete', [DocumentChecklistController::class, 'bulkDelete'])->name('document_checklist.bulk-delete');


    // College & University
    Route::resource('college_and_university', CollegeAndUniversityController::class);
    Route::post('college_and_university/bulk-delete', [CollegeAndUniversityController::class, 'bulkDelete'])->name('college_and_university.bulk-delete');

    // Why Country
    Route::resource('why_country', WhyCountryController::class);
    Route::post('why_country/bulk-delete', [WhyCountryController::class, 'bulkDelete'])->name('why_country.bulk-delete');

    // Country Guide
    Route::resource('country_guide', CountryGuideController::class);
    Route::post('country_guide/bulk-delete', [CountryGuideController::class, 'bulkDelete'])->name('country_guide.bulk-delete');

    //Enroll Now
    Route::resource('enrollNow', EnrollNowController::class);
    Route::post('enrollNow/bulk-delete', [EnrollNowController::class, 'bulkDelete'])->name('enrollnow.bulk-delete');

    Route::resource('galleryCategory', GalleryCategoryController::class);
    Route::post('galleryCategory/bulk-delete', [GalleryCategoryController::class, 'bulkDelete'])->name('galleryCategory.bulk-delete');

    Route::resource('gallery', GalleryController::class);
    Route::post('gallery/bulk-delete', [GalleryController::class, 'bulkDelete'])->name('gallery.bulk-delete');
    Route::delete('gallery/{gallery}/image', [GalleryController::class, 'deleteImage'])
        ->name('gallery.deleteImage');

    Route::get('status-change-faq', [FaqController::class, 'changeStatus'])->name('status-change-faq');
    Route::resource('faqs', FaqController::class);
    Route::post('faqs/bulk-delete', [FaqController::class, 'bulkDelete'])->name('faqs.bulk-delete');
});
