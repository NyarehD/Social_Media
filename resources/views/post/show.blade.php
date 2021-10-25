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
    <main class="">
        <div class="container-fluid p-0 show-post h-100">
            <div class="row">
                <div class="col-9 p-0 bg-light">
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
                        <div class="col-10 d-flex align-items-center">
                            <a href="{{ route('profile',$post->post_owner->id) }}" class="">
                                <img
                                    src="{{ isset($post->post_owner->profile_picture)?asset("storage/profile-picture/".$post->post_owner->profile_picture): asset("storage/profile-picture/default-profile.jpg") }}"
                                    alt=""
                                    class="post-profile-img h-100 ">
                            </a>
                            <div class="">
                                <a href="{{ route('profile',$post->post_owner->id) }}"
                                   class="h4">{{ $post->post_owner->name }}</a>
                                <h6>{{ $post->created_at->diffForHumans() }}</h6>
                            </div>
                        </div>
                        <div class="col-2">
                            <form action="{{ route("post.destroy", $post->id) }}"
                                  id="del{{ $post->id }}"
                                  method="post">
                                @csrf
                                @method("delete")
                            </form>
                            <div class="dropdown my-auto">
                                <button class="btn" type="button" id="dropdownMenuButton" data-toggle="dropdown"
                                        aria-haspopup="true" aria-expanded="false">
                                    <i class="fas fa-ellipsis-h"></i>
                                </button>
                                <div class="dropdown-menu dropdown-menu-right" aria-labelledby="dropdownMenuButton">
                                    <a href="{{ route("post.show",$post->id) }}" class="dropdown-item">View Post</a>
                                    @if(Auth::id()===$post->user_id)
                                        <a href="{{ route('post.edit',$post->id) }}" class="dropdown-item">Edit</a>
                                        <button class="dropdown-item" type="submit" form="del{{ $post->id }}">
                                            Delete
                                        </button>
                                    @endif
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-12">
                            <h5>{{ $post->title }}</h5>
                            <p>{{ $post->description }}</p>
                        </div>
                    </div>
                    <div class="row justify-content-between align-items-center mb-2">
                        <div class="col-4 text-center p-0">
                            <button class="btn w-100" form="like{{ $post->id }}">
                                <i class="fa-lg {{ $post->total_likes->where("user_id",Auth::id())->count()===1?"fas":"far" }} fa-thumbs-up"></i>{{ $post->total_likes->count() }}
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
                        <div class="col-4 text-center p-0 border-right border-left">
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
                    <div class="row">
                        <div class="col-12">
                            <div class="">
                                <form action="{{ route('comment.store') }}" class="justify-content-between"
                                      method="post">
                                    @csrf
                                    <input type="text" name="post_id" class="d-none" value="{{ $post->id }}">
                                    <textarea class="form-control mb-2" name="comment" rows="1"
                                              placeholder="Comment Here..."></textarea>
                                    <button class="btn btn-primary float-right">Comment</button>
                                </form>
                            </div>
                        </div>
                        <div class="col-12">
                            <div class="row h-auto">
                                <div class="col-2 p-0 pl-3">
                                    <img
                                        src="{{ isset($post->post_owner->profile_picture)?asset("storage/profile-picture/".$post->post_owner->profile_picture): asset("storage/profile-picture/default-profile.jpg") }}"
                                        alt=""
                                        class="comment-profile-img h-100 ">
                                </div>
                                <div class="col-10 p-0 pr-3">
                                    <div class="">
                                        <p class="">Some comment here</p>
                                    </div>
                                    <div class="text-right">
                                        <a href="" class="text-black-50 mr-2">Edit</a>
                                        <a href="" class="text-black-50">Delete</a>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="position-fixed back-newsfeed">
            <a href="{{ route("newsfeed") }}" class="h1"><i class="fas fa-chevron-circle-left"></i></a>
        </div>
    </main>
</div>
<script>
    $(document).ready(function () {
        $(".toast").toast("show")
    })
</script>
</body>
</html>
