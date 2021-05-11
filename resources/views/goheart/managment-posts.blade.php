@extends('layouts.master')

@section('title', '- Mis entradas.')
@section('content')

<div class="row col-12">
    <div class="offset-sm-2 col-sm-9 offset-sm-1 col-12">
        @if(count($posts) > 0)
    @foreach ($posts as $post)
        <div class="col">
            <div class="card mb-3  ">
                @if($post->front_page != null)
                    <img class="rounded " height="180" src="../{{$post->front_page}}" alt="Card image cap">
                @endif
                <div class="card-body">
                <a href="{{ route('seeOne',$post->id )}}"><h3 class="card-title font-weight-bold">{{$post->title}}</h3></a>
                <hr class="myhr">
                <p class="card-text">{!!  \Illuminate\Support\Str::limit(strip_tags($post->body), $limit = 400, $end = '...') !!}</p>
                <div class="row">
                    @if( $post->user->url_avatar !=null)
                        <div class="col-sm-5 col-6 my-auto mx-auto"><p class="card-text"><img src="{{$post->user->url_avatar}}" alt="Profile picture" class="avatar"><small class="text-muted">
                            {{ $post->creator_name }}
                            </small></p>
                        </div>
                    @else
                        <div class="col-lg-6 col-12 my-auto mx-auto"><p class="card-text"><img src="https://img2.freepng.es/20180616/sxr/kisspng-avatar-computer-icons-avatar-icon-5b254abb7cf344.7556131215291706195118.jpg" alt="Profile picture" class="avatar"><small class="text-muted">
                            {{ $post->creator_name }}
                            </small></p>
                        </div>
                    @endif
                    <div class="col-12 col-lg-6 text-center d-flex d-lg-inline "> 
                        <a href="{{ route('seeOne',$post->id )}}" class="btn btn-primary">Ver</a>
                        <a class="btn btn-light" href="{{ route('edit.post',$post->id) }}"><i class="far fa-edit">Editar</i></a>
                        <a class="btn btn-danger" href="{{ route('delete-post',$post->id) }}"><i class="far fa-trash-alt"> Eliminar</i></a> 
                    </div>
                </div>
                </div>
            </div>
        </div>
    @endforeach
    @else
        <p>No has creado ninguna entrada.</p>
        <a href="{{ route('create.post')}}">Crear entrada.</a>
    @endif
    </div>
</div>
@endsection

