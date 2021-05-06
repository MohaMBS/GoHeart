@extends('layouts/master')

@section('content')
<div class="row">
    <div class="col-12 col-sm-11">
      @foreach ($posts as $post)
        <div class="offset-sm-2 col-sm-9 offset-sm-1 col-12">
            <div class="card mb-3  ">
                <img class="rounded " height="180" src="https://images.ctfassets.net/hrltx12pl8hq/4plHDVeTkWuFMihxQnzBSb/aea2f06d675c3d710d095306e377382f/shutterstock_554314555_copy.jpg" alt="Card image cap">
                <div class="card-body">
                <h3 class="card-title font-weight-bold">{{$post->title}}</h3>
                <hr class="myhr">
                <p class="card-text">{!! strip_tags($post->body) !!}</p>
                <div class="row">
                    <div class="col-sm-5 col-6 my-auto mx-auto"><p class="card-text"><img src="https://img2.freepng.es/20180616/sxr/kisspng-avatar-computer-icons-avatar-icon-5b254abb7cf344.7556131215291706195118.jpg" alt="Profile picture" class="avatar"><small class="text-muted">
                        {{ $post->creator_name }}
                    </small></p></div>
                    <div class="col-sm-5 col-6 my-auto mx-auto"> <i class="far fa-thumbs-up"></i> 66  <i class="fas fa-comments"></i> 2 <i class="far fa-heart"> 23</i></div>
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
                <i class="fas fa-plus-circle"></i>
            </a>
        </div>
    </div>
    <div class="col-12 d-sm-none text-center position-fixed fixed-bottom mb-2">
        <a href="{{route('create.post')}}" class="btn btn-primary cmn-btncircle">
            <i class="fas fa-plus-circle"></i>
        </a>
    </div>
</div>

@endsection
<!--
    <div class="row offset-1 col-10 my-2 offset-1">
    <div class="col-sm-4 col-12 ">
        <img src="https://images.ctfassets.net/hrltx12pl8hq/4plHDVeTkWuFMihxQnzBSb/aea2f06d675c3d710d095306e377382f/shutterstock_554314555_copy.jpg"class="mx-auto img-fluid" alt="Picture of post." >
    </div>
    <div class="row col-md-8 col-12">
        <div class="col-md-10">
            <div class="col-12"> <h3>{{$post->title}}</h3> </div>
            <div class="col-12">{!! strip_tags($post->body) !!} </div>
            <div class="col-12 my-4"><p><img src="https://img2.freepng.es/20180616/sxr/kisspng-avatar-computer-icons-avatar-icon-5b254abb7cf344.7556131215291706195118.jpg" alt="Profile picture" class="avatar"><small> Mohamed Boughima</small> 25/05/2021</p></div>
        </div>
        <div class="col-sm-2 row">                  
        </div>
    </div>
</div>
-->