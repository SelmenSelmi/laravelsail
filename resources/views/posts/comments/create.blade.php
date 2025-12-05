<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bulma@1.0.4/css/bulma.min.css">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Document</title>
</head>
<body>
    <form action="/posts/comments" method="POST">
        @csrf
        <input class="input" type="hidden" name="user_id" value="{{ auth()->id() }}" />
        <input class="input" type="hidden" name="post_id" value="{{ $post_id }}" />
        <label for="content">Comment Content</label>
        <textarea class="textarea" id="content" name="content" placeholder="Comment Content" required></textarea>
        <button class="button is-primary" type="submit">Create Comment</button>
    </form>
</body>
</html>