@extends('weblayout.app')
@section('title', 'Privacy Policy')
@section('image', $image)
@section('content')


    <!-- Page Header Start -->
    <div class="container-fluid bg-dark p-5">
        <div class="row">
            <div class="col-12 text-center">
                <h1 class="display-4 text-white">Privacy Policy</h1>
                <a href="{{route ('homepage') }}">Home</a>
                <i class="far fa-square text-primary px-2"></i>
                <a href="">Privacy Policy</a>
            </div>
        </div>
    </div>
    <!-- Page Header End -->


    <!-- Services Start -->
    <div class="container-fluid py-6 px-5">
        <div class="text-center mx-auto mb-5" style="max-width: 600px;">
            <h1 class="display-5 mb-0">Privacy Policy</h1>
            <hr class="w-25 mx-auto bg-primary">
        </div>
        <div class="row g-5">
            @if($privacyPolicy->content!=null)
                {!! html_entity_decode($privacyPolicy->content) !!}
            @else
                <h5>No Record Found</h5>
            @endif
        </div>
    </div>
    <!-- Services End -->
@endsection