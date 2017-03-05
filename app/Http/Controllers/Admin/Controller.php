<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;

/**
 * Class Controller
 * @package App\Http\Controllers\Admin
 */
class Controller extends \App\Http\Controllers\Controller
{
    /** @var null */
    public $breadcrumb_route = null;
    /** @var null */
    public $breadcrumb_name = null;

    /**
     * Create a new controller instance.
     */
    public function __construct()
    {
        $this->middleware('auth');
    }

    /**
     * @param Request $request
     * @return \Illuminate\Http\JsonResponse
     */
    public function ajaxFormData(Request $request)
    {
        $mapped_data = [];
        // Make sure we have a query
        $search = $request->get('q', null);
        if (!is_null($search)) {
            // Find the models by name
            $models = $this->findModels($search);
            // Properly map the tags to return them
            foreach ($models as $model_id => $model_name) {
                $mapped_data[] = ['id' => $model_id, 'text' => $model_name];
            }
        }
        return response()->json([
            'results' => $mapped_data,
        ]);
    }


    /**
     * @param array $add_breadcrumbs
     * @return array
     */
    protected function getBreadcrumbs($add_breadcrumbs = [])
    {
        $breadcrumbs[] = ['route' => route('admin.dashboard'), 'name' => trans('admin.dashboard')];
        $breadcrumbs[] = ['route' => $this->breadcrumb_route, 'name' => $this->breadcrumb_name];
        foreach ($add_breadcrumbs as $breadcrumb) {
            $breadcrumbs[] = $breadcrumb;
        }

        return $breadcrumbs;
    }
}
