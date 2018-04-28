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