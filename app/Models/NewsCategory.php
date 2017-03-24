<?php

namespace App\Models;

use App\Database\Eloquent\Model;
use App\Observers\ByWhoObserver;
use App\Traits\SoftDeletes;
use Edofre\Sluggable\HasSlug;
use Edofre\Sluggable\SlugOptions;

class NewsCategory extends Model
{
    use SoftDeletes, HasSlug;

    /** @var array */
    protected $dates = ['deleted_at'];
    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'is_public',
        'name',
        'description',
        'image_url',
    ];

    /**
     *
     */
    protected static function boot()
    {
        parent::boot();
        NewsCategory::observe(new ByWhoObserver());
    }

    /**
     * Get the options for generating the slug.
     */
    public function getSlugOptions()
    {
        return SlugOptions::create()
            ->generateSlugsFrom('name')
            ->saveSlugsTo('slug');
    }

    /**
     * Get all the available items from a category
     * @param null $count
     * @return mixed
     */
    public function availableItems($count = null)
    {
        // Get the public items and sort them by their id so we have the most recent ones on top
        $items = $this->newsItems()->where('is_public', true)->orderBy('id', SORT_DESC);
        if (!is_null($count)) {
            $items->limit($count);
        }
        return $items->get();
    }

    /**
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     */
    public function newsItems()
    {
        return $this->hasMany(NewsItem::class, 'news_category_id');
    }
}
