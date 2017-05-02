<?php

namespace Tests\Browser;

use Tests\DuskTestCase;
use Laravel\Dusk\Browser;

class RouteTest extends DuskTestCase
{
    /**
     * Scenario:
     * No user is logged in in application
     * User try to access home page (/ or /home)
     *
     * Expectation
     * He is still redirected to homepage
     */
    public function testHomeRouteWhenNotLoggedIn()
    {
        $this->browse(function (Browser $browser) {
            $browser->visit('/')
                ->assertSee('Bine ati venit la "Fundatia Gabriela Tudor"!')
                ->assertPathIs('/proiectIP/public/');
        });


        $this->browse(function (Browser $browser) {
            $browser->visit('/home')
                ->assertSee('Bine ati venit la "Fundatia Gabriela Tudor"!')
                ->assertPathIs('/proiectIP/public/home');
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
            $browser->visit('/login')

                ->type('identifier', 'user1@yahoo.com')
                ->type('password', '111111')
                ->press('.submit')
                ->assertSee('Bine ati venit la "Fundatia Gabriela Tudor"!')
                ->assertPathIs('/proiectIP/public/');
        });

        $this->goToLogout();
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
            $browser->visit('/login')

                ->type('identifier', 'user1@yahoo.com')
                ->type('password', '')
                ->press('.submit')

                ->assertSee('User / E-Mail')
                ->assertDontSee('Bine ati venit la "Fundatia Gabriela Tudor"!')
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
                ->assertSee('Inregistreaza-te:')
                ->assertSee('Parola')
                ->assertSee('Adresa de email')
                ->assertSee('Nume')
                ->assertSee('Prenume')
                ->assertSee('User')
                ->assertSee('Inregistreaza-te')

                ->type('user', 'test user' . rand(200,300))
                ->type('email', 'test' . rand(200,300) . '@email.com' . rand(200,300))
                ->type('name', 'test name')
                ->type('surname', 'test surname')
                ->type('password', '111111')
                ->type('password_confirmation', '111111')
                ->press('.submit')

                ->assertPathIs("/proiectIP/public/home")
                ->assertSee('Bine ati venit la "Fundatia Gabriela Tudor"!');
        });

        $this->goToLogout();
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
                ->assertSee('Inregistreaza-te:')
                ->assertSee('Parola')
                ->assertSee('Adresa de email')
                ->assertSee('Nume')
                ->assertSee('Prenume')
                ->assertSee('User')
                ->assertSee('Inregistreaza-te')

                ->type('user', 'test user' . rand(10,100))
                ->type('name', 'test name')
                ->type('surname', 'test surname')
                ->type('email', 'test@email.com' . rand(10,100))
                ->type('password', '111111')
                ->type('password_confirmation', '111121')
                ->press('.submit')

                ->assertSee('The password confirmation does not match')
                ->assertPathIs('/proiectIP/public/register');
        });

        $this->goToLogout();
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
            $browser->visit('/login')

                ->type('identifier', 'user1@yahoo.com')
                ->type('password', '111111')
                ->press('.submit');
        });

        $this->browse(function (Browser $browser) {
            $browser->visit('/upcomingEvents')

                ->assertSee('Categorii disponibile')
                ->assertDontSee('User / E-Mail')
                ->assertPathIs('/proiectIP/public/upcomingEvents');
        });

        $this->goToLogout();
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
            $browser->visit('/login')

                ->type('identifier', 'user1@yahoo.com')
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
    public function goToLogout()
    {
        $this->browse(function (Browser $browser) {
            $browser->visit('/logout')
                ->assertSee('Bine ati venit la "Fundatia Gabriela Tudor"!')
                ->assertPathIs('/proiectIP/public/');
        });

    }


}
