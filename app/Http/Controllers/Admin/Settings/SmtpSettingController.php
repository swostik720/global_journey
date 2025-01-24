<?php

namespace App\Http\Controllers\Admin\Settings;

use Illuminate\View\View;
use App\Models\SmtpSetting;
use Illuminate\Http\Request;
use App\Enums\MailEncryption;
use Illuminate\Support\Facades\DB;
use App\Http\Controllers\Controller;
use Illuminate\Http\RedirectResponse;
use Illuminate\Database\Eloquent\ModelNotFoundException;
use App\Http\Requests\Admin\Settings\SmptSettingUpdateRequest;

class SmtpSettingController extends Controller
{
    public function index(SmtpSetting $smtpSettings): View
    {
        try {
            $smtpSetting = $smtpSettings->first();
            $encryptionOptions = MailEncryption::values();
        } catch (ModelNotFoundException $e) {
            $smtpSetting = null;
            $encryptionOptions = [];
        }

        return view('admin.setting.smtp_setting', [
            'smtpSettings' => $smtpSetting,
            'id' => $smtpSetting ? $smtpSetting->id : null,
            'encryptionOptions' => $encryptionOptions,
        ]);
    }
    public function update(SmptSettingUpdateRequest $request, SmtpSetting $smtpSettings, $id = null): RedirectResponse
    {
        DB::beginTransaction();
        try {
            if ($id) {
                $smtpSettings = SmtpSetting::find($id);
            }

            if (!$smtpSettings) {
                $smtpSettings = new SmtpSetting();
            }

            $smtpSettings->fill($request->validated());
            $smtpSettings->save();

            DB::commit();
            return redirect()->back()->with('success', 'SMTP Setting Updated Successfully!');
        } catch (\Exception $e) {
            DB::rollback();
            return redirect()->back()->with('error', $e->getMessage());
        }
    }
}
