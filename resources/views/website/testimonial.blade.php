@extends('weblayout.app')
@section('title', 'Testimonial')
@section('content')


    <!-- Page Header Start -->
    <div class="container-fluid bg-dark p-5">
        <div class="row">
            <div class="col-12 text-center">
                <h1 class="display-4 text-white">Testimonial</h1>
                <a href="{{route ('homepage') }}">Home</a>
                <i class="far fa-square text-primary px-2"></i>
                <a href="">Testimonial</a>
            </div>
        </div>
    </div>
    <!-- Page Header End -->


    <!-- Testimonial Start -->
    @if(count($ourClientSay)>0)
    <div class="container-fluid bg-secondary p-0">
        <div class="row g-0">
            <div class="col-lg-6" style="min-height: 500px;">
                <div class="position-relative h-100">
                    <img class="position-absolute w-100 h-100" src="{{ URL::asset('/resources/assets/website/img/testimonial.jpg')}}" style="object-fit: cover;">
                </div>
            </div>
            <div class="col-lg-6 py-6 px-5">
                <h1 class="display-5 mb-4">What Say Our Client!!!</h1>
                <div class="owl-carousel testimonial-carousel">
                @foreach($ourClientSay as $key => $client)
                    <div class="testimonial-item">
                        <p class="fs-4 fw-normal mb-4"><i class="fa fa-quote-left text-primary me-3"></i>{{$client->our_client_say_description}}</p>
                        <div class="d-flex align-items-center">
                            <img class="img-fluid rounded-circle" src="{{ $client->our_client_say_profile? $client->our_client_say_profile:URL::asset('/resources/assets/img/user.png')}}" alt="{{ $client->our_client_say_profile? $client->our_client_say_profile:URL::asset('/resources/assets/img/user.png')}}">
                            <div class="ps-4">
                                <h3>{{$client->our_client_say_name}}</h3>
                                <span class="text-uppercase">{{$client->profession}}</span>
                            </div>
                        </div>
                    </div>
                    <!-- <div class="testimonial-item">
                        <p class="fs-4 fw-normal mb-4"><i class="fa fa-quote-left text-primary me-3"></i>Dolores sed duo clita tempor justo dolor et stet lorem kasd labore dolore lorem ipsum. At lorem lorem magna ut et, nonumy et labore et tempor diam tempor erat dolor rebum sit ipsum.</p>
                        <div class="d-flex align-items-center">
                            <img class="img-fluid rounded-circle" src="{{ URL::asset('/resources/assets/website/img/testimonial-2.jpg')}}" alt="">
                            <div class="ps-4">
                                <h3>Client Name</h3>
                                <span class="text-uppercase">Profession</span>
                            </div>
                        </div>
                    </div> -->
                @endforeach
                </div>
            </div>
        </div>
    </div>
    @else
    <div class="container-fluid py-6 px-5">
        <div class="text-center mx-auto mb-5" style="max-width: 600px;">
            <h1 class="display-5 mb-0">No Records</h1>
        </div>
    </div>
    @endif
    <!-- Testimonial End -->


  @endsection