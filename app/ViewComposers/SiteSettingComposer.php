<?php

namespace App\ViewComposers;

use App\Models\SiteSetting;
use Illuminate\View\View;

class SiteSettingComposer
{
    protected mixed $site_setting;

    public function __construct()
    {
        $this->site_setting = SiteSetting::first();
    }

    public function compose(View $view): void
    {
        $view->with('setting', $this->site_setting ?? []);
    }
}
