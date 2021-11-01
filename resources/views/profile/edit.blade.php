@extends('layouts.app')
@section('content')
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-10 mb-3">
                <div class="card">
                    <p class="card-title h3 text-center my-3 font-weight-bold">Profile Edit</p>
                    <div class="row g-0">
                        <div class="col-md-4">
                            <img
                                src="{{ isset(Auth::user()->profile_picture)?asset("storage/profile-picture/".Auth::user()->profile_picture): asset("storage/profile-picture/default-profile.jpg") }}"
                                class="img-fluid rounded-start" alt="..." id="profile-img">
                            <div class="">
                                <button id="profile-picture-button" class="btn btn-primary w-100"><i
                                        class="fas fa-edit"></i>
                                    Change
                                    Profile
                                    Picture
                                </button>
                                <form action="{{ route("profile.pictureUpdate") }}" id="profile-picture-form"
                                      method="post" enctype="multipart/form-data">
                                    @csrf
                                    <input type="file" name="profile_picture" id="profile-picture-input" class="d-none"
                                           accept="image/jpeg,image/png">
                                </form>

                                @error("profile-photo")
                                <span class="text-danger">{{ $message }}</span>
                                @enderror
                            </div>
                        </div>
                        <div class="col-md-8">
                            <div class="card-body p-0 px-3">
                                <div class="">
                                    <form action="{{ route("profile.update") }}" class="" method="post"
                                          enctype="multipart/form-data">
                                        @csrf
                                        <div class="d-flex justify-content-between align-items-start h-60">
                                            <label for="email" class="h4">Name</label>
                                            <div class="w-75">
                                                <input type="text"
                                                       class="form-control w-100 @error("name") is-invalid @enderror"
                                                       id="name" name="name"
                                                       value="{{ old("name")? old("name"):Auth::user()->name }}">
                                                @error("name")
                                                <span class="text-danger w-100 d-block">{{ $message }}</span>
                                                @enderror
                                            </div>
                                        </div>

                                        <div class="d-flex justify-content-between align-items-start h-60">
                                            <label for="email" class="h4">Email</label>
                                            <div class="w-75">
                                                <input type="text"
                                                       class="form-control w-100 @error("email") is-invalid @enderror"
                                                       id="email" name="email"
                                                       value="{{ old("email")? old("email"):Auth::user()->email }}">
                                                @error("email")
                                                <span class="text-danger w-100 d-block">{{ $message }}</span>
                                                @enderror
                                            </div>
                                        </div>

                                        <div style="height: 160px">
                                            <label for="bio" class="h4">Bio</label>
                                            <textarea name="bio" id="bio" cols="30" rows="4"
                                                      class="form-control mb-2">{{ old("bio") ? old("bio") : ( Auth::user()->bio ? Auth::user()->bio: "Add your bio here ...") }}
                                            </textarea>
                                            @error("bio")
                                            <span class="text-danger">{{ $message }}</span>
                                            @enderror
                                        </div>
                                        <div class="d-flex justify-content-end">
                                            <a href="{{ route('profile',Auth::id()) }}"
                                               class="btn btn-outline-secondary mr-2">Back</a>
                                            <button class="btn btn-primary ">Update</button>
                                        </div>
                                    </form>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-10">
                <div class="row">
                    <div class="col-6">
                        <div class="card">
                            <div class="card-body">
                                <h4 class="card-title">Social Links</h4>
                                <form action="{{ route('profile.socialUpdate') }}" method="post">
                                    @csrf
                                    <div class="form-group">
                                        <label for="facebook">Facebook Link</label>
                                        <input type="text" id="facebook" name="facebook_link"
                                               class="form-control @error("facebook_link") is-invalid @enderror"
                                               value="{{ old("facebook_link")? old("facebook_link"):Auth::user()->facebook_link}}">
                                        @error("facebook_link")
                                        <span class="text-danger w-100 d-block">{{ $message }}</span>
                                        @enderror
                                    </div>
                                    <div class="form-group">
                                        <label for="github">Github Link</label>
                                        <input type="text" id="github" name="github_link"
                                               class="form-control @error("github_link") is-invalid @enderror"
                                               value="{{ old("github_link")? old("github_link"):Auth::user()->github_link}}">
                                        @error("github_link")
                                        <span class="text-danger w-100 d-block">{{ $message }}</span>
                                        @enderror
                                        @error("*")
                                        <span class="text-danger w-100 d-block">{{ $message }}</span>
                                        @enderror
                                    </div>
                                    <div class="form-group">
                                        <label for="twitter">Twitter Link</label>
                                        <input type="text" id="twitter" name="twitter_link"
                                               class="form-control @error("twitter_link") is-invalid @enderror"
                                               value="{{ old("twitter_link")? old("twitter_link"):Auth::user()->twitter_link}}">
                                        @error("twitter_link")
                                        <span class="text-danger w-100 d-block">{{ $message }}</span>
                                        @enderror
                                    </div>
                                    <button class="btn btn-block btn-primary">Update</button>
                                </form>
                            </div>
                        </div>
                    </div>
                </div>
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
@endsection
@section("script")
    <script>
        $("document").ready(function () {
            $("#profile-picture-button").on("click", function (event) {
                event.preventDefault();
                $("#profile-picture-input").click();
            })
            $("#profile-picture-input").on("change", function (event) {
                event.preventDefault();
                $("#profile-picture-form").submit();
            })
        })
    </script>
@endsection
