<div class="card post mb-3">
    <div class="card-body py-1">
        <div class="row">
            <div class="col-4 d-flex align-items-center">
                <img src="{{ asset("storage/profile-picture/default-profile.jpg") }}" alt=""
                     class="post-profile-img h-100">
                <div class="">
                    <h4 class="mb-0">{{ $name  }}</h4>
                    <h5>{{ $created_time }}</h5>
                </div>
            </div>
        </div>
    </div>
    <img class="card-img-top" src="{{ $post_img_src }}" alt="Card image cap">
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
