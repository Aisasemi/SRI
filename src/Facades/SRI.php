<?php

namespace Aisasemi\SRI\Facades;

use Illuminate\Support\Facades\Facade;

class SRI extends Facade
{
    /**
     * Get the registered name of the component.
     *
     * @return string
     */
    protected static function getFacadeAccessor(): string
    {
        return 'sri';
    }
}
