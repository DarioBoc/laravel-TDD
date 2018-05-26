<?php

// Posts
Route::get('posts/create', [
    'uses' => 'CreatePostController@create',
    'as' => 'posts.create'
]);

Route::post('posts/store', [
    'uses' => 'CreatePostController@store',
    'as' => 'posts.store'
]);

Route::post('posts/{post}/comment', [
    'uses' => 'CommentController@store',
    'as' => 'comments.store'
]);

Route::post('comment/{comment}/accept', [
   'uses' => 'CommentController@accept',
   'as' => 'comments.accept'
]);
