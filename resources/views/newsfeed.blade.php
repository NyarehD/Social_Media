@extends("layouts.app")
@section("content")
    <div class="container">
        <div class="row">
            <div class="col-8">
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
        $(document).ready(function () {
            $(".toast").toast("show")
            $(".post-carousel").slick({
                slidesToShow: 1,
                slidesToScroll: 1,
                autoplay: false,
                arrows: true,
                dots: true,
                infinite: false,
                left: true,
            })
        })
    </script>

@endsection
