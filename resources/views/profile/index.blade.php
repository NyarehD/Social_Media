@extends('layouts.app')
@section('content')
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-12">
                <div class="card mb-3">
                    <div class="row g-0">
                        <div class="col-md-4">
                            <img
                                src="{{ isset($user->profile_picture)?asset("storage/profile-picture/".$user->profile_picture): asset("storage/profile-picture/default-profile.jpg") }}"
                                class="img-fluid rounded-start" alt="..." id="profile-img">
                        </div>
                        <div class="col-md-8">
                            <div class="card-body d-flex justify-content-between flex-column h-100 pb-0">
                                <div class="">
                                    <h1 class="card-title font-weight-bold">{{ $user->name }}</h1>
                                    <h5 class="text-black-50">{{ $user->bio ?? "Add your bio here ..." }}</h5>
                                </div>
                                <div class="">
                                    <div class="row align-items-center">
                                        <div class="col-10">
                                            <div class="social-link d-inline">
                                                <a href="#" class="mr-2">Facebook</a>
                                                <a href="#" class="mr-2">Github</a>
                                                <a href="#" class="mr-2">Twitter</a>
                                            </div>
                                            <h6 class=""><i class="fas fa-birthday-cake mr-2 text-primary"></i>Joined
                                                at {{ $user->created_at->format("d M Y") }} </h6>
                                        </div>
                                        <div class="col-2">
                                            @if(Auth::id()===$user->id)
                                                <a href="{{ route("profile.edit") }}" class="btn btn-primary" id="edit"
                                                   title="Edit Profile"><i
                                                        class="fas fa-pen-fancy"></i> </a>
                                            @endif
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="row">
            <div class="col-8">
                @foreach($post_by_user as $post)
                    <x-post :post="$post"></x-post>
                @endforeach
            </div>
            <div class="col-4">
                <div class="card">
                    <div class="card-body">
                        <label for="search" class="">Search</label>
                        <form action="{{ route("profile",Auth::id()) }}">
                            <input type="text" id="search" class="form-control mb-2" name="search"
                                   value="{{ request()->search }}">
                            <button type="submit" class="btn btn-primary float-right"><i class="fas fa-search"></i>
                                Search
                            </button>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
@section("script")
    <script>

    </script>
@endsection
