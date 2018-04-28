<?php

class CreatePostsTest extends FeatureTestCase
{
    /**
     *
     */
    public function test_a_user_create_a_post()
    {
        // Having
        $title = 'This is a question';
        $content = 'This is the content';

        $this->actingAs($user = $this->defaultUser());

        // When
        $this->visit(route('posts.create'))
            ->type($title, 'title')
            ->type($content, 'content')
            ->press('Published');

        // Then
        $this->seeInDatabase('posts', [
            'title' => $title,
            'content' => $content,
            'pending' => true,
            'user_id' => $user->id,
        ]);

        $this->see($title);
    }

    public function test_creating_a_post_requires_authentication()
    {
        $this->visit(route('posts.create'))->seePageIs(route('login'));
    }

    public function test_create_post_form_validation()
    {
        $this->actingAs($user = $this->defaultUser())
            ->visit(route('posts.create'))
            ->press('Published')
            ->seePageIs(route('posts.create'))
            ->seeInElement('#field_title .help-block', 'The title field is required.')
            ->seeInElement('#field_content .help-block', 'The content field is required.');

    }
}