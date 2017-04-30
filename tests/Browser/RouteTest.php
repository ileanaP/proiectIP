<?php

namespace Tests\Browser;

use Tests\DuskTestCase;
use Laravel\Dusk\Browser;
use Illuminate\Foundation\Testing\DatabaseMigrations;

class RouteTest extends DuskTestCase
{
    /**
     * Scenario:
     * No user is logged in in application
     * User try to access home page (/ or /home)
     *
     * Expectation
     * He is redirected to login form
     */
    public function testHomeRouteWhenNotLoggedIn()
    {
        $this->browse(function (Browser $browser) {
            $browser->visit('/')
                    ->assertSee('User / E-Mail')
                    ->assertSee('Forgot Your Password?')
                    ->assertDontSee('Subscribe to our site');
        });


        $this->browse(function (Browser $browser) {
            $browser->visit('/home')
                ->assertSee('User / E-Mail')
                ->assertSee('Forgot Your Password?')
                ->assertDontSee('Subscribe to our site');
        });
    }

    /**
     * Scenario:
     * User try to login in application with correct credentials and submit form
     *
     * Expectation:
     * He is redirected to homepage
     *
     * Then he logout and is redirected again to login form (we logout in order to reset setup for the next test)
     */
    public function testSuccessLogin()
    {
        $this->browse(function (Browser $browser) {
            $browser->visit('/')
                ->type('identifier', 'diana2@email.com')
                ->type('password', '111111')
                ->press('.submit')
                ->assertSee('What We Do');
        });

        $this->browse(function (Browser $browser) {
            $browser->visit('/logout')
                ->assertSee('User / E-Mail')
                ->assertSee('Forgot Your Password?')
                ->assertDontSee('Subscribe to our site');
        });
    }

    /**
     * Scenario:
     * User try to login in application with wrong credentials and submit form
     *
     * Expectation:
     * He is not redirected to homepage and stays in login page
     */
    public function testFailLogin()
    {
        $this->browse(function (Browser $browser) {
            $browser->visit('/')
                ->type('identifier', 'diana2@email.com')
                ->type('password', '')
                ->press('.submit')
                ->assertSee('User / E-Mail')
                ->assertSee('Forgot Your Password?')
                ->assertDontSee('What We Do');
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
            $browser->visit('/')
                ->type('identifier', 'diana2@email.com')
                ->type('password', '111111')
                ->press('.submit');
        });
//
//        $this->browse(function (Browser $browser) {
//            $browser->visit('/upcomingEvents')
//                ->assertSee('Categorii disponibile')
//                ->assertDontSee('User / E-Mail')
//                ->assertAuthenticated();
//        });
    }


    public function testLogoutRoute()
    {
        $this->browse(function (Browser $browser) {
            $browser->visit('/logout')
                ->assertSee('User / E-Mail')
                ->assertSee('Forgot Your Password?')
                ->assertDontSee('Subscribe to our site');
        });

    }

    public function testAddEventPageRoute()
    {
        $this->browse(function (Browser $browser) {
            $browser->visit('/addEventForm')
                ->assertSelectHasOptions('categoryId', [1,2,3,4])
                ->assertSee('Adauga un nou eveniment din urmatoarele categorii disponibile:');
        });

    }

}
