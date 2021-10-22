<?php

namespace SevenLab\Stamps\Facades;

use Illuminate\Support\Facades\Facade;

class Stamps extends Facade
{
    /**
     * Get the registered name of the component.
     *
     * @return string
     */
    protected static function getFacadeAccessor(): string
    {
        return 'stamps';
    }
}
