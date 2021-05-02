<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>GoHeart</title>
    
    <script src="https://code.jquery.com/jquery-3.4.1.slim.min.js" integrity="sha384-J6qa4849blE2+poT4WnyKhv5vZF5SrPo0iEjwBvKU7imGFAV0wwj1yYfoRSJoZ+n" crossorigin="anonymous"></script>
    
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.6.0/dist/css/bootstrap.min.css" integrity="sha384-B0vP5xmATw1+K9KRQjQERJvTumQW0nPEzvF6L/Z6nronJ3oUOFUFpCjEUQouq2+l" crossorigin="anonymous">
    <script src="https://code.jquery.com/jquery-3.5.1.slim.min.js" integrity="sha384-DfXdz2htPH0lsSSs5nCTpuj/zy4C+OGpamoFVy38MVBnE+IbbVYUew+OrCXaRkfj" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@4.6.0/dist/js/bootstrap.bundle.min.js" integrity="sha384-Piv4xVNRyMGpqkS2by6br4gNJ7DXjqk09RmUpJ8jgGtD7zP9yug3goQfGII0yAns" crossorigin="anonymous"></script>
    
    <script src="https://kit.fontawesome.com/64fd2ea547.js" crossorigin="anonymous"></script>

    <script src="https://cdn.tiny.cloud/1/d2c5k3zmkiqgn6brkffsa1cysyvuntzc13rcuhggwzofs50u/tinymce/5/tinymce.min.js" referrerpolicy="origin"></script>
    
    <link rel="stylesheet" href="{{ asset('css/mycss.css') }}">
</head>
<body>
    <!-- Menu fijo en la parte superior -->
    <nav class="navbar navbar-expand-lg navbar-dark ftco_navbar pri ftco-navbar-light sticky-top" id="ftco-navbar">
	    <div class="container-fluid m-auto">
            <a class="navbar-brand m-auto" href="#">Logo GoHeart</a>
	        <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#ftco-nav" aria-controls="ftco-nav" aria-expanded="false" aria-label="Toggle navigation">
	            <span class="fa fa-bars"></span> Menu
	        </button>
	        <div class="collapse navbar-collapse" id="ftco-nav">
                <ul class="navbar-nav m-auto"></ul>
                <ul class="navbar-nav m-auto">
                    <li class="nav-item "><a href="#" class="nav-link">Home</a></li>
                    <li class="nav-item dropdown">
                        <a class="nav-link dropdown-toggle {{ (request()->is('create-post')) ? 'active' : '' }}" href="#" id="dropdown04" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">Blogs</a>
                        <div class="dropdown-menu" aria-labelledby="dropdown04">
                            <a class="dropdown-item" href="#">Guias</a>
                            <a class="dropdown-item" href="#">Eentos</a>
                        </div>
                    </li>
                    <li class="nav-item"><a href="#" class="nav-link">Ayuda</a></li>
                    <li class="nav-item"><a href="#" class="nav-link">¿Quines somos?</a></li>
                    <li class="nav-item"><a href="#" class="nav-link">Contacto</a></li>
                </ul>
                <ul class="navbar-nav m-auto">
                    <li class="nav-item "><a class="nav-link" href="">Registro</a></li>
                    <li class="nav-item "><a class="nav-link" href="">Log in.</a></li>
                    <li class="nav-item "> 
                        <span style="font-size: 1.8em;">
                            <i class="fas fa-user-circle"></i>
                        </span>
                    </li>
                </ul>
                <ul class="navbar-nav">
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
	        </div>
	    </div>
    </nav>
<div class="mt-4 row" style="margin-left:auto;margin-right:auto;">
    <div class="col-md-2">
        @yield("l-content")
    </div>
    <div class="col.md-8">
        @yield("content")
    </div>
    <div class="col-md-2">
        @yield("r-content")
    </div>
</div>
   
</body>
</html>