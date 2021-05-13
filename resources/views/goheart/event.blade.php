@extends('layouts.master')
@section('title', '- '.$event->title)
@section('content')
<div class="col-12 mt-3 ">
    <main class="row offset-sm-1 col-sm-10 offset-sm-1">
        <div class="col-12 col-lg-8 bg-white border rounded p-4">
            <div class="col-12 mt-2">
                <h2 class="col-12">{!! $event->title !!}</h2>
                <small class="mx-auto"> Creada por: <b>{!! $event->name_user !!}</b> </small>
                <small class="mx-3">
                    Fecha de inicio:{{ explode(" - ",$event->dates)[0]}}  Fecha de fin:{{ explode(" - ",$event->dates)[0]}}
                </small>
                <hr/>
            </div>
            <div class="col-12">
                {!! $event->body !!}
            </div>
        </div>
        <div class="col-12 col-lg-4 mt-3 mt-lg-auto">
            <div id="mapid" style="height: 485px;z-index:1;"></div>
        </div>
        <div class="col-12"></div>
    </main>
    <main class="p-3 my-5 row offset-sm-2 col-sm-8 offset-sm-2 bg-white border rounded text-center">
        <h3 class="col-12">¿Te gusta el evento? Pues no dudes en crear un evento tu mismo, se original y atrevete a crear tu propio evento!</h3> </br>
        <a class="col-12 btn btn-primary" href="{{ route('create-event') }}"> <h3>Haz click aqui!</h3></a>
    </main>
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
@endsection