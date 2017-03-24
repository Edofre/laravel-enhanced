<?php

namespace Tests\Unit;

use App\Models\Tag;
use Tests\TestCase;
use Illuminate\Foundation\Testing\DatabaseMigrations;

/**
 * Class TagTest
 * @package Tests\Unit
 */
class TagTest extends TestCase
{
    use DatabaseMigrations;

    /**
     * @return void
     */
    public function testCreateTag()
    {
        $tag = factory(Tag::class)->create([
            'name' => 'Test tag',
        ]);

        $this->assertEquals('Test tag', $tag->name);
        $this->assertNotEquals('Definitely not the id', $tag->id);
    }
}
