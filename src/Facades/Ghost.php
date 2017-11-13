<?php

namespace Specter\Facades;

use Illuminate\Support\Facades\Facade;
use Specter\Settings;

class Ghost extends Facade
{
    /**
     * Get the registered name of the component.
     *
     * @return string
     */
    protected static function getFacadeAccessor()
    {
        return Settings::class;
    }
}
