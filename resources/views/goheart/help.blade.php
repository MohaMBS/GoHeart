@extends('layouts.master')
@section('title', '- Ayuda')
@section('content')
<section>
    <div class="container">
        <div class="col-12 text-center">
            <h1>Centro de ayuda</h1>
        </div>
      <div class="row">
        <div class="col-md-12 col-lg-6 d-flex align-items-stretch mb-5 mb-lg-4">
          <div class="bg-white p-3 rounded">
            <div class="text-center p-3">
                <i style="font-size: 5rem;" class="fas fa-phone"></i>
            </div>
            <h4 class="title"><a href="{{route('form-contact')}}">Contactanos</a></h4>
            <p>Tienes dudas sobre nuestra web, no dudes en darnos un toque y te ayudaremos.</p>
          </div>
        </div>

        <div class="col-md-12 col-lg-6 d-flex align-items-stretch mb-5 mb-lg-4">
          <div class="bg-white p-3 rounded">
            <div class="text-center p-3">
                <i style="font-size: 5rem;" class="fas fa-info-circle"></i>
                <i style="font-size: 5rem;" class="fas fa-cookie"></i>
            </div>
            <h4 class="title"><a href="{{route('cookie')}}">Cookies y</a> <a href="{{route('privacy')}}">Politica de privacidad</a></h4>
            <p>Aprende y lee sobre nuestra politica de privacidad y cookies tanto nuestars como de terceros.</p>
          </div>
        </div>

        <div class="col-md-12 col-lg-6 d-flex align-items-stretch mb-5 mb-lg-4">
          <div class="bg-white p-3 rounded">
            <div class="text-center p-3">
                <i style="font-size: 5rem;" class="fas fa-balance-scale"></i>
            </div>
            <h4 class="title"><a href="{{route('legal-warning')}}">Aviso legal</a></h4>
            <p>Lee nuestro aviso legal y enterate de las leyes que te afectan.&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;</p>
            <p></p>
          </div>
        </div>

        <div class="col-md-12 col-lg-6 d-flex align-items-stretch mb-5 mb-lg-4">
          <div class="bg-white p-3 rounded">
            <div class="text-center p-3">
                <i style="font-size: 5rem;" class="fas fa-user-cog"></i>
            </div>
            <h4 class="title"><a href="{{route('update-profile')}}">Modificar cuenta</a></h4>
            <p>En este apartado puedes, modificar tus datos de usuario o eliminar tu cuenta.</p>
          </div>
        </div>

      </div>

    </div>
</section>
@endsection