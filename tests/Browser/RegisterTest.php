<?php

namespace Tests\Browser;

use App\User;
use Tests\DuskTestCase;
use Illuminate\Foundation\Testing\DatabaseMigrations;

/**
 * Class LoginTest
 * @package Tests\Browser
 */
class RegisterTest extends DuskTestCase
{
    use DatabaseMigrations;

    /**
     * Login
     * @return void
     */
    public function testRegistration()
    {
        $this->browse(function ($browser) {
            $browser->visit(route('register'))
                ->type('name', 'Rick Sanchez')
                ->type('email', 'ricksanchez@C-132.com')
                ->type('password', 'hunter')
                ->type('password_confirmation', 'hunter')
                ->press('Register')
                ->assertPathIs('/dashboard')
                ->assertSee('You are logged in!');

            // Logout
            $browser->clickLink('Logout');
        });
    }

    /**
     *
     */
    public function testIncorrectConfirmationRegistration()
    {
        $this->browse(function ($browser) {
            $browser->visit(route('register'))
                ->type('name', 'Rick Sanchez')
                ->type('email', 'ricksanchez@C-132.com')
                ->type('password', 'hunter')
                ->type('password_confirmation', 'plumbus')
                ->press('Register')
                ->assertSee('The password confirmation does not match.');
        });
    }

    /**
     *
     */
    public function testIncorrectEmailRegistration()
    {
        $user = factory(User::class)->create([
            'email' => 'ricksanchez@C-132.com',
        ]);

        $this->browse(function ($browser) {
            $browser->visit(route('register'))
                ->type('name', 'Rick Sanchez')
                ->type('email', 'ricksanchez@C-132.com')
                ->type('password', 'hunter')
                ->type('password_confirmation', 'hunter')
                ->press('Register')
                ->assertSee('The email has already been taken.');
        });
    }
}
