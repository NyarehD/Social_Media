@extends("layouts.app")
@section("content")
    <div class="container py-2">
        <div class="row">
            <div class="col-8" id="newsfeed-post-container">
                @foreach($posts as $post)
                    <x-post :post=$post></x-post>
                @endforeach
            </div>
            <div class="col-4">
                <a href="{{ route('post.create') }}" class="btn btn-primary">New Post</a>
            </div>
        </div>
    </div>
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
    @error("title")
    <x-error-toast message="{{$message}}"></x-error-toast>
    @enderror
    @error("description")
    <x-error-toast message="{{$message}}"></x-error-toast>
    @enderror
@endsection
@section("script")
    <script>

    </script>
@endsection
