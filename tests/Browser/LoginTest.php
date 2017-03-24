<?php

namespace Tests\Browser;

use App\User;
use Tests\DuskTestCase;
use Illuminate\Foundation\Testing\DatabaseMigrations;

/**
 * Class LoginTest
 * @package Tests\Browser
 */
class LoginTest extends DuskTestCase
{
    use DatabaseMigrations;

    /**
     * Login a user
     * @return void
     */
    public function testCorrectLogin()
    {
        $user = factory(User::class)->create([
            'email' => 'edo@example.com',
        ]);

        $this->browse(function ($browser) use ($user) {
            $browser->visit(route('login'))
                ->type('email', $user->email)
                ->type('password', 'hunter')
                ->press('Login')
                ->assertPathIs('/dashboard')
                ->assertSee('You are logged in!');

            // Logout
            $browser->clickLink('Logout');
        });
    }

    /**
     * Tru to login with incorrect details
     * @return void
     */
    public function testInCorrectLogin()
    {
        $user = factory(User::class)->create([
            'email'    => 'edo@example.com',
            'password' => bcrypt('hunter'),
        ]);

        $this->browse(function ($browser) use ($user) {
            $browser->visit(route('login'))
                ->type('email', $user->email)
                ->type('password', '******')
                ->press('Login')
                ->assertSee(trans('auth.failed'));
        });
    }
}
