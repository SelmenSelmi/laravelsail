<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Document</title>
</head>
<body>
    <form action="/post/{{ $post->id }}" method="POST">
        @csrf
        @method('PUT')
        <label for="title">Post Title</label>
        <input type="text" id="title" name="title" value="{{ $post->title }}" required />
        <label for="content">Post Content</label>
        <textarea id="content" name="content" required>{{ $post->content }}</textarea>
        <button type="submit">Update Post</button>
    </form>
</body>
</html>