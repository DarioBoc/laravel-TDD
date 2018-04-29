<?php

use Carbon\Carbon;

class ListPostTest extends FeatureTestCase
{
    public function test_a_user_can_see_the_posts_list_and_go_to_the_details()
    {
        $post = $this->createPost([
            'title' => 'Working Hard is Not the Same as Working Smart'
        ]);

        $this->visit('/')
            ->seeInElement('h1', 'Posts')
            ->see($post->title)
            ->click($post->title)
            ->seePageIs($post->url);
    }

    public function test_the_posts_are_paginated()
    {
        $first = $this->createPost([
            'title' => 'old post',
            'created_at' => Carbon::now()->subDays(2)
        ]);

        factory(\App\Post::class)->times(15)->create([
            'created_at' => Carbon::now()->subDay()
        ]);

        $last = $this->createPost([
            'title' => 'recent post',
            'created_at' => Carbon::now()
        ]);

        $this->visit('/')
            ->see($last->title)
            ->dontSee($first->title)
            ->click('2')
            ->see($first->title)
            ->dontSee($last->title);
    }
}
