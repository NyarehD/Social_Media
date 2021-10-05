@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="row justify-content-center">
            <div class="card mb-3" style="max-width: 80%">
                <div class="row g-0">
                    <div class="col-md-4">
                        <img src="{{ asset("storage/profile-picture/".Auth::user()->profile_picture) }}"
                             class="img-fluid rounded-start" alt="...">
                        <div class="">
                            <a id="profile-upload" class="btn btn-primary w-100"><i class="fas fa-edit"></i> Change
                                Profile
                                Picture</a>
                        </div>
                    </div>
                    <div class="col-md-8">
                        <div class="card-body d-flex justify-content-between flex-column h-100 pb-0">
                            <div class="">
                                <h1 class="card-title font-weight-bold">{{ Auth::user()->name }}</h1>
                                <h2 class="font-weight-normal">{{ Auth::user()->email }}</h2>
                                <h5 class="text-black-50">{{ isset(Auth::user()->bio) ? Auth::user()->bio : "Add your bio here ..." }}</h5>
                            </div>
                            <div class="">
                                <div class="row">
                                    <div class="col-10">
                                        <div class="social-link d-inline">
                                            <a href="#" class="mr-2">Facebook</a>
                                            <a href="#" class="mr-2">Github</a>
                                            <a href="#" class="mr-2">Twitter</a>
                                        </div>
                                        <h6 class=""><i class="fas fa-birthday-cake mr-2 text-primary"></i>Joined
                                            at {{ Auth::user()->created_at->format("d M Y") }} </h6>
                                    </div>
                                    <div class="col-2">
                                        <a href="#" class="btn btn-primary" title="Edit Profile"><i
                                                class="fas fa-pen-fancy"></i> </a>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection

@section("script")
    <script>
        let but = document.getElementById("profile-upload");
        let fileUpload = document.getElementById("file-upload-button");
        but.addEventListener("click",function (event){
            event.preventDefault();
            fileUpload.click()
        })
        fileUpload.addEventListener("change",function (event) {
            document.getElementById("profileUploadBut").click();
        })
    </script>
@endsection
