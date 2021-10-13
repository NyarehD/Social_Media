<div class="card post mb-3">

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
    <div class="card-body">
        <div class="row justify-content-between align-items-center">
            <div class="col-4 text-center">
                <i class="far fa-lg fa-thumbs-up"></i> Likes
            </div>
            <div class="col-4 text-center">
                <i class="far fa-lg fa-comment-alt"></i> Comment
            </div>
            <div class="col-4 text-center">
                <i class="fas fa-lg fa-share"></i> Share
            </div>
        </div>
    </div>
</div>
