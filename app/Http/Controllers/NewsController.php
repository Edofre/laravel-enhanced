<?php

namespace App\Http\Controllers;

use App\Models\Front\NewsCategory;
use App\Models\Front\NewsItem;
use App\Models\Front\SiteContent;
use Flash;
use Illuminate\Http\Request;

/**
 * Class NewsController
 * @package App\Http\Controllers
 */
class NewsController extends Controller
{
    /**
     * @param Request $request
     * @return \Illuminate\View\View
     */
    public function index(Request $request)
    {
        $newsItems = NewsItem::query()
            ->where('is_public', true)
            ->orderBy('created_at', 'desc')
            ->paginate(NewsItem::PAGINATION_SIZE);

        return view('news.index', [
            'title'          => trans('front.all_news'),
            'newsItems'      => $newsItems,
            'newsCategory'   => null,
            'newsCategories' => $this->getFilterCategories(),
        ]);
    }

    /**
     * @return mixed
     */
    private function getFilterCategories()
    {
        return NewsCategory::all_public()->sortBy('name')->pluck('name', 'slug');
    }

    /**
     * @param Request                        $request
     * @param \App\Models\Front\NewsCategory $newsCategory
     * @return \Illuminate\View\View
     */
    public function category(Request $request, \App\Models\Front\NewsCategory $newsCategory)
    {
        // Make sure item is public
        $this->authorizeItem($newsCategory);

        $newsItems = NewsItem::query()
            ->where('is_public', true)
            ->where('news_category_id', $newsCategory->id)
            ->orderBy('created_at', 'desc')
            ->paginate(NewsItem::PAGINATION_SIZE);

        return view('news.index', [
            'title'          => $newsCategory->name,
            'newsItems'      => $newsItems,
            'newsCategory'   => $newsCategory,
            'newsCategories' => $this->getFilterCategories(),
        ]);
    }

    /**
     * @param Request  $request
     * @param NewsItem $newsItem
     * @return \Illuminate\View\View
     */
    public function show(Request $request, \App\Models\Front\NewsItem $newsItem)
    {
        // Make sure item is public
        $this->authorizeItem($newsItem);

        return view('news.show')
            ->with('newsItem', $newsItem);
    }
}
