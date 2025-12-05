<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>comments</title>
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
    <button class="button is-primary" redirect="/post/create" onclick="window.location.href='/post/create'">Create New Post</button>
    <h1>comments</h1>
    <div class="columns">

    @if(isset($comments) && count($comments))
        <ul>
            @foreach($comments as $comment)
                <div class="column is-half is-offset-one-quarter">
            <div class="card">
             <div class="card-content">
               
                    <a href="/post/{{ $comment->id }}">
                        <strong>{{ $comment->title }}</strong><br>
                    </a>
                    <span>{{ $comment->content }}</span>
                </div>
            </div>
                </div>
            @endforeach
        </ul>
    </div>
    @else
        <p>No comments found.</p>
    @endif
    @php
        $nasaImg = app(\App\Services\NasaApodService::class)->getImageUrl();
    @endphp
     @if($nasaImg)
     <div class="card is-half is-offset-one-quarter">
  <div class="card-image is-half is-offset-one-quarter">
    <figure class="image">
    <div style="margin-top:30px;">
        <img src="{{ $nasaImg }}" alt="NASA APOD" style="max-width:100%;height:auto;" />
    </div>
    </figure>
  </div>
@endif
</body>
</html>