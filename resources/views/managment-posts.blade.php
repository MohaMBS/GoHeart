<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
</head>
<body>
    @if(count($posts) > 0)
        @foreach ($posts as $post)
            <div>
                <div>{{$post->title}}</div>
                <div>{!! $post->body !!}</div>
                <div> <a href="{{ route('delete-post',$post->id) }}">Eliminar</a> <a href="{{ route('edit.post',$post->id) }}">Editar</a></div>
            </div>
        @endforeach
    @else
        <p>No has creado ninguna entrada.</p>
        <a href="{{ route('create.post')}}">Crear entrada.</a>
    @endif
</body>
</html>