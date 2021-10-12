@extends("layouts.app")
@section("content")
    <div class="container">
        <div class="row">
            <div class="col-8">
                @foreach($posts as $post)
                    <x-post name="{{ $post->name }}" time="{{ Auth::user()->created_at->diffForHumans() }}"
                            post-img-src="{{ asset('storage/post/'.$post->images[0]->filename) }}"></x-post>
                @endforeach
            </div>
            <div class="col-4">
                <a href="{{ route('post.create') }}" class="btn btn-primary">New Post</a>
            </div>
        </div>
    </div>
@endsection
