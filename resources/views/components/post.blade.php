<div class="card post mb-3" id="{{ $post->id }}">
    <div class="card-body py-1">
        <div class="row justify-content-between align-items-center px-3 py-2">
            <div class="d-flex align-items-center">
                <div class="mr-2">
                    <a href="{{ route('profile',$post->post_owner->id) }}" class="">
                        <img
                            src="{{ isset($post->post_owner->profile_picture)?asset("storage/profile-picture/".$post->post_owner->profile_picture): asset("storage/profile-picture/default-profile.jpg") }}"
                            alt=""
                            class="post-profile-img h-100 ">
                    </a>
                </div>
                <div class="">
                    <a href="{{ route('profile',$post->post_owner->id) }}"
                       class="h4">{{ $post->post_owner->name }}</a>
                    <h6>{{ $post->created_at->diffForHumans() }}</h6>
                </div>
            </div>
            <div class="mr-2 post-dropdown-container">
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
    </div>
    <div class="card-body py-0">
        <h5>{{ $post->title }}</h5>
        @if(strlen($post->description)>190)
            <p class="">{{ substr($post->description,0,190) }} ...&nbsp;&nbsp; <a
                    href="{{ route("post.show",$post) }}">See
                    more</a></p>
        @else
            <p>{{ $post->description }}</p>
        @endif
    </div>
    @if(count($post->images)==1)
        <img class="card-img-top" src="{{ asset("storage/post/".$post->images[0]->filename) }}"
             alt="Card image cap">
    @else
        <div class="post-carousel">
            @foreach($post->images as $image)
                <div class="">
                    <img class="card-img" src="{{ asset("storage/post/".$image->filename) }}" alt="Card image cap">
                </div>
            @endforeach
        </div>
    @endif
    <div class="p-2 card-body">
        <div class="row justify-content-between align-items-center">
            <div class="col-4 text-center">
                <button class="btn w-100" form="like{{ $post->id }}">
                    <i class="fa-lg {{ $post->total_likes->count()==1?"fas":"far" }} fa-thumbs-up"></i>{{ $post->total_likes->count() }}
                    {{ $post->total_likes->count()>1?"Likes":"Like" }}
                </button>
                @error("post_id")
                <div role="alert" aria-live="assertive" aria-atomic="true" class="toast postIdToast"
                     data-autohide="false">
                    <div class="toast-header">
                        <strong>{{ $message }}</strong>
                        <button type="button" class="ml-2 mb-1 close" data-dismiss="toast" aria-label="Close">
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
            <div class="col-4 text-center">
                <button class="btn w-100">
                    <i class="far fa-lg fa-comment-alt"></i> Comment
                </button>
            </div>
            <div class="col-4 text-center">
                <button class="btn w-100">
                    <i class="fas fa-lg fa-share"></i> Share
                </button>
            </div>
        </div>
    </div>
</div>
