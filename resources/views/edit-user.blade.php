@extends('layouts/master')
@section('content')
<div class="col-12">
    <h1 class="text-center">Editor de perfil</h1>
</div>
<div class="container rounded bg-white">
    <div class="row">
        <div class="col-md-4 border-right">
            <div class="d-flex flex-column align-items-center text-center p-3 py-5"><img class="rounded-circle mt-5" src="https://i.imgur.com/0eg0aG0.jpg" width="90"><span class="font-weight-bold">John Doe</span><span class="text-black-50">john_doe12@bbb.com</span><span>United States</span></div>
        </div>
        <div class="col-md-8">
            <div class="p-3 py-5">
                <div class="d-flex justify-content-between align-items-center mb-3">
                    <div class="row d-flex flex-row align-items-center back">
                       <a class="col-12" href="{{route('home')}}"><h6><i class="fa fa-long-arrow-left mr-1 mb-1"></i>Ir atras</h6></a>
                       <a class="col-12" href="{{route('home')}}"><h6><i class="fa fa-long-arrow-left mr-1 mb-1"></i>Volver al inicio</h6></a>
                    </div>
                    <h6 class="text-right">Editor de perfil <span class="special-font"> GoHeart </span></h6>
                </div>
                <div class="row mt-2">
                    <div class="col-md-2 "> <label for="name">Nombare:</label> </div>
                    <div class="col-md-10"><input type="text" class="form-control" placeholder="name" value="{{Auth::user()->name}}"></div>
                </div>
                <div class="row mt-3">
                    <div class="col-md-2 "> <label for="email">Email:</label> </div>
                    <div class="col-md-10"><input type="text" class="form-control" placeholder="Email" value="{{Auth::user()->email}}"></div>
                </div>
                <div class="row mt-3">
                    <div class="col-md-4 "> <label for="email"><small> Escriba la contraseña actual:</small></label> </div>
                    <div class="col-md-8"><input type="text" class="form-control" placeholder="Email" value=""></div>
                </div>
                <div class="row mt-3">
                    <div class="col-md-4 "> <label for="email">Nueva contraseña:</label> </div>
                    <div class="col-md-8"><input type="text" class="form-control" placeholder="Email" value=""></div>
                </div>
                <div class="row mt-3">
                    <div class="col-md-4 "> <label for="email">Nueva contraseña: </label> </div>
                    <div class="col-md-8"><input type="text" class="form-control" placeholder="Email" value=""></div>
                </div>
                <div class="mt-5 text-right"><button class="btn btn-primary profile-button" type="button">Guardar</button></div>
            </div>
        </div>
    </div>
</div>
@endsection