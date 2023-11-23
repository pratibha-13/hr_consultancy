<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <title>@yield('title') {{ config('app.name', 'Xcash') }}</title>
    <meta content="width=device-width, initial-scale=1.0" name="viewport">
    <meta content="HR - Consultancy" name="keywords">
    <meta property="og:type" content="article" />
    <meta property="og:description" content="@yield('description')" />
    <meta property="og:image" content="@yield('image')" />
    <!-- Favicon -->
    <link href="{{ URL::asset('/resources/assets/website/img/favicon.ico')}}" rel="icon">

    <!-- Google Web Fonts -->
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Barlow:wght@500;600;700&family=Open+Sans:wght@400;600&display=swap" rel="stylesheet">

    <!-- Icon Font Stylesheet -->
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.10.0/css/all.min.css" rel="stylesheet">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.4.1/font/bootstrap-icons.css" rel="stylesheet">

    <!-- Libraries Stylesheet -->
    <link href="{{ URL::asset('/resources/assets/website/lib/owlcarousel/assets/owl.carousel.min.css')}}" rel="stylesheet">

    <!-- Customized Bootstrap Stylesheet -->
    <link href="{{ URL::asset('/resources/assets/website/css/bootstrap.min.css')}}" rel="stylesheet">

    <!-- Template Stylesheet -->
    <link href=" {{ URL::asset('/resources/assets/website/css/style.css')}}" rel="stylesheet">
</head>
<body class="">
<div id="header">
@include('weblayout.header')
</div>
@yield('content')
    <div id="footer">
        @include('weblayout.footer')
    </div>

    <!-- Back to Top -->
    <a href="#" class="btn btn-lg btn-primary btn-lg-square rounded-circle back-to-top"><i class="bi bi-arrow-up"></i></a>
    <!-- JavaScript Libraries -->
    <script src="https://code.jquery.com/jquery-3.4.1.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.0/dist/js/bootstrap.bundle.min.js"></script>
    <script src="{{ URL::asset('/resources/assets/website/lib/easing/easing.min.js')}}"></script>
    <script src="{{ URL::asset('/resources/assets/website/lib/waypoints/waypoints.min.js')}}"></script>
    <script src="{{ URL::asset('/resources/assets/website/lib/owlcarousel/owl.carousel.min.js')}}"></script>

    <!-- Template Javascript -->
    <script src="{{ URL::asset('/resources/assets/website/js/main.js')}}"></script>

@yield('script')
</body>
</html>
