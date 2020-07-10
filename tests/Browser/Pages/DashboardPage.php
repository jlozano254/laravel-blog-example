<?php

namespace Tests\Browser\Pages;

use Laravel\Dusk\Browser;
use Laravel\Dusk\Page as BasePage;

use App\User;
use App\Post;

class DashboardPage extends BasePage
{
    /**
     * Get the URL for the page.
     *
     * @return string
     */
    public function url()
    {
        return '/home';
    }

    /**
     * Assert that the browser is on the page.
     *
     * @param  Browser  $browser
     * @return void
     */
    public function assert(Browser $browser)
    {
        $browser->assertPathIs($this->url());
    }

    /**
     * Assert that the page shows given posts.
     *
     * @param  Browser  $browser
     * @param  collection  $posts
     * @param  App\User  $user
     * @param  collection  $except_posts
     * @return void
     */
    public function assertSeePosts(Browser $browser, $posts, User $user, $except_posts)
    {
        $pages = $posts->chunk(Post::TAKE);

        $pages->each(function ($page, $index) use ($browser, $user, $posts, $except_posts) {
            $current = $index + 1;
            $browser->visit(route('home', ['page' => $current]))
                    ->assertSee($user->name)
                    ->assertSeePostsSegment($posts->nth($current, $current * Post::TAKE))
                    ->assertDontSeePostsSegment($except_posts);
        });
    }

    /**
     * Assert that the page shows posts segment.
     *
     * @param  Browser  $browser
     * @param  collection  $posts
     * @return void
     */
    public function assertSeePostsSegment(Browser $browser, $posts)
    {
        $posts->each(function ($post) use ($browser, $posts) {
            $browser->assertSeeIn('@posts-list-body', $post->id . ' ' . $post->title);
        });
    }

    /**
     * Assert that the page shows posts segment.
     *
     * @param  Browser  $browser
     * @param  collection  $posts
     * @return void
     */
    public function assertDontSeePostsSegment(Browser $browser, $posts)
    {
        $posts->each(function ($post) use ($browser, $posts) {
            $browser->assertDontSeeIn('@posts-list-body', $post->id . ' ' . $post->title);
        });
    }

    /**
     * Get the element shortcuts for the page.
     *
     * @return array
     */
    public function elements()
    {
        return [
            '@posts' => '#posts-list',
            '@posts-list-body' => '#posts-list tbody',
        ];
    }
}
