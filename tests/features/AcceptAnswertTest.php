<?php

use Illuminate\Foundation\Testing\WithoutMiddleware;
use Illuminate\Foundation\Testing\DatabaseMigrations;
use Illuminate\Foundation\Testing\DatabaseTransactions;

class AcceptAnswertTest extends FeatureTestCase
{
    public function test_the_posts_author_can_accept_a_comment_as_the_posts_answer()
    {
        $comment = factory(\App\Comment::class)->create([
            'comment' => 'This is the best answer'
        ]);

        $this->actingAs($comment->post->user);

        $this->visit($comment->post->url)
            ->press('Accept comment');

        $this->seeInDatabase('posts', [
            'id' => $comment->post->id,
            'pending' => false,
            'answer_id' => $comment->id
        ]);

        $this->seePageIs($comment->post->url)
            ->seeInElement('.answer', $comment->comment);
    }

    public function test_non_posts_author_dont_see_the_accept_answer_button()
    {
        $comment = factory(\App\Comment::class)->create([
            'comment' => 'This is the best answer'
        ]);

        $user = factory(\App\User::class)->create();

        $this->actingAs($user);

        $this->visit($comment->post->url)
            ->dontSee('Accept comment');
    }

    public function test_non_posts_author_cannot_accept_a_comment_as_the_posts_answer()
    {
        $comment = factory(\App\Comment::class)->create([
            'comment' => 'This is the best answer'
        ]);

        $user = factory(\App\User::class)->create();

        $this->actingAs($user);

        $this->post(route('comments.accept', $comment));

        $this->seeInDatabase('posts', [
            'id' => $comment->post->id,
            'pending' => true
        ]);
    }

    public function test_the_accept_button_is_hidden_when_the_comment_is_already_the_posts_answer()
    {
        $comment = factory(\App\Comment::class)->create([
            'comment' => 'This is the best answer'
        ]);

        $this->actingAs($comment->post->user);

        $comment->markAsAnwer();

        $this->visit($comment->post->url)
            ->dontSee('Accept comment');
    }
}
