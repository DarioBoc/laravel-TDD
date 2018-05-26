<?php

namespace App\Http\Controllers;

use App\{Post, Comment};
use Illuminate\Http\Request;

class CommentController extends Controller
{
    public function store(Request $request, Post $post)
    {
        Auth()->user()->comment($post, $request->get('comment'));

        return redirect($post->url);
    }

    public function accept(Request $request, Comment $comment)
    {
        $comment->markAsAnwer();

        return redirect($comment->post->url);
    }
}
