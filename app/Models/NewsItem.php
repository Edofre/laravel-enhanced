<?php

namespace App\Models;

use App\Database\Eloquent\Model;
use App\Observers\ByWhoObserver;
use App\Traits\HasTags;
use App\Traits\SoftDeletes;
use Edofre\Sluggable\HasSlug;
use Edofre\Sluggable\SlugOptions;

/**
 * Class NewsItem
 * @package App\Models
 */
class NewsItem extends Model
{
    use SoftDeletes, HasSlug, HasTags;

    /** @var array */
    protected $dates = ['deleted_at'];

    /**
     * The attributes that are mass assignable.
     * @var array
     */
    protected $fillable = [
        'order_index',
        'is_public',
        'news_category_id',
        'title',
        'intro',
        'content',
        'image_url',
    ];

    /**
     * Get the form data, id and name value pairs
     * @return mixed
     */
    public static function getFormData()
    {
        return self::orderBy('title')->pluck('title', 'id');
    }

    /**
     *
     */
    protected static function boot()
    {
        parent::boot();
        NewsItem::observe(new ByWhoObserver());
    }

    /**
     * Get the options for generating the slug.
     */
    public function getSlugOptions()
    {
        return SlugOptions::create()
            ->generateSlugsFrom('title')
            ->saveSlugsTo('slug');
    }

    /**
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     */
    public function calendarItems()
    {
        return $this->hasMany(CalendarItem::class, 'news_item_id');
    }

    /**
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function newsCategory()
    {
        return $this->belongsTo(NewsCategory::class);
    }

    /**
     * @return \Illuminate\Database\Eloquent\Relations\BelongsToMany
     */
    public function tags()
    {
        return $this->belongsToMany(Tag::class, 'news_item_tags', 'news_item_id', 'tag_id');
    }

    /**
     * @return int
     */
    public function getHighestIndex()
    {
        $news_item = NewsItem::limit(1)->where('id', '<>', $this->id)->orderby('order_index', 'desc')->first();
        return is_null($news_item) ? 0 : $news_item->order_index;
    }
}