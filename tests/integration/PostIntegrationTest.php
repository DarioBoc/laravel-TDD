<?php

use Illuminate\Foundation\Testing\DatabaseTransactions;

class PostIntegrationTest extends FeatureTestCase
{
    use DatabaseTransactions;

    public function test_a_slug_is_generated_and_saved_to_the_database()
    {
        $post = $this->createPost([
            'title' => 'This is the title of the post.'
        ]);

        $this->assertSame('this-is-the-title-of-the-post', $post->fresh()->slug);
    }
}
