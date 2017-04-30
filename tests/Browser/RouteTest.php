<?php

namespace Tests\Browser;

use Tests\DuskTestCase;
use Laravel\Dusk\Browser;
use Illuminate\Foundation\Testing\DatabaseMigrations;

class RouteTest extends DuskTestCase
{
    /**
     * A basic browser test example.
     *
     * @return void
     */
    public function testHomeRouteWhenNotLoggedIn()
    {
        $this->browse(function (Browser $browser) {
            $browser->visit('/')
                    ->assertSee('User / E-Mail')
                    ->assertSee('Forgot Your Password?')
                    ->assertDontSee('Subscribe to our site');
        });
    }

    public function testLoginRoute()
    {
        $this->browse(function (Browser $browser) {
            $browser->visit('/login')
                ->assertSee('User / E-Mail')
                ->assertDontSee('Subscribe to our site')
                ->assertSee('Forgot Your Password?');
        });
    }

    public function testRegisterRoute()
    {
        $this->browse(function (Browser $browser) {
            $browser->visit('/register')
                ->assertSee('Subscribe to our site')
                ->assertSee('Password')
                ->assertSee('Name')
                ->assertSee('Register');
        });
    }

    public function testUpcomingEventsRoute()
    {
        $this->browse(function (Browser $browser) {
            $browser->visit('/upcomingEvents')
                ->assertSee('Categorii disponibile');
        });
    }


}
