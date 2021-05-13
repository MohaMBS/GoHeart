@extends('layouts.master')
@section('title', '- My events.')
@section('content')

<main>
    @if(count($events) < 0)
    
    @else
    <div class="col-12">
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
