@extends('weblayout.app')
@section('title', 'Blog')
@section('content')


    <!-- Page Header Start -->
    <div class="container-fluid bg-dark p-5">
        <div class="row">
            <div class="col-12 text-center">
                <h1 class="display-4 text-white">Blog Grid</h1>
                <a href="{{route ('homepage') }}">Home</a>
                <i class="far fa-square text-primary px-2"></i>
                <a href="">Blog Grid</a>
            </div>
        </div>
    </div>
    <!-- Page Header End -->


    <!-- Blog Start -->
    @if(count($blog)>0)
    <div class="container-fluid py-6 px-5">
        <div class="row g-5">
            <!-- Blog list Start -->
            <div class="col-lg-8">
                <div class="row g-5">
                @foreach($blog as $key => $blogs)
                    <div class="col-xl-6 col-lg-12 col-md-6">
                        <div class="blog-item">
                            <div class="position-relative overflow-hidden">
                                <img class="img-fluid" src="{{ $blogs->blog_image? $blogs->blog_image:URL::asset('/resources/assets/img/default.png')}}" alt="{{ $blogs->blog_image? $blogs->blog_image:URL::asset('/resources/assets/img/default.png')}}">
                            </div>
                            @php
                                $date = \Carbon\Carbon::parse($blogs->created_at);
                            @endphp
                            <div class="bg-secondary d-flex">
                                <div class="flex-shrink-0 d-flex flex-column justify-content-center text-center bg-primary text-white px-4">
                                <span>{{$date->day}}</span>
                                <h5 class="text-uppercase m-0">{{ $date->format('M') }}</h5>
                                <span>{{ $date->year }}</span>
                                </div>
                                <div class="d-flex flex-column justify-content-center py-3 px-4">
                                    <div class="d-flex mb-2">
                                        <small class="text-uppercase me-3"><i class="bi bi-person me-2"></i>{{$blogs->blog_created}}</small>
                                        <small class="text-uppercase me-3"><i class="bi bi-bookmarks me-2"></i>{{$blogs->category}}</small>
                                    </div>
                                    <a class="h4" href="{{url('/detail/'.$blogs->blog_id)}}">{{$blogs->blog_title}}</a>
                                </div>
                            </div>
                        </div>
                    </div>
                @endforeach
                    <div class="col-12">
                        <nav aria-label="Page navigation">
                          <ul class="pagination pagination-lg m-0">
                            <li class="page-item disabled">
                              <a class="page-link rounded-0" href="#" aria-label="Previous">
                                <span aria-hidden="true"><i class="bi bi-arrow-left"></i></span>
                              </a>
                            </li>
                            <li class="page-item active"><a class="page-link" href="#">1</a></li>
                            <li class="page-item"><a class="page-link" href="#">2</a></li>
                            <li class="page-item"><a class="page-link" href="#">3</a></li>
                            <li class="page-item">
                              <a class="page-link rounded-0" href="#" aria-label="Next">
                                <span aria-hidden="true"><i class="bi bi-arrow-right"></i></span>
                              </a>
                            </li>
                          </ul>
                        </nav>
                    </div>
                </div>
            </div>
            <!-- Blog list End -->

            <!-- Sidebar Start -->
            <div class="col-lg-4">
                <!-- Search Form Start -->
                <div class="mb-5">
                    <div class="input-group">
                        <input type="text" class="form-control p-3" placeholder="Keyword">
                        <button class="btn btn-primary px-4"><i class="bi bi-search"></i></button>
                    </div>
                </div>
                <!-- Search Form End -->

                <!-- Category Start -->
                <div class="mb-5">
                    <h2 class="mb-4">Categories</h2>
                    <div class="d-flex flex-column justify-content-start bg-secondary p-4">
                    @foreach($category as $key => $cat)
                        <a class="h5 mb-3"><i class="bi bi-arrow-right text-primary me-2"></i>{{$cat->name}}</a>
                    @endforeach
                    </div>
                </div>
                <!-- Category End -->

                <!-- Recent Post Start -->
                <div class="mb-5">
                    <h2 class="mb-4">Recent Post</h2>
                    <div class="d-flex mb-3">
                        <img class="img-fluid" src="{{ URL::asset('/resources/assets/website/img/blog-1.jpg')}}" style="width: 100px; height: 100px; object-fit: cover;" alt="">
                        <a href="" class="h5 d-flex align-items-center bg-secondary px-3 mb-0">Lorem ipsum dolor sit amet adipis elit
                        </a>
                    </div>
                    <div class="d-flex mb-3">
                        <img class="img-fluid" src="{{ URL::asset('/resources/assets/website/img/blog-1.jpg')}}" style="width: 100px; height: 100px; object-fit: cover;" alt="">
                        <a href="" class="h5 d-flex align-items-center bg-secondary px-3 mb-0">Lorem ipsum dolor sit amet adipis elit
                        </a>
                    </div>
                    <div class="d-flex mb-3">
                        <img class="img-fluid" src="{{ URL::asset('/resources/assets/website/img/blog-1.jpg')}}" style="width: 100px; height: 100px; object-fit: cover;" alt="">
                        <a href="" class="h5 d-flex align-items-center bg-secondary px-3 mb-0">Lorem ipsum dolor sit amet adipis elit
                        </a>
                    </div>
                    <div class="d-flex mb-3">
                        <img class="img-fluid" src="{{ URL::asset('/resources/assets/website/img/blog-1.jpg')}}" style="width: 100px; height: 100px; object-fit: cover;" alt="">
                        <a href="" class="h5 d-flex align-items-center bg-secondary px-3 mb-0">Lorem ipsum dolor sit amet adipis elit
                        </a>
                    </div>
                    <div class="d-flex">
                        <img class="img-fluid" src="{{ URL::asset('/resources/assets/website/img/blog-1.jpg')}}" style="width: 100px; height: 100px; object-fit: cover;" alt="">
                        <a href="" class="h5 d-flex align-items-center bg-secondary px-3 mb-0">Lorem ipsum dolor sit amet adipis elit
                        </a>
                    </div>
                </div>
                <!-- Recent Post End -->

                <!-- Image Start -->
                <div class="mb-5">
                    <img src="{{ URL::asset('/resources/assets/website/img/blog-1.jpg')}}" alt="" class="img-fluid">
                </div>
                <!-- Image End -->

                <!-- Tags Start -->
                <div class="mb-5">
                    <h2 class="mb-4">Tag Cloud</h2>
                    <div class="d-flex flex-wrap m-n1">
                        <a href="" class="btn btn-secondary m-1">Design</a>
                        <a href="" class="btn btn-secondary m-1">Development</a>
                        <a href="" class="btn btn-secondary m-1">Marketing</a>
                        <a href="" class="btn btn-secondary m-1">SEO</a>
                        <a href="" class="btn btn-secondary m-1">Writing</a>
                        <a href="" class="btn btn-secondary m-1">Consulting</a>
                        <a href="" class="btn btn-secondary m-1">Design</a>
                        <a href="" class="btn btn-secondary m-1">Development</a>
                        <a href="" class="btn btn-secondary m-1">Marketing</a>
                        <a href="" class="btn btn-secondary m-1">SEO</a>
                        <a href="" class="btn btn-secondary m-1">Writing</a>
                        <a href="" class="btn btn-secondary m-1">Consulting</a>
                    </div>
                </div>
                <!-- Tags End -->

                <!-- Plain Text Start -->
                <div>
                    <h2 class="mb-4">Plain Text</h2>
                    <div class="bg-secondary text-center" style="padding: 30px;">
                        <p>Vero sea et accusam justo dolor accusam lorem consetetur, dolores sit amet sit dolor clita kasd justo, diam accusam no sea ut tempor magna takimata, amet sit et diam dolor ipsum amet diam</p>
                        <a href="" class="btn btn-primary rounded-pill py-2 px-4">Read More</a>
                    </div>
                </div>
                <!-- Plain Text End -->
            </div>
            <!-- Sidebar End -->
        </div>
    </div>
    @else
    <div class="container-fluid py-6 px-5">
        <div class="text-center mx-auto mb-5" style="max-width: 600px;">
            <h1 class="display-5 mb-0">No Blog</h1>
        </div>
    </div>
    @endif
    <!-- Blog End -->


    @endsection