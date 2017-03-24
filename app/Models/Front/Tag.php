<?php

namespace App\Models\Front;

/**
 * Class Tag
 * @package App\Models\Front
 */
class Tag extends \App\Models\Tag
{
    /**
     * Get the route key for the model.
     * @return string
     */
    public function getRouteKeyName()
    {
        return 'slug';
    }

    /**
     * @return \Illuminate\Database\Eloquent\Relations\BelongsToMany
     */
    public function newsItems()
    {
        return $this->belongsToMany(NewsItem::class, 'news_item_tags', 'tag_id', 'news_item_id');
    }
}
