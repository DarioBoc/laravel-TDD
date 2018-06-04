@extends('layouts.app')

@section('content')

    <h1>{{ $post->title }}}</h1>

    {!! $post->safe_html_content !!}

    <p>{{ $post->user->name }}}</p>

    {!! Form::open(['method' => 'POST', 'route' => ['comments.store', $post]]) !!}

        {!! Field::textarea('comment') !!}

        <button type="submit">Publish comment</button>

    {!! Form::close() !!}

    @foreach($post->lastComments as $comment)
        <article class="{{ $comment->answer ? 'answer' : ''}}">
            {{ $comment->comment }}
            @if(Gate::allows('accept', $comment) && ! $comment->answer)
            {!! Form::open(['method' => 'POST', 'route' => ['comments.accept', $comment]]) !!}
            <button type="submit">Accept comment</button>
            {!! Form::close() !!}
            @endif
        </article>
    @endforeach

@endsection