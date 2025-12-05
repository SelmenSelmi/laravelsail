<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bulma@1.0.4/css/bulma.min.css">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Document</title>
</head>
<body>
    <form class="form" action="/post/{{ $post->id }}" method="POST">
        @csrf
        @method('PUT')
        <label class="label" for="title">Comment Title</label>
        <input class="input" type="text" id="content" name="content" value="{{ $post->content }}" required />
        <button class="button is-primary" type="submit">Update Post</button>
    </form>
</body>
</html>