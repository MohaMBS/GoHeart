@extends('layouts.master')

@section('title', '- Mis favoritos.')
@section('content')
<div class="row col-12 ">
    <div class="col-12 text-center">
        <h1 class="font-italic"> Mis favoritos: </h1>
    </div>
    <div class="offset-sm-2 col-sm-8 offset-sm-2 col-12">
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
                            <a href="{{ route('seeOne',$post->post->id )}}" class="btn btn-primary">Ver</a> 
                        </div>
                    </div>
                    </div>
                </div>
            </div>
        @endforeach
    @else
    <div class="col">
        <div class="card mb-3 text-center">
            <div class="card-body">
            <h3 class="card-title font-weight-bold"> Tines 0 entradas en favoritos.</h3>
            <hr class="myhr">
            </div>
        </div>
    </div>
    @endif
    </div>
</div>

@endsection