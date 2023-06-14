<?php

namespace Tests\Browser;

use Illuminate\Foundation\Testing\DatabaseMigrations;
use Laravel\Dusk\Browser;
use Tests\DuskTestCase;

class AuthTest extends DuskTestCase
{

    use DatabaseMigrations;

    /** @test */
    public function a_user_can_register()
    {
        $this->browse(function (Browser $browser) {
            $browser->visit('/register')
                ->type('name', 'John Doe')
                ->type('email', 'johndoe@example.com')
                ->type('password', 'password')
                ->type('password_confirmation', 'password')
                ->press('button[type="submit"]')
                ->assertPathIs('/dashboard');
        });
    }
}
