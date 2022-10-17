<?php

namespace Mhassan654\LicenseSupport\Facades;

use Illuminate\Support\Facades\Facade;

class LicenseSupport extends Facade
{
    protected static function getFacadeAccessor()
    {
        return 'license-support';
    }
}
