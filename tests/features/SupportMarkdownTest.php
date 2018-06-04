<?php

class SupportMarkdownTest extends FeatureTestCase
{
    public function test_the_post_content_support_markdown()
    {
        $post = $this->createPost([
            'content'=> 'This is a text with **markup**'
        ]);

        $this->visit($post->url)
            ->seeInElement('strong', 'markup');
    }

    public function test_xss_attack()
    {
        $xssAttack = "<script>alert('danger code')</script>";

        $post = $this->createPost([
            'content'=> "$xssAttack. text normal"
        ]);

        $this->visit($post->url)
            ->dontSee($xssAttack)
            ->seeText('text normal');
    }
}
