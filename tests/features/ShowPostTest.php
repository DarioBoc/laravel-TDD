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

        $this->visit(route('posts.show', $post))
            ->seeInElement('h1', $post->title)
            ->see($post->content)
            ->see($post->user->name);
    }
}
