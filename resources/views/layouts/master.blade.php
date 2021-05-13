<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>GoHeart @yield('title')</title>
    <!-- Fuente Damion -->
    <link href='https://fonts.googleapis.com/css?family=Damion' rel='stylesheet'> 
    <!-- JQuery -->
    <script src="https://code.jquery.com/jquery-3.6.0.min.js" integrity="sha256-/xUj+3OJU5yExlq6GSYGSHk7tPXikynS7ogEvDej/m4=" crossorigin="anonymous" defer></script>
    <script src="https://code.jquery.com/jquery-migrate-3.0.0.min.js" defer></script>
    <!-- JQueryAnimation -->
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
    <!-- JQuery validator -->
    <script src="https://cdn.jsdelivr.net/npm/jquery-validation@1.19.3/dist/jquery.validate.js" defer></script>
    <!-- Bootstrap 4.6.0 -->
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.6.0/dist/css/bootstrap.min.css" integrity="sha384-B0vP5xmATw1+K9KRQjQERJvTumQW0nPEzvF6L/Z6nronJ3oUOFUFpCjEUQouq2+l" crossorigin="anonymous">
    <script src="https://code.jquery.com/jquery-3.5.1.slim.min.js" integrity="sha384-DfXdz2htPH0lsSSs5nCTpuj/zy4C+OGpamoFVy38MVBnE+IbbVYUew+OrCXaRkfj" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@4.6.0/dist/js/bootstrap.bundle.min.js" integrity="sha384-Piv4xVNRyMGpqkS2by6br4gNJ7DXjqk09RmUpJ8jgGtD7zP9yug3goQfGII0yAns" crossorigin="anonymous" defer></script>
    <!-- Fon Awesome  -->
    <script src="https://kit.fontawesome.com/64fd2ea547.js" crossorigin="anonymous"></script>
    <!-- Tinymce -->
    <script src="https://cdn.tiny.cloud/1/d2c5k3zmkiqgn6brkffsa1cysyvuntzc13rcuhggwzofs50u/tinymce/5/tinymce.min.js" referrerpolicy="origin"></script>
    <!-- Estilos propios -->
    <link rel="stylesheet" href="{{ asset('css/mycss.css') }}">
    <!--<script src="{{ asset('js/auto-hiding-bootstrap-navbar.js') }}"></script>-->
    @yield('css')
</head>
<body>
    <!-- Menu fijo en la parte superior -->
    <nav style="border-bottom: 22px solid #244866;" class="navbar navbar-expand-xl navbar-dark ftco_navbar pri sticky-top " id="ftco-navbar">
	    <div class="container-fluid ">
            <a class="navbar-brand " href="{{ route('home')}}"><img class="logo-tamaño" src="{{ asset('storage/web/images/logo.png')}}" alt="LogoWeb"> GoHeart</a>
	        <button class="navbar-toggler" id="collapse-button" type="button" data-toggle="collapse" data-target="#ftco-nav" aria-controls="ftco-nav" aria-expanded="false" aria-label="Toggle navigation">
	            <span class="fa fa-bars"></span> Menu
	        </button>
	        <div class="collapse navbar-collapse m-auto ml-sm-5" id="ftco-nav">
                <ul class="navbar-nav ml-auto">
                    <li class="nav-item {{ (request()->is('/')) ? 'active' : '' }}"><a href="{{ route('home')}}" class="nav-link">Home</a></li>
                    <li class="nav-item dropdown">
                        <a class="nav-link dropdown-toggle {{ (request()->is('blog/create-post') || (request()->is('blog/event/create')) || request()->is('blog/events') || request()->is('blog/posts') ) || request()->is('blog/post/'.request()->id) || request()->is('blog/event/'.request()->id) ? 'active' : '' }}" href="#" id="dropdown04" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">Blogs</a>
                        <div class="dropdown-menu" aria-labelledby="dropdown04"> 
                            <a class="dropdown-item" href="{{route ('posts')}}">GoBlog</a>
                            <a class="dropdown-item" href="{{ route('events') }}">Eventos</a>
                        </div>
                    </li>
                    <li class="nav-item"><a href="#" class="nav-link">Ayuda</a></li>
                    <li class="nav-item"><a href="#" class="nav-link">¿Quines somos?</a></li>
                    <li class="nav-item"><a href="#" class="nav-link">Contacto</a></li>
                </ul>
                <ul class="navbar-nav ml-auto">
                    <li>
                        <form class="d-flex input-group w-auto" action="javascript:void(0);">
                        <input
                          type="search"
                          class="form-control"
                          placeholder="Busca aquí..."
                          aria-label="Search"
                        />
                        <button
                          class="btn btn-info  "
                          type="button"
                          data-mdb-ripple-color="dark"
                        >
                          Buscar
                        </button>
                      </form>
                    </li>
                </ul>      
                <ul class=" navbar-nav d-md-flex ">
                    @auth
                        <li class="ml-lg-2 d-flex nav-item dropdown">
                            <a href="{{ route('edit-user') }}" class="text-white"><img class="rounded-circle" src="{{ auth()->user()->url_avatar }}" alt="" width="40"></a>
                            <a class="nav-link dropdown-toggle {{ (request()->is('my-profile')) || (request()->is('my-profile/my-posts')) || (request()->is('my-profile/my-events')) 
                            || (request()->is('my-profile/my-favorites')) || (request()->is('my-profile/my-saves')) ? 'active' : '' }}" href="#" id="dropdown02" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false"><small> 
                                    {{ Auth::user()->name }} </small></a>
                            <div class="dropdown-menu" aria-labelledby="dropdown02">
                                <a class="dropdown-item" href="{{route ('edit-user')}}">Editar cuenta</a>
                                <a class="dropdown-item" href="{{ route('my-posts') }}">Ver mis entradas</a>
                                <a class="dropdown-item" href="{{ route('my-events') }}">Ver mis eventos</a>
                                <a class="dropdown-item" href="{{route ('my-favorites')}}">Ver mis favoritos</a>
                                <a class="dropdown-item" href="{{route ('my-saves')}}">Ver mis guardados</a>
                            </div>
                            <a data-toggle="tooltip" data-placement="bottom" title="Cerrar session." class="text-white" href="{{ route('logout-get') }}">
                                <span style="font-size:1.8rem">
                                    <i class="fas fa-sign-out-alt"></i>
                                </span>
                            </a>
                        </li>              
                    @endauth
                    @guest
                        <li class="ml-lg-2 nav-item d-flex"> 
                            <span class="mr-2 mr-sm-1" style="font-size: 1.8em;">
                                <a href="{{ route('login') }}" class="text-white"><i class="fas fa-user-circle"></i></a> 
                            </span>
                            <a class="nav-link ml-2 ml-sm-1 " href="{{ route('register') }}">Registro</a>
                            <a class="nav-link ml-3 ml-sm-1" href="{{ route('login') }}">Log in.</a>
                        </li>
                    @endguest
                </ul>
                
	        </div>
	    </div>
    </nav>
