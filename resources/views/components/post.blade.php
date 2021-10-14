<div class="card post mb-3">
    {{--    {{ dd($post->totalLikes->where("user_id",Auth::id())->count()==0) }}--}}

    <div class="card-body py-1">
        <div class="row justify-content-between align-items-center">
            <div class="col-4 d-flex align-items-center">
                <img src="{{ asset("storage/profile-picture/default-profile.jpg") }}" alt=""
                     class="post-profile-img h-100">
                <div class="">
                    <h4 class="mb-0">{{ $post->post_owner->name  }}</h4>
                    <h6>{{ $post->created_at->diffForHumans() }}</h6>
                </div>
            </div>
            <div class="col-4">
                <a href="{{ route('post.edit',$post->id) }}" class="btn btn-primary">Edit</a>
                <button class="btn btn-danger" type="submit" form="del{{ $post->id }}">
                    Delete
                </button>
                <form action="{{ route("post.destroy", $post->id) }}"
                      id="del{{ $post->id }}"
                      method="post">
                    @csrf
                    @method("delete")
                </form>
            </div>
        </div>
    </div>
    <div class="card-body">
        <h5>{{ $post->title }}</h5>
        <p>{{ $post->description }}</p>
    </div>
    <img class="card-img-top" src="{{ "storage/post/".$post->images[0]->filename }}" alt="Card image cap">
    <div class="p-2 card-body">
        <div class="row justify-content-between align-items-center">
            <div class="col-4 text-center">
                <button class="btn w-100" form="like{{ $post->id }}">
                    <i class="fa-lg {{ $post->totalLikes->where("user_id",Auth::id())->count()==1?"fas":"far" }} fa-thumbs-up"></i>{{ $post->totalLikes->count() }}
                    Likes
                </button>
                @error("post_id")
                {{ $message }}
                @enderror
                @error("user_id")
                {{$message}}
                @enderror
                <form
                    action="{{ $post->totalLikes->where("user_id",Auth::id())->count()==1?route("like.unlike",$post->id):route("like.like") }}"
                    id="like{{$post->id}}" method="post">
                    @csrf
                    <input type="text" name="post_id" value="{{ $post->id }}" class="d-none">
                    <input type="text" class="d-none" name="user_id" value="{{ Auth::id() }}">
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
