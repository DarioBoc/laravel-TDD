<?php

class ShowPostTest extends FeatureTestCase
{

    public function test_a_user_can_see_the_post_details()
    {
        $user = $this->defaultUser([
            'name' => 'Dario Nahuel Rodriguez'
        ]);

        $post = $this->createPost([
            'title' => 'This is the title of the post.',
            'content' => 'This is the content of the post',
            'user_id' => $user->id
        ]);

        $this->visit($post->url)
            ->seeInElement('h1', $post->title)
            ->see($post->content)
            ->see($post->user->name);
    }

    public function test_old_urls_are_redirected()
    {
        $post = $this->createPost([
            'title' => 'This is the title of the post.',
            'content' => 'This is the content of the post'
        ]);

        $url = $post->url;

        $post->update(['title' => 'This is the new title.']);

        $this->visit($url)
            ->seePageIs($post->url);
    }
}