<div class="mt-4 row" style="margin-left:auto;margin-right:auto;">
    <div class="col-12">
        @yield("content")
    </div>
</div>
<footer id="footer" style="border-top: 18px solid #244866;" class="pri text-white d-flex-column text-center">
    <hr class="mt-0">
    <div class="text-center">
      <h4>Estamos en</h4>
      <ul class="list-unstyled list-inline">
        <li class="list-inline-item">
          <a href="https://www.facebook.com/MohamedBoughima/" class="link sbtn btn-large mx-1" title="Facebook">
            <i class="fab fa-facebook-square fa-2x"></i>
          </a>
        </li>
        <li class="list-inline-item">
          <a href="https://www.linkedin.com/in/mohamed-boughima-7218b1207/" class="link sbtn btn-large mx-1" title="Linkedin">
            <i class="fab fa-linkedin fa-2x"></i>
          </a>
        </li>
        <li class="list-inline-item">
          <a href="https://github.com/MohaMBS" class="link sbtn btn-large mx-1" title="Twitter">
            <i class="fab fa-github fa-2x"></i>
          </a>
        </li>
        <li class="list-inline-item">
          <a href="www.youtube.es" class="link sbtn btn-large mx-1" title="Youtube">
            <i class="fab fa-youtube-square fa-2x"></i>
          </a>
        </li>
      </ul>
    </div>
    <hr class="mb-0">
    <div class="container text-left text-md-center">
      <div class="row">
        <hr class="clearfix w-100 d-md-none mb-0">
        <div class="col-md-3 mx-auto shfooter">
          <h5 class="my-2 font-weight-bold d-none d-md-block">GoHeart</h5>
          <div class="d-md-none title" data-target="#Company" data-toggle="collapse">
            <div class="mt-3 font-weight-bold">GoHeart
              <div class="float-right navbar-toggler">
                <i class="fas fa-angle-down"></i>
                <i class="fas fa-angle-up"></i>
              </div>
            </div>
          </div>
          <ul class="list-unstyled collapse" id="Company">
            <li><a class="link " href="">Sobre nosotros</a></li>
            <li><a class="link " href="">Cual es nuestro objetivo</a></li>
            <li><a class="link " href="">FAQ</a></li>
            <li><a class="link " href="">Tutorial.</a></li>
          </ul>
        </div>
        <hr class="clearfix w-100 d-md-none mb-0">
        <div class="col-md-3 mx-auto shfooter">
          <h5 class="my-2 font-weight-bold d-none d-md-block">Funcciones</h5>
          <div class="d-md-none title" data-target="#Resources" data-toggle="collapse">
            <div class="mt-3 font-weight-bold">Funcciones
              <div class="float-right navbar-toggler">
                <i class="fas fa-angle-down"></i>
                <i class="fas fa-angle-up"></i>
              </div>
            </div>
          </div>
          <ul class="list-unstyled collapse" id="Resources">
            <li><a class="link " href="">Blog</a></li>
            <li><a class="link " href="">Eventos</a></li>
            <li><a class="link " href="">Crear una entrada.</a></li>
            <li><a class="link " href="">Crear un evento.</a></li>
          </ul>
        </div>
        <hr class="clearfix w-100 d-md-none mb-0">
        <div class="col-md-3 mx-auto shfooter">
          <h5 class="my-2 font-weight-bold d-none d-md-block">Obten ayuda</h5>
          <div class="d-md-none title" data-target="#Get-Help" data-toggle="collapse">
            <div class="mt-3 font-weight-bold">Obten ayuda
              <div class="float-right navbar-toggler">
                <i class="fas fa-angle-down"></i>
                <i class="fas fa-angle-up"></i>
              </div>
            </div>
          </div>
          <ul class="list-unstyled collapse" id="Get-Help">
            <li><a class="link " href="" target="_blank">Centro de ayuda.</a></li>
            <li><a class="link " href="">Ponte en contacto con nostros.</a></li>
            <li><a class="link " href="">Privacidad</a></li>
            <li><a class="link " href="{{ route('login')}}">Login</a></li>
          </ul>
        </div>
      </div>
    </div>
    <hr class="mb-0">
    <div class="py-3 text-center">
      Copyright 2020-
      <script>
        document.write(new Date().getFullYear())
      </script> <a href="https://codepen.io/jettaz">GoHeart</a> | Takr care about your life
    </div>
  </footer>
</body>
</html>