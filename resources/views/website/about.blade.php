@extends('weblayout.app')
@section('title', 'About Us')
@section('image', $image)
@section('content')


    <!-- Page Header Start -->
    <div class="container-fluid bg-dark p-5">
        <div class="row">
            <div class="col-12 text-center">
                <h1 class="display-4 text-white">About Us</h1>
                <a href="{{route ('homepage') }}">Home</a>
                <i class="far fa-square text-primary px-2"></i>
                <a href="">About</a>
            </div>
        </div>
    </div>
    <!-- Page Header End -->


    <!-- About Start -->
    <div class="container-fluid bg-secondary p-0">
        <div class="row g-0">
            <div class="col-lg-6 py-6 px-5">
                <h1 class="display-5 mb-4">Welcome To <span class="text-primary">CONSULT</span></h1>
                <h4 class="text-primary mb-4">Diam dolor diam ipsum sit. Clita erat ipsum et lorem stet no lorem sit clita duo justo magna dolore</h4>
                <p class="mb-4">Et stet ipsum nonumy rebum eos justo, accusam invidunt aliquyam stet magna at et sanctus, vero sea sit amet dolores, sit dolor duo invidunt dolor, kasd rebum consetetur diam invidunt erat stet. Accusam nonumy lorem kasd eirmod. Justo clita sadipscing ea invidunt rebum sadipscing consetetur. Amet diam amet amet sanctus sanctus invidunt erat ipsum eirmod.</p>
                <a href="" class="btn btn-primary py-md-3 px-md-5 rounded-pill">Get A Quote</a>
            </div>
            <div class="col-lg-6">
                <div class="h-100 d-flex flex-column justify-content-center bg-primary p-5">
                    <div class="d-flex text-white mb-5">
                        <div class="d-flex flex-shrink-0 align-items-center justify-content-center bg-white text-primary rounded-circle mx-auto mb-4" style="width: 60px; height: 60px;">
                            <i class="fa fa-user-tie fs-4"></i>
                        </div>
                        <div class="ps-4">
                            <h3>Business Planning</h3>
                            <p class="mb-0">Tempor erat elitr rebum at clita. Diam dolor ipsum amet eos erat ipsum lorem et sit sed stet lorem sit clita duo</p>
                        </div>
                    </div>
                    <div class="d-flex text-white mb-5">
                        <div class="d-flex flex-shrink-0 align-items-center justify-content-center bg-white text-primary rounded-circle mx-auto mb-4" style="width: 60px; height: 60px;">
                            <i class="fa fa-chart-line fs-4"></i>
                        </div>
                        <div class="ps-4">
                            <h3>Financial Analaysis</h3>
                            <p class="mb-0">Tempor erat elitr rebum at clita. Diam dolor ipsum amet eos erat ipsum lorem et sit sed stet lorem sit clita duo</p>
                        </div>
                    </div>
                    <div class="d-flex text-white">
                        <div class="d-flex flex-shrink-0 align-items-center justify-content-center bg-white text-primary rounded-circle mx-auto mb-4" style="width: 60px; height: 60px;">
                            <i class="fa fa-balance-scale fs-4"></i>
                        </div>
                        <div class="ps-4">
                            <h3>legal Advisory</h3>
                            <p class="mb-0">Tempor erat elitr rebum at clita. Diam dolor ipsum amet eos erat ipsum lorem et sit sed stet lorem sit clita duo</p>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!-- About End -->


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
            <!-- <div class="col-lg-4">
                <div class="team-item position-relative overflow-hidden">
                    <img class="img-fluid w-100" src="{{ URL::asset('/resources/assets/website/img/team-2.jpg')}}" alt="">
                    <div class="team-text w-100 position-absolute top-50 text-center bg-primary p-4">
                        <h3 class="text-white">Full Name</h3>
                        <p class="text-white text-uppercase mb-0">Designation</p>
                    </div>
                </div>
            </div>
            <div class="col-lg-4">
                <div class="team-item position-relative overflow-hidden">
                    <img class="img-fluid w-100" src="{{ URL::asset('/resources/assets/website/img/team-3.jpg')}}" alt="">
                    <div class="team-text w-100 position-absolute top-50 text-center bg-primary p-4">
                        <h3 class="text-white">Full Name</h3>
                        <p class="text-white text-uppercase mb-0">Designation</p>
                    </div>
                </div>
            </div> -->
        @endforeach
        </div>
    </div>
    @endif
    <!-- Team End -->
    @endsection