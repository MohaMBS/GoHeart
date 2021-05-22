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
</style>
@endsection
@section('content')
<div class="video-container">
  <video autoplay loop class="fillWidth visible-lg">
     <source src="https://www.youtube.com/watch?v=HQfF5XRVXjU" type="video/mp4; "/>        
     Your browser does not support the video tag.
 </video>
</div>
@guest
<div class="jumbotron offset-sm-1 col-sm-10 offset-sm-1">
  <h1 class="display-4">Bienvenido, a GoHeart!</h1>
  <p class="lead">El sito web líder, donde nuestros usuarios comparten todos sus conocimientos hacia otros.</p>
  <hr class="my-4">
  <p>Unete y se un <span class="special-font">Heart</span> y comparte tu sabiduria en nuestros foros.</p>
  <a class="btn btn-primary btn-lg" href="{{ route('register') }}" role="button">Unete</a>
</div>
@endguest
@endsection