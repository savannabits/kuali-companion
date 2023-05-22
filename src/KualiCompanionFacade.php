<?php

namespace Savannabits\KualiCompanion;

use Illuminate\Support\Facades\Facade;

/**
 * @see \Savannabits\KualiCompanion\Skeleton\SkeletonClass
 */
class KualiCompanionFacade extends Facade
{
    /**
     * Get the registered name of the component.
     *
     * @return string
     */
    protected static function getFacadeAccessor()
    {
        return 'kuali-companion';
    }
}
