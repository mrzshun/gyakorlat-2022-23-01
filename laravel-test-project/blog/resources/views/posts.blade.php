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
    @if(Route::has('login'))
      <p>Login here</p>
    @endif
    
    <h1>Blogpostok</h1>
    @forelse ($posts as $post)
      <h2>{{ $post->title }}</h2>
      <cite>Authur: {{ $post->author->name }}</cite>
      <p><strong>Tags:</strong>
      @foreach($post->categories as $tag)
        <span style="background-color:{{$tag->bg_color}}">{{ $tag->name }}</span>
      @endforeach
     </p>
     <p><strong>{{ $post->description }}</strong></p>
     <p>{{ $post->text }}</p>
    @empty
      <p>üres</p>
    @endforelse
  </body>
</html>