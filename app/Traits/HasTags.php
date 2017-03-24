<?php

namespace App\Traits;

use App\Models\Tag;

/**
 * Class HasTags
 * @package App\Traits
 */
trait HasTags
{
    /**
     * @return mixed
     */
    public function getTagSelectData()
    {
        return $this->tags->pluck('id', 'id')->all();
    }

    /**
     * Synchronize the skills declared in the expert form
     * @param $source
     * @param $request
     */
    public function syncTags($source, $request)
    {
        if (!$request->has('tags')) {
            $source->tags()->detach();
        } else {
            $tag_ids = [];
            foreach ($request->tags as $tag) {
                // If we have the Tag::NEW_KEY present in the tag it's a new entry
                if (substr($tag, 0, 4) == Tag::NEW_KEY) {
                    $new_tag = Tag::create(['name' => substr($tag, 4)]);
                    $tag_ids[] = $new_tag->id;
                } else {
                    $tag_ids[] = $tag;
                }
            }

            // Sync the tags
            $source->tags()->sync($tag_ids);
        }
    }
}