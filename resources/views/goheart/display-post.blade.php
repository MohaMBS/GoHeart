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
                <button type="button" class="btn btn-default" data-dismiss="modal" id="notification-delete">Cancelar</button>
                <a id="deletComment"class="btn btn-danger btn-ok">Borar</a>
            </div>
        </div>
    </div>
</div>   
@endif
<main role="main" class="offset-sm-1 col-sm-10 offset-sm-1">
    <div class="">
        @auth
            @if(Auth::user()->is_admin)
                <div class="col-12 bg-dark rounded text-center">
                    <a class="btn border-bottom" style="color: rgb(255, 255, 0)" href="{{ route('admin.delete-post',$post[0]->id) }}" data-toggle="tooltip" data-placement="right" title="Como admin puedes borrar esta entrada"><i class="fas fa-trash-alt"> Borrar esta entrada como admin.</i></a>
                    <a class="btn" style="color: rgb(255, 255, 0)" href="{{ route('admin.disable-post',$post[0]->id) }}" data-toggle="tooltip" data-placement="right" title="Como admin puedes borrar esta entrada"><i class="fas fa-power-off"> Dehabilitar entrada.</i></a>
                </div>
            @endif
        @endauth
        <div class="col-12 blog-main bg-white rounded">
            <div class="blog-post col-12 p-sm-4">
                <div class="">
                    <h2 class="blog-post-title">{!! $post[0]->title !!}</h2>
                    <p class="blog-post-meta">Creado por <span class="font-weight-bold">{!! $post[0]->creator_name !!}</span>, {!! explode(' ',$post[0]->created_at)[0] !!} </p>
                </div>
                <div class="row">
                    <div class="col-sm-11 col-12 body-post-fixed">
                        {!! $post[0]->body !!}
                    </div>
                    <div class="text-center col-lg-1 col-12 ">
                        <span style="font-size:1.5rem" class="pb-auto d-flex d-lg-inline text-center">
                            @if(!$ownpost)
                            <a id="report" href="#" class="reaciton-post" data-toggle="tooltip" data-placement="right" title="Reportar este post."> <i  class="fas fa-exclamation col"></i></a>
                            @endif
                            @if($post[0]->favorite_count)
                                <a id="faovrite" href="#" class="reaciton-post" data-toggle="tooltip" data-placement="right" title="Me gusta."> <i style="color: red" class="fas fa-heart col"></i> </a> 
                            @else
                                <a id="faovrite" href="#" class="reaciton-post" data-toggle="tooltip" data-placement="right" title="Me gusta."> <i class="fas fa-heart col"></i> </a> 
                            @endif
                            @if($post[0]->save_post_count)
                                <a id="save" href="#" class="reaciton-post" data-toggle="tooltip" data-placement="right" title="Guardar para más tarde."> <i class="fas fa-bookmark col"></i> </a>
                            @else
                                <a id="save" href="#" class="reaciton-post" data-toggle="tooltip" data-placement="right" title="Guardar para más tarde."> <i class="far fa-bookmark col"></i> </a>
                            @endif
                            
                        </span>
                    </div>
                </div>
            </div>
        </div>
        <div class="col-12 bg-white rounded pb-3">
            <div class="mt-5">
                <h2 class="px-3 pt-3">Comentarios:</h2>
                <hr/>
                <div class="d-flex justify-content-center row">
                    <div class="col-12">
                        <div class="d-flex flex-column comment-section" >
                            <div id="secciton-comment">
                                @if( count($post[0]->comments) > 0)
                                    @foreach ( $post[0]->comments as $comment)
                                        <div id="comment-id-{{$comment->id}}" class="p-2 mb-1 bg-commnets rounded border border-light">
                                            <div class="d-flex flex-row user-info">
                                                @if( $comment->user->url_avatar )
                                                    <img class="rounded-circle" src="{{ $comment->user->url_avatar }}" width="65">
                                                @else
                                                    <span style="font-size: 50px">
                                                        <i class="fas fa-user-circle"></i>
                                                    </span>
                                                @endif
                                                <div class="d-flex flex-column justify-content-start ml-2">
                                                    <span class="d-block font-weight-bold name">{{$comment->name}} @auth @if(Auth::user()->id == $comment->user_id)<a class="comment-button-delete btn btn-danger" href="" id="{{$comment->id}}"><i class="far fa-trash-alt"> Eliminar.</i></a>@endif @endauth</span><span class="date text-black-50">{{explode(' ',$post[0]->created_at)[0]}}</span>
                                                </div>
                                                </div>
                                                    <div class="mt-2">
                                                        <p class="comment-text">{{$comment->comment}} </br></p>
                                                </div>
                                                @if($ownpost && $comment->user_id != Auth::id())
                                                    <div>
                                                        <a href="" class="badge badge-warning" own-comment="{{$comment->name}}" data-href="{{$comment->id}}" data-toggle="modal" data-target="#confirm-delete">Borrar este comentario.</a><br>
                                                    </div>
                                                @endif 
                                                @auth
                                                    @if(Auth::user()->is_admin)
                                                        <a id="{{$comment->id}}" spy="admin-delete-comment" class="btn btn-danger" href=""><i class="fas fa-comment-slash">Borrar este mensaje como admin.</i></a>
                                                    @endif
                                                @endauth     
                                        </div>
                                    @endforeach
                                @endif
                            </div>
                            @auth    
                            <form  method="POST">
                            <div class="bg-light p-2">
                                <div class="d-flex flex-row align-items-start">
                                    @if(auth()->user()->url_avatar)
                                        <img class="rounded-circle" src="{{auth()->user()->url_avatar   }}" width="40">
                                    @else
                                        <span style="font-size: 40px">
                                            <i class="fas fa-user-circle"></i>
                                        </span>
                                    @endif
                                    <textarea name="comment" id="comment-area" class="form-control ml-1 shadow-none textarea" placeholder="Escribe aquú su mensaje..."></textarea>
                                </div>
                                <div class="mt-2 text-right"><button class="btn btn-primary btn-sm shadow-none" id="send" type="button">Comentar</button><button id="cancel-send" class="btn btn-outline-primary btn-sm ml-1 shadow-none" type="button">Cancelar</button></div>
                            </div>
                            @endauth
                            @guest
                            <div class="bg-light p-2 mt-2">
                                <div class="d-flex flex-row align-items-start">
                                        <span style="font-size: 40px">
                                            <i class="fas fa-user-circle"></i>
                                        </span>
                                    <textarea name="comment" id="comment-area" class="form-control ml-1 shadow-none textarea" placeholder="Para poder comentar, proceda a autenticarse..." disabled></textarea>
                                </div>
                                <div class="mt-2 text-right"><button class="btn btn-primary btn-sm shadow-none" id="send" type="button" disabled>Comentar</button><button id="cancel-send" class="btn btn-outline-primary btn-sm ml-1 shadow-none" type="button" disabled>Cancelar</button></div>
                            </div>
                            @endguest
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
    @if(Auth::user()->is_admin)
        <script>
            $(document).ready(()=>{
                $('[spy="admin-delete-comment"]').click(function(e){
                    e.preventDefault();
                    $route="{{ route('admin.delete-comment-post',':id')}}"
                    $id=$(this).attr('id')
                    $parent=$(this).parent()
                    $url=$route.replace(":id", $id);
                    $.post($url,{'_token':"{{ csrf_token() }}"},(data,status)=>{
                        if(data){
                            $($parent).remove()
                        }
                    })
                })
            })
            
        </script>
    @endif
