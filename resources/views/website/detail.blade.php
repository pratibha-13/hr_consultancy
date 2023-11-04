@extends('weblayout.app')
@section('title', 'Home')
@section('content')


    <!-- Page Header Start -->
    <div class="container-fluid bg-dark p-5">
        <div class="row">
            <div class="col-12 text-center">
                <h1 class="display-4 text-white">Blog Detail</h1>
                <a href="{{route ('homepage') }}">Home</a>
                <i class="far fa-square text-primary px-2"></i>
                <a href="">Blog Detail</a>
            </div>
        </div>
    </div>
    <!-- Page Header End -->


    <!-- Blog Start -->
    <div class="container-fluid py-6 px-5">
        <div class="row g-5">
            <div class="col-lg-8">
                <!-- Blog Detail Start -->
                <div class="mb-5">
                    <img class="img-fluid w-100 mb-5" src="{{ $blog->blog_image? $blog->blog_image:URL::asset('/resources/assets/img/default.png')}}" alt="{{ $blog->blog_image? $blog->blog_image:URL::asset('/resources/assets/img/default.png')}}">
                    <h1 class="mb-4">{{$blog->blog_title}}</h1>
                    <p>{!! html_entity_decode($blog->blog_description) !!}</p>
                </div>
                <!-- Blog Detail End -->

                <!-- Comment List Start -->
                @if(count($comment)>0)
                    <div class="mb-5">
                        <h2 class="mb-4">{{$commentCount}} Comments</h2>
                        @foreach($comment as $key => $comments)
                        @php
                            $date = \Carbon\Carbon::parse($comments->created_at);
                        @endphp
                            <div class="d-flex mb-4">
                                <img src="{{ URL::asset('/resources/assets/website/img/user.jpg')}}" class="img-fluid rounded-circle" style="width: 45px; height: 45px;">
                                <div class="ps-3">
                                    <h6><a href="">{{$comments->user_name}}</a> <small><i>{{$date->day}} {{ $date->format('M') }} {{ $date->year }}</i></small></h6>
                                    <p>{{$comments->comments}}</p>
                                    <!-- <button class="btn btn-sm btn-light">Reply</button> -->
                                </div>
                            </div>
                        @endforeach
                        <!-- <div class="d-flex mb-4">
                            <img src="{{ URL::asset('/resources/assets/website/img/user.jpg')}}" class="img-fluid rounded-circle" style="width: 45px; height: 45px;">
                            <div class="ps-3">
                                <h6><a href="">John Doe</a> <small><i>01 Jan 2045</i></small></h6>
                                <p>Diam amet duo labore stet elitr invidunt ea clita ipsum voluptua, tempor labore
                                    accusam ipsum et no at. Kasd diam tempor rebum magna dolores sed eirmod</p>
                                <button class="btn btn-sm btn-light">Reply</button>
                            </div>
                        </div>
                        <div class="d-flex ms-5 mb-4">
                            <img src="{{ URL::asset('/resources/assets/website/img/user.jpg')}}" class="img-fluid rounded-circle" style="width: 45px; height: 45px;">
                            <div class="ps-3">
                                <h6><a href="">John Doe</a> <small><i>01 Jan 2045</i></small></h6>
                                <p>Diam amet duo labore stet elitr invidunt ea clita ipsum voluptua, tempor labore
                                    accusam ipsum et no at. Kasd diam tempor rebum magna dolores sed eirmod</p>
                                <button class="btn btn-sm btn-light">Reply</button>
                            </div>
                        </div> -->
                    </div>
                @endif
                <!-- Comment List End -->

                <!-- Comment Form Start -->
                <div class="bg-secondary p-5">
                    <h2 class="mb-4">Leave a comment</h2>
                    <form class="" id="" role="form" action="{{url('commentStore')}}" method="post" enctype="multipart/form-data" >
                    <input type="hidden" name="blog_id" id="blog_id" value="{{$blog->blog_id}}"/>
                    @csrf
                        <div class="row g-3">
                            <div class="col-12 col-sm-6">
                                <input type="text" name="user_name" class="form-control bg-white border-0" placeholder="Your Name" style="height: 55px;">
                            </div>
                            <div class="col-12 col-sm-6">
                                <input type="email" name="email" class="form-control bg-white border-0" placeholder="Your Email" style="height: 55px;">
                            </div>
                            <!-- <div class="col-12">
                                <input type="text" class="form-control bg-white border-0" placeholder="Website" style="height: 55px;">
                            </div> -->
                            <div class="col-12">
                                <textarea class="form-control bg-white border-0" name="comments" rows="5" placeholder="Comment"></textarea>
                            </div>
                            <div class="col-12">
                                <button class="btn btn-primary w-100 py-3" type="submit" id="submitBtn" name="submit" value="Submit">Leave Your Comment</button>
                            </div>
                        </div>
                    </form>
                </div>
                <!-- Comment Form End -->
            </div>

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
                        <a class="h5 mb-3" href="#"><i class="bi bi-arrow-right text-primary me-2"></i>{{$cat->name}}</a>
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
    <!-- Blog End -->


@endsection