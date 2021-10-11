@extends('layouts.app')
@section('content')
    <div class="container">
        <div class="row justify-content-center">
          <div class="col-10">
              <div class="card mb-3">
                  <div class="row g-0">
                      <div class="col-md-4">
                          <img
                              src="{{ isset(Auth::user()->profile_picture)?asset("storage/profile-picture/".Auth::user()->profile_picture): asset("storage/profile-picture/default-profile.jpg") }}"
                              class="img-fluid rounded-start" alt="..." id="profile-img">
                      </div>
                      <div class="col-md-8">
                          <div class="card-body d-flex justify-content-between flex-column h-100 pb-0">
                              <div class="">
                                  <h1 class="card-title font-weight-bold">{{ Auth::user()->name }}</h1>
                                  <h2 class="font-weight-normal">{{ Auth::user()->email }}</h2>
                                  <h5 class="text-black-50">{{ isset(Auth::user()->bio) ? Auth::user()->bio : "Add your bio here ..." }}</h5>
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
                                              at {{ Auth::user()->created_at->format("d M Y") }} </h6>
                                      </div>
                                      <div class="col-2">
                                          <a href="{{ route("profile.edit") }}" class="btn btn-primary" id="edit" title="Edit Profile"><i
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
    </div>
@endsection
@section("script")
    <script>

    </script>
@endsection
