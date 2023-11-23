@extends('weblayout.app')
@section('title', 'Contact Us')
@section('image', $image)
@section('content')
<?php
use App\Helper\GlobalHelper;
$header_list = GlobalHelper::header_list();
?>
<style>
    .contact_map2 {
    height: 100%;
}
.map iframe {

height: 460px;

width: 100%;

border: 0;

display: block;

}

.contact_map {

height:400px;

}

.contact_map2 {

height: 100%;

}

.map1 {

height: 460px;

}
.contact_box .map {

position: absolute;

left: 0;

right: 0;

top: 0;

bottom: 0;

z-index: 0;

}

.contact_box .map iframe {

height: 100%;

}
</style>

    <!-- Page Header Start -->
    <div class="container-fluid bg-dark p-5">
        <div class="row">
            <div class="col-12 text-center">
                <h1 class="display-4 text-white">Contact Us</h1>
                <a href="{{route ('homepage') }}">Home</a>
                <i class="far fa-square text-primary px-2"></i>
                <a href="">Contact</a>
            </div>
        </div>
    </div>
    <!-- Page Header End -->


    <!-- Contact Start -->
    <div class="container-fluid bg-secondary px-0">
        <div class="row g-0">
            <div class="col-lg-6 py-6 px-5">
                <h1 class="display-5 mb-4">Contact For Any Queries</h1>
                <form class="" id="" role="form" action="{{url('contactStore')}}" method="post" enctype="multipart/form-data" >
                        @csrf
                    <div class="row g-3">
                        <div class="col-6">
                            <div class="form-floating">
                                <input required type="text" name="name" class="form-control" id="form-floating-1" placeholder="John Doe">
                                <label for="form-floating-1">Full Name</label>
                            </div>
                        </div>
                        <div class="col-6">
                            <div class="form-floating">
                                <input required type="email" name="email" class="form-control" id="form-floating-2" placeholder="name@example.com">
                                <label for="form-floating-2">Email address</label>
                            </div>
                        </div>
                        <div class="col-12">
                            <div class="form-floating">
                                <input required type="text" name="subject" class="form-control" id="form-floating-3" placeholder="Subject">
                                <label for="form-floating-3">Subject</label>
                            </div>
                        </div>
                        <div class="col-12">
                            <div class="form-floating">
                                <textarea required class="form-control" name="message" placeholder="Message" id="form-floating-4" style="height: 150px"></textarea>
                                <label for="form-floating-4">Message</label>
                              </div>
                        </div>
                        <div class="col-12">
                            <button class="btn btn-primary w-100 py-3" type="submit" name="submit" value="Submit" id="submitBtn">Submit</button>
                        </div>
                    </div>
                </form>
            </div>
            <!-- <div class="col-lg-6" style="min-height: 400px;">
                <div class="position-relative h-100">
                    <iframe class="position-relative w-100 h-100"
                        src="https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d3001156.4288297426!2d-78.01371936852176!3d42.72876761954724!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x4ccc4bf0f123a5a9%3A0xddcfc6c1de189567!2sNew%20York%2C%20USA!5e0!3m2!1sen!2sbd!4v1603794290143!5m2!1sen!2sbd"
                        frameborder="0" style="border:0;" allowfullscreen="" aria-hidden="false" tabindex="0"></iframe>
                </div>
            </div> -->
            <div class="col-lg-6" style="min-height: 400px;">
                <div class="position-relative h-100">
            	    <div id="map" class="contact_map2" data-zoom="12" data-latitude="{{$header_list['latitude']}}" data-longitude="{{$header_list['longitude']}}" data-icon="{{ URL::asset('/resources/assets/website/img/marker.png')}}"></div>
                </div>
            </div>
        </div>
    </div>
    <!-- Contact End -->
    <script src="https://maps.googleapis.com/maps/api/js?key=AIzaSyD7TypZFTl4Z3gVtikNOdGSfNTpnmq-ahQ&amp;callback=initMap"></script>
@endsection

@section('script')
<script>
    if ($("#map").length > 0){
		google.maps.event.addDomListener(window, 'load', init);
	}

	var map_selector = $('#map');
	function init() {

		var mapOptions = {
			zoom: map_selector.data("zoom"),
			mapTypeControl: false,
			center: new google.maps.LatLng(map_selector.data("latitude"), map_selector.data("longitude")), // New York
		  };
		var mapElement = document.getElementById('map');
		var map = new google.maps.Map(mapElement, mapOptions);
		var marker = new google.maps.Marker({
			position: new google.maps.LatLng(map_selector.data("latitude"), map_selector.data("longitude")),
			map: map,
			icon: map_selector.data("icon"),

			title: map_selector.data("title"),
		});
		marker.setAnimation(google.maps.Animation.BOUNCE);
	}
</script>
@endsection