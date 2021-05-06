@extends('layouts/master')
@section('title', '- '.$post[0]->title)
@section('content')
@if($ownpost)
<div class="modal fade" id="confirm-delete" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
        
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
                <h4 class="modal-title" id="myModalLabel">Confirm Delete</h4>
            </div>
        
            <div class="modal-body">
                <p>Estas seguro de que quieres borrar este mensaje que no te pertenece?</p>
                <p>Esta accion irreversible.</p>
                <p class="debug-url"></p>
            </div>
            
            <div class="modal-footer">
                <button type="button" class="btn btn-default" data-dismiss="modal">Cancel</button>
                <a id="deletComment"class="btn btn-danger btn-ok">Delete</a>
            </div>
        </div>
    </div>
</div>   
@endif
<main role="main" class="offset-sm-1 col-sm-10 offset-sm-1">
    <div class="">
        <div class="col-12 blog-main bg-white rounded">
            <div class="blog-post col-12 p-sm-4">
                <div class="col-12">
                    <h2 class="blog-post-title">{!! $post[0]->title !!}</h2>
                    <p class="blog-post-meta">Creado por <span class="font-weight-bold">{!! $post[0]->creator_name !!}</span>, {!! explode(' ',$post[0]->created_at)[0] !!} </p>
                </div>
                <div class="col-12">
                    {!! $post[0]->body !!}
                </div>
            </div>
        </div>
        <div class="col-12 bg-white rounded">
            <div class="mt-5">
                <h2 class="px-3 pt-3">Comentarios:</h2>
                <hr/>
                <div class="d-flex justify-content-center row">
                    <div class="col-12">
                        <div class="d-flex flex-column comment-section" >
                            <div id="secciton-comment">
                                @if( count($post[0]->comments) > 0)
                                    @foreach ( $post[0]->comments as $comment)
                                        <div class="p-2 mb-1 bg-commnets rounded border border-light">
                                            <div class="d-flex flex-row user-info"><img class="rounded-circle" src="https://i.imgur.com/RpzrMR2.jpg" width="50">
                                                <div class="d-flex flex-column justify-content-start ml-2"><span class="d-block font-weight-bold name">{{$comment->name}}</span><span class="date text-black-50">{{explode(' ',$post[0]->created_at)[0]}}</span></div>
                                                </div>
                                                    <div class="mt-2">
                                                        <p class="comment-text">{{$comment->comment}} </br></p>
                                                </div>
                                                <div>
                                                    @if($ownpost && $comment->user_id != Auth::id())
                                                        <a href="" class="badge badge-warning" own-comment="{{$comment->name}}" data-href="{{$comment->id}}" data-toggle="modal" data-target="#confirm-delete">Borrar este comentario.</a><br>
                                                    @endif
                                                </div>
                                        </div>
                                    @endforeach
                                @endif
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
                            @auth    
                            <form  method="POST">
                            <div class="bg-light p-2">
                                <div class="d-flex flex-row align-items-start"><img class="rounded-circle" src="https://i.imgur.com/RpzrMR2.jpg" width="40"><textarea name="comment" id="comment-area" class="form-control ml-1 shadow-none textarea" placeholder="Escribe aquú su mensaje..."></textarea></div>
                                <div class="mt-2 text-right"><button class="btn btn-primary btn-sm shadow-none" id="send" type="button">Comentar</button><button id="cancel-send" class="btn btn-outline-primary btn-sm ml-1 shadow-none" type="button">Cancelar</button></div>
                            </div>
                            @endauth
                        </div>
                    </div>
                    @auth
                        <input type="text" name="post" id="postKey" value="{{ $post[0]->id }}" hidden>
                        <input type="text" name="token_post" id="token_post" value="{{ $post[0]->security_token }}" hidden>
                        @csrf
                        </form>
                    @endauth
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
            console.log($("#comment-area").val())
            let data = {'_token':"{{ csrf_token() }}","token_post":"{{ $post[0]->security_token }}","comment":$("#comment-area").val()}
            $.post("{{ route('makeComment' )}}",data,function(data,status) {
                let comment = $.parseJSON(data)
                console.log(comment)
                $("#secciton-comment").append(comment.comment)
                $("#comment-area").val("")
            });
        });
        $("#cancel-send").click(()=>{
            $("#comment-area").val("")
        })
    });
    </script>
@endauth

@if($ownpost)
<script>
    $('#confirm-delete').on('show.bs.modal', function(e) {

        $(this).find('.btn-ok').attr('href', $(e.relatedTarget).data('href'));
        $('.debug-url').html('Borrar comentario de: <strong>' + $(e.relatedTarget).attr('own-comment') + '</strong>');
    });
    $("#deletComment").click((e)=>{
        e.preventDefault();
        console.log($("#deletComment").attr('href'))
        var url= "{{ route('delete.comment',['id'=>":id",'cid'=>":cid"]) }}"
        url = url.replace(':id', $("#postKey").val());
        url = url.replace(':cid', $("#deletComment").attr('href'));
        console.log(url)
        let data = {
            "_token":"{{ csrf_token() }}",
            "token_post":"{{ $post[0]->security_token }}"
        }
        $.post(url,data,function(data,stat){
            console.log(data);
        })
    })
</script>
@endif
@endsection
