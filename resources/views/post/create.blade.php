@extends('layouts.app')
@section('content')
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-8">
                <div class="card mb-3 p-3">
                    <form action="{{ route('post.store') }}" class="" enctype="multipart/form-data" method="post">
                        @csrf
                        <h3 class="card-title text-center text-primary font-weight-bold">Add Post</h3>
                        <div class="mb-2">
                            <label for="description" class="h3">Description</label>
                            <textarea name="description" id="description" cols="30" rows="10"
                                      class="form-control @error("title") is-invalid @enderror">{{ old("description") }}</textarea>
                            @error("description")
                            <span class="text-danger">{{ $message }}</span>
                            @enderror
                        </div>
                        <div class="mb-2 d-flex justify-content-between">
                            <div class="">
                                <input type="file" class="form-control-file" name="post-img[]"
                                       accept="image/jpeg,image/png" multiple>
                                @error("post-img.*")
                                <span class="text-danger">{{ $message }}</span>
                                @enderror
                            </div>
                            <button type="submit" class="btn btn-primary"><i class="fas fa-plus-circle"></i> Add Post
                            </button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
@endsection
@section("script")
    <script>

    </script>
@endsection
