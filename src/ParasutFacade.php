<?php

namespace TarfinLabs\Parasut;

use Illuminate\Support\Facades\Facade;

/**
 * @see \TarfinLabs\Parasut\Skeleton\SkeletonClass
 */
class ParasutFacade extends Facade
{
    /**
     * Get the registered name of the component.
     *
     * @return string
     */
    protected static function getFacadeAccessor(): string
    {
        return 'parasut';
    }
}
