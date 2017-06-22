<?php

namespace App\Http\Controllers\Admin;

use Flash;

use App\Models\NewsCategory;
use App\Models\Search\NewsItem;
use Illuminate\Http\Request;

/**
 * Class NewsCategoryController
 * @package App\Http\Controllers\Admin
 */
class NewsCategoryController extends Controller
{
    /**
     * @var array
     */
    public $validation_rules = [
        'name'        => 'required|min:3',
        'description' => '',
        'upload_url'  => '',
    ];

    /**
     * NewsCategory constructor.
     */
    public function __construct()
    {
        parent::__construct();

        // Set the breadcrumbs
        $this->breadcrumb_route = route('admin.news-categories.index');
        $this->breadcrumb_name = trans('news-categories.news_categories');
    }

    /**
     * @param Request $request
     * @return \Illuminate\View\View
     */
    public function index(Request $request)
    {
        $newsCategories = NewsCategory::query();

        // Search for NewsCategory models
        if ($search = $request->get('search', false)) {
            $this->validate($request, ['search' => 'required|min:3'], [trans('common.search_validation_error')]);
            $newsCategories = NewsCategory::where('name', 'LIKE', '%' . $search . '%')
                ->orWhere('description', 'LIKE', '%' . $search . '%');
        }

        // We always want to order news categories by name and paginate them here
        $newsCategories = $newsCategories
            ->orderBy('name')
            ->paginate(NewsCategory::PAGINATION_SIZE);

        return view('admin.news-categories.index', [
            'title' => $search ? trans('crud.results_for', ['keyword' => $search]) : trans('crud.view_all', ['model'=> strtolower(trans('news-categories.news_categories'))]),
            'newsCategories' => $newsCategories,
            'search'         => $search,
            'breadcrumbs'    => $this->getBreadcrumbs(),
        ]);
    }

    /**
     * @param $id
     * @return \Illuminate\View\View
     */
    public function show($id)
    {
        $newsCategory = NewsCategory::findOrFail($id);
        return view('admin.news-categories.show')
            ->with('newsCategory', $newsCategory)
            ->with('newsItems', $newsCategory->newsItems()->orderBy('created_at', 'DESC')->paginate(NewsItem::PAGINATION_SIZE))
            ->with('breadcrumbs', $this->getBreadcrumbs([
                ['route' => route('admin.news-categories.show', $newsCategory), 'name' => $newsCategory->name],
            ]));
    }

    /**
     * @return \Illuminate\View\View
     */
    public function create()
    {
        $newsCategory = new NewsCategory;
        return view('admin.news-categories.create')
            ->with('newsCategory', $newsCategory)
            ->with('breadcrumbs', $this->getBreadcrumbs([
                ['route' => route('admin.news-categories.create'), 'name' => trans('crud.create_model', ['model' => strtolower(trans('news-categories.news_category'))])],
            ]));
    }

    /**
     * @param $id
     * @return \Illuminate\View\View
     */
    public function edit($id)
    {
        $newsCategory = NewsCategory::findOrFail($id);
        return view('admin.news-categories.edit')
            ->with('newsCategory', $newsCategory)
            ->with('breadcrumbs', $this->getBreadcrumbs([
                ['route' => route('admin.news-categories.edit', $newsCategory), 'name' => trans('crud.edit_name', ['name' => $newsCategory->name])],
            ]));
    }

    /**
     * @param Request $request
     * @return \Illuminate\Http\RedirectResponse
     */
    public function store(Request $request)
    {
        $this->validate($request, $this->validation_rules);

        $newsCategory = new NewsCategory($request->all());
        $newsCategory->image_url = $this->saveImage($request);
        $newsCategory->save();

        flash(trans('crud.created_model', ['model' => strtolower(trans('news-categories.news_category'))]), 'success');
        return redirect()->route('admin.news-categories.show', $newsCategory);
    }

    /**
     * @param Request      $request
     * @param NewsCategory $newsCategory
     * @return \Illuminate\Http\RedirectResponse
     */
    public function update(Request $request, NewsCategory $newsCategory)
    {
        $this->validate($request, $this->validation_rules);

        $newsCategory->update([
            'name'        => $request->get('name'),
            'description' => $request->get('description'),
            'is_public'   => $request->get('is_public', 0),
        ]);
        $newsCategory->image_url = $this->saveImage($request, $newsCategory->image_url);
        $newsCategory->save();

        flash(trans('crud.updated_model', ['model' => strtolower(trans('news-categories.news_category'))]), 'success');
        return redirect()->route('admin.news-categories.show', $newsCategory);
    }

    /**
     * Remove the specified resource from storage.
     * @param  int $id
     * @return \Illuminate\Http\RedirectResponse
     */
    public function destroy($id)
    {
        $newsCategory = NewsCategory::findOrFail($id);
        $newsCategory->delete();

        flash(trans('crud.deleted_model', ['model' => strtolower(trans('news-categories.news_category'))]), 'success');
        return redirect()->route('admin.news-categories.index');
    }

    /**
     * @param $search
     * @return mixed
     */
    protected function findModels($search)
    {
        return NewsCategory::where('name', 'LIKE', '%' . $search . '%')->orderBy('name')->limit(50)->pluck('name', 'id');
    }
}
