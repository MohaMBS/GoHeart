@extends('layouts.master')
@section('content')
@if(count($posts) > 0)
    @foreach ($posts as $post)
        <div>
            <div>{{$post->title}}</div>
            <div>{!! $post->body !!}</div>
            <div> <a href="{{ route('delete-post',$post->id) }}">Eliminar</a> <a href="{{ route('edit.post',$post->id) }}">Editar</a></div>
        </div>
    @endforeach
    @else
        <p>No has creado ninguna entrada.</p>
        <a href="{{ route('create.post')}}">Crear entrada.</a>
    @endif
@endsection