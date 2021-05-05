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
    <!-- Bootstrap 4.6.0 -->
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.6.0/dist/css/bootstrap.min.css" integrity="sha384-B0vP5xmATw1+K9KRQjQERJvTumQW0nPEzvF6L/Z6nronJ3oUOFUFpCjEUQouq2+l" crossorigin="anonymous">
    <script src="https://code.jquery.com/jquery-3.5.1.slim.min.js" integrity="sha384-DfXdz2htPH0lsSSs5nCTpuj/zy4C+OGpamoFVy38MVBnE+IbbVYUew+OrCXaRkfj" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@4.6.0/dist/js/bootstrap.bundle.min.js" integrity="sha384-Piv4xVNRyMGpqkS2by6br4gNJ7DXjqk09RmUpJ8jgGtD7zP9yug3goQfGII0yAns" crossorigin="anonymous"></script>
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
    <nav class="navbar navbar-expand-xl navbar-dark ftco_navbar pri sticky-top " id="ftco-navbar">
	    <div class="container-fluid ">
            <a class="navbar-brand " href="{{ route('home')}}"><img class="logo-tamaño" src="{{ asset('storage/web/images/logo.png')}}" alt="LogoWeb"> GoHeart</a>
	        <button class="navbar-toggler" id="collapse-button" type="button" data-toggle="collapse" data-target="#ftco-nav" aria-controls="ftco-nav" aria-expanded="false" aria-label="Toggle navigation">
	            <span class="fa fa-bars"></span> Menu
	        </button>
	        <div class="collapse navbar-collapse m-auto ml-sm-5" id="ftco-nav">
                <ul class="navbar-nav ml-auto">
                    <li class="nav-item {{ (request()->is('/')) ? 'active' : '' }}"><a href="{{ route('home')}}" class="nav-link">Home</a></li>
                    <li class="nav-item dropdown">
                        <a class="nav-link dropdown-toggle {{ (request()->is('blog/create-post') || request()->is('blog/posts') ) ? 'active' : '' }}" href="#" id="dropdown04" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">Blogs</a>
                        <div class="dropdown-menu" aria-labelledby="dropdown04">
                            <a class="dropdown-item" href="{{route ('posts')}}">Guias</a>
                            <a class="dropdown-item" href="">Eentos</a>
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
                          class="btn btn-info d-none d-sm-block "
                          type="button"
                          data-mdb-ripple-color="dark"
                        >
                          Buscar
                        </button>
                      </form>
                    </li>
                </ul>
                <ul class="px-5 navbar-nav d-md-flex align-items-md-center">
                    @auth
                        <li class="nav-item mx-2 d-sm-inline-flex"> 
                            <span style="font-size: 1.8em;">
                            <a href="" class="text-white"><i class="fas fa-user-circle"></i></a> 
                            </span>
                        </li>        
                        <li class="nav-item "><small> {{ Auth::user()->name }} </small></li>                
                    @endauth
                    @guest
                        <li class="nav-item "><a class="nav-link" href="{{ route('register') }}">Registro</a></li>
                        <li class="nav-item "><a class="nav-link" href="{{ route('login') }}">Log in.</a></li>
                        <li class="nav-item "> 
                            <span style="font-size: 1.8em;">
                            <a href="" class="text-white"><i class="fas fa-user-circle"></i></a> 
                            </span>
                        </li>
                    @endguest
                </ul>
                
	        </div>
	    </div>
    </nav>
    <div id="barr" class="col-12 position-fixed  shadow-lg border-top border-dark" style="height: 1rem;background-color:#244866; z-index:99;"></div>
<div class="mt-4 row" style="margin-left:auto;margin-right:auto;">
    <div class="col-12">
        @yield("content")
    </div>
</div>
   
</body>
</html>