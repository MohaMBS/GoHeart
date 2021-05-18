@extends('errors::minimal')

@section('title', __('Not Found'))
@section('code', '404')
@section('message')
Direcion url no encontrada <a style="color:#35638a;" href="{{route('home')}}"><b>Go</b>Hert</a>
@endsection
