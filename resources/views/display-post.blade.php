<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>GeHeart | {{$post[0]->title }}</title>
    <script src="https://code.jquery.com/jquery-3.6.0.js" integrity="sha256-H+K7U5CnXl1h5ywQfKtSj8PCmoN9aaq30gDh27Xc0jk=" crossorigin="anonymous"></script>
</head>
<body>
    <div>
        <h1>{!! $post[0]->title !!}</h1>
        {!! $post[0]->body !!}
    </div>
    <div>
        @if( count($post[0]->comments) > 0)
            @foreach ( $post[0]->comments as $comment)
                {{$comment->name}}: {{$comment->comment}} </br>
            @endforeach
        @endif
    </div>
    @auth
    <form action="{{ route('makeComment') }}" method="POST">
    <input type="text" name="post" value="{{ $post[0]->id }}" hidden>
    @csrf
    <textarea name="comment" id="" cols="30" rows="10" required></textarea><br>
    <input type="submit" value="Comentar">
    </form>
    @endauth
</body>

<script>
$(document).ready(function(){
    console.log($("form").html)
    $("button").click(function(event){
        event.preventDefault();
        $.post("{{ route('makeComment') }}",$("form"),
        function(data,status){
            alert("Data: " + data + "\nStatus: " + status);
        });
    });
});
</script>
</html>