@extends('weblayout.app')
@section('title', 'Free Quote')
@section('image', $image)
@section('content')



    <!-- Page Header Start -->
    <div class="container-fluid bg-dark p-5">
        <div class="row">
            <div class="col-12 text-center">
                <h1 class="display-4 text-white">Free Quote</h1>
                <a href="{{route ('homepage') }}">Home</a>
                <i class="far fa-square text-primary px-2"></i>
                <a href="">Free Quote</a>
            </div>
        </div>
    </div>
    <!-- Page Header End -->


    <!-- Quote Start -->
    <div class="container-fluid bg-secondary px-0">
        <div class="row g-0">
            <div class="col-lg-6 py-6 px-5">
                <h1 class="display-5 mb-4">Request A Free Quote</h1>
                <p class="mb-4">Kasd vero erat ea amet justo no stet, et elitr no dolore no elitr sea kasd et dolor diam tempor. Nonumy sed dolore no eirmod sit nonumy vero lorem amet stet diam at. Ea at lorem sed et, lorem et rebum ut eirmod gubergren, dolor ea duo diam justo dolor diam ipsum dolore stet stet elitr ut. Ipsum amet labore lorem lorem diam magna sea, eos sed dolore elitr.</p>
                <form class="" id="" role="form" action="{{url('freeQuoteStore')}}" method="post" enctype="multipart/form-data" >
                @csrf
                    <div class="row gx-3">
                        <div class="col-6">
                            <div class="form-floating">
                                <input required type="text" name="full_company_name" class="form-control" id="form-floating-1" placeholder="John Doe">
                                <label for="form-floating-1">Full Name</label>
                            </div>
                        </div>
                        <div class="col-6">
                            <div class="form-floating mb-3">
                                <input required type="email" name="email" class="form-control" id="form-floating-2" placeholder="name@example.com">
                                <label for="form-floating-2">Email address</label>
                            </div>
                        </div>
                        <div class="col-6">
                            <div class="form-floating">
                                <input required type="text" name="contact_number" class="form-control" id="form-floating-2" placeholder="name@example.com">
                                <label for="form-floating-2">Contact number</label>
                            </div>
                        </div>
                        <div class="col-6">
                        <button id="submitBtn" name="submit" value="Submit" class="btn btn-primary w-100 h-100" type="submit">Request A Quote</button>
                        </div>
                    </div>
                </form>
            </div>
            <div class="col-lg-6" style="min-height: 400px;">
                <div class="position-relative h-100">
                    <img class="position-absolute w-100 h-100" src="{{ URL::asset('/resources/assets/website/img/quote.jpg')}}" style="object-fit: cover;">
                </div>
            </div>
        </div>
    </div>
    <!-- Quote End -->


   @endsection