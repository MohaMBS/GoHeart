@extends('layouts.master')
@section('title', '- My events.')
@section('content')

<main>
    <div class="offset-lg-2 col-lg-8 offset-lg-2 row">
        <div class="col-12 text-center">
            <h2>Tus eventos:</h2>
        </div>
    @if(count($events) > 0)
        @foreach($events as $event)
        <div class=" col-12 col-sm-6 col-lg-4 mb-3">
            <div class="card h-100">
                @if($event->front_page)
                <img src="https://encrypted-tbn0.gstatic.com/images?q=tbn:ANd9GcTZMhLk5Dbdg5O5XX2iHiBofMmCV7p4fFwIiw&usqp=CAU" class="card-img-top" alt="...">
                @else
                <img src="https://images-wixmp-ed30a86b8c4ca887773594c2.wixmp.com/f/5df04f25-7dfe-4a9b-8ffa-61d0894e9070/d9gpfys-41381adf-0a3a-429c-9d59-c996f8a9f5ab.jpg?token=eyJ0eXAiOiJKV1QiLCJhbGciOiJIUzI1NiJ9.eyJzdWIiOiJ1cm46YXBwOjdlMGQxODg5ODIyNjQzNzNhNWYwZDQxNWVhMGQyNmUwIiwiaXNzIjoidXJuOmFwcDo3ZTBkMTg4OTgyMjY0MzczYTVmMGQ0MTVlYTBkMjZlMCIsIm9iaiI6W1t7InBhdGgiOiJcL2ZcLzVkZjA0ZjI1LTdkZmUtNGE5Yi04ZmZhLTYxZDA4OTRlOTA3MFwvZDlncGZ5cy00MTM4MWFkZi0wYTNhLTQyOWMtOWQ1OS1jOTk2ZjhhOWY1YWIuanBnIn1dXSwiYXVkIjpbInVybjpzZXJ2aWNlOmZpbGUuZG93bmxvYWQiXX0.CjV-Pwf2Eztd4JxAD27ErOmx-fss1XxagI9Ylf_sEuE" class="card-img-top" alt="...">
                @endif
                <div class="card-body mb-auto">
                    <h5 class="card-title">{{$event->title}}</h5>
                    <p class="card-text">{!! \Illuminate\Support\Str::limit(strip_tags($event->body), $limit = 150, $end = '...') !!}</p>
                </div>
                <div class="card-body text-center">
                    <p class="col-12 card-text text-center"><a class="btn btn-primary" href="{{ route('see-event',$event->id) }}">Ver</a></p>
                    <a class="btn btn-light" href="{{ route('edit-evnet',$event->id) }}"><i class="far fa-edit">Editar</i></a>
                    <a class="btn btn-danger" href="{{ route('delete-event',$event->id) }}"><i class="far fa-trash-alt"> Eliminar</i></a> 
                    <p class="col-12 card-text text-center"><small class="text-muted">{{ $event->updated_at }} <br> por <b>{{ $event->user->name}}</b></small></p>
                </div>
            </div> 
        </div>
        @endforeach
    </div>  
    @else
    <div class="col-12" style="margin-top:5rem;margin-bottom:10rem;">
        <div class="col-12 text-center bg-white border rounded p-3 ">
            <h1> No tienes ningun evento creado, si quieres puedes crear tus propios eventos haciendo click al siguiente boton <br> 
            <a class="btn btn-primary" href="{{ route('create-event') }}">Crear evento.</a></h1>
        </div>
    </div>
    @endif
    <div>
        
    </div>
</main>

@endsection
