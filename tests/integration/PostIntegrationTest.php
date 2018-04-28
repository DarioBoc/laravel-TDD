<?php

use Illuminate\Foundation\Testing\DatabaseTransactions;

class PostIntegrationTest extends TestCase
{
    use DatabaseTransactions;

    public function test_a_slug_is_generated_and_saved_to_the_database()
    {
        $user = $this->defaultUser();

        $post = factory(\App\Post::class)->make([
            'title' => 'This is the title of the post.'
        ]);

        $user->posts()->save($post);

        $this->assertSame('this-is-the-title-of-the-post', $post->fresh()->slug);
    }
}
