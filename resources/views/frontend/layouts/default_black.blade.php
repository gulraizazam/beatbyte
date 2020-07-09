<!DOCTYPE html>

<html lang="en">



<head>

    <meta charset="utf-8" />

    <title>Beat Byte - Categories</title>

    <meta content="width=device-width, initial-scale=1.0" name="viewport" />

    <meta name="description" content="" />

    <meta name="keywords" content="" />

    <meta name="author" content="" />

    <meta name="MobileOptimized" content="320" />

    <!--Template style -->

    <link rel="stylesheet" type="text/css" href="{{asset('css/animate.css')}}" />

    <link rel="stylesheet" type="text/css" href="{{asset('css/bootstrap.min.css')}}" />

    <link rel="stylesheet" type="text/css" href="{{asset('css/fonts.css')}}" />

    <link rel="stylesheet" type="text/css" href="{{asset('css/flaticon.css')}}" />

    <link rel="stylesheet" type="text/css" href="{{asset('css/font-awesome.css')}}" />

    <link rel="stylesheet" type="text/css" href="{{asset('css/owl.carousel.css')}}">

    <link rel="stylesheet" type="text/css" href="{{asset('css/player.css')}}">

    <link rel="stylesheet" type="text/css" href="{{asset('css/owl.theme.default.css')}}">

    <link rel="stylesheet" type="text/css" href="{{asset('css/nice-select.css')}}" />

    <link rel="stylesheet" type="text/css" href="{{asset('css/swiper.css')}}" />

    <link rel="stylesheet" type="text/css" href="{{asset('css/magnific-popup.css')}}" />

    <link rel="stylesheet" type="text/css" href="{{asset('css/style.css')}}" />

    <link rel="stylesheet" type="text/css" href="{{asset('css/responsive.css')}}" />

    <link rel="stylesheet" href="//code.jquery.com/ui/1.12.1/themes/base/jquery-ui.css">

    <!--favicon-->

    <link rel="shortcut icon" type="image/png" href="{{asset('images/favicon.png')}}" />

</head>



<body>

     <!-- Header Starts -->

        @include('frontend/layouts/includes/header_black')

     <!-- Header Ends -->

     @yield('content')



      <!-- footer Wrapper start -->

      @include('frontend/layouts/includes/footer')

       <!--footer wrapper end-->

        <!--custom js files-->

            <script src="{{asset('js/jquery-3.3.1.min.js')}}"></script>
            <script src="{{asset('js/plugin.js')}}"></script>
            <script src="{{asset('js/comboTreePlugin.js')}}"></script>
            <script src="{{asset('js/mp3/player.js')}}"></script>
            <script src="{{asset('js/mp3/jquery.jplayer.min.js')}}"></script>
            <script src="{{asset('js/mp3/jplayer.playlist.js')}}"></script>
            <script src="{{asset('js/bootstrap.min.js')}}"></script>

            <script src="{{asset('js/jquery.magnific-popup.js')}}"></script>

            <script src="{{asset('js/owl.carousel.js')}}"></script>

            <script src="{{asset('js/custom.js')}}"></script>

            @yield('scripts')

            

        <!-- custom js-->

</body>



</html>