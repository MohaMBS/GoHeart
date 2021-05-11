@extends('layouts.master')

@section('title', '- Mis favoritos.')
@section('content')
<div class="row col-12">
    <div class="offset-sm-2 col-sm-9 offset-sm-1 col-12">
    @if(count($posts) > 0)
        @foreach($posts as $post)
            <div class="col">
                <div class="card mb-3  ">
                    @if($post->post->front_page != null)
                        <img class="rounded " height="180" src="../{{$post->post->front_page}}" alt="Card image cap">
                    @endif
                    <div class="card-body">
                    <a href="{{ route('seeOne',$post->post->id )}}"><h3 class="card-title font-weight-bold">{{$post->post->title}}</h3></a>
                    <hr class="myhr">
                    <p class="card-text">{!!  \Illuminate\Support\Str::limit(strip_tags($post->post->body), $limit = 400, $end = '...') !!}</p>
                    <div class="row">
                        <div class="col-12 text-center d-flex d-lg-inline "> 
                            <a href="{{ route('seeOne',$post->id )}}" class="btn btn-primary">Ver</a> 
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