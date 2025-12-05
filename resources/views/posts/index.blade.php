<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Posts</title>
    <!-- Add Toastr CSS -->
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bulma@1.0.4/css/bulma.min.css">
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
    <h2>Welcome, {{ auth()->user()->email }}</h2>
    <form action="/logout" method="POST" style="margin-bottom: 20px;">
        @csrf
        <button class="button is-danger" type="submit">Logout</button>
    </form>
    <button class="button is-primary" redirect="/post/create/" onclick="window.location.href='/post/create'">Create New Post</button>
    <h1>Posts</h1>
    <div class="columns">

    @if(isset($posts) && count($posts))
        <ul>
            @foreach($posts as $post)
                <div class="column is-half is-offset-one-quarter">
            <div class="card">
             <div class="card-content">
               
                    <a href="/post/{{ $post->id }}">
                        <strong>{{ $post->title }}</strong><br>
                    </a>
                    <span>{{ $post->content }}</span>
                    <div class="card-footer">
                    <button class="button is-link" onclick="window.location.href='/posts/{{ $post->id }}/comments/show'">View Comments</button>
                    <button class="button is-link ml-3" onclick="window.location.href='/posts/{{ $post->id }}/comments'">create</button>
                
                    </div>
                </div>
            </div>
                </div>
            @endforeach
        </ul>
    </div>
    @else
        <p>No posts found.</p>
    @endif
     @php
            $nasaImg = app(\App\Services\NasaApodService::class)->getImageUrl();
        @endphp
        
        @if($nasaImg)
            <div class="card" style="margin-top: 30px;">
                <div class="card-content">
                    <h2 class="title is-2">NASA Astronomy Picture of the Day</h2>
                    <figure class="image">
                        <img src="{{ $nasaImg }}" alt="NASA APOD" style="max-width:100%;height:auto;" />
                    </figure>
                </div>
            </div>
        @endif
</body>
</html>