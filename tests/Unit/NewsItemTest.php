<?php

namespace Tests\Unit;

use App\Models\NewsItem;
use Tests\TestCase;
use Illuminate\Foundation\Testing\DatabaseMigrations;

/**
 * Class NewsItemTest
 * @package Tests\Unit
 */
class NewsItemTest extends TestCase
{
    use DatabaseMigrations;

    /**
     * @return void
     */
    public function testCreateNewsItem()
    {
        $news_item = factory(NewsItem::class)->create([
            'is_public' => true,
            'title'     => 'News item',
        ]);

        $this->assertEquals('News item', $news_item->title);
        $this->assertNotEquals(false, $news_item->is_public);
    }
}
