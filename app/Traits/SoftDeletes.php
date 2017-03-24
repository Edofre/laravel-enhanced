<?php

namespace App\Traits;

/**
 * Class SoftDeletes
 * @package App\Traits
 */
trait SoftDeletes
{
    use \Illuminate\Database\Eloquent\SoftDeletes;

    /**
     * @see https://github.com/laravel/framework/issues/4990
     */
    protected function runSoftDelete()
    {
        if ($this->fireModelEvent('deleting') === false) {
            return false;
        }

        $query = $this->newQueryWithoutScopes()->where($this->getKeyName(), $this->getKey());

        $this->{$this->getDeletedAtColumn()} = $time = $this->freshTimestamp();
        $query->update([$this->getDeletedAtColumn() => $this->fromDateTime($time)]);

        // Also update the deleted_by column
        if (\App::runningInConsole()) {
            // Admin deleted this if we're in console
            $query->update([$this->getDeletedByColumn() => 1]);
        } else {
            $query->update([$this->getDeletedByColumn() => \Auth::user()->id]);
        }

        $this->fireModelEvent('deleted', false);
    }

    /**
     * Get the name of the "deleted_by" column.
     * @return string
     */
    public function getDeletedByColumn()
    {
        return defined('static::DELETED_BY') ? static::DELETED_BY : 'deleted_by';
    }
}