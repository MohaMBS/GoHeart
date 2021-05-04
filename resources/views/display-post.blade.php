@extends('layouts/master')
@section('title', '- '.$post[0]->title)
@section('content')
    <div>
        <h1>{!! $post[0]->title !!}</h1>
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
