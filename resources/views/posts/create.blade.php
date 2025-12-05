<html lang="en">
<head>
    <meta charset="UTF-8">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bulma@1.0.4/css/bulma.min.css">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Document</title>
</head>
<body>
    <form action="/post" method="POST">
        @csrf
        <label class="label" for="title">Post Title</label>
        <input class="input" type="text" id="title" name="title" placeholder="Post Title" required />
        <label class="label" for="content">Post Content</label>
        <textarea class="textarea" id="content" name="content" placeholder="Post Content" required></textarea>
        <button class="button is-primary" type="submit">Create Post</button>
    </form>
</body>
</html>