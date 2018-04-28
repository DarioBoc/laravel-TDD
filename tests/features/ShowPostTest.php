<?php

class ShowPostTest extends FeatureTestCase
{

    public function test_a_user_can_see_the_post_details()
    {
        $post = factory(\App\Post::class)->make([
            'title' => 'This is the title of the post.',
            'content' => 'This is the content of the post'
        ]);

        $user = $this->defaultUser([
            'name' => 'Dario Nahuel Rodriguez'
        ]);

        $user->posts()->save($post);

        $this->visit($post->url)
            ->seeInElement('h1', $post->title)
            ->see($post->content)
            ->see($post->user->name);
    }

    public function test_old_urls_are_redirected()
    {
        $post = factory(\App\Post::class)->make([
            'title' => 'This is the title of the post.',
            'content' => 'This is the content of the post'
        ]);

        $user = $this->defaultUser();

        $user->posts()->save($post);

        $url = $post->url;

        $post->update(['title' => 'This is the new title.']);

        $this->visit($url)
            ->seePageIs($post->url);
    }
}
