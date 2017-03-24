<?php

namespace App\Database\Eloquent;

use App\User;

/**
 * Class Model
 * @package App\Database\Eloquent
 */
class Model extends \Illuminate\Database\Eloquent\Model
{
    /** Default pagination size */
    const PAGINATION_SIZE = 20;

    /**
     * Get the form data, id and name value pairs
     * @return mixed
     */
    public static function getFormData()
    {
        return self::orderBy('name')->pluck('name', 'id');
    }

    /**
     *
     */
    public function getFrontImageUrlAttribute()
    {
        $image_url = 'no_image.jpg';
        if (!is_null($this->image_url)) {
            $image_url = $this->image_url;
        }
        return $image_url;
    }

    /**
     * @param $self_attribute
     * @param $model_attribute
     * @param $model_class
     * @return array
     */
    public function getSelectedFormData($self_attribute, $model_attribute, $model_class)
    {
        $selected_form_data = [];
        $model = $model_class::where('id', $this->$self_attribute)->first();
        if (!empty($model)) {
            $selected_form_data[$model->id] = $model->$model_attribute;
        }

        return $selected_form_data;
    }

    /**
     * @param $relation
     * @param $model_attribute
     * @return array
     */
    public function getMultipleSelectFormData($relation, $model_attribute)
    {
        $selected_form_data = [];
        foreach ($this->$relation as $relation) {
            $selected_form_data[$relation->id] = $relation->$model_attribute;
        }
        return $selected_form_data;
    }

    /**
     * @param string $key
     * @param mixed  $value
     * @return \Illuminate\Database\Eloquent\Model
     */
    public function setAttribute($key, $value)
    {
        if (is_scalar($value) && !is_bool($value)) {
            $value = $this->emptyStringToNull(trim($value));
        }

        return parent::setAttribute($key, $value);
    }

    /**
     * @param $string
     * @return null|string
     */
    private function emptyStringToNull($string)
    {
        return ($string === '') ? null : $string;
    }

    /**
     * @param $file
     * @return string|\Symfony\Component\Translation\TranslatorInterface
     */
    public function getFileLink($file)
    {
        if (!empty($file)) {
            return link_to(route('file', ['file' => $this->upload_url]), trans('common.download_file'), ['class' => 'btn btn-primary btn-sm', 'target' => '_blank']);
        }

        return trans('common.no_file');
    }

    /**
     * @param       $image_url
     * @param null  $alt
     * @param array $options
     * @return string|\Symfony\Component\Translation\TranslatorInterface
     */
    public function getImage($image_url, $alt = null, $options = [])
    {
        if (!is_null($image_url)) {
            return link_to(route('image', ['image' => $image_url]), \Html::image(route('image', ['image' => $image_url]), $alt, $options), ['target' => '_blank']);
        }

        return trans('common.no_file');
    }

    /**
     * @return null|string
     */
    public function getUpdatedByNameAttribute()
    {
        return $this->getUserName('updated_by');
    }

    /**
     * @param      $attribute
     * @param bool $link
     * @return null|string
     */
    private function getUserName($attribute, $link = false)
    {
        $user = $this->user($attribute)->getResults();
        if (!is_null($user)) {
            if ($link) {
                return link_to(route('admin.users.show', ['user' => $user]), $user->name);
            }
            return $user->name;
        }
        return null;
    }

    /**
     * @param $attribute
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function user($attribute)
    {
        return $this->belongsTo(User::class, $attribute);
    }

    /**
     * @return null|string
     */
    public function getCreatedByNameAttribute()
    {
        return $this->getUserName('created_by');
    }

    /**
     * @return null|string
     */
    public function getCreatedByLinkAttribute()
    {
        return $this->getUserName('created_by', true);
    }

    /**
     * @return null|string
     */
    public function getUpdatedByLinkAttribute()
    {
        return $this->getUserName('updated_by', true);
    }
}
