<?php

namespace Tests\Browser;

use App\Models\Tag;
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
     * Tag index page
     * @return void
     */
    public function testTagIndex()
    {
        $user = factory(User::class)->create([
            'email' => 'edo@example.com',
        ]);

        $this->browse(function ($browser) use ($user) {
            // Make sure we can't see it without logging in
            $browser
                ->visit(route('admin.tags.index'))
                ->assertDontSee('View all tags')// We don't see the title
                ->assertSee('Login'); // We see the login page

            $browser
                ->loginAs($user)
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
            $browser
                ->loginAs($user)
                ->visit(route('admin.tags.create'))
                ->assertSee('Create tag')
                ->type('name', 'My cool new tag!')
                ->press('Save')
                ->assertSee('My cool new tag!')
                ->assertSee('Show My cool new tag!');
        });
    }

    /**
     * Tag view page
     * @return void
     */
    public function testTagView()
    {
        // Create a user so we can login and see tags
        $user = factory(User::class)->create([
            'email' => 'edo@example.com',
        ]);

        // Create a tag
        $tag = factory(Tag::class)->create([
            'name' => 'My Test Tag',
        ]);

        $this->browse(function ($browser) use ($user, $tag) {
            $browser
                ->loginAs($user)
                ->visit(route('admin.tags.show', [$tag->id]))
                ->assertSee('Show My Test Tag');
        });
    }

    /**
     * Tag update page
     * @return void
     */
    public function testTagUpdate()
    {
        // Create a user so we can login and see tags
        $user = factory(User::class)->create([
            'email' => 'edo@example.com',
        ]);

        // Create a tag
        $tag = factory(Tag::class)->create([
            'name' => 'My Test Tag',
        ]);

        $this->browse(function ($browser) use ($user, $tag) {
            $browser
                ->loginAs($user)
                ->visit(route('admin.tags.show', [$tag->id]))
                ->assertSee('Show My Test Tag')
                ->visit(route('admin.tags.edit', [$tag->id]))
                ->type('name', 'My Updated Test Tag!')
                ->press('Save')
                ->assertSee('Show My Updated Test Tag')
                ->assertPathIs('/admin/tags/' . $tag->id);
        });
    }

    /**
     * Tag delete
     * @return void
     */
    public function testTagDelete()
    {
        // Create a user so we can login and see tags
        $user = factory(User::class)->create([
            'email' => 'edo@example.com',
        ]);

        // Create a tag
        $tag = factory(Tag::class)->create([
            'name' => 'My Test Tag',
        ]);

        $this->browse(function ($browser) use ($user, $tag) {
            $browser
                ->loginAs($user)
                ->visit(route('admin.tags.show', [$tag->id]))
                ->assertSee('Show My Test Tag')
                ->click('.delete-tag')
                ->acceptDialog()
                ->assertSee('Successfully deleted tag')
                ->assertPathIs('/admin/tags');
        });
    }
}
