@extends('layouts.master')
@section('title','- Home')
@section('css')
<style>
  .video-container 
{
  top: 0%;
  left: 0%;
  height: 400px;
  width: 100%;
  overflow: hidden;
}
video.fillWidth {
  width: 100%;
}
header.masthead {
    position: relative;
    background-color: #343a40;
    background: url(https://www.lifefitness.es/resource/blob/871074/d632673d8afbb70efbf3fb5cc3589059/brand-elevation-treadmill-running-detail-dx15623-mr-data.jpg) no-repeat center center;
    background-size: cover;
    padding-top: 8rem;
    padding-bottom: 8rem;
}
</style>
@endsection
@section('header')
<header class="masthead">
  <div class="container position-relative">
      <div class="row justify-content-center">
          <div class="col-xl-6">
              <div class="text-center text-white">
                  <!-- Page heading-->
                  <h1 class="mb-5">Bienvenido a <span class="special-font-xxl">GoHeart</span> el lugar indicado para aprender a cuidarte.</h1>
                  <h3>¿Que tal si comienzas buscando algo?</h3>
                  <!-- Signup form-->
                  <form>
                      <div class="input-group input-group-lg">
                        <form id="form-seacrh" class="d-flex input-group w-auto">
                          <input type="search" id="dataToSearch" class="form-control" placeholder="Busca aquí..." aria-label="Search">
                          <button class="btn btn-info" id="buttonSeacr" type="submit" data-mdb-ripple-color="dark"> Buscar </button>
                        </form>
                      </div>
                  </form>
              </div>
          </div>
      </div>
  </div>
</header>
@endsection
@section('content')
@guest
<div class="jumbotron offset-sm-1 col-sm-10 offset-sm-1">
  <h1 class="display-4">Hemos detectado que no estas autenticado</h1>
  <p class="lead">No dudes en autenticarte y coemnzar a expandir tus conocimientos hacia el mundo.</p>
  <div class="col-12 text-center">
    <a class="btn btn-primary btn-lg" href="{{ route('login') }}" role="button">Autenticarse</a>
    <a class="btn btn-primary btn-lg" href="{{ route('register') }}" role="button">Registro</a>
  </div>
</div>
@endguest
<section class="offset-sm-1 col-sm-10 offset-sm-1 features-icons  text-center rounded ">
  <h1 class='rounded bg-white p-2'>¿Que puedes hacer?</h1>
  <div class="col-12 mb-3 bg-light p-4">
      <div class="features-icons-item mx-auto mb-5 mb-lg-0 mb-lg-3">
          <div class="features-icons-icon d-flex"><i class="bi-window m-auto text-primary"></i></div>
          <h2>Nutrir tus conocimientos</h2>
          <i style="font-size: 10rem" class="fas fa-book-reader"></i>
          <hr>
          <p class="lead mb-0">En la web podrás encontrar decenas de entradas creadas por otros usuarios con la finalidad de poder compartir</p>
          <p>sus experiencias, únete y ayuda que esta comunidad sea más grande.</p>
      </div>
  </div>
  <div class="col-12 mb-3 bg-light p-4">
      <div class="features-icons-item mx-auto mb-5 mb-lg-0 mb-lg-3">
          <div class="features-icons-icon d-flex"><i class="bi-layers m-auto text-primary"></i></div>
          <h2>¿Como puedo empezar?</h2>
          <i style="font-size: 12rem" class="fas fa-users"></i>
          <hr>
          <p class="lead mb-0">Puede empezar por unirte a esta gran comunidad de <span class="special-font-xl">hearts</span> y mejorar tu dia a</p>
          <p>dia, és tan facil como hacer click <a href="{{ route('login') }}">aquí</a> y coemnzar una nueva aventura. Si quieres motivos para forma parte, és </p>
          <p>sencillo, que hay más importante que la salud y el bien estar.</p>
      </div>
  </div>
  <div class="col-12 mb-3 bg-light p-4">
      <div class="features-icons-item mx-auto mb-0 mb-lg-3">
          <div class="features-icons-icon d-flex"><i class="bi-terminal m-auto text-primary"></i></div>
          <h2>Simple de usar</h2>
          <i style="font-size: 12rem" class="fas fa-shapes"></i>
          <hr>
          <p>Nuestra web, está pensada para que sea las más simple posible y fácil para al usuario final, y así hacerte llevar</p>
          <p> una grata sorpresa. Está pensada para todo tipo de público, atrévete a probar es gratis!</p>
          <p></p>
      </div>
  </div>

  <div class="col-12">
    <section>
<div class="container">
    <div class="col-12 text-center">
        <h1>Opiniones de nuestros usuarios</h1>
    </div>
  <div class="row">
    <div class="col-md-12 col-lg-6 d-flex align-items-stretch mb-5 mb-lg-4">
      <div class="bg-white p-3 rounded">
        <div class="">
          <img src="https://mk0lanoticiapwmx1x6a.kinstacdn.com/wp-content/uploads/2020/08/gato_png_crop1567201738546-jpg_673822677-1.jpg" alt="Foto de perfil" class="rounded-circle" width="100" height="80">
          <br> Gato loco
          <hr>
        </div>
        <div class="col">
          <p>Esta web me parace muy bonita, ya que se puede compartir de tus conocimientos y aprender mucho mas!!</p>
          
        </div>
      </div>
    </div>
    <div class="col-md-12 col-lg-6 d-flex align-items-stretch mb-5 mb-lg-4">
      <div class="bg-white p-3 rounded">
        <div class="">
          <img src="https://s03.s3c.es/imag/_v0/770x420/7/6/f/GettyImages-522796439.jpg" alt="Foto de perfil" class="rounded-circle" width="100" height="80">
          <br>Jordi Pico
          <hr>
        </div>
        <div class="col">
          <p>Yo soy un entrador personal, un dia me tope que esta web y ví lo magnifico que es la comunidad.</p>
          
        </div>
      </div>
    </div>
    <div class="col-md-12 col-lg-6 d-flex align-items-stretch mb-5 mb-lg-4">
      <div class="bg-white p-3 rounded">
        <div class="">
          <img src="https://eslamoda.com/wp-content/uploads/sites/2/2014/09/chica-bonita.png" alt="Foto de perfil" class="rounded-circle" width="100" height="80">
          <br> Rosa Mela
          <hr>
        </div>
        <div class="col">
          <p>Esta web me a ayudado a crecer como una persoan muy fuerte, muchas gracias a la comunidad.</p>
        </div>
      </div>
    </div>
    <div class="col-md-12 col-lg-6 d-flex align-items-stretch mb-5 mb-lg-4">
      <div class="bg-white p-3 rounded">
        <div class="">
          <img src="https://emtstatic.com/2014/03/stock-footage-close-up-young-man-with-short-hair-smiling.jpg" alt="Foto de perfil" class="rounded-circle" width="100" height="80">
          <br> Terece 13
          <hr>
        </div>
        <div class="col">
          <p>Yo nunca supe tanto sobre como cuidarme, pero a la hora de iniciar en esta web ya soy todo un manitas.</p>
          
        </div>
      </div>
    </div>

  </div>

</div>
</section>
</div>

@endsection