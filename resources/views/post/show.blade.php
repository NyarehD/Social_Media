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
                <div class="col-9 p-0 bg-white">
                    @if(count($post->images)==1)
                        <img class="card-img-top show-post-not-carousel"
                             src="{{ asset("storage/post/".$post->images[0]->filename) }}"
                             alt="Card image cap">
                    @else
                        <div class="show-post-carousel">
                            @foreach($post->images as $image)
                                <div class="">
                                    <img class="card-img" src="{{ asset("storage/post/".$image->filename) }}"
                                         alt="Card image cap">
                                </div>
                            @endforeach
                        </div>
                    @endif
                </div>
                <div class="col-3 py-2 border-right card">
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
                    <div class="row justify-content-between align-items-center">
                        <div class="col-4 text-center p-0">
                            <button class="btn w-100" form="like{{ $post->id }}">
                                <i class="fa-lg {{ $post->total_likes->count()==1?"fas":"far" }} fa-thumbs-up"></i>{{ $post->total_likes->count() }}
                                {{ $post->total_likes->count()>1?"Likes":"Like" }}
                            </button>
                            @error("post_id")
                            <div role="alert" aria-live="assertive" aria-atomic="true" class="toast postIdToast"
                                 data-autohide="false">
                                <div class="toast-header">
                                    <strong>{{ $message }}</strong>
                                    <button type="button" class="ml-2 mb-1 close" data-dismiss="toast"
                                            aria-label="Close">
                                        <span aria-hidden="true">&times;</span>
                                    </button>
                                </div>
                            </div>
                            @enderror

                            <form
                                action="{{ $post->total_likes->where("user_id",Auth::id())->count()==1?route("like.unlike",$post->id):route("like.like") }}"
                                id="like{{$post->id}}" method="post">
                                @csrf
                                <input type="text" name="post_id" value="{{ $post->id  }}" class="d-none">
                            </form>
                        </div>
                        <div class="col-4 text-center p-0">
                            <button class="btn w-100">
                                <i class="far fa-lg fa-comment-alt"></i> Comment
                            </button>
                        </div>
                        <div class="col-4 text-center p-0">
                            <button class="btn w-100">
                                <i class="fas fa-lg fa-share"></i> Share
                            </button>
                        </div>
                    </div>
                </div>
            </div>
        </div>

    </main>
    <div class="position-fixed back-newsfeed">
        <a href="{{ route("newsfeed") }}" class="h1"><i class="fas fa-chevron-circle-left"></i></a>
    </div>
</div>
<script>
    $(document).ready(function () {
        $(".toast").toast("show")
    })
</script>
</body>
</html>
