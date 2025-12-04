<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Posts Network</title>
</head>
<body>
    <h2>Post title is - {{ $post->content }}</h2>
    <button onclick="window.location.href='/post'">Back to Posts</button>
    <button onclick="window.location.href='/edit/{{ $post->id }}'">Edit Post</button>
    <form action="/post/{{ $post->id }}" method="POST" style="display:inline;">
        @csrf
        @method('DELETE')
        <button type="submit" onclick="return confirm('Are you sure you want to delete this post?')">Delete Post</button>
    </form>
</body>
</html>