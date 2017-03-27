<?php

namespace Tests\Browser\Pages;

use Laravel\Dusk\Browser;
use Laravel\Dusk\Page as BasePage;

/**
 * Class Login
 * @package Tests\Browser\Pages
 */
class Login extends BasePage
{
    /**
     * Assert that the browser is on the page.
     * @param Browser $browser
     */
    public function assert(Browser $browser)
    {
        $browser->assertPathIs($this->url());
    }

    /**
     * Get the URL for the page.
     * @return string
     */
    public function url()
    {
        return '/login';
    }

    /**
     * Get the element shortcuts for the page.
     * @return array
     */
    public function elements()
    {
        return [
            '@email'    => 'input[name=email]',
            '@password' => 'input[name=password]',
        ];
    }
}
