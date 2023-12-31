@extends('weblayout.app')
@section('title', 'Team')
@section('image', $image)
@section('content')


    <!-- Page Header Start -->
    <div class="container-fluid bg-dark p-5">
        <div class="row">
            <div class="col-12 text-center">
                <h1 class="display-4 text-white">Our Team</h1>
                <a href="{{route ('homepage') }}">Home</a>
                <i class="far fa-square text-primary px-2"></i>
                <a href="">Our Team</a>
            </div>
        </div>
    </div>
    <!-- Page Header End -->


    <!-- Team Start -->
    @if(count($ourTeam)>0)
        <div class="container-fluid py-6 px-5">
            <div class="text-center mx-auto mb-5" style="max-width: 600px;">
                <h1 class="display-5 mb-0">Our Team Members</h1>
                <hr class="w-25 mx-auto bg-primary">
            </div>
            <div class="row g-5">
                @foreach($ourTeam as $key => $team)
                    <div class="col-lg-4">
                        <div class="team-item position-relative overflow-hidden">
                            <img class="img-fluid w-100" src="{{ $team->profile? $team->profile:URL::asset('/resources/assets/img/default.png')}}" alt="{{ $team->profile? $team->profile:URL::asset('/resources/assets/img/default.png')}}" style="height:250px;">
                            <div class="team-text w-100 position-absolute top-50 text-center bg-primary p-4">
                                <h3 class="text-white">{{$team->full_name}}</h3>
                                <p class="text-white text-uppercase mb-0">{{$team->designation}}</p>
                            </div>
                        </div>
                    </div>
                @endforeach
            </div>
        </div>
    @endif
    <!-- Team End -->


   @endsection