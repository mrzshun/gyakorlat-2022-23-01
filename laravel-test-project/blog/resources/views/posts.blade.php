<!DOCTYPE html>
<html lang="en">
  <head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>HTML 5 Boilerplate</title>
    <link rel="stylesheet" href="style.css">
  </head>
  <body>
    <h1>Minden blogpost</h1>
    @foreach ($posts as $post)
        <h2><a href="./post/{{$post['id']}}">{{ $post['title'] }}</a></h2>
        <p>Authur: {{ $post['userName'] }}</p>
    @endforeach
  </body>
</html>