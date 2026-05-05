<?php

namespace App\Http\Controllers\Admin\Settings;

use App\Http\Controllers\Controller;
use App\Http\Requests\Admin\Settings\LegalPageUpdateRequest;
use App\Models\LegalPage;
use Illuminate\Http\RedirectResponse;
use Illuminate\Support\Facades\DB;
use Illuminate\View\View;

class LegalPageSettingController extends Controller
{
    public function index(): View
    {
        $terms = LegalPage::query()->firstOrCreate(
            ['key' => 'terms-and-conditions'],
            [
                'title' => ['en' => 'Terms and Conditions'],
                'description' => ['en' => '<p>Terms content is not set yet.</p>'],
                'last_updated' => null,
            ]
        );

        $privacy = LegalPage::query()->firstOrCreate(
            ['key' => 'privacy-policy'],
            [
                'title' => ['en' => 'Privacy Policy'],
                'description' => ['en' => '<p>Privacy policy content is not set yet.</p>'],
                'last_updated' => null,
            ]
        );

        return view('admin.setting.legal_pages', compact('terms', 'privacy'));
    }

    public function update(LegalPageUpdateRequest $request): RedirectResponse
    {
        DB::beginTransaction();

        try {
            LegalPage::query()->updateOrCreate(
                ['key' => 'terms-and-conditions'],
                [
                    'title' => ['en' => $request->validated('terms_title')],
                    'description' => ['en' => $request->validated('terms_description')],
                    'last_updated' => $request->validated('terms_last_updated'),
                ]
            );

            LegalPage::query()->updateOrCreate(
                ['key' => 'privacy-policy'],
                [
                    'title' => ['en' => $request->validated('privacy_title')],
                    'description' => ['en' => $request->validated('privacy_description')],
                    'last_updated' => $request->validated('privacy_last_updated'),
                ]
            );

            DB::commit();

            return redirect()->back()->with('success', 'Legal pages updated successfully!');
        } catch (\Throwable $th) {
            DB::rollBack();

            return redirect()->back()->with('error', $th->getMessage());
        }
    }
}
