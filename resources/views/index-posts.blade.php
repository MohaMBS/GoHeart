@extends('layouts/master')

@section('content')
@foreach ($posts as $post)
    <div>
    <h1>{{$post->title}}</h1>
    {!! $post->body !!}
    {{$post->comments_count}}
    <small>{{$post->creator_name}}</small>
    </div>
    @endforeach

@endsection