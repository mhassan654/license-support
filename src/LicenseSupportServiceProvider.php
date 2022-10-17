<?php

namespace Mhassan654\LicenseSupport;

use Illuminate\Support\ServiceProvider as BaseServiceProvider;

use Mhassan654\LicenseSupport\Facades\LicenseSupport;

final class LicenseSupportServiceProvider extends BaseServiceProvider
{
    public function boot(): void
    {
    }

    public function register(): void
    {
        $this->app->singleton('license-support', function () {
            return new LicenseSupport();
        });
    }
}
