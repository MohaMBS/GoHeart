<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>GoHeart-Notificacion de borrado.</title>
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/css/bootstrap.min.css" integrity="sha384-Gn5384xqQ1aoWXA+058RXPxPg6fy4IWvTNh0E263XmFcJlSAwiGgFAW/dAiS6JXm" crossorigin="anonymous">
    <script src="https://code.jquery.com/jquery-3.2.1.slim.min.js" integrity="sha384-KJ3o2DKtIkvYIK3UENzmM7KCkRr/rE9/Qpg6aAZGJwFDMVNA/GpGFF93hXpG5KkN" crossorigin="anonymous"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.12.9/umd/popper.min.js" integrity="sha384-ApNbgh9B+Y1QKtv3Rn7W3mgPxhU9K/ScQsAP7hUibX39j7fakFPskvXusvfa0b4Q" crossorigin="anonymous"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/js/bootstrap.min.js" integrity="sha384-JZR6Spejh4U02d8jOt6vLEHfe/JQGiRRSQQxSfFWpi1MquVdAyjUar5+76PVCmYl" crossorigin="anonymous"></script>
    <script src="https://kit.fontawesome.com/64fd2ea547.js" crossorigin="anonymous"></script>
</head>
<body>
    <div class="p-3 col-12 text-center" style="border-bottom: 18px solid #244866;background-color: #35638A">
        <a class="row text-center" href="{{ route('home') }}">
            <a class="" href="{{ route('home')}}"><img style="height:75px; height:75px;" src="{{ $logo }}" alt="LogoWeb"> 
                <span style="color:#fff;font-size:40px;">GoHeart</span></a>
            <h4 style="color: #fff;">Tu sito de confianza para compartir tu sabiduria y cuidarte</h4>
        </a>
    </div>
    <div class="col-12 bg-light p-4 text-center" style="font-size: 1rem;">
        <p>Estimado/a {{$user->name}}, una de tus entradas/eventos ha sido borrada por incumplir normas de nustra web.</p>
        <p>Tenga en cuenta que una entrada borrada no se puede recuperar en ningun momento.</p>
        <hr>
        <p> <b> Titulo: </b></p>
        <p><em>{{$data->title}}</em></p>
        <p> <b> Contenido de la entrada: </b> </p>
        <em><p> {{$data->body}}</p>
        </em>
        <hr>
        <p>Recuerde todos tus datos estaran protegido por la ley organica RGPD, para mas informacion haga click <a href="">aquí</a> para poder consultar</p>
        <p>nuestros terminos y contidiocnes.</p>
        <em><p>Gracias por confiar en nosotros, salud y bendiciones.</p></em>
    </div>
    <footer id="footer" style="border-top: 18px solid #244866;background-color:#35638A;" class="pri text-white d-flex-column text-center">
        <hr class="mt-0">
        <div class="text-center">
          <h4>Visitanos en</h4>
          <ul class="list-unstyled list-inline">
            <li class="list-inline-item">
              <a href="https://www.facebook.com/MohamedBoughima/" class="link sbtn btn-large mx-1" title="Facebook">
                <a class="" href="{{ route('home')}}"><img class="logo-tamaño mb-3" style="height:30px;" src="{{ $logo }}" alt="LogoWeb"></a>
              </a>
            </li>
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
        <div class="py-3 text-center">
          Copyright 2020-
          <script>
            document.write(new Date().getFullYear())
          </script> <a href="{{ route('home') }}">GoHeart</a> | Take care about your life
        </div>
      </footer>
</body>
</html>