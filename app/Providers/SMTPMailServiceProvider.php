<?php

namespace App\Providers;

use App\Models\SmtpSetting;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Cache;
use Illuminate\Support\Facades\Config;
use Illuminate\Support\Facades\Schema;
use Illuminate\Support\ServiceProvider;

class SMTPMailServiceProvider extends ServiceProvider
{
    public function register(): void
    {
        $this->app->singleton('smtp.settings', function () {
            return Cache::remember('smtp.settings', 60 * 24, function () {
                if (Schema::hasTable('smtp_settings')) {
                    return SmtpSetting::first();
                }
                return null;
            });
        });
    }

    public function boot(): void
    {
        $this->configureMailSettings();
    }

    private function configureMailSettings()
    {
        $smtpSettings = $this->app->make('smtp.settings');

        if ($smtpSettings) {
            $data = [
                'driver' => $smtpSettings->mail_mailer,
                'host' => $smtpSettings->mail_host,
                'port' => $smtpSettings->mail_port,
                'encryption' => $smtpSettings->mail_encryption,
                'username' => $smtpSettings->mail_username,
                'password' => $smtpSettings->mail_password,
                'from' => [
                    'address' => $smtpSettings->mail_from_address,
                    'name' => $smtpSettings->mail_from_name,
                ],
            ];

            Config::set('mail', $data);
        } else {
            Log::warning('SMTP settings not found. Using default mail configuration.');
        }
    }
}
