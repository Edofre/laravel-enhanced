<?php

namespace App\Http\Controllers;

use Flash;
use Illuminate\Http\Request;

/**
 * Class TagController
 * @package App\Http\Controllers
 */
class TagController extends Controller
{
    /**
     * @param Request               $request
     * @param \App\Models\Front\Tag $tag
     * @return \Illuminate\View\View
     */
    public function index(Request $request, \App\Models\Front\Tag $tag)
    {
        // make sure items are public
        $newsItems = $tag
            ->newsItems()
            ->where('is_public', true)
            ->orderBy('id', 'desc')
            ->limit(20)
            ->get();

        return view('tag.index', [
            'title'     => $tag->name,
            'newsItems' => $newsItems,
        ]);
    }
}
