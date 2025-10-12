<?php

namespace App\Providers;

use App\Models\SmtpSetting;
use Illuminate\Support\Facades\Config;
use Illuminate\Support\Facades\Schema;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\ServiceProvider;

class SMTPMailServiceProvider extends ServiceProvider
{
    /**
     * Register services.
     */
    public function register(): void
    {
        // No need to return early; allow singleton registration
        if (Schema::hasTable('smtp_settings')) {
            $this->app->singleton('smtp.settings', function () {
                return SmtpSetting::first();
            });
        }
    }

    /**
     * Bootstrap services.
     */
    public function boot(): void
    {
        $this->applySmtpSettings();
    }

    /**
     * Apply SMTP settings dynamically.
     */
    private function applySmtpSettings(): void
    {
        // Only apply if singleton is registered
        if ($this->app->bound('smtp.settings')) {
            $smtp = $this->app->make('smtp.settings');

            if ($smtp) {
                Config::set('mail.mailers.smtp', [
                    'transport' => 'smtp',
                    'host' => $smtp->mail_host,
                    'port' => $smtp->mail_port,
                    'encryption' => $smtp->mail_encryption,
                    'username' => $smtp->mail_username,
                    'password' => $smtp->mail_password,
                    'timeout' => null,
                    'auth_mode' => null,
                ]);

                Config::set('mail.from.address', $smtp->mail_from_address);
                Config::set('mail.from.name', $smtp->mail_from_name);
            } else {
                Log::warning('SMTP settings table is empty. Using default mail config.');
            }
        } else {
            Log::warning('SMTP settings singleton not bound. Using default mail config.');
        }
    }
}
