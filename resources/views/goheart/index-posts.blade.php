@extends('layouts/master')
@section('title', '- Entradas.')
@section('content')
<div class="row">   
    <div class="col-12 col-sm-11">
      @foreach ($posts as $post)
        <div class="offset-sm-2 col-sm-9 offset-sm-1 col-12">
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
                        <div class="col-sm-5 col-6 my-auto mx-auto"><p class="card-text"><img src="https://img2.freepng.es/20180616/sxr/kisspng-avatar-computer-icons-avatar-icon-5b254abb7cf344.7556131215291706195118.jpg" alt="Profile picture" class="avatar"><small class="text-muted">
                            {{ $post->creator_name }}
                            </small></p>
                        </div>
                    @endif
                    <div class="col-sm-5 col-6 my-auto mx-auto"> <i class="fas fa-comments"></i> {{ $post->comments_count }} <i class="fas fa-heart"> {{ $post->favorite_count }}</i></div>
                    <div class="col-sm-2 col-12 my-auto mx-autod-flex"><a href="{{ route('seeOne',$post->id )}}" class="btn btn-primary">Ver</a></div>
                </div>
                </div>
            </div>
        </div>
        @endforeach  
    </div>
    <div class="col-sm-1 d-none d-sm-inline-flex" >
        <div id="div-totop" class="cmn-divfloat">
            <a href="{{route('create.post')}}" class="btn btn-primary cmn-btncircle">
                <span style="font-size: 1.5em;">
                <i class="fas fa-plus-circle"></i>
                </span>
            </a>
        </div>
    </div>
    <div class="col-12 d-sm-none text-center position-fixed fixed-bottom mb-2">
        <a href="{{route('create.post')}}" class="btn btn-primary cmn-btncircle">
            <span style="font-size: 1.5em;">
                <i class="fas fa-plus-circle"></i>
            </span>
        </a>
    </div>
    <div class="col-12 ">{{$posts->links() }}</div>
</div>

@endsection
    