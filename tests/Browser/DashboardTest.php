<?php

namespace Tests\Browser;

use App\User;
use Tests\DuskTestCase;
use Laravel\Dusk\Browser;
use Illuminate\Foundation\Testing\DatabaseMigrations;

class DashboardTest extends DuskTestCase
{
    use DatabaseMigrations;

    /**
     * Test dashboard page
     *
     * @return void
     */
    public function testDashboardPage()
    {
        $user = factory(User::class)->create();

        $this->browse(function (Browser $browser) use ($user) {
            $browser->loginAs($user)
                    ->visit('/home')
                    ->assertSee('You are logged in!')
                    ->assertSee($user->name);
        });
    }
}
