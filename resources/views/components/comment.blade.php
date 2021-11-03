<div class="row h-auto mb-2 comment" id="comment-{{$comment->id}}">
    <div class="col-3 p-0 pl-3">
        <a href="{{ route('profile',$comment->owner->id) }}" class="d-flex justify-content-start">
            <img
                src="{{asset("storage/profile-picture/".$comment->owner->profile_picture) }}"
                alt=""
                class="comment-profile-img h-100 rounded-pill">
        </a>
    </div>
    <div class="col-9 px-0 pr-3">
        <div class="">
            <a class="mb-0 font-weight-bold"
               href="{{ route('profile',$comment->owner->id) }}">{{ $comment->owner->name}}</a>
            <p class="mb-0" id="comment-text-{{$comment->id}}">{{ $comment->comment }}</p>
            @if(Auth::id()==$comment->owner->id)
                <div class="text-right comment-options">
                    <button class="text-black-50 mr-2 comment-button btn btn-link" id="comment-button-{{$comment->id}}"
                            data-comment-id="{{$comment->id}}">Edit
                    </button>
                    <button class="text-black-50 btn btn-link" form="del{{$comment->id}}"
                            onclick="return confirm('Are you sure you want to delete this comment?')">Delete
                    </button>
                    <form action="{{ route('comment.destroy',$comment->id) }}"
                          class="d-none"
                          id="del{{$comment->id}}" method="post">
                        @csrf
                        @method("delete")
                    </form>
                </div>
            @endif
        </div>
    </div>
</div>
