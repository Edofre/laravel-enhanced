<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\File;

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
        $breadcrumbs[] = ['route' => route('dashboard'), 'name' => trans('admin.dashboard')];
        $breadcrumbs[] = ['route' => $this->breadcrumb_route, 'name' => $this->breadcrumb_name];
        foreach ($add_breadcrumbs as $breadcrumb) {
            $breadcrumbs[] = $breadcrumb;
        }

        return $breadcrumbs;
    }


    /**
     * Saves the file from the request and removes the old file if required
     * @param Request $request
     * @param null    $old_file_name
     * @return null
     */
    protected function saveImage(Request $request, $old_file_name = null)
    {
        $file = $request->file('upload_file');
        if (is_null($file)) {
            return $old_file_name;
        }

        // do we have af file we should remove first?
        if (!is_null($old_file_name)) {
            Storage::delete($old_file_name);
        }

        // Create the file name
        $image_name = $this->createFileName($file);

        // Save the image
        Storage::put($image_name, File::get($file));

        //        // Resize the image TODO FOR LATER POSSIBLY
        //        $image = Image::make($file);
        //        $image->fit(self::ITEM_IMAGE_WIDTH, self::ITEM_IMAGE_HEIGHT);
        //
        //        // Save the image stream
        //        Storage::put($image_name, $image->stream());

        // return the filename so we can save it as the model attribute
        return $image_name;
    }


    /**
     * @param $file
     * @return string
     */
    private function createFileName($file)
    {
        return time() . '_' . $file->getClientOriginalName();
    }
}
