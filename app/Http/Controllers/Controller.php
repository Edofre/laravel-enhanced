<?php

namespace App\Http\Controllers;

use Illuminate\Foundation\Bus\DispatchesJobs;
use Illuminate\Routing\Controller as BaseController;
use Illuminate\Foundation\Validation\ValidatesRequests;
use Illuminate\Foundation\Auth\Access\AuthorizesRequests;
use Illuminate\Support\Facades\File;
use Intervention\Image\Facades\Image;

/**
 * Class Controller
 * @package App\Http\Controllers
 */
class Controller extends BaseController
{
    use AuthorizesRequests, DispatchesJobs, ValidatesRequests;

    /**
     * @param $image
     * @return mixed
     */
    public function getImage($image)
    {
        if (!File::exists($image = storage_path("app/{$image}"))) {
            abort(404);
        }
        return Image::make($image)->response();
    }

    /**
     * @param $item
     */
    protected function authorizeItem($item)
    {
        if ($item->is_public == false) {
            abort(404);
        }
    }
}
