<div class="card-body py-1">
    <div class="row justify-content-between align-items-center px-3 py-2">
        <div class="d-flex align-items-center">
            <div class="mr-2">
                <a href="{{ route('profile',$post->owner->id) }}" class="">
                    <img
                        src="{{ asset("storage/profile-picture/".$post->owner->profile_picture) }}"
                        alt=""
                        class="post-profile-img h-100 rounded-pill">
                </a>
            </div>
            <div class="">
                @isset($post->original_post_id)
                    <a href="{{ route('profile',$post->owner->id) }}"
                       class="h4">{{ $post->owner->name }}</a>
                    <p class="mb-0"> shared <a
                            href="{{ route('profile',$post->original_post->owner->id) }}">{{$post->original_post->owner->name}}</a>'s
                        <a href="{{ route('post.show',$post->original_post->id) }}">post</a></p>
                @else
                    <a href="{{ route('profile',$post->owner->id) }}"
                       class="h4">{{ $post->owner->name }}</a>
                @endisset
                <h6>{{ $post->created_at->diffForHumans() }}</h6>
            </div>
        </div>
        <div class="mr-2 post-dropdown-container">
            <div class="dropdown my-auto">
                <button class="btn" type="button" id="dropdownMenuButton"
                        data-toggle="dropdown"
                        aria-haspopup="true" aria-expanded="false">
                    <i class="fas fa-ellipsis-h"></i>
                </button>
                <div class="dropdown-menu dropdown-menu-right"
                     aria-labelledby="dropdownMenuButton">
                    <a href="{{ route("post.show",$post->id) }}" class="dropdown-item">View
                        Post</a>
                    @if(Auth::id()===$post->user_id)
                        <form action="{{ route("post.destroy", $post->original_post->id) }}"
                              id="del{{ $post->original_post->id }}"
                              method="post">
                            @csrf
                            @method("delete")
                        </form>
                        <a href="{{ route('post.edit',$post->id) }}"
                           class="dropdown-item">Edit</a>
                        <button class="dropdown-item" type="submit"
                                form="del{{ $post->id }}">
                            Delete
                        </button>
                    @endif
                </div>
            </div>
        </div>
    </div>
</div>
