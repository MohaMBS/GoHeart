@extends('layouts.master')
@section('title', '- '.$event->title)
@section('content')
@if($ownevent)
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
<div class="col-12 offset-sm-1 my-1 col-sm-10 offset-sm-1 mt-3 ">
    <div class="row ">
        <div class="col-12 col-lg-8 bg-white border rounded p-4">
            <div class="col-12 mt-2">
                <h2 class="col-12">{!! $event->title !!}</h2>
                <small class="mx-auto"> Creada por: <b>{!! $event->user_name !!}</b> </small>
                <small class="mx-3">
                    Fecha de inicio:{{ explode(" - ",$event->dates)[0]}}  Fecha de fin:{{ explode(" - ",$event->dates)[0]}}
                </small>
                <hr/>
            </div>
            <div class="col-12">
                {!! $event->body !!}
            </div>
        </div>
        <div class="col-12 col-lg-4 my-1">
            <div id="mapid" class="mapView"></div>
        </div>
        <div class="col-12"></div>
    </div>
    <div class="mt-3 bg-white p-3 col-12 offset-lg-2 col-lg-8 offset-lg-2  rounded">
        <h3 class="col-12">¿Te gusta el evento? Pues no dudes en crear un evento tu mismo, se original y atrevete a crear tu propio evento!</h3> </br>
        <a class="col-12 btn btn-primary" href="{{ route('create-event') }}"> <h3>Haz click aqui!</h3></a>
    </div>
    <div class="col-12 bg-white rounded pb-3">
        <div class="mt-5">
            <h2 class="px-3 pt-3">Comentarios:</h2>
            <hr/>
            <div class="d-flex justify-content-center row">
                <div class="col-12">
                    <div class="d-flex flex-column comment-section" >
                        <div id="secciton-comment">
                            @if( count($event->comment) > 0)
                                @foreach ( $event->comment as $comment)
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
                                                <span class="d-block font-weight-bold name">{{$comment->user_name}} @auth @if(Auth::user()->id == $comment->user_id)<a class="comment-button-delete btn btn-danger" href="" id="{{$comment->id}}"><i class="far fa-trash-alt"> Eliminar.</i></a>@endif @endauth</span><span class="date text-black-50">{{explode(' ',$event->created_at)[0]}}</span>
                                            </div>
                                            </div>
                                                <div class="mt-2">
                                                    <p class="comment-text">{{$comment->comment}} </br></p>
                                            </div>
                                            @if($ownevent && $comment->user_id != Auth::id())
                                                <div>
                                                    <a href="" class="badge badge-warning" own-comment="{{$comment->user_name}}" data-href="{{$comment->id}}" data-toggle="modal" data-target="#confirm-delete">Borrar este comentario.</a><br>
                                                </div>
                                            @endif      
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
                    <input type="text" name="post" id="eventKey" value="{{ $event->id }}" hidden>
                    @csrf
                    </form>
                @endauth
            </div>
        </div>
    </div>
</div>
<link rel="stylesheet" href="https://unpkg.com/leaflet@1.7.1/dist/leaflet.css"
integrity="sha512-xodZBNTC5n17Xt2atTPuE1HxjVMSvLVW9ocqUKLsCC5CXdbqCmblAshOMAS6/keqq/sMZMZ19scR4PsZChSR7A=="
crossorigin=""/>
<script src="https://unpkg.com/leaflet@1.7.1/dist/leaflet.js"
integrity="sha512-XQoYMqMTK8LvdxXYG3nZ448hOEQiglfqkJs1NOQV44cWnUrBc8PkAOcXy20w0vlaXaVUearIOBhiXZ5V3ynxwA=="
crossorigin="" ></script>
<link rel="stylesheet" href="https://unpkg.com/leaflet-control-geocoder/dist/Control.Geocoder.css" />
<script src="https://unpkg.com/leaflet-control-geocoder/dist/Control.Geocoder.js" ></script>
<script src="https://labs.easyblog.it/maps/leaflet-search/dist/leaflet-search.src.js" ></script>
<script>
    $(document).ready(()=>{ 
        var mmymarker=null;
        var map = L.map('mapid')
        var popup = L.popup();
        var direcion
        map.setView([{{ explode(' ',$event->cords)[0]}},{{ explode(' ',$event->cords)[1]}}], 12);
        L.tileLayer('https://{s}.tile.osm.org/{z}/{x}/{y}.png', {
        attribution: '&copy; <a href="https://osm.org/copyright">OpenStreetMap</a> contributors'
        }).addTo(map);
        $.get("https://nominatim.openstreetmap.org/reverse?format=json&addressdetails=1&accept-language=es&zoom=18&lat={{ explode(' ',$event->cords)[0]}}&lon={{ explode(' ',$event->cords)[1]}}",(data)=>{
            //https://api.bigdatacloud.net/data/reverse-geocode-client?latitude={{ explode(' ',$event->cords)[0]}}&longitude={{ explode(' ',$event->cords)[1]}}&localityLanguage=es
            console.log(data)
            var popup = L.popup()
            .setLatLng([{{ explode(' ',$event->cords)[0]}},{{ explode(' ',$event->cords)[1]}}])
            .setContent('<p>'+data.display_name+'.</p>')
            .openOn(map);
            L.marker([{{ explode(' ',$event->cords)[0]}},{{ explode(' ',$event->cords)[1]}}]).addTo(map)
            
        })
    })
</script>

@auth
    <script>
        function deleteMsg(){
            console.log("cargado")
            $(".comment-button-delete").click(function(e){
                e.preventDefault()
                console.log("delete")
                let id=$(this).attr("id");
                $.post('{{ route("delet-comment-event",$event->id) }}',{'_token':'{{ csrf_token() }}','id':id},function(data){
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
    
        deleteMsg()
        $("#send").click(()=>{
            $.post("{{ route('comment-event',$event->id) }}",{"_token":"{{ csrf_token() }}","comment":$("#comment-area").val()},function(data , status){
                let comment = $.parseJSON(data)
                console.log(comment)
                $("#secciton-comment").append(comment.comment)
                $("#comment-area").val("")
                deleteMsg()
            })
        })
        $("#cancel-send").click(()=>{
            console.log("click")
            $("#comment-area").val("");
        })
    </script>
@endauth
@if($ownevent)
    <script>
        $(document).ready(()=>{
            $('#confirm-delete').on('show.bs.modal', function(e) {
                $(this).find('.btn-ok').attr('href', $(e.relatedTarget).data('href'));
                $('.debug-url').html('Borrar comentario de: <strong>' + $(e.relatedTarget).attr('own-comment') + '</strong>');
            });
            $("#deletComment").click((e)=>{
                e.preventDefault();
                let idcomment=$("#deletComment").attr('href')
                //var url= "{{ route('delete.comment',['id'=>":id",'cid'=>":cid"]) }}"
                //url = url.replace(':id', $("#postKey").val());
                //url = url.replace(':cid', $("#deletComment").attr('href'));
                let data = {
                    "_token":"{{ csrf_token() }}",
                    "id_comment_to_delete":$("#deletComment").attr('href')
                }
                $.post("{{ route('delet-not-my-comment-event',$event->id) }}",data,function(data,stat){
                    $("#comment-id-"+idcomment).remove();
                    $("#notification-delete").trigger("click")
                })
            })
        })
        
    </script>
@endif
@endsection