@extends('weblayout.app')
@section('title', 'Terms and Conditions')
@section('content')


    <!-- Page Header Start -->
    <div class="container-fluid bg-dark p-5">
        <div class="row">
            <div class="col-12 text-center">
                <h1 class="display-4 text-white">Terms and Conditions</h1>
                <a href="{{route ('homepage') }}">Home</a>
                <i class="far fa-square text-primary px-2"></i>
                <a href="">Terms and Conditions</a>
            </div>
        </div>
    </div>
    <!-- Page Header End -->


    <!-- Services Start -->
    <div class="container-fluid py-6 px-5">
        <div class="text-center mx-auto mb-5" style="max-width: 600px;">
            <h1 class="display-5 mb-0">Terms and Conditions</h1>
            <hr class="w-25 mx-auto bg-primary">
        </div>
        <div class="row g-5">
            @if($terms->content!=null)
                {!! html_entity_decode($terms->content) !!}
            @else
                <h5>No Record Found</h5>
            @endif
        </div>
    </div>
    <!-- Services End -->
@endsection