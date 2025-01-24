<?php

namespace App\Http\Controllers\Admin\Settings;

use Illuminate\View\View;
use App\Models\SiteSetting;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use App\Http\Controllers\Controller;
use Illuminate\Http\RedirectResponse;
use Illuminate\Database\Eloquent\ModelNotFoundException;
use App\Http\Requests\Admin\Settings\SiteSettingUpdateRequest;

class SiteSettingController extends Controller
{
    public function index(SiteSetting $siteSettings): View
    {
        try {
            $siteSetting = $siteSettings->first();
        } catch (ModelNotFoundException $e) {
            $siteSetting = null;
        }

        return view('admin.setting.site_setting', [
            'siteSettings' => $siteSetting,
            'id' => $siteSetting ? $siteSetting->id : null,
        ]);
    }
    public function update(SiteSettingUpdateRequest $request, SiteSetting $siteSettings, $id = null): RedirectResponse
    {
        DB::beginTransaction();
        try {
            if ($id) {
                $siteSettings = SiteSetting::find($id);
            }

            if (!$siteSettings) {
                $siteSettings = new SiteSetting();
            }

            $siteSettings->fill($request->validated());
            $siteSettings->save();

            $this->handleFileUploads($siteSettings, $request);

            DB::commit();
            return redirect()->back()->with('success', 'Company Setting Updated Successfully!');
        } catch (\Exception $e) {
            DB::rollback();
            return redirect()->back()->with('error', $e->getMessage());
        }
    }
    private function handleFileUploads(SiteSetting $siteSettings, SiteSettingUpdateRequest $request): void
    {
        if ($request->hasFile('logo')) {
            if ($siteSettings->logo) {
                $siteSettings->updateLogo('logo', 'site-setting-images', $request->file('logo'));
            } else {
                $siteSettings->storeLogo('logo', 'site-setting-images', $request->file('logo'));
            }
        }

        if ($request->hasFile('favicon')) {
            if ($siteSettings->favicon) {
                $siteSettings->updateFavicon('favicon', 'site-setting-images', $request->file('favicon'));
            } else {
                $siteSettings->storeFavicon('favicon', 'site-setting-images', $request->file('favicon'));
            }
        }
    }
}
