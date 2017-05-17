<?php

namespace Tests\Browser;

use App\Models\NewsCategory;
use App\User;
use Tests\DuskTestCase;
use Illuminate\Foundation\Testing\DatabaseMigrations;

/**
 * Class ManageNewsCategoryTest
 * @package Tests\Browser
 */
class ManageNewsCategoryTest extends DuskTestCase
{
    use DatabaseMigrations;

    /**
     * NewsCategory index page
     * @return void
     */
    public function testNewsCategoryIndex()
    {
        $user = factory(User::class)->create([
            'email' => 'new-edo@example.com',
        ]);

        $this->browse(function ($browser) use ($user) {
            // Make sure we can't see it without logging in
            $browser
                ->visit(route('admin.news-categories.index'))
                ->assertDontSee('View all news categories')// We don't see the title
                ->assertSee('Login'); // We see the login page

            $browser
                ->loginAs($user)
                ->visit(route('admin.news-categories.index'))
                ->assertSee('View all news categories');
        });
    }

    /**
     * NewsCategory create page
     * @return void
     */
    public function testNewsCategoryCreate()
    {
        $user = factory(User::class)->create([
            'email' => 'edo@example.com',
        ]);

        $this->browse(function ($browser) use ($user) {
            $browser
                ->loginAs($user)
                ->visit(route('admin.news-categories.create'))
                ->assertSee('Create news category')
                ->type('name', 'My cool new news category!')
                ->press('Save')
                ->assertSee('My cool new news category!')
                ->assertSee('Show My cool new news category!');
        });
    }

    /**
     * NewsCategory view page
     * @return void
     */
    public function testNewsCategoryView()
    {
        // Create a user so we can login and see news categories
        $user = factory(User::class)->create([
            'email' => 'edo@example.com',
        ]);

        // Create a news category
        $news_category = factory(NewsCategory::class)->create([
            'name' => 'My Test NewsCategory',
        ]);

        $this->browse(function ($browser) use ($user, $news_category) {
            $browser
                ->loginAs($user)
                ->visit(route('admin.news-categories.show', [$news_category->id]))
                ->assertSee('Show My Test NewsCategory');
        });
    }

    /**
     * NewsCategory update page
     * @return void
     */
    public function testNewsCategoryUpdate()
    {
        // Create a user so we can login and see news categories
        $user = factory(User::class)->create([
            'email' => 'edo@example.com',
        ]);

        // Create a news category
        $news_category = factory(NewsCategory::class)->create([
            'name' => 'My Test NewsCategory',
        ]);

        $this->browse(function ($browser) use ($user, $news_category) {
            $browser
                ->loginAs($user)
                ->visit(route('admin.news-categories.show', [$news_category->id]))
                ->assertSee('Show My Test NewsCategory')
                ->visit(route('admin.news-categories.edit', [$news_category->id]))
                ->type('name', 'My Updated Test NewsCategory!')
                ->press('Save')
                ->assertSee('Show My Updated Test NewsCategory')
                ->assertPathIs('/admin/news-categories/' . $news_category->id);
        });
    }

    /**
     * NewsCategory delete
     * @return void
     */
    public function testNewsCategoryDelete()
    {
        // Create a user so we can login and see news categories
        $user = factory(User::class)->create([
            'email' => 'edo@example.com',
        ]);

        // Create a news category
        $news_category = factory(NewsCategory::class)->create([
            'name' => 'My Test NewsCategory',
        ]);

        $this->browse(function ($browser) use ($user, $news_category) {
            $browser
                ->loginAs($user)
                ->visit(route('admin.news-categories.show', [$news_category->id]))
                ->assertSee('Show My Test NewsCategory')
                ->click('.delete-news-category')
                ->acceptDialog()
                ->assertSee('Successfully deleted news category')
                ->assertPathIs('/admin/news-categories');
        });
    }

    /**
     * NewsCategory test all attributes
     * @return void
     */
    public function testAllNewsCategoryAttributes()
    {
        // Create a user so we can login and see news categories
        $user = factory(User::class)->create([
            'email' => 'edo@example.com',
        ]);

        // Create a news category
        $news_category = factory(NewsCategory::class)->create([
            'name' => 'My Test NewsCategory',
        ]);

        $this->browse(function ($browser) use ($user, $news_category) {
            $browser
                ->loginAs($user)
                ->visit(route('admin.news-categories.show', [$news_category->id]))
                ->assertSee('Show My Test NewsCategory')
                ->visit(route('admin.news-categories.edit', [$news_category->id]))
                ->check('is_public')
                ->type('name', 'My Updated Test NewsCategory!')
                //                ->type('description', 'This is my test description')
                ->attach('upload_file', __DIR__ . '/images/edofre.png')
                ->press('Save')
                ->assertSee('Show My Updated Test NewsCategory')
                ->assertVisible('.news-category-image')
                //                ->assertSee('his is my test description')
                ->assertPathIs('/admin/news-categories/' . $news_category->id);
        });
    }
}
