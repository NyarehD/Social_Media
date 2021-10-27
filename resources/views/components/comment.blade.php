<div class="row h-auto mb-2 comment">
    <div class="col-3 p-0 pl-3">
        <a href="{{ route('profile',$comment->comment_owner->id) }}" class="">
            <img
                src="{{asset("storage/profile-picture/".$comment->comment_owner->profile_picture) }}"
                alt=""
                class="comment-profile-img h-100 rounded-pill">
        </a>
    </div>
    <div class="col-7 px-0 pr-3">
        <div class="">
            <a class="mb-0 font-weight-bold"
               href="{{ route('profile',$comment->comment_owner->id) }}">{{ $comment->comment_owner->name}}</a>
            <p class="mb-0">{{ $comment->comment }}</p>
        </div>
    </div>
    @if(Auth::id()==$comment->comment_owner->id)
        <div class="col-2 comment-options">
            <div class="dropdown my-auto">
                <button class="btn" type="button" id="dropdownMenuButton" data-toggle="dropdown"
                        aria-haspopup="true" aria-expanded="false">
                    <i class="fas fa-ellipsis-h"></i>
                </button>
                <div class="dropdown-menu dropdown-menu-right" aria-labelledby="dropdownMenuButton">
                    <a href="{{ route('comment.edit',$comment->id) }}" class="dropdown-item">Edit</a>
                    <button form="comment{{$comment->id}}" class="dropdown-item">Delete</button>
                    <form action="{{ route('comment.destroy',$comment->id) }}"
                          class="d-none"
                          id="comment{{$comment->id}}" method="post">
                        @csrf
                        @method("delete")
                    </form>
                </div>
            </div>
        </div>
    @endif
</div>
