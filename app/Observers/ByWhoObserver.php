<?php

namespace App\Observers;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Auth;

/**
 * Class ByWhoObserver
 * @package App\Observers
 */
class ByWhoObserver
{
    /**
     * @param Model $model
     */
    public function creating(Model $model)
    {
        $model->created_by = $this->getUserId();
    }

    /**
     * If user is not logged in we return null
     */
    private function getUserId()
    {
        return (is_null(Auth::user()) ? null : Auth::user()->id);
    }

    /**
     * @param Model $model
     */
    public function updating(Model $model)
    {
        $model->updated_by = $this->getUserId();
    }

    /**
     * @param Model $model
     */
    public function deleting(Model $model)
    {
        $model->deleted_by = $this->getUserId();
    }
}