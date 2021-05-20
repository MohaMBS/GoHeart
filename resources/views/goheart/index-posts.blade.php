@extends('layouts/master')
@section('title', '- Entradas.')
@section('content')
<div class="col-12 offset-sm-1 col-sm-10 offset-sm-1">
    <div class="input-group mb-3">
        <div class="input-group-prepend">
          <label class="input-group-text" for="inputGroupSelect01">Filtrar entradas por tipo</label>
        </div>
        <select id="filter-posts" class="custom-select" id="inputGroupSelect01">
            @if(Request::is('blog/posts/type-*'))
                <option value="0">Todos</option>
                <option 
                @if(explode('-',Request::segment(3))[1] == 1)
                    selected
                @endif 
                value="1">Tipo de ejercicos</option>
                <option 
                @if(explode('-',Request::segment(3))[1] == 2)
                    selected
                @endif
                value="2">Tipo de dieta</option>
                <option
                @if(explode('-',Request::segment(3))[1] == 3)
                    selected
                @endif
                value="3">Tipo de blog</option> 
            @else
                <option value="0" selected>Todos</option>
                <option value="1">Tipo de ejercicos</option>
                <option value="2">Tipo de dieta</option>
                <option value="3">Tipo de blog</option>
            @endif
        </select>
    </div>
</div>
<div class="row">
    <div class="col-12 offset-sm-1 col-sm-10  offset-sm-1">
        <div class="col-12">
            @auth
                @if(Auth::user()->is_admin)
                    @if(session()->has('operation'))
                        @if(session()->get('operation') )
                            <div class="alert alert-success">
                                Se han guardado los cambios.
                            </div>
                        @else
                            <div class="alert alert-danger">
                                Se han guardado los cambios.
                            </div>
                        @endif
                    @endif
                @endif
            @endauth
        </div>
    @if(count($posts)>0)
      @foreach ($posts as $post)
        <div class="offset-sm-1 col-sm-10 offset-sm-1 col-12">
            @if($post->front_page != null)
                <div class="col-12" style="height:180px;
                    margin-left: auto;
                    margin-right: auto;
                    padding: 25px;
                    background: url(/{{$post->front_page}}) no-repeat center;;
                    background-size: auto;"></div>
            @endif
            <div class="card mb-3  ">
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
    @else
        <div class="col-12 text-center p-5 bg-white my-5">
            <h1 class="my-5 p-2">No hay ninguna entrada creada en estos momentos </h1>
            <p>Puedes crear una entrada tu mismo haciendo click <a href="{{ route('create.post') }}">aquí</a>.</p>
        </div>
    @endif
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
<script>
    $(document).ready(()=>{
        $('#filter-posts').change(function(){
            if($(this).val() == "0"){
                window.location = "{{ route('posts') }}"
            }else{
                window.location = "{{ route('posts-filter',':type') }}".replace(':type','type-'+$(this).val()) 
            }
        })
    })
</script>
@endsection
    