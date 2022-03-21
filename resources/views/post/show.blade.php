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
<body class="">
<div id="app" class="">
    <main class="">
        <div class="container-fluid p-0 show-post h-100">
            <div class="row">
                <div class="col-9 p-0 bg-light overflow-hidden">
                    @if($post->original_post==null)
                        @if(count($post->post_photos)==1)
                            <img class="card-img-top show-post-not-carousel"
                                 src="{{ asset("storage/post/".$post->post_photos[0]->filename) }}"
                                 alt="Card image cap">
                        @else
                            <div class="show-post-carousel">
                                @foreach($post->post_photos as $image)
                                    <div class="">
                                        <img class="card-img" src="{{ asset("storage/post/".$image->filename) }}"
                                             alt="Card image cap">
                                    </div>
                                @endforeach
                            </div>
                        @endif
                    @else
                        @if(count($post->post_photos)==1)
                            <img class="card-img-top show-post-not-carousel"
                                 src="{{ asset("storage/post/".$post->original_post->images[0]->filename) }}"
                                 alt="Card image cap">
                        @else
                            <div class="show-post-carousel">
                                @foreach($post->original_post->post_photos as $image)
                                    <div class="">
                                        <img class="card-img" src="{{ asset("storage/post/".$image->filename) }}"
                                             alt="Card image cap">
                                    </div>
                                @endforeach
                            </div>
                        @endif
                    @endif
                </div>
                <div class="col-3 py-2  card overflow-auto vh-100">
                    <div class="row">
                        <div class="col-10 d-flex align-items-center mb-2">
                            <a href="{{ route('profile',$post->owner->id) }}" class="">
                                <img
                                    src="{{ asset("storage/profile-picture/".$post->owner->profile_picture) }}"
                                    alt=""
                                    class="post-profile-img h-100 rounded-pill">
                            </a>
                            <div class="ml-2">
                                <a href="{{ route('profile',$post->owner->id) }}"
                                   class="h4">{{ $post->owner->name }}</a>
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
                            <div role="alert" aria-live="assertive" aria-atomic="true" class="toast fixedToast"
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
                        @empty($post->original_post)
                            <div class="col-4 text-center">
                                <!-- Button trigger modal-->
                                <button type="button" class="btn w-100" data-toggle="modal"
                                        data-target="#shareModal{{$post->id}}">
                                    <i class="fas fa-lg fa-share mr-2"></i> Share
                                </button>
                                <!-- Modal -->
                                <div class="modal fade" id="shareModal{{$post->id}}" tabindex="-1" role="dialog"
                                     aria-labelledby="exampleModalLabel" aria-hidden="true">
                                    <div class="modal-dialog modal-dialog-centered" role="document">
                                        <div class="modal-content">
                                            <div class="modal-header">
                                                <h5 class="modal-title" id="exampleModalLabel">
                                                    Share {{$post->owner->name }}'s post</h5>
                                                <button type="button" class="close" data-dismiss="modal"
                                                        aria-label="Close">
                                                    <span aria-hidden="true">&times;</span>
                                                </button>
                                            </div>
                                            <div class="modal-body">
                                                <form action="{{ route('post.share',$post->id) }}"
                                                      id="share{{$post->id}}"
                                                      method="post">
                                                    @csrf
                                                    <div class="form-group">
                                                        <label for="description"
                                                               class="h3 float-left">Description</label>
                                                        <input type="text" class="form-control"
                                                               name="description">
                                                    </div>
                                                </form>
                                            </div>
                                            <div class="modal-footer">
                                                <button type="button" class="btn btn-secondary"
                                                        data-dismiss="modal">Cancel
                                                </button>
                                                <button type="submit" class="btn btn-primary"
                                                        form="share{{$post->id}}">
                                                    Share <i class="fas fa-lg fa-share"></i>
                                                </button>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        @endempty
                    </div>
                    <div class="row comments-container">
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
                        <div class="col-12 overflow-auto comments h-100">
                            @foreach($post->comments as $comment)
                                <div class="row h-auto mb-2 comment" id="comment-{{$comment->id}}">
                                    <div class="col-3 p-0 pl-3">
                                        <a href="{{ route('profile',$comment->user_id) }}"
                                           class="d-flex justify-content-start">
                                            <img
                                                src="{{asset("storage/profile-picture/".$comment->comment_owner->profile_picture) }}"
                                                alt=""
                                                class="comment-profile-img h-100 rounded-pill">
                                        </a>
                                    </div>
                                    <div class="col-9 px-0 pr-3">
                                        <div class="">
                                            <a class="mb-0 font-weight-bold"
                                               href="{{ route('profile',$comment->comment_owner->id) }}">{{ $comment->comment_owner->name}}</a>
                                            <p class="mb-0"
                                               id="comment-text-{{$comment->id}}">{{ $comment->comment }}</p>
                                            @if(Auth::id()==$comment->comment_owner->id)
                                                <div class="text-right comment-options">
                                                    <!-- Button trigger modal for editing comment-->
                                                    <button type="button"
                                                            class="btn btn-link text-black-50 mr-2 comment-button"
                                                            data-toggle="modal"
                                                            data-target="#commentModal{{$comment->id}}">
                                                        Edit
                                                    </button>

                                                    <!-- Modal for editing comment-->
                                                    <div class="modal" id="commentModal{{$comment->id}}"
                                                         tabindex="1" style="z-index: 100000000"
                                                         role="dialog" aria-labelledby="exampleModalCenterTitle"
                                                         aria-hidden="true">
                                                        <div class="modal-dialog modal-dialog-centered" role="document">
                                                            <div class="modal-content">
                                                                <div class="modal-header">
                                                                    <h5 class="modal-title" id="exampleModalLongTitle">
                                                                        Edit Comment</h5>
                                                                    <button type="button" class="close"
                                                                            data-dismiss="modal" aria-label="Close">
                                                                        <span aria-hidden="true">&times;</span>
                                                                    </button>
                                                                </div>
                                                                <div class="modal-body">
                                                                    <form
                                                                        action="{{ route('comment.update',$comment->id) }}"
                                                                        method="post"
                                                                        id="commentUpdateForm{{$comment->id}}">
                                                                        @csrf
                                                                        @method("put")
                                                                        <input type="text" name="edited_comment"
                                                                               class="form-control"
                                                                               value="{{$comment->comment}}">
                                                                    </form>
                                                                </div>
                                                                <div class="modal-footer">
                                                                    <button type="button" class="btn btn-secondary"
                                                                            data-dismiss="modal">Cancel
                                                                    </button>
                                                                    <button type="submit" class="btn btn-primary"
                                                                            form="commentUpdateForm{{$comment->id}}">
                                                                        Update Comment
                                                                    </button>
                                                                </div>
                                                            </div>
                                                        </div>
                                                    </div>
                                                    <button class="text-black-50 btn btn-link"
                                                            form="delCom{{$comment->id}}"
                                                            onclick="return confirm('Are you sure you want to delete this comment?')">
                                                        Delete me
                                                    </button>
                                                    <form action="{{route("comment.destroy",$comment->id)}}"
                                                          class="d-none"
                                                          id="delCom{{$comment->id}}" method="post">
                                                        @csrf
                                                        @method("delete")
                                                    </form>
                                                </div>
                                            @endif
                                        </div>
                                    </div>
                                </div>
                            @endforeach
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="position-fixed back-newsfeed">
            <a href="{{ route("newsfeed") }}" class="h1"><i class="fas fa-chevron-circle-left"></i></a>
        </div>
        {{--        Toast for comment deleting--}}
        @if(session("message"))
            <div role="alert" aria-live="assertive" aria-atomic="true" class="toast fixedToast"
                 data-autohide="false">
                <div class="toast-header">
                    <strong>{{ session("message")}}</strong>
                    <button type="button" class="ml-2 mb-1 close" data-dismiss="toast" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
            </div>
        @endif
    </main>
</div>
<script>
    $(document).ready(function () {
        $(".toast").toast("show");
    })
</script>
</body>
</html>
