@extends('layouts.master')
@section('title', '- Quienes somos?')
@section('content')

<section>
    <div class="container">
        <div class="col-12 text-center">
            <h1>¿Quienes somos?</h1>
        </div>
      <div class="row">
        <div class="col-12 d-flex align-items-stretch mb-5 mb-lg-4">
          <div class="col-12 bg-white p-3 rounded">
            <div class="text-center p-3">
                <i style="font-size: 5rem;" class="fas fa-phone"></i>
            </div>
            <h4 class="title"><a href="{{route('form-contact')}}">Contactanos</a></h4>
            <p>Tienes dudas sobre nuestra la web, ¿no sabes que como funcciona? Pues no dudes, disponemos de un servicio de atencion a la comunidad excelente. Solo debes rellenar el formulario de contacto 
                y un administrador se pondra en contacto contigo lo antes posible para poder ayudarte.
            </p>
          </div>
        </div>

        <div class="col-12 d-flex align-items-stretch mb-5 mb-lg-4">
          <div class="col-12 bg-white p-3 rounded">
            <div class="text-center p-3">
                <i style="font-size: 5rem" class="fas fa-bullseye"></i>
            </div>
            <h4 class="title"><a href="{{route('cookie')}}">Objetivos </a></h4>
            <p>Nuestros objetivos, es que como comuidad ayudar a todo aquell que lo necesite en su dia a dia. 
                Somos una comunidad bastante unida y con muchos usuario conectado a la vez, lo cuales te puede ayudar y guíar. 
                No dudes en crear una entrada si queires aprender
                 nuestro objetvio es que te cuides.</p>
          </div>
        </div>

        <div class="col-12 d-flex align-items-stretch mb-5 mb-lg-4">
          <div class="col-12 bg-white p-3 rounded">
            <div class="text-center p-3">
                <i style="font-size: 5rem;" class="fas fa-balance-scale"></i>
            </div>
            <h4 class="title"><a href="{{route('legal-warning')}}">Aviso legal</a></h4>
            <p>Te precupan tus datos personales, lee nuestro aviso legal y enterate de las leyes que te afectan. Nosotros somos una web qué vela por tu privacidad. Tu información no es compartida
                con terceros, puede eliminar todos aquellos datos que tengamos registrados en la web.
            </p>
            <p></p>
          </div>
        </div>

        <div class="col-12 d-flex align-items-stretch mb-5 mb-lg-4">
            <div class="col-12 bg-white p-3 rounded">
                <div class="text-center p-3">
                    <i style="font-size: 5rem;" class="fas fa-user-cog"></i>
                </div>
                <h4 class="title"><a href="{{route('update-profile')}}">Mi cuenta</a></h4>
                <p>Siempre intentamos brindar la mejor seguridad para ti, por ese tenemos un sistema de gestión de datos bastante robusto con el cual puede modificar tu cuenta o hasta eliminarla de forma permanente y recuerda que tus datos serán borrados de forma automática en nuestra base de datos.</p>
            </div>
        </div>
      </div>

    </div>
</section>
@endsection