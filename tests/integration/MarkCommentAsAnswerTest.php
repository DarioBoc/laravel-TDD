<?php

use Illuminate\Foundation\Testing\WithoutMiddleware;
use Illuminate\Foundation\Testing\DatabaseMigrations;
use Illuminate\Foundation\Testing\DatabaseTransactions;

class MarkCommentAsAnswerTest extends TestCase
{
    use DatabaseTransactions;

    public function test_a_post_can_be_answered()
    {
        $post = $this->createPost();

        $comment = Factory(\App\Comment::class)->create([
           'post_id' => $post->id
        ]);

        $comment->markAsAnwer();

        $this->assertTrue($comment->fresh()->answer);

        $this->assertFalse($post->fresh()->pending);
    }

    public function test_a_post_can_only_have_one_answer()
    {
        $post = $this->createPost();

        $comments = Factory(\App\Comment::class)->times(2)->create([
            'post_id' => $post->id
        ]);

        $comments->first()->markAsAnwer();
        $comments->last()->markAsAnwer();

        $this->assertFalse($comments->first()->fresh()->answer);
        $this->assertTrue($comments->last()->fresh()->answer);
    }
}
