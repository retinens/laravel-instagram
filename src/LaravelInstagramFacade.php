<?php

namespace Retinens\LaravelInstagram;

use Illuminate\Support\Facades\Facade;

/**
 * @see \Retinens\LaravelInstagram\Skeleton\SkeletonClass
 */
class LaravelInstagramFacade extends Facade
{
    /**
     * Get the registered name of the component.
     *
     * @return string
     * @codeCoverageIgnore
     */
    protected static function getFacadeAccessor()
    {
        return 'laravel-instagram';
    }
}
