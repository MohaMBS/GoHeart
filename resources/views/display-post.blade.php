@extends('layouts/master')
@section('title', '- '.$post[0]->title)
@section('content')
    <div>
        <h1></h1>
        {{ strip_tags($post[0]->body) }}
        {!! $post[0]->body !!}
    </div>
    <div>
        @if( count($post[0]->comments) > 0)
            @foreach ( $post[0]->comments as $comment)
                {{$comment->name}}: {{$comment->comment}} </br>
            @endforeach
        @endif
    </div>
    @auth
    <form  method="POST">
    <input type="text" name="post" value="{{ $post[0]->id }}" hidden>
    <input type="text" name="token_post" id="token_post" value="{{ $post[0]->security_token }}" hidden>
    @csrf
    <textarea name="comment" id="comment" cols="30" rows="10" required></textarea><br>
    <input type="submit" id="send" value="Comentar">
    </form>
    @endauth

<main role="main" class="offset-sm-1 col-sm-10 offset-sm-1 ">
    <div class="">
        <div class="col-12 blog-main bg-white">
            <div class="blog-post col-12">
                <div class="col-12">
                    <h2 class="blog-post-title">{!! $post[0]->title !!}</h2>
                    <p class="blog-post-meta">Creado por <span class="font-weight-bold">{!! $post[0]->creator_name !!}</span>, {!! explode(' ',$post[0]->created_at)[0] !!} </p>
                </div>
                <div class="col-12">
                    {!! $post[0]->body !!}
                </div>
            </div>
        </div>
        <div class="col-12 bg-white">
            <div class="mt-5">
                <h2>Comentarios:</h2>
                <div class="d-flex justify-content-center row">
                    <div class="col-12">
                        <div class="d-flex flex-column comment-section">
                            <div class="p-2 bg-commnets">
                                <div class="d-flex flex-row user-info"><img class="rounded-circle" src="https://i.imgur.com/RpzrMR2.jpg" width="50">
                                    <div class="d-flex flex-column justify-content-start ml-2"><span class="d-block font-weight-bold name">Marry Andrews</span><span class="date text-black-50">Shared publicly - Jan 2020</span></div>
                                    </div>
                                        <div class="mt-2">
                                            <p class="comment-text">Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam, quis nostrud exercitation ullamco laboris nisi ut aliquip ex ea commodo consequat.</p>
                                    </div>
                            </div>
                            <div class="p-2 bg-commnets">
                                <div class="d-flex flex-row user-info"><img class="rounded-circle" src="https://i.imgur.com/RpzrMR2.jpg" width="50">
                                    <div class="d-flex flex-column justify-content-start ml-2"><span class="d-block font-weight-bold name">Marry Andrews</span><span class="date text-black-50">Shared publicly - Jan 2020</span></div>
                                    </div>
                                        <div class="mt-2">
                                            <p class="comment-text">Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam, quis nostrud exercitation ullamco laboris nisi ut aliquip ex ea commodo consequat.</p>
                                    </div>
                            </div>
                            <div class="p-2 bg-commnets">
                                <div class="d-flex flex-row user-info"><img class="rounded-circle" src="https://i.imgur.com/RpzrMR2.jpg" width="50">
                                    <div class="d-flex flex-column justify-content-start ml-2"><span class="d-block font-weight-bold name">Marry Andrews</span><span class="date text-black-50">Shared publicly - Jan 2020</span></div>
                                    </div>
                                        <div class="mt-2">
                                            <p class="comment-text">Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam, quis nostrud exercitation ullamco laboris nisi ut aliquip ex ea commodo consequat.</p>
                                    </div>
                            </div>
                            <div class="p-2 bg-commnets">
                                <div class="d-flex flex-row user-info"><img class="rounded-circle" src="https://i.imgur.com/RpzrMR2.jpg" width="50">
                                    <div class="d-flex flex-column justify-content-start ml-2"><span class="d-block font-weight-bold name">Marry Andrews</span><span class="date text-black-50">Shared publicly - Jan 2020</span></div>
                                    </div>
                                        <div class="mt-2">
                                            <p class="comment-text">Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam, quis nostrud exercitation ullamco laboris nisi ut aliquip ex ea commodo consequat.</p>
                                    </div>
                            </div>
                            <div class="p-2 bg-commnets">
                                <div class="d-flex flex-row user-info"><img class="rounded-circle" src="https://i.imgur.com/RpzrMR2.jpg" width="50">
                                    <div class="d-flex flex-column justify-content-start ml-2"><span class="d-block font-weight-bold name">Marry Andrews</span><span class="date text-black-50">Shared publicly - Jan 2020</span></div>
                                    </div>
                                        <div class="mt-2">
                                            <p class="comment-text">Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam, quis nostrud exercitation ullamco laboris nisi ut aliquip ex ea commodo consequat.</p>
                                    </div>
                            </div>
                                <!--
                                <div class="bg-white">
                                    <div class="d-flex flex-row fs-12">
                                        <div class="like p-2 cursor"><i class="fa fa-thumbs-o-up"></i><span class="ml-1">Like</span></div>
                                        <div class="like p-2 cursor"><i class="fa fa-commenting-o"></i><span class="ml-1">Comment</span></div>
                                        <div class="like p-2 cursor"><i class="fa fa-share"></i><span class="ml-1">Share</span></div>
                                    </div>
                                </div>
                                -->
                            <div class="bg-light p-2">
                                <div class="d-flex flex-row align-items-start"><img class="rounded-circle" src="https://i.imgur.com/RpzrMR2.jpg" width="40"><textarea class="form-control ml-1 shadow-none textarea"></textarea></div>
                                <div class="mt-2 text-right"><button class="btn btn-primary btn-sm shadow-none" type="button">Post comment</button><button class="btn btn-outline-primary btn-sm ml-1 shadow-none" type="button">Cancel</button></div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    
</main>

@auth
    <script>
    $(document).ready(function(){
        $("#send").click((event)=>{
            event.preventDefault()
            console.log($("#comment").val())
            let data = {'_token':"{{ csrf_token() }}","token_post":"{{ $post[0]->security_token }}","comment":$("#comment").val()}
            $.post("{{ route('makeComment' )}}",data,function(data,status) {
                console.log("Enviado d:"+data+" s:"+status)
            });
        });
    });
    </script>
@endauth

@endsection
