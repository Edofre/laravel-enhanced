<?php

namespace App\Models\Search;

use Illuminate\Database\Eloquent\Builder;

/**
 * Class NewsItem
 * @package App\Models\Search
 */
class NewsItem extends \App\Models\NewsItem
{
    /** Keyword used to search for multiple attributes */
    const SEARCH_KEYWORD = 'search_keyword';
    const SORT_KEYWORD = 'sort_keyword';
    const SORT_DIRECTION = 'sort_direction';
    /** Directions for sort */
    const SORT_ASC = 'asc';
    const SORT_DESC = 'desc';

    /**
     * The attributes that are searchable.
     * @var array
     */
    protected $fillable = [
        'news_category_id',
        'title',
        'intro',
        'content',
        self::SEARCH_KEYWORD,
        self::SORT_KEYWORD,
        self::SORT_DIRECTION,
    ];

    /**
     * @return array
     */
    public static function getSortAttributes()
    {
        return [
            'news_category_id' => trans('newsItems.news_category_id'),
            'title'            => trans('newsItems.title'),
            'intro'            => trans('newsItems.intro'),
            'content'          => trans('newsItems.content'),
            'created_at'       => trans('crud.created_at'),
        ];
    }

    /**
     * @return NewsItem|Builder
     */
    public function search()
    {
        $newsItems = NewsItem::query();
        foreach ($this->attributes as $attribute => $value) {
            if ((!empty($value) || $value === '0') && !in_array($attribute, [self::SORT_DIRECTION, self::SORT_KEYWORD])) {
                $newsItems = $this->addQuery($attribute, $value, $newsItems);
            }
        }

        // Fix the empty sort keyword
        $sort_keyword = !empty($this->attributes[self::SORT_KEYWORD]) ? $this->attributes[self::SORT_KEYWORD] : 'created_at';
        $sort_direction = !empty($this->attributes[self::SORT_DIRECTION]) ? $this->attributes[self::SORT_DIRECTION] : self::SORT_DESC;

        return $newsItems
            ->orderBy($sort_keyword, $sort_direction)
            ->paginate(\App\Models\NewsItem::PAGINATION_SIZE);
    }

    /**
     * @param $attribute
     * @param $value
     * @param $query
     * @return mixed
     */
    private function addQuery($attribute, $value, $query)
    {
        switch ($attribute) {
            case self::SEARCH_KEYWORD:
                $query = $query->where(function ($query) use ($attribute, $value) {
                    $query->where('title', 'LIKE', '%' . $value . '%')
                        ->orWhere('intro', 'LIKE', '%' . $value . '%')
                        ->orWhere('content', 'LIKE', '%' . $value . '%');
                });
                break;
            default:
                $query = $query->where($attribute, $value);
                break;
        }
        return $query;
    }
}
