@extends('layouts.app')

@section('content')

    <h1>{{ $post->title }}}</h1>

    <p>{{ $post->content }}}</p>

    <p>{{ $post->user->name }}}</p>

    {!! Form::open(['method' => 'POST', 'route' => ['comments.store', $post]]) !!}

        {!! Field::textarea('comment') !!}

        <button type="submit">Publish comment</button>

    {!! Form::close() !!}
@endsection