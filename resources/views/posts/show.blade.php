<html lang="en">
<head>
    <meta charset="UTF-8">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bulma@1.0.4/css/bulma.min.css">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Posts Network</title>
</head>
<body>
    <h1 class=" is-size-2 has-text-weight-bold">Post title is - {{ $post->content }}</h1>
    <button class="button is-link" onclick="window.location.href='/post'">Back to Posts</button>
    <button class="button is-warning" onclick="window.location.href='/edit/{{ $post->id }}'">Edit Post</button>
    <form action="/post/{{ $post->id }}" method="POST" style="display:inline;">
        @csrf
        @method('DELETE')
        <button class="button is-danger" type="submit" onclick="return confirm('Are you sure you want to delete this post?')">Delete Post</button>
    </form>
</body>
</html>