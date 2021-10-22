<!doctype html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <!-- CSRF Token -->
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <link rel="icon" href="{{ asset("assets/Asset 3.png") }}">
    <title>{{ config('app.name', 'Laravel') }}</title>

    <!-- Scripts -->
    <script src="{{ asset('js/app.js') }}"></script>

    <!-- Fonts -->
    <link rel="dns-prefetch" href="//fonts.gstatic.com">
    <link href="https://fonts.googleapis.com/css?family=Nunito" rel="stylesheet">

    <!-- Styles -->
    <link href="{{ asset('css/app.css') }}" rel="stylesheet">
</head>
<body>
<div id="app" class="">
    <main class="overflow-hidden">
        <div class="container-fluid p-0 show-post h-100">
            <div class="row">
                <div class="col-9">
                    @if(count($post->images)==1)
                        <img class="card-img-top" src="{{ asset("storage/post/".$post->images[0]->filename) }}"
                             alt="Card image cap">
                    @else
                        <div class="post-carousel">
                            @foreach($post->images as $image)
                                <div class="">
                                    <img class="card-img" src="{{ asset("storage/post/".$image->filename) }}"
                                         alt="Card image cap">
                                </div>
                            @endforeach
                        </div>
                        <ul class="slick-dots"></ul>
                    @endif
                </div>
                <div class="col-3 py-2">
                    <div class="row">
                        <div class="col-12 d-flex align-items-center">
                            <img
                                src="{{ isset($post->post_owner->profile_picture)?asset("storage/profile-picture/".$post->post_owner->profile_picture): asset("storage/profile-picture/default-profile.jpg") }}"
                                alt=""
                                class="post-profile-img h-100">
                            <div class="">
                                <h4 class="mb-0">{{ $post->post_owner->name  }}</h4>
                                <h6>{{ $post->created_at->diffForHumans() }}</h6>
                            </div>
                        </div>
                        <div class="col-12">
                            <h5>{{ $post->title }}</h5>
                            <p>{{ $post->description }}</p>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </main>
</div>
@yield("script")
<script>
    $(document).ready(function () {
        $(".toast").toast("show")
    })
</script>
</body>
</html>
