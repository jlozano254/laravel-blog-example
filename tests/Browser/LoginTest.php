<?php

namespace Tests\Browser;

use App\User;
use Tests\DuskTestCase;
use Laravel\Dusk\Browser;
use Illuminate\Foundation\Testing\DatabaseMigrations;

class LoginTest extends DuskTestCase
{
    use DatabaseMigrations;

    /**
     * Test for wrong credentials
     *
     * @return void
     */
    public function testLoginWithWrongCredentials()
    {
        $user = factory(User::class)->create(['password' => bcrypt('secret')]);

        $this->browse(function (Browser $browser) use ($user) {
            $browser->visit('/login')
                    ->assertSee('E-Mail Address')
                    ->assertSee('Password')
                    ->type('email', $user->email)
                    ->type('password', 'wrong password')
                    ->press('Login')
                    ->assertDontSee('You are logged in!');
        });
    }

    /**
     * Test for valid credentials
     *
     * @return void
     */
    public function testLoginWithValidCredentials()
    {
        $user = factory(User::class)->create(['password' => bcrypt('secret')]);

        $this->browse(function (Browser $browser) use ($user) {
            $browser->visit('/login')
                    ->assertSee('E-Mail Address')
                    ->assertSee('Password')
                    ->type('email', $user->email)
                    ->type('password', 'secret')
                    ->press('Login')
                    ->assertSee('You are logged in!');
        });
    }
}
