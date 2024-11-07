<?php

namespace App\Providers;
use App\Models\MailConfiguration;
use Config;

use Illuminate\Support\ServiceProvider;

class MailConfigServiceProvider extends ServiceProvider
{
    /**
     * Register services.
     */
    public function register(): void
    {
        //
    }

    /**
     * Bootstrap services.
     */
    public function boot(): void
    {
        $this->loadMailConfig();
    }

    protected function loadMailConfig()
    {
        // Fetch mail configuration from the database
        $mailConfiguration = MailConfiguration::first();

        // Set mail configuration in Laravel configuration
        Config::set('mail.mailer', $mailConfiguration->mail_host);
        Config::set('mail.host', $mailConfiguration->mail_host);
        Config::set('mail.port', $mailConfiguration->mail_port);
        Config::set('mail.username', $mailConfiguration->mail_username);
        Config::set('mail.password', $mailConfiguration->mail_password);
        Config::set('mail.encryption', $mailConfiguration->mail_encryption);
        Config::set('mail.from.address', $mailConfiguration->mail_from_address);
    }
}
