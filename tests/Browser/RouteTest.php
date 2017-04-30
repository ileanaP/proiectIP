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
                    ->assertDontSee('Subscribe to our site')
                    ->assertPathIs('/proiectIP/public/login');
        });


        $this->browse(function (Browser $browser) {
            $browser->visit('/home')

                ->assertSee('User / E-Mail')
                ->assertSee('Forgot Your Password?')
                ->assertDontSee('Subscribe to our site')
                ->assertPathIs('/proiectIP/public/login');
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
    public function testLoginSuccess()
    {
        $this->browse(function (Browser $browser) {
            $browser->visit('/')

                ->type('identifier', 'diana2@email.com')
                ->type('password', '111111')
                ->press('.submit')
                ->assertSee('What We Do')
                ->assertPathIs('/proiectIP/public/');
        });

        $this->browse(function (Browser $browser) {
            $browser->visit('/logout')

                ->assertSee('User / E-Mail')
                ->assertSee('Forgot Your Password?')
                ->assertDontSee('Subscribe to our site')
                ->assertPathIs('/proiectIP/public/login');
        });
    }

    /**
     * Scenario:
     * User try to login in application with wrong credentials and submit form
     *
     * Expectation:
     * He is not redirected to homepage and stays in login page
     */
    public function testLoginFail()
    {
        $this->browse(function (Browser $browser) {
            $browser->visit('/')

                ->type('identifier', 'diana2@email.com')
                ->type('password', '')
                ->press('.submit')

                ->assertSee('User / E-Mail')
                ->assertSee('Forgot Your Password?')
                ->assertDontSee('What We Do')
                ->assertPathIs('/proiectIP/public/login');
        });

    }


    /**
     * Scenario:
     * User try to register in application with correct credentials and submit form
     *
     * Expectation:
     * He is redirected to homepage
     *
     * Then he logout and is redirected again to login form (we logout in order to reset setup for the next test)
     */
    public function testRegisterSuccess()
    {
        $this->browse(function (Browser $browser) {
            $browser->visit('/register')

                ->assertSee('Subscribe to our site')
                ->assertSee('Password')
                ->assertSee('E-Mail Address')
                ->assertSee('Name')
                ->assertSee('Register')

                ->type('user', 'test user' . rand(200,300))
                ->type('email', 'test@email.com' . rand(200,300))
                ->type('password', '111111')
                ->type('password_confirmation', '111111')
                ->press('.submit')

                ->assertPathIs("/proiectIP/public/home")
                ->assertSee('What We Do');
        });

        $this->testLogoutRoute();
    }

    /**
     * Scenario:
     * User try to register but the password and confirmed password does not match
     *
     * Expectation:
     * He is not successfully registered and he see a message error
     */
    public function testRegisterFail()
    {
        $this->browse(function (Browser $browser) {
            $browser->visit('/register')
                ->assertSee('Subscribe to our site')
                ->assertSee('Password')
                ->assertSee('E-Mail Address')
                ->assertSee('Name')
                ->assertSee('Register')

                ->type('user', 'test user' . rand(10,100))
                ->type('email', 'test@email.com' . rand(10,100))
                ->type('password', '111111')
                ->type('password_confirmation', '111121')
                ->press('.submit')

                ->assertSee('The password confirmation does not match')
                ->assertPathIs('/proiectIP/public/register');
        });

        $this->testLogoutRoute();
    }

    /**
     * Scenario:
     * User visit application and is redirected to login form - he login with correct credentials
     *
     * Expectation: when user visit /upcomingEvents page, he see events and data filtering by category
     */
    public function testUpcomingEventsRoute()
    {
        $this->browse(function (Browser $browser) {
            $browser->visit('/')

                ->type('identifier', 'diana2@email.com')
                ->type('password', '111111')
                ->press('.submit');
        });

        $this->browse(function (Browser $browser) {
            $browser->visit('/upcomingEvents')

                ->assertSee('Categorii disponibile')
                ->assertDontSee('User / E-Mail')
                ->assertPathIs('/proiectIP/public/upcomingEvents');
        });

        $this->testLogoutRoute();
    }

    /**
     * Scenario: user successfully login
     * After that, he visit /addEventForm link and see form for new event
     *
     * Expectation:
     */
    public function testAddEventPageRoute()
    {
        $this->browse(function (Browser $browser) {
            $browser->visit('/')

                ->type('identifier', 'diana2@email.com')
                ->type('password', '111111')
                ->press('.submit');
        });

        $this->browse(function (Browser $browser) {
            $browser->visit('/addEventForm')

                ->assertSelectHasOptions('categoryId', [1,2,3,4])
                ->assertSee('Adauga un nou eveniment din urmatoarele categorii disponibile:')
                ->assertPathIs('/proiectIP/public/addEventForm')

                ->type('title', 'titlu nou' . rand(1,100))
                ->type('description', 'descriere')
                ->type('address', 'addresa dummy')
                ->type('price', 12)
                ->type('link', 'www.event.com')

                ->press('.submit')
                ->assertPathIs('/proiectIP/public/addEvent');
        });
    }

    /**
     * Scenario: user click logout button
     *
     * Expectation: he is redirected to homepage
     */
    public function testLogoutRoute()
    {
        $this->browse(function (Browser $browser) {
            $browser->visit('/logout')
                ->assertSee('User / E-Mail')
                ->assertSee('Forgot Your Password?')
                ->assertDontSee('Subscribe to our site');
        });

    }


}
