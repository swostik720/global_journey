<?php

namespace App\Http\Controllers\Front;

use App\Http\Controllers\Controller;
use App\Models\LegalPage;
use Illuminate\View\View;

class LegalPageController extends Controller
{
    public function terms(): View
    {
        $page = LegalPage::query()
            ->where('key', 'terms-and-conditions')
            ->firstOrFail();

        return view('frontend.legal.show', [
            'page' => $page,
            'pageLabel' => 'Terms and Conditions',
        ]);
    }

    public function privacy(): View
    {
        $page = LegalPage::query()
            ->where('key', 'privacy-policy')
            ->firstOrFail();

        return view('frontend.legal.show', [
            'page' => $page,
            'pageLabel' => 'Privacy Policy',
        ]);
    }
}
