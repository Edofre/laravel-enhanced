<?php

namespace App\Http\Controllers\Admin;

use App\Models\NewsItem;
use Flash;
use Illuminate\Http\Request;

/**
 * Class NewsItemController
 * @package App\Http\Controllers\Admin
 */
class NewsItemController extends Controller
{
    /** @var array */
    public $validation_rules = [
        'news_category_id' => '',
        'is_public'        => '',
        'title'            => 'required|min:5',
        'intro'            => '',
        'content'          => '',
        'image_url'        => '',
    ];

    /**
     * NewsItemController constructor.
     */
    public function __construct()
    {
        parent::__construct();

        // Set the breadcrumbs
        $this->breadcrumb_route = route('admin.newsItems.index');
        $this->breadcrumb_name = trans('newsItems.news_items');
    }

    /**
     * @param Request                     $request
     * @param \App\Models\Search\NewsItem $newsItem
     * @return \Illuminate\View\View
     */
    public function index(Request $request, \App\Models\Search\NewsItem $newsItem)
    {
        $newsItem->fill($request->all());
        // check if we have some search variables
        if ($newsItem->isDirty()) {
            $this->validate($request, [
                'news_category_id' => '',
                'search'           => 'min:3',
            ], [
                'search' => trans('common.search_validation_error'),
            ]);
            $newsItems = $newsItem->search();
        } else {
            $newsItems = NewsItem::query()
                ->orderBy('id', 'desc')
                ->paginate(NewsItem::PAGINATION_SIZE);
        }

        return view('admin.newsItems.index', [
            'newsItems'   => $newsItems,
            'newsItem'    => $newsItem,
            'breadcrumbs' => $this->getBreadcrumbs(),
        ]);
    }

    /**
     * @param $id
     * @return \Illuminate\View\View
     */
    public function show($id)
    {
        $newsItem = NewsItem::findOrFail($id);
        return view('admin.newsItems.show')
            ->with('newsItem', $newsItem)
            ->with('breadcrumbs', $this->getBreadcrumbs([
                ['route' => route('admin.newsItems.show', $newsItem), 'name' => $newsItem->title],
            ]));
    }

    /**
     * @return \Illuminate\View\View
     */
    public function create()
    {
        $newsItem = new NewsItem;

        return view('admin.newsItems.create')
            ->with('newsItem', $newsItem)
            ->with('breadcrumbs', $this->getBreadcrumbs([
                ['route' => route('admin.newsItems.create'), 'name' => trans('crud.create_model', ['model' => strtolower(trans('newsItems.news_item'))])],
            ]));
    }

    /**
     * @param $id
     * @return \Illuminate\View\View
     */
    public function edit($id)
    {
        $newsItem = NewsItem::findOrFail($id);
        return view('admin.newsItems.edit')
            ->with('newsItem', $newsItem)
            ->with('breadcrumbs', $this->getBreadcrumbs([
                ['route' => route('admin.newsItems.edit', $newsItem), 'name' => trans('crud.edit_name', ['name' => $newsItem->title])],
            ]));
    }

    /**
     * @param Request $request
     * @return \Illuminate\Http\RedirectResponse
     */
    public function store(Request $request)
    {
        $this->validate($request, $this->validation_rules);

        $newsItem = new NewsItem($request->all());
        $newsItem->image_url = $this->saveImage($request);
        $newsItem->save();

        // Sync the tags
        $newsItem->syncTags($newsItem, $request);

        flash(trans('crud.created_model', ['model' => strtolower(trans('newsItems.news_item'))]), 'success');
        return redirect()->route('admin.newsItems.show', $newsItem);
    }

    /**
     * @param Request  $request
     * @param NewsItem $newsItem
     * @return \Illuminate\Http\RedirectResponse
     */
    public function update(Request $request, NewsItem $newsItem)
    {
        $this->validate($request, $this->validation_rules);

        $newsItem->update([
            'news_category_id' => $request->get('news_category_id'),
            'is_public'        => $request->get('is_public', 0),
            'title'            => $request->get('title'),
            'intro'            => $request->get('intro'),
            'content'          => $request->get('content'),
        ]);
        $newsItem->image_url = $this->saveImage($request, $newsItem->image_url);
        $newsItem->save();

        // Sync the tags
        $newsItem->syncTags($newsItem, $request);

        flash(trans('crud.updated_model', ['model' => strtolower(trans('newsItems.news_item'))]), 'success');
        return redirect()->route('admin.newsItems.show', $newsItem);
    }


    /**
     * Remove the specified resource from storage.
     * @param  int $id
     * @return \Illuminate\Http\RedirectResponse
     */
    public function destroy($id)
    {
        $newsItem = NewsItem::findOrFail($id);
        $newsItem->delete();

        flash(trans('crud.deleted_model', ['model' => strtolower(trans('newsItems.news_item'))]), 'success');
        return redirect()->route('admin.newsItems.index');
    }

    /**
     * @param $search
     * @return mixed
     */
    protected function findModels($search)
    {
        return NewsItem::where('title', 'LIKE', '%' . $search . '%')->orderBy('title')->limit(50)->pluck('title', 'id');
    }
}
