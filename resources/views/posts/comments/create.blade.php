<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Document</title>
</head>
<body>
    <form action="/posts/comments" method="POST">
        @csrf
        <input type="hidden" name="post_id" value="{{ $post_id }}" />
        <label for="content">Comment Content</label>
        <textarea id="content" name="content" placeholder="Comment Content" required></textarea>
        <button type="submit">Create Comment</button>
    </form>
</body>
</html>