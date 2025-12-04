<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Document</title>
</head>
<body>
    <form action="/post" method="POST">
        @csrf
        <label for="title">Post Title</label>
        <input type="text" id="title" name="title" placeholder="Post Title" required />
        <label for="content">Post Content</label>
        <textarea id="content" name="content" placeholder="Post Content" required></textarea>
        <button type="submit">Create Post</button>
    </form>
</body>
</html>