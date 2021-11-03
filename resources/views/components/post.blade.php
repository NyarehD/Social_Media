<div class="card post mb-3" id="{{ $post->id }}">
    <x-post-profile-detail :post=$post></x-post-profile-detail>
    {{--  Show the post description--}}
    <div class="card-body py-1">
        @isset($post->description)
            <p class="">{{$post->description}}</p>
        @endisset
    </div>
    {{--If the post is a original post, show the photoes of the post--}}
    {{-- If not, show the photos of the original post --}}
    @empty($post->original_post_id)
        {{--        Checked with equal to not show the when there is not photo for post--}}
        @if(count($post->post_photos)==1)
            <img class="card-img-top"
                 src="{{ asset("storage/post/".$post->post_photos[0]->filename) }}"
                 alt="Card image cap">
        @elseif(count($post->post_photos)>1)
            <div class="post-carousel">
                @foreach($post->post_photos as $image)
                    <div class="">
                        <img class="card-img" src="{{ asset("storage/post/".$image->filename) }}"
                             alt="Card image cap">
                    </div>
                @endforeach
            </div>
        @endif
    @else
        @if(count($post->original_post->post_photos)==1)
            <img class="card-img-top"
                 src="{{ asset("storage/post/".$post->original_post->post_photos[0]->filename) }}"
                 alt="Card image cap">
        @elseif(count($post->original_post->post_photos)>1)
            <div class="post-carousel">
                @foreach($post->original_post->post_photos as $image)
                    <div class="">
                        <img class="card-img" src="{{ asset("storage/post/".$image->filename) }}"
                             alt="Card image cap">
                    </div>
                @endforeach
            </div>
        @endif
    @endempty
    {{--  If the post is shared post, show the original post details--}}
    @isset($post->original_post_id)
        <div class="card mx-2 mb-2 rounded-bottom">
            <x-post-profile-detail :post="$post->original_post"></x-post-profile-detail>
            <div class="card-body py-1">
                <p class="">{{ substr($post->original_post->description,1,190) }}
                    ...&nbsp;&nbsp; <a
                        href="{{ route("post.show",$post->original_post->id) }}">See
                        more</a>
                </p>
            </div>
        </div>
    @endisset
    <div class="p-2 card-body">
        <div class="row justify-content-between align-items-center">
            <div class="col-4 text-center">
                <button class="btn w-100" form="like{{ $post->id }}">
                    <i class="fa-lg {{ $post->total_likes->where("user_id",Auth::id())->count()===1?"fas":"far" }} fa-thumbs-up mr-2"></i>{{ $post->total_likes->count() }}
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
            <div class="col-4 text-center">
                <a class="btn w-100" href="{{ route('post.show',$post->id) }}">
                    <i class="far fa-lg fa-comment-alt mr-2"></i>{{ $post->comments->count() }}  {{ $post->comments->count()>1?"Comments": "Comment"}}
                </a>
            </div>
            {{-- If the post is original_post, add the button to share post--}}
            @empty($post->original_post)
                <div class="col-4 text-center">
                    <!-- Button trigger share modal-->
                    <button type="button" class="btn w-100" data-toggle="modal"
                            data-target="#shareModal{{$post->id}}">
                        <i class="fas fa-lg fa-share mr-2"></i> Share
                    </button>
                    <!-- Share Modal -->
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
    </div>
</div>
