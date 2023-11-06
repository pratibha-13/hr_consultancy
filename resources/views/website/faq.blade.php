@extends('weblayout.app')
@section('title', 'FAQs')
@section('content')
<link rel="stylesheet" href="{{ URL::asset('/resources/assets/website/css/ionicons.min.css')}}">
<style>
    .heading_s1 h1, .heading_s1 h2, .heading_s1 h3, .heading_s1 h4, .heading_s1 h5, .heading_s1 h6
    {
        font-weight: 700;
        margin: 0;
        text-transform: capitalize;
    }
    .accordion_style1.accordion .card {
        background-color: transparent;
        margin-bottom: 15px;
        border-radius: 0;
        border: 0;
    }
    .card {
        position: relative;
        display: flex;
        flex-direction: column;
        min-width: 0;
        word-wrap: break-word;
    }
    .accordion .card .card-header {
        background-color: transparent;
        padding: 0px;
        margin: 0;
    }
    .card-header:first-child {
        border-radius: calc(0.25rem - 1px) calc(0.25rem - 1px) 0 0;
    }
    .card-header {
        border-bottom: 1px solid rgba(0,0,0,.125);
    }
    .accordion.accordion_style1 .card-header a {
        padding-left: 0;
        padding-top: 0;
        font-weight: 600;
    }
    .accordion .card-header a {
        padding: 15px 40px 15px 15px;
        display: block;
        line-height: normal;
    }
    .accordion_style1 .card-body {
        padding: 15px 0 10px 0;
    }
    .card-body p {
        margin-bottom: 15px;
    }
    p {
        color: #687188;
        line-height: 28px;
        margin-bottom: 25px;
    }
    p {
        margin-top: 0;
    }
    a{
        color: black;
    }
    a:hover {
        color: black;
    }
    .accordion_style1 .card-header a::after {
        content: "\f208";
        font-family: "Ionicons";
        font-size: 16px;
        font-weight: normal;
        position: absolute;
        right: 15px;
        top: 0px;
    }

    .accordion_style1 .card-header a[aria-expanded="false"]::after {
        content: "\f217";
    }

    .accordion_style2 .card-header {
        border: 0;
        background-color: transparent;
        padding: 0px;
    }

    .accordion_style2 .card-header a {
        padding: 15px 40px 15px 15px;
        display: block;
        font-weight: 600;
    }
</style>

    <!-- Page Header Start -->
    <div class="container-fluid bg-dark p-5">
        <div class="row">
            <div class="col-12 text-center">
                <h1 class="display-4 text-white">Frequently Asked Question</h1>
                <a href="{{route ('homepage') }}">Home</a>
                <i class="far fa-square text-primary px-2"></i>
                <a href="">Frequently Asked Question</a>
            </div>
        </div>
    </div>
    <!-- Page Header End -->


    <!-- Services Start -->
    <div class="container-fluid py-6 px-5">
        <div class="text-center mx-auto mb-5" style="max-width: 600px;">
            <h1 class="display-5 mb-0">Frequently Asked Question</h1>
            <hr class="w-25 mx-auto bg-primary">
        </div>
        <div class="row justify-content-center">

        	<div class="col-md-6">
            	<div class="heading_s1 mb-3 mb-md-5">
                	<h3>General Questions</h3>
                </div>
            	<div id="accordion" class="accordion accordion_style1">
                @foreach($generalFaq as $key => $gFaq)
                    <div class="card">
                        <div class="card-header" id="heading{{$key}}">
                            <h6 class="mb-0"> <a class="collapsed" data-bs-toggle="collapse" href="#collapse{{$key}}" @if($key == 0) aria-expanded="true" @else aria-expanded="false" @endif aria-controls="collapse{{$key}}">{{$gFaq->question}}</a> </h6>
                          </div>
                          <div id="collapse{{$key}}" class="collapse @if($key == 0) show @endif" aria-labelledby="heading{{$key}}" data-bs-parent="#accordion">
                            <div class="card-body">
                            {!! html_entity_decode($gFaq->answer) !!}
                            </div>
                        </div>
                    </div>
                @endforeach
              	</div>
            </div>

            <div class="col-md-6 mt-4 mt-md-0">
            	<div class="heading_s1 mb-3 mb-md-5">
                	<h3>Other Questions</h3>
                </div>
                <div id="accordion2" class="accordion accordion_style1">
                @foreach($otherFaq as $key => $oFaq)
                    <div class="card">
                        <div class="card-header" id="heading1{{$key}}">
                            <h6 class="mb-0"> <a class="collapsed" data-bs-toggle="collapse" href="#collapse1{{$key}}" @if($key == 0) aria-expanded="true" @else aria-expanded="false" @endif aria-controls="collapse1{{$key}}">{{$oFaq->question}}</a> </h6>
                          </div>
                          <div id="collapse1{{$key}}" class="collapse @if($key == 0) show @endif" aria-labelledby="heading1{{$key}}" data-bs-parent="#accordion2">
                            <div class="card-body">
                            	{!! html_entity_decode($oFaq->answer) !!}
                            </div>
                        </div>
                    </div>
                @endforeach
                </div>
            </div>

        </div>
    </div>
    <!-- Services End -->
@endsection