@endauth 

@guest
<div id="Modal" class="modal" tabindex="-1" role="dialog">
    <div class="modal-dialog" role="document">
      <div class="modal-content">
        <div class="modal-header">
          <h5 class="modal-title">OPS!</h5>
          <button type="button" class="close" data-dismiss="modal" aria-label="Close">
            <span aria-hidden="true">&times;</span>
          </button>
        </div>
        <div class="modal-body">
          <p>Para poder reaccionar a esta entrada debe estar autenticado. Por favor proceda a autenticarse o registrarse.</p>
        </div>
        <div class="modal-footer">
            <button type="button" class="btn btn-secondary" data-dismiss="modal">Cerrar.</button>
            <a href="{{ route('register') }}" class="btn btn-primary">Registrarse.</a>
            <a href="{{ route('login') }}" class="btn btn-primary">Iiniciar session.</a>
        </div>
      </div>
    </div>
  </div>
  
    <script>
        $(document).ready(()=>{
            $("#report").click(function(e){
                $('#Modal').fadeIn("1500").modal('show');
                e.preventDefault()
            })
            $("#faovrite").click((e)=>{
                $('#Modal').fadeIn("1500").modal('show');
                e.preventDefault()
            })
            $("#save").click((e)=>{
                $('#Modal').fadeIn("1500").modal('show');
                e.preventDefault()
            })
        })
    </script>
