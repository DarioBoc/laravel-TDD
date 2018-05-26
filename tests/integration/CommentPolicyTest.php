<?php

use App\Policies\CommentPolicy;
use Illuminate\Foundation\Testing\WithoutMiddleware;
use Illuminate\Foundation\Testing\DatabaseMigrations;
use Illuminate\Foundation\Testing\DatabaseTransactions;

class CommentPolicyTest extends TestCase
{
    public function test_the_posts_author_can_select_a_comment_as_an_answer()
    {
        $comment = factory(\App\Comment::class)->create();

        $policy = new CommentPolicy;

        $this->assertTrue($policy->accept($comment->post->user, $comment));
    }

    public function test_non_author_cannot_select_a_comment_as_an_answer()
    {
        $comment = factory(\App\Comment::class)->create();

        $policy = new CommentPolicy;

        $this->assertFalse($policy->accept(factory(\App\User::class)->create(), $comment));
    }
}
