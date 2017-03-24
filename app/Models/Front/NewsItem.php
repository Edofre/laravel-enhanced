<?php

namespace App\Models\Front;

use App\Traits\IsPublic;

/**
 * Class NewsItem
 * @package App\Models\Front
 */
class NewsItem extends \App\Models\NewsItem
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

    /**
     * @return mixed
     */
    public function getFrontIntroAttribute()
    {
        return $this->intro;
    }

    /**
     * @return \Illuminate\Database\Eloquent\Relations\BelongsToMany
     */
    public function tags()
    {
        return $this->belongsToMany(Tag::class, 'news_item_tags', 'news_item_id', 'tag_id');
    }
}