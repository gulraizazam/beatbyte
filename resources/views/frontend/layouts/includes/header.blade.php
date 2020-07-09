<header class="site-header background-gradient-1">

    <div id="header-wrap">

        <div class="container-fluid">

            <div class="row">

                <div class="col d-flex align-items-center justify-content-between">

                    <a class="navbar-brand text-dark h2 brand-heading mb-0" href="{{route('index')}}"><img

                            src="{{asset('images/beat-bytes-logo.png')}}"></a>

                    <nav class="navbar navbar-expand-lg navbar-light ml-auto">

                        <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarNav"

                            aria-expanded="false" aria-label="Toggle navigation">

                            <i class="flaticon-menu-1 text-white"></i>

                        </button>

                        <div class="collapse navbar-collapse"

                            data-animations="fadeInDown fadeInRight fadeInUp fadeInLeft" id="navbarNav">

                            <ul class="navbar-nav ml-auto" style="text-transform:capitalize;">

                                <li class="nav-item">

                                    <?php

                                     $allgenerations = \App\Generation::all();

                                     $allbeats = \App\Beat::all();

                                    ?>

                                    <a class="nav-link" href="{{url('/')}}">Home</a>

                                </li>

                                <li class="nav-item dropdown" id="genres"><a class="nav-link dropdown-toggle" href="#"

                                        data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">Genres</a>

                                    <ul class="dropdown-menu">
                                       
                                        @foreach($allgenerations as $generations)

                                        <li><a class="dropdown-item" href="{{url('categories')}}/{{$generations->id}}">{{$generations->generation_name}}</a>

                                        </li>

                                        @endforeach

                                    </ul>

                                </li>

                                <li class="nav-item">

                                    <a class="nav-link" href="{{route('beats.all')}}"> Beats</a>

                                </li>
                                <li class="nav-item">

                                    <a class="nav-link" href="{{route('playlists')}}"> Playlists</a>

                                </li>
                                @if(Auth::guest())
                                <li class="nav-item">

                                    <a class="nav-link" href="{{route('user.signup')}}">Pricing</a>

                                </li>
                                @else
                                @endif
                                @role('seller')
                                 <li class="nav-item "><a class="nav-link " href="{{route('seller.index')}}"aria-expanded="false">Dashboard</a>
                                    
                                </li>
                                @endrole
                                @role('admin')
                                <li class="nav-item dropdown"><a class="nav-link dropdown-toggle" href="#"
                                        data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">My Account</a>
                                    <ul class="dropdown-menu">
                                        <li class="dropdown-item">
                                            <a class="nav-link" href="{{route('admin.index')}}">Dashboard</a>
                                        </li> 
                                    </ul>
                                </li>
                                @endrole
                               
                            </ul>

                        </div>

                    </nav>

                    @if(Auth::guest())

                        <a class="btn btn-outline-white btn-sm ml-4 d-none d-lg-block" href="{{url('login')}}">LOG IN</a>

                        <a class="btn btn-white-with-black-color btn-sm ml-2 d-none d-lg-block" href="{{url('signup')}}">SIGN

                            UP</a>

                    @else

                    <a class="btn btn-white-with-black-color btn-sm ml-2 d-none d-lg-block" href="/actlogout">Logout</a>

                    @endif

                </div>

            </div>

        </div>

    </div>

</header>