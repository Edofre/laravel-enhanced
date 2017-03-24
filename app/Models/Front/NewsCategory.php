<?php

namespace App\Models\Front;

use App\Traits\IsPublic;

/**
 * Class NewsCategory
 * @package App\Models\Front
 */
class NewsCategory extends \App\Models\NewsCategory
{
    use IsPublic;

    /**
     * Get the route key for the model.
     * @return string
     */
    public function getRouteKeyName()
    {
        return 'slug';
    }
}
