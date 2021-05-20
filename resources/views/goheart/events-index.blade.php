@extends('layouts.master')
@section('title', '- Eventos.')
@section('content')
<main class="offset-sm-1 col-sm-10 offset-sm-1 ">
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
<div class="row">
    @if(count($events)>0)
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
                <div class="card-body">
                    <p class="col-12 card-text text-center"><a class="btn btn-primary" href="{{ route('see-event',$event->id) }}">Ver</a></p>
                    <p class="col-12 card-text text-center"><small class="text-muted">{{ $event->updated_at }} por <b>{{ $event->user->name}}</b></small></p>
                </div>
            </div> 
        </div>
        @endforeach
    @else
        <div class="col-12 text-center p-5 bg-white my-5">
            <h1 class="my-5 p-2">No hay ningun evento activo en estos momentos </h1>
            <p>Puedes crear un evento tu mismo haciendo click <a href="{{ route('create-event') }}">aquí</a>.</p>
        </div>
    @endif
    <div class="col-12 text-center">
        <a href="{{ route('create-event') }}" data-toggle="tooltip" data-placement="top" title="Crear un nuevo evento." class="btn btn-primary rounded-circle"><i class="fas fa-plus-circle"></i></a>
    </div>
</div>
</main>
@endsection
<!-- 
    <div class="card">
        <img src="https://encrypted-tbn0.gstatic.com/images?q=tbn:ANd9GcTZMhLk5Dbdg5O5XX2iHiBofMmCV7p4fFwIiw&usqp=CAU" class="card-img-top" alt="...">
        <div class="card-body">
            <h5 class="card-title">Card title</h5>
            <p class="card-text">Lorem ipsum dolor sit amet, consectetur adipi elit. Nam eu sem tempor, varius quam at, luctus dui. Mauris magna metus.</p>
            <p class="card-text"><small class="text-muted">Last updated 3 mins ago</small> <a class="btn btn-primary" href="{{ route('see-event',1) }}">Ver</a></p>
        </div>
    </div>
    <div class="card">
        <blockquote class="blockquote mb-0 card-body">
            <p>Nam eget purus consectetur in vehicula. Nullamr ultrices nisl risus, viverra libero.</p>
            <footer class="blockquote-footer">
                <small class="text-muted">Someone famous</small>
            </footer>
        </blockquote>
    </div>
    <div class="card">
        <img src="https://i.ytimg.com/vi/MtY9J2frbsM/maxresdefault.jpg" class="card-img-top" alt="...">
        <div class="card-body">
            <h5 class="card-title">Card title</h5>
            <p class="card-text">Vestibulum id metus ac nisl bibendum scelerisque non dignissim purus.</p>
            <p class="card-text"><small class="text-muted">Last updated 2 mins ago</small></p>
        </div>
    </div>
    <div class="card bg-primary text-white text-center p-3">
        <blockquote class="blockquote mb-0">
            <p>Pulvinar leo risus vestibulum. Sed diam on sodales eget.</p>
            <footer class="blockquote-footer text-white">
                <small>Someone famous</small>
            </footer>
        </blockquote>
    </div>
    <div class="card text-center">
        <div class="card-body">
            <h5 class="card-title">Card title</h5>
            <p class="card-text">Enim arcu, interdum dignissim venenatis velc.</p>
            <p class="card-text"><small class="text-muted">Last updated 1 mins ago</small></p>
        </div>
    </div>
    <div class="card">
        <img src="https://mediarealm.com.au/wp-content/uploads/2018/06/Open-Street-Map-Markers.png" class="card-img-top" alt="...">
    </div>
    <div class="card p-3 text-right">
        <blockquote class="blockquote mb-0">
            <p>Quis quam ut magna consequat faucibus. Pellentesque eget nisi suscipit tincidunt. Pellentesque quam.</p>
            <footer class="blockquote-footer">
                <small class="text-muted">Someone famous</small>
            </footer>
        </blockquote>
    </div>
    <div class="card">
        <div class="card-body">
            <h5 class="card-title">Card title</h5>
            <p class="card-text">Convallis eget pretium, bibendum non leo. Proien suscipit purus adipiscing dolor gravida fermentum sapien blandit praest interdum vel metus.</p>
            <p class="card-text"><small class="text-muted">Last updated 3 mins ago</small></p>
        </div>
    </div>
-->