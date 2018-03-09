<?php

namespace Tests\Browser;

use App\User;
use Tests\DuskTestCase;
use Laravel\Dusk\Browser;
use Illuminate\Foundation\Testing\DatabaseMigrations;

use App\Post;

use Tests\Browser\Pages\DashboardPage;

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
                    ->assertSee($user->name);
        });
    }

    /**
     * Test that shows a posts list
     *
     * @return void
     */
    public function testPostsListInDashboardPage()
    {
        $user = factory(User::class)->create();
        $user_2 = factory(User::class)->create();

        $other_user_posts = factory(Post::class, 50)->create(['user_id' => $user_2->id]);

        $posts = factory(Post::class, 10)->create(['user_id' => $user->id]);

        $this->browse(function (Browser $browser) use ($user, $posts) {
            $browser->loginAs($user)
                    ->visit(new DashboardPage())
                    ->waitFor('@posts')
                    ->assertSeePosts($posts, $user)
                    ->screenshot('dashboard-ok');
        });
    }
}
