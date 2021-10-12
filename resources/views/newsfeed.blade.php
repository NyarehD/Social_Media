@extends("layouts.app")
@section("content")
<div class="container">
    <div class="row">
        <div class="col-8">

        </div>
        <div class="col-4">
            <a href="{{ route('post.create') }}" class="btn btn-primary">New Post</a>
        </div>
    </div>
</div>
@endsection
