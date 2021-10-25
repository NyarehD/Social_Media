@extends("layouts.app")
@section("content")
    <div class="container py-2">
        <div class="row">
            <div class="col-8" id="newsfeed-post-container">
                @foreach($posts as $post)
                    <x-post :post="$post"></x-post>
                @endforeach
            </div>
            <div class="col-4">
                <a href="{{ route('post.create') }}" class="btn btn-primary">New Post</a>
            </div>
        </div>
    </div>
@endsection
@section("script")
    <script>

    </script>
@endsection