@endguest
@auth
    <script>    
        $(document).ready(function(){

            function deleteMsg(){
                console.log("cargado")
                $(".comment-button-delete").click(function(e){
                    e.preventDefault()
                    let id=$(this).attr("id");
                    $.post('{{ route("delete.my.comment",$post[0]->id) }}',{'_token':'{{ csrf_token() }}','id':id},function(data){
                        console.log("Vamos bien.")
                        console.log(data)
                        if(data == true){
                            console.log(id)
                            $("#comment-id-"+id).remove()
                        }
                    })
                    return false;
                })
            }

            $("#send").click((event)=>{
                event.preventDefault()
                console.log($("#comment-area").val())
                let data = {'_token':"{{ csrf_token() }}","token_post":"{{ $post[0]->security_token }}","comment":$("#comment-area").val()}
                $.post("{{ route('makeComment' )}}",data,function(data,status) {
                    let comment = $.parseJSON(data)
                    console.log(comment)
                    $("#secciton-comment").append(comment.comment)
                    $("#comment-area").val("")
                    deleteMsg()
                });
            });
            $("#cancel-send").click(()=>{
                $("#comment-area").val("")
            })

            deleteMsg()

            $("#report").click(function(e){
                console.log("Reportando...")
                $.post("{{ route('report.post',$post_id) }}",{"_token":"{{ csrf_token()}}"},(data,status)=>{
                    console.log(data)
                })
                e.preventDefault()
            })
            $("#faovrite").click((e)=>{
                const evento = $("#faovrite")
                console.log("Favorito")
                $.post("{{ route('favorite.post',$post_id) }}",{"_token":"{{ csrf_token()}}"},(data,status)=>{
                    console.log(data+" "+status)
                    if(data){
                        if($(evento).children().first().attr("style")){
                            $(evento).children().first().removeAttr("style")
                        }else{
                            $(evento).css('color',"red")
                        }
                    }
                })
                e.preventDefault()
            })
            $("#save").click((e)=>{
                const evento = $("#save")
                console.log("Guardando")
                $.post("{{ route('save.post',$post_id) }}",{"_token":"{{ csrf_token()}}"},(data,status)=>{
                    console.log(data+" "+status)
                    if(data){
                        if($(evento).children().first().hasClass("far")){
                            $(evento).children().first().removeClass("far").addClass("fas")
                        }else{
                            $(evento).children().first().removeClass("fas").addClass("far")
                        }
                    }
                })
                e.preventDefault()
            })
        })
    </script>
@endauth

@if($ownpost)
    <script>
        $(document).ready(()=>{
            $('#confirm-delete').on('show.bs.modal', function(e) {
                $(this).find('.btn-ok').attr('href', $(e.relatedTarget).data('href'));
                $('.debug-url').html('Borrar comentario de: <strong>' + $(e.relatedTarget).attr('own-comment') + '</strong>');
            });
            $("#deletComment").click((e)=>{
                e.preventDefault();
                let idcomment=$("#deletComment").attr('href')
                var url= "{{ route('delete.comment',['id'=>":id",'cid'=>":cid"]) }}"
                url = url.replace(':id', $("#postKey").val());
                url = url.replace(':cid', $("#deletComment").attr('href'));
                console.log(url)
                let data = {
                    "_token":"{{ csrf_token() }}",
                    "token_post":"{{ $post[0]->security_token }}"
                }
                $.post(url,data,function(data,stat){
                    $("#comment-id-"+idcomment).remove();
                    $("#notification-delete").trigger("click")
                })
            })
        })
        
    </script>
@endif
@endsection
