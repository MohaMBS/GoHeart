@extends('layouts.master')
@section('content')

<div class="row col-12">
    <div class="offset-sm-2 col-sm-9 offset-sm-1 col-12">
        @if(count($posts) > 0)
    @foreach ($posts as $post)
        <div>
            <div><h3 class="font-weight-bold">{{$post->title}}</h3></div>
            <div> {!! strip_tags($post->body) !!}</div>
            <div class="text-right"> 
                <a class="btn btn-light" href="{{ route('edit.post',$post->id) }}"><i class="far fa-edit">Editar</i></a>
                <a class="btn btn-danger" href="{{ route('delete-post',$post->id) }}"><i class="far fa-trash-alt"> Eliminar</i></a> 
            </div>
        </div>
    @endforeach
    @else
        <p>No has creado ninguna entrada.</p>
        <a href="{{ route('create.post')}}">Crear entrada.</a>
    @endif
@endsection
    </div>
</div>

