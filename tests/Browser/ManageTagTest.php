<?php

namespace Tests\Browser;

use App\User;
use Tests\DuskTestCase;
use Illuminate\Foundation\Testing\DatabaseMigrations;

/**
 * Class ManageTagTest
 * @package Tests\Browser
 */
class ManageTagTest extends DuskTestCase
{
    use DatabaseMigrations;

    /**
     * Login
     * @return void
     */
    public function testTagIndex()
    {
        $user = factory(User::class)->create([
            'email' => 'edo@example.com',
        ]);

        $this->browse(function ($browser) use ($user) {
            $browser->loginAs($user)
                ->visit(route('admin.newsItems.index'))
                ->assertSee('View all news items');
        });
    }
}
