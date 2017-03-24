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
     * Register
     * @return void
     */
    public function testSuccessfulRegistration()
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
     * Register with incorrect confirmation password
     * @return void
     */
    public function testIncorrectConfirmationPasswordRegistration()
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
     * Register with an exiting email
     * @return void
     */
    public function testIncorrectEmailRegistration()
    {
        // Create a user with the ricksanchez@C-132.com mail so we can check for duplicates
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
