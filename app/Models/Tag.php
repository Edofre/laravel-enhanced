<?php

namespace App\Models;

use App\Database\Eloquent\Model;
use App\Observers\ByWhoObserver;
use App\Traits\SoftDeletes;
use Edofre\Sluggable\HasSlug;
use Edofre\Sluggable\SlugOptions;

/**
 * Class Tag
 * @package App\Models
 */
class Tag extends Model
{
    use SoftDeletes, HasSlug;

    /** Constant to notify the system this is a new tag */
    const NEW_KEY = 'new:';
    /** @var array */
    protected $dates = ['deleted_at'];
    /**
     * The attributes that are mass assignable.
     * @var array
     */
    protected $fillable = [
        'name',
    ];

    /**
     * @param $name
     * @return Tag
     */
    public static function findOrCreateNew($name)
    {
        $tag = self::where('name', $name)->first();
        if (is_null($tag)) {
            $tag = new Tag();
            $tag->name = $name;
            $tag->save();
        }
        return $tag;
    }

    /**
     *
     */
    protected static function boot()
    {
        parent::boot();
        Tag::observe(new ByWhoObserver());
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
     * @return \Illuminate\Database\Eloquent\Relations\BelongsToMany
     */
    public function newsItems()
    {
        return $this->belongsToMany(NewsItem::class, 'news_item_tags', 'tag_id', 'news_item_id');
    }
}
