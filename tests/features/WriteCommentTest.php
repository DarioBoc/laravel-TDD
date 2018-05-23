<?php

use Illuminate\Foundation\Testing\WithoutMiddleware;
use Illuminate\Foundation\Testing\DatabaseMigrations;
use Illuminate\Foundation\Testing\DatabaseTransactions;

class WriteCommentTest extends FeatureTestCase
{

    public function test_a_user_can_write_a_comment()
    {
        $post = $this->createPost();

        $user = $this->defaultUser();

        $this->actingAs($user)
            ->visit($post->url)
            ->type('Leave a comment', 'comment')
            ->press('Publish comment');

        $this->seeInDatabase('comments', [
            'comment' => 'Leave a comment',
            'post_id' => $post->id,
            'user_id' => $user->id
        ]);

        $this->seePageIs($post->url);
    }
}
