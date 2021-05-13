@extends('layouts.master')
@section('title', '- Editando ')
@section('content')
<link rel="stylesheet" href="https://unpkg.com/leaflet@1.7.1/dist/leaflet.css" integrity="sha512-xodZBNTC5n17Xt2atTPuE1HxjVMSvLVW9ocqUKLsCC5CXdbqCmblAshOMAS6/keqq/sMZMZ19scR4PsZChSR7A==" crossorigin=""/>
<div class="col-12">
    <form action="{{ route ('update-event', $event->id) }}" method="POST">
    <div class="row col-12">
        @csrf
        <div class="form-group col-lg-6 col-12">
            <label for="title"> <h2> Nombre del evento: </h2></label> 
            <input id="titulo" type="text" class="form-control" name="title" id="title" maxlength="150" placeholder="El titelo de tener un maximo de 150 caracteres" value="{{ $event->title }}" required>
        </div>

        <div class="form-group col-lg-6 col-12">
            <label class="col-12" for="category"> <h2> Fechas: </h2></label>
            <input class="col-12" type="text" name="daterange" value="{{$event->dates}}" />
        </div>
        <div class="col-lg-8">
          <textarea name="body" class="form-control my-editor"> {!! $event->body !!}</textarea>
        </div>
        <div class="col-lg-4">
            <div id="mapid" style=" height: 485px;"></div>
        </div>
        <div class="form-group col-12 col-md-10 mt-4 ">
            <div class="col-12">
                <h3 class="">Imagen destacada. <small>(Opcional)</small></h3>
            </div>
            <div class="input-group col-12 ">
                <span class="input-group-btn">
                <a id="lfm" data-input="front_page" data-preview="holder" class="btn btn-primary text-white">
                    <i class="fa fa-picture-o"></i> Seleccionar
                </a>
                </span>
                @if($event->front_page)
                <input id="front_page" class="form-control " type="text" name="filepath">
                @else
                <input id="front_page" class="form-control " type="text" name="filepath">
                @endif
            </div>
        </div>
        <div class="col-12 col-md-2 mt-sm-5 mt-2 text-center align-middle">
            <a class="btn btn-danger" href="{{ route('my-events') }}"> Cancelar</a>
            <input type="submit" id="send" class="btn btn-primary" value="Guardar">
            <input type="text" name="cords" id="cords" value="{{$event->cords}}" hidden>
            </form>
        </div>
    </div>    
</div>
<!-- PARA LA SELECION DE FEHCAS -->
<script type="text/javascript" src="https://cdn.jsdelivr.net/jquery/latest/jquery.min.js" defer></script>
<script type="text/javascript" src="https://cdn.jsdelivr.net/momentjs/latest/moment.min.js" defer></script>
<script type="text/javascript" src="https://cdn.jsdelivr.net/npm/daterangepicker/daterangepicker.min.js" defer></script>
<link rel="stylesheet" type="text/css" href="https://cdn.jsdelivr.net/npm/daterangepicker/daterangepicker.css" />
<script>
    $(document).ready(()=>{
        var f = new Date();
        var d = f.getDate();
        var m = f.getMonth() + 1;
        var a = f.getFullYear();
        const fecha =d+"/"+m+"/"+a;
        $('input[name="daterange"]').daterangepicker({
            "showDropdowns": true,
            "timePicker": true,
            "timePicker24Hour": true,
            "locale": {
                "format": "DD/MM/YYYY",
                "separator": " - ",
                "applyLabel": "Guardar",
                "cancelLabel": "Cancelar",
                "fromLabel": "Des de",
                "toLabel": "A",
                "customRangeLabel": "Custom",
                "weekLabel": "W",
                "daysOfWeek": [
                    "D",
                    "L",
                    "M",
                    "X",
                    "J",
                    "V",
                    "S"
                ],
                "monthNames": [
                    "Enero",
                    "Febrero",
                    "Marzo",
                    "Abril",
                    "Mayo",
                    "Junio",
                    "Julio",
                    "Agosto",
                    "Setiembre",
                    "Octubre",
                    "Noviembre",
                    "Diciembre"
                ],
                "firstDay": 1
            },
            "linkedCalendars": false,
            "showCustomRangeLabel": false,
            "startDate": fecha,
            "endDate":  fecha
        });
    })

</script>

<script>
    $(document).ready(()=>{
        var editor_config = {
        selector: 'textarea.my-editor',
        height : $( window ).height()*0.5,
        plugins: [
            "advlist autolink lists link image charmap print preview hr anchor pagebreak",
            "searchreplace wordcount visualblocks visualchars code fullscreen",
            "insertdatetime media nonbreaking save table directionality",
            "emoticons template paste textpattern"
        ],
        block_unsupported_drop: true,
        toolbar: "insertfile undo redo | styleselect | bold italic | alignleft aligncenter alignright alignjustify | bullist numlist outdent indent ",
        };
        tinymce.init(editor_config);
    })
</script>

<!-- PARA EL MAPA -->

<script src="https://unpkg.com/leaflet@1.7.1/dist/leaflet.js"
integrity="sha512-XQoYMqMTK8LvdxXYG3nZ448hOEQiglfqkJs1NOQV44cWnUrBc8PkAOcXy20w0vlaXaVUearIOBhiXZ5V3ynxwA=="
crossorigin="" ></script>
<link rel="stylesheet" href="https://unpkg.com/leaflet-control-geocoder/dist/Control.Geocoder.css" />
<script src="https://unpkg.com/leaflet-control-geocoder/dist/Control.Geocoder.js"></script>
<script src="https://labs.easyblog.it/maps/leaflet-search/dist/leaflet-search.src.js"></script>
<script>
    $(document).ready(()=>{ 
        var mmymarker=null;
        var map = L.map('mapid')
        var popup = L.popup();
    /*************************************************/
        navigator.geolocation.getCurrentPosition( success, error );
        function success(position) {
            console.log(position.coords)
            map.setView([position.coords.latitude,position.coords.longitude], 13);
        };
        function error(error) {
            map.setView([41.3775087,2.1703097], 12);
        };
    /***********************************************/
        L.tileLayer('https://{s}.tile.osm.org/{z}/{x}/{y}.png', {
        attribution: '&copy; <a href="https://osm.org/copyright">OpenStreetMap</a> contributors'
        }).addTo(map);
        L.Control.geocoder().on('markgeocode', function(e) {
            console.log(e)
            console.log($("input#cords").attr('value', e.geocode.center.lat + " " + e.geocode.center.lng))
            if(mmymarker != null){
                mmymarker.remove()  
            }
        }).addTo(map);
        $.get("https://nominatim.openstreetmap.org/reverse?format=json&addressdetails=1&accept-language=es&zoom=18&lat={{ explode(' ',$event->cords)[0]}}&lon={{ explode(' ',$event->cords)[1]}}",(data)=>{
            //https://api.bigdatacloud.net/data/reverse-geocode-client?latitude={{ explode(' ',$event->cords)[0]}}&longitude={{ explode(' ',$event->cords)[1]}}&localityLanguage=es
            console.log(data)
            var popup = L.popup()
            .setLatLng([{{ explode(' ',$event->cords)[0]}},{{ explode(' ',$event->cords)[1]}}])
            .setContent('<p><b>Direccion actual: </b>'+data.display_name+'.</p>')
            .openOn(map);
            L.marker([{{ explode(' ',$event->cords)[0]}},{{ explode(' ',$event->cords)[1]}}]).addTo(map)
            
        })
    })
</script>
@endsection