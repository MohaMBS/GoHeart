<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
</head>
<body>
    @foreach ($posts as $post)
    <div>
    <h1>{{$post->title}}</h1>
    {!! $post->body !!}
    {{$post->comments_count}}
    <small>{{$post->creator_name}}</small>
    </div>
    @endforeach
</body>
</html>