<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Posts</title>
    <!-- Add Toastr CSS -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/toastr.min.css">
</head>
<body>
    <!-- Add Toastr Scripts -->
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.7.1/jquery.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/toastr.min.js"></script>
    
    <script>
        $(function() {
            // Show success toast if there's a success message in session
            @if(session('success'))
                toastr.success("{{ session('success') }}");
            @endif
            
            // Show error toast if there's an error message
            @if(session('error'))
                toastr.error("{{ session('error') }}");
            @endif
        });
    </script>

    <form action="/logout" method="POST" style="margin-bottom: 20px;">
        @csrf
        <button type="submit">Logout</button>
    </form>
    <button redirect="/post/create" onclick="window.location.href='/post/create'">Create New Post</button>
    <h1>Posts</h1>

    @if(isset($posts) && count($posts))
        <ul>
            @foreach($posts as $post)
                <li>
                    <a href="/post/{{ $post->id }}">
                        <strong>{{ $post->title }}</strong><br>
                    </a>
                    <span>{{ $post->content }}</span>
                </li>
            @endforeach
        </ul>
    @else
        <p>No posts found.</p>
    @endif
    @php
        $nasaImg = app(\App\Services\NasaApodService::class)->getImageUrl();
    @endphp
     @if($nasaImg)
    <div style="margin-top:30px;">
        <img src="{{ $nasaImg }}" alt="NASA APOD" style="max-width:100%;height:auto;" />
    </div>
@endif
</body>
</html>