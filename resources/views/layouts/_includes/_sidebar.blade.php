<style>
    .fixed-navbar {
        position: fixed;
        top: 0;
        left: 0;
        height: 100vh;
    }

    .fixed-navbar .menu-inner {
        height: 90%;
        overflow-y: auto !important;
    }

    .fixed-navbar .menu-inner::-webkit-scrollbar {
        width: 5px;
    }

    .fixed-navbar .menu-inner::-webkit-scrollbar-track {
        -webkit-box-shadow: inset 0 0 5px grey;
        box-shadow: inset 0 0 5px grey;
        border-radius: 10px;
    }

    .fixed-navbar .menu-inner::-webkit-scrollbar-thumb {
        background: #696cff;
        border-radius: 10px;
    }

    .fixed-navbar .menu-inner::-webkit-scrollbar-thumb:hover {
        background: #696cff;
    }
</style>
<aside id="layout-menu" class="layout-menu menu-vertical menu bg-menu-theme">
    <div class="fixed-navbar">
        @if (is_object($setting) && isset($setting['logo']))
            <a href="{{ url('home') }}" class="app-brand-link">
                <img src="{{ asset('uploaded-images/site-setting-images/' . $setting->logo) }}"
                    style="max-width: 200px;max-height:60px; object-fit: contain;margin:10px;" alt="Logo">
            </a>
        @else
            <a href="{{ url('home') }}" class="app-brand-link">
                <span class="app-brand-text demo text-body fw-bolder text-uppercase">
                    LOGO
                </span>
            </a>
        @endif

        <div class="menu-inner-shadow"></div>

        <ul class="menu-inner py-1">
            <x-sidebar-item route="{{ route('home') }}" name="DASHBOARD" uri="home">
                <i class="menu-icon tf-icons bx bx-home-circle"></i>
            </x-sidebar-item>

            <x-sidebar-item route="{{ route('admin.branches.index') }}" name="BRANCHES" uri="admin/branches">
                <i class="menu-icon tf-icons bx bxs-buildings"></i>
            </x-sidebar-item>

            <x-sidebar-multilist-head icon="bx bxs-notepad" name="BLOGS" :routes="['admin/categories', 'admin/blogs']">
                <x-sidebar-item route="{{ route('admin.categories.index') }}" name="BLOG CATEGORIES"
                    uri="admin/categories">
                </x-sidebar-item>
                <x-sidebar-item route="{{ route('admin.blogs.index') }}" name="BLOGS" uri="admin/blogs">
                </x-sidebar-item>
            </x-sidebar-multilist-head>

            <x-sidebar-item route="{{ route('admin.contacts.index') }}" name="CONTACTS REQ" uri="admin/contacts">
                <i class="menu-icon tf-icons bx bxs-phone-incoming"></i>
            </x-sidebar-item>

            <x-sidebar-item route="{{ route('admin.enquiries.index') }}" name="ENQUIRY REQ" uri="admin/enquiries">
                <i class="menu-icon tf-icons bx bxs-phone-incoming"></i>
            </x-sidebar-item>

            <x-sidebar-multilist-head icon="bx bxs-plane-alt" name="STUDY ABROAD" :routes="['admin/countries', 'admin/study-abroads']">
                <x-sidebar-item route="{{ route('admin.countries.index') }}" name="COUNTRIES" uri="admin/countries">
                </x-sidebar-item>
                <x-sidebar-item route="{{ route('admin.study-abroads.index') }}" name="STUDY ABROAD"
                    uri="admin/study-abroads">
                </x-sidebar-item>
            </x-sidebar-multilist-head>

            <x-sidebar-multilist-head icon="bx bxs-image" name="GALLERY" :routes="['admin/galleryCategory', 'admin/gallery']">
                <x-sidebar-item route="{{ route('admin.galleryCategory.index') }}" name="GALLERY CATEGORY"
                    uri="admin/galleryCategory">
                </x-sidebar-item>
                <x-sidebar-item route="{{ route('admin.gallery.index') }}" name="GALLERY" uri="admin/gallery">
                </x-sidebar-item>
            </x-sidebar-multilist-head>

            <x-sidebar-item route="{{ route('admin.document_checklist.index') }}" name="DOCUMENT CHECKLIST"
                uri="admin/document_checklist">
                <i class="menu-icon tf-icons bx bxs-file-doc"></i>
            </x-sidebar-item>

            <x-sidebar-item route="{{ route('admin.college_and_university.index') }}" name="COLLEGE & UNIVERSITY"
                uri="admin/college_and_university">
                <i class="menu-icon tf-icons bx bxs-graduation"></i>
            </x-sidebar-item>

            <x-sidebar-item route="{{ route('admin.why_country.index') }}" name="WHY COUNTRY"
                uri="admin/why_country">
                <i class="menu-icon tf-icons bx bxs-flag"></i>
            </x-sidebar-item>

            <x-sidebar-item route="{{ route('admin.country_guide.index') }}" name="COUNTRY GUIDE"
                uri="admin/country_guide">
                <i class="menu-icon tf-icons bx bxs-map"></i>
            </x-sidebar-item>

            <x-sidebar-item route="{{ route('admin.teams.index') }}" name="TEAMS" uri="admin/teams">
                <i class="menu-icon tf-icons bx bxs-user"></i>
            </x-sidebar-item>

            <x-sidebar-item route="{{ route('admin.testimonials.index') }}" name="TESTIMONIALS"
                uri="admin/testimonials">
                <i class="menu-icon tf-icons bx bxs-user-circle"></i>
            </x-sidebar-item>

            <x-sidebar-item route="{{ route('admin.test-preparations.index') }}" name="TEST PREPARATION"
                uri="admin/test-preparations">
                <i class="menu-icon tf-icons bx bxs-flag-alt"></i>
            </x-sidebar-item>

            <x-sidebar-item route="{{ route('admin.interview_preparation.index') }}" name="INTERVIEW PREPARATION"
                uri="admin/interview_preparation">
                <i class="menu-icon tf-icons bx bxs-conversation"></i>
            </x-sidebar-item>

            <x-sidebar-item route="{{ route('admin.enrollNow.index') }}" name="ENROLL NOW" uri="admin/enrollnow">
                <i class="menu-icon tf-icons bx bxs-edit-location"></i>
            </x-sidebar-item>

            <x-sidebar-multilist-head icon="bx bxs-cog" name="SETTINGS" :routes="['admin/setting/company-setting', 'admin/setting/smtp-setting']">
                <x-sidebar-item route="{{ route('admin.setting.company') }}" name="COMPANY SETTING"
                    uri="admin/setting/company-setting">
                </x-sidebar-item>
                <x-sidebar-item route="{{ route('admin.setting.smtp') }}" name="SMTP SETTING"
                    uri="admin/setting/smtp-setting">
                </x-sidebar-item>
            </x-sidebar-multilist-head>

            <x-sidebar-item route="{{ route('admin.subscribes.index') }}" name="SUBSCRIBERS" uri="admin/subscribes">
                <i class="menu-icon tf-icons bx bxs-envelope"></i>
            </x-sidebar-item>

            {{-- @can('view', \App\Models\User::class)
                <x-sidebar-item route="{{ route('admin.users.index') }}" name="User" uri="admin/users">
                    <i class="menu-icon tf-icons bx bx-user-circle"></i>
                </x-sidebar-item>
            @endcan

            @canany('view', [\App\Models\Permission::class, \App\Models\Role::class])
                <x-sidebar-multilist-head icon="bx bx-check-shield" name="Roles & Permissions">
                    @can('view', \App\Models\Permission::class)
                        <x-sidebar-item route="{{ route('admin.permissions.index') }}" name="Permissions"
                            uri="admin/permissions"></x-sidebar-item>
                    @endcan
                    @can('view', \App\Models\Role::class)
                        <x-sidebar-item route="{{ route('admin.roles.index') }}" name="Roles"
                            uri="admin/roles"></x-sidebar-item>
                    @endcan
                </x-sidebar-multilist-head>
            @endcanany --}}
        </ul>
    </div>
</aside>
