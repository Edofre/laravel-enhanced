<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;

/**
 * Class Controller
 * @package App\Http\Controllers\Admin
 */
class Controller extends \App\Http\Controllers\Controller
{
    const PAGINATION_SIZE = 50;
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
