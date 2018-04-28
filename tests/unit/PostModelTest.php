<?php

use App\Post;

class PostModelTest extends TestCase
{

    public function test_adding_a_title_generates_a_slug()
    {
        $post = new Post([
            'title' => 'Title of the post.'
        ]);

        $this->assertSame('title-of-the-post', $post->slug);
    }

    public function test_editing_the_title_changes_the_slug()
    {
        $post = new Post([
            'title' => 'Title of the post.'
        ]);

        $post->title = 'This is the new title';

        $this->assertSame('this-is-the-new-title', $post->slug);
    }
}
