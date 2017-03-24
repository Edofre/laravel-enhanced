<?php

use Illuminate\Database\Seeder;

/**
 * Class NewsTableSeeder
 */
class NewsTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     * @return void
     */
    public function run()
    {
        factory(App\Models\NewsItem::class, 50)->create()->each(function ($news_item) {
            $news_item->tags()->save(factory(App\Models\Tag::class)->make());
        });
    }
}