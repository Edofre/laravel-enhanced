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
     * Tag index
     * @return void
     */
    public function testTagIndex()
    {
        $user = factory(User::class)->create([
            'email' => 'edo@example.com',
        ]);

        $this->browse(function ($browser) use ($user) {
            // Make sure we can't see it without logging in
            $browser->visit(route('admin.tags.index'))
                ->assertDontSee('View all tags')// We don't see the title
                ->assertSee('Login'); // We see the login page

            $browser->loginAs($user)
                ->visit(route('admin.tags.index'))
                ->assertSee('View all tags');
        });
    }

    /**
     * Tag create page
     * @return void
     */
    public function testTagCreate()
    {
        $user = factory(User::class)->create([
            'email' => 'edo@example.com',
        ]);

        $this->browse(function ($browser) use ($user) {
            $browser->loginAs($user)
                ->visit(route('admin.tags.create'))
                ->assertSee('Create tag')
                ->type('name', 'My cool new tag!')
                ->press('Save')
                ->assertSee('My cool new tag!')
                ->assertSee('Show My cool new tag!');
        });
    }
}
