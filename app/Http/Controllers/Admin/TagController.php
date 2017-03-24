<?php

namespace App\Http\Controllers\Admin;

use Flash;

use App\Models\NewsItem;
use App\Models\Tag;
use Illuminate\Http\Request;

/**
 * Class TagController
 * @package App\Http\Controllers\Admin
 */
class TagController extends Controller
{
    /** @var array */
    public $validation_rules = [
        'name' => 'required|min:3',
    ];

    /**
     * TagController constructor.
     */
    public function __construct()
    {
        parent::__construct();

        // Set the breadcrumbs
        $this->breadcrumb_route = route('admin.tags.index');
        $this->breadcrumb_name = trans('tags.tags');
    }

    /**
     * @param Request $request
     * @return \Illuminate\View\View
     */
    public function index(Request $request)
    {
        $tags = Tag::query();

        // Search for Tag models
        if ($search = $request->get('search', false)) {
            $this->validate($request, ['search' => 'required|min:3'], [trans('common.search_validation_error')]);
            $tags = Tag::where('name', 'LIKE', '%' . $search . '%');
        }

        // We always want to order tags by name and paginate them here
        $tags = $tags
            ->orderBy('name')
            ->paginate(Tag::PAGINATION_SIZE);

        return view('admin.tags.index', [
            'tags'        => $tags,
            'search'      => $search,
            'breadcrumbs' => $this->getBreadcrumbs(),
        ]);
    }

    /**
     * @param $id
     * @return \Illuminate\View\View
     */
    public function show($id)
    {
        $tag = Tag::findOrFail($id);
        return view('admin.tags.show')
            ->with('tag', $tag)
            ->with('newsItems', $tag->newsItems()->orderBy('created_at', 'DESC')->paginate(NewsItem::PAGINATION_SIZE))
            ->with('breadcrumbs', $this->getBreadcrumbs([
                ['route' => route('admin.tags.show', $tag), 'name' => $tag->name],
            ]));
    }

    /**
     * @return \Illuminate\View\View
     */
    public function create()
    {
        $tag = new Tag;
        return view('admin.tags.create')
            ->with('tag', $tag)
            ->with('breadcrumbs', $this->getBreadcrumbs([
                ['route' => route('admin.tags.create'), 'name' => trans('crud.create_model', ['model' => strtolower(trans('tags.tag'))])],
            ]));
    }

    /**
     * @param $id
     * @return \Illuminate\View\View
     */
    public function edit($id)
    {
        $tag = Tag::findOrFail($id);
        return view('admin.tags.edit')
            ->with('tag', $tag)
            ->with('breadcrumbs', $this->getBreadcrumbs([
                ['route' => route('admin.tags.edit', $tag), 'name' => trans('crud.edit_name', ['name' => $tag->name])],
            ]));
    }

    /**
     * @param Request $request
     * @return \Illuminate\Http\RedirectResponse
     */
    public function store(Request $request)
    {
        $this->validate($request, $this->validation_rules);

        $tag = new Tag($request->all());
        $tag->save();

        flash(trans('crud.created_model', ['model' => strtolower(trans('tags.tag'))]), 'success');
        return redirect()->route('admin.tags.show', $tag);
    }

    /**
     * @param Request $request
     * @param Tag     $tag
     * @return \Illuminate\Http\RedirectResponse
     */
    public function update(Request $request, Tag $tag)
    {
        $this->validate($request, $this->validation_rules);

        $tag->update([
            'name' => $request->get('name'),
        ]);
        $tag->save();

        flash(trans('crud.updated_model', ['model' => strtolower(trans('tags.tag'))]), 'success');
        return redirect()->route('admin.tags.show', $tag);
    }

    /**
     * Remove the specified resource from storage.
     * @param  int $id
     * @return \Illuminate\Http\RedirectResponse
     */
    public function destroy($id)
    {
        $tag = Tag::findOrFail($id);
        $tag->delete();

        flash(trans('crud.deleted_model', ['model' => strtolower(trans('tags.tag'))]), 'success');
        return redirect()->route('admin.tags.index');
    }

    /**
     * @param $search
     * @return mixed
     */
    protected function findModels($search)
    {
        return Tag::where('name', 'LIKE', '%' . $search . '%')->orderBy('name')->limit(50)->pluck('name', 'id');
    }
}
