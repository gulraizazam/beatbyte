

<!DOCTYPE html>
<html lang="zxx" class="bg-black">
<meta http-equiv="content-type" content="text/html;charset=utf-8" />

<head>
    <meta charset="utf-8" />
    <title>Beat Byte - Reset Password</title>
    <meta content="width=device-width, initial-scale=1.0" name="viewport" />
    <meta name="description" content="music,song" />
    <meta name="keywords" content="music,song" />
    <meta name="author" content="" />
    <meta name="MobileOptimized" content="320" />
    <!--Template style -->
    <link rel="stylesheet" type="text/css" href="{{asset('css/animate.css')}}" />
    <link rel="stylesheet" type="text/css" href="{{asset('css/bootstrap.min.css')}}" />
    <link rel="stylesheet" type="text/css" href="{{asset('css/fonts.css')}}" />
    <link rel="stylesheet" type="text/css" href="{{asset('css/flaticon.css')}}" />
    <link rel="stylesheet" type="text/css" href="{{asset('css/font-awesome.css')}}" />
    <link rel="stylesheet" type="text/css" href="{{asset('css/owl.carousel.css')}}">
    <link rel="stylesheet" type="text/css" href="{{asset('css/owl.theme.default.css')}}">
    <link rel="stylesheet" type="text/css" href="{{asset('css/nice-select.css')}}" />
    <link rel="stylesheet" type="text/css" href="{{asset('css/swiper.css')}}" />
    <link rel="stylesheet" type="text/css" href="{{asset('css/magnific-popup.css')}}" />
    <link rel="stylesheet" type="text/css" href="{{asset('css/style.css')}}" />
    <link rel="stylesheet" type="text/css" href="{{asset('css/dark_theme.css')}}" />
    <link rel="stylesheet" type="text/css" href="{{asset('css/responsive.css')}}" />
    <!--favicon-->
    <link rel="shortcut icon" type="image/png" href="{{asset('images/favicon.png')}}" />
</head>

<body class="bg-black">
    <div class="container">
        <div class="row">
            <div class="text-center logo mt-100px">
                <a href="{{url('/')}}">
                    <img src="{{asset('images/beat-bytes-logo-2.png')}}" height=100 alt="Beat Bytes Logo" />
                </a>
            </div>
            <div class="signup-title text-center">
                <h4 class="text-center mt-3 text-white">Recover Password</h4>
                
            </div>
        </div>
        <div class="row">
             
            <div class="form-content">
                @if (session('status'))
                        <div class="alert alert-success" role="alert">
                            {{ session('status') }}
                        </div>
                    @endif
                <form method="POST" action="{{ route('password.update') }}">
                        @csrf

                        <input type="hidden" name="token" value="{{ $token }}">

                        <div class="form-group row ">
                            <label for="email" style="color: white">Email</label>

                            <div class="col-md-12">
                                <input id="email" type="email" class="form-control @error('email') is-invalid @enderror" name="email" value="{{ $email ?? old('email') }}" required autocomplete="email" autofocus>

                                @error('email')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                        </div>

                        <div class="form-group row">
                            <label for="password" style="color: white">Password</label>

                            <div class="col-md-12">
                                <input id="password" type="password" class="form-control @error('password') is-invalid @enderror" name="password" required autocomplete="new-password">

                                @error('password')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                        </div>

                        <div class="form-group row">
                            <label for="password-confirm" style="color: white">Confirm Password</label>

                            <div class="col-md-12">
                                <input id="password-confirm" type="password" class="form-control" name="password_confirmation" required autocomplete="new-password">
                            </div>
                        </div>

                        <div class="form-group row mb-0">
                            <div class="col-md-6 offset-md-4">
                                <button type="submit" class="btn btn-primary">
                                    {{ __('Reset Password') }}
                                </button>
                            </div>
                        </div>
                    </form>
            </div>
        </div>
    </div>

    <script src="{{asset('js/jquery-3.3.1.min.js')}}"></script>
    <script src="{{asset('js/bootstrap.min.js')}}"></script>
    <script src="{{asset('js/modernizr.js')}}"></script>
    <script src="{{asset('js/plugin.js')}}"></script>
    <script src="{{asset('js/jquery.nice-select.min.js')}}"></script>
    <script src="{{asset('js/jquery.inview.min.js')}}"></script>
    <script src="{{asset('js/jquery.magnific-popup.js')}}"></script>
    <script src="{{asset('js/swiper.min.js')}}"></script>
    <script src="{{asset('js/comboTreePlugin.js')}}"></script>
    <script src="{{asset('js/mp3/jquery.jplayer.min.js')}}"></script>
    <script src="{{asset('js/mp3/jplayer.playlist.js')}}"></script>
    <script src="{{asset('js/owl.carousel.js')}}"></script>
    <script src="{{asset('js/mp3/player.js')}}"></script>
    <script src="{{asset('js/custom.js')}}"></script>
    <!-- custom js-->
</body>

</html>