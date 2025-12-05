<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Comments</title>
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
    
    <div class="container" style="padding: 20px;">
        <h2>Welcome, {{ auth()->user()->email }}</h2>
        <form action="/logout" method="POST" style="margin-bottom: 20px;">
            @csrf
            <button class="button is-danger" type="submit">Logout</button>
        </form>
        <button class="button is-primary" onclick="window.location.href='/post/create'">Create New Post</button>
        
        <h1 class="title is-1" style="margin-top: 30px;">Comments</h1>
        
        <div class="columns is-multiline">
            @if(isset($comments) && is_iterable($comments) && count($comments) > 0)
                @foreach($comments as $comment)
                    <div class="column is-half">
                        <div class="card">
                            <div class="card-content">
                                <div class="content">
                                    @if(isset($comment->post))
                                        <a href="/post/{{ $comment->post->id ?? $comment->post_id }}">
                                            <strong>Post: {{ $comment->post->title ?? 'Related Post' }}</strong><br>
                                        </a>
                                    @endif
                                    <strong>Comment:</strong>
                                    <p>{{ $comment->content ?? $comment->body ?? 'No content' }}</p>
                                    <small>Posted: {{ $comment->created_at->format('M d, Y') ?? 'Unknown date' }}</small>
                                </div>
                            </div>
                        </div>
                    </div>
                @endforeach
            @else
                <div class="column is-full">
                    <div class="notification is-warning">
                        <p>No comments found.</p>
                    </div>
                </div>
            @endif
        </div>
        
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
    </div>
</body>
</html>