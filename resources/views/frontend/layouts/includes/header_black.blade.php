<div class="header-classic">

        <!-- navigation start -->

        <div class="container-fluid">

            <div class="row">

                <div class="col-xl-12 col-lg-12 col-md-12 col-sm-12 col-12">

                    <nav class="navbar navbar-expand-lg navbar-classic">

                        <div class="row pt-3">

                            <div class="col-md-4 col-sm-4"><a class="navbar-brand" href="{{url('/')}}">

                                    <img src="{{asset('images/beat-bytes-logo.png')}}"></a></div>

                            <div class="col-md-5 ml-auto col-sm-5">
                                 <form id="mainsearchform" method="post" action="{{route('main.search')}}">
                                    @csrf
                                <div class="search">

                                   

                                        <button class="btn-search mat-icon-button mat-button-base"

                                            id="btn-search-top-nav1" mat-icon-button="" type="submit"><span

                                                class="mat-button-wrapper"><i class="fas fa-search"></i></span>

                                            <div class="mat-button-ripple mat-ripple mat-button-ripple-round"

                                                matripple="">

                                            </div>

                                            <div class="mat-button-focus-overlay"></div>

                                        </button>

                                        <input id="input-search-top-nav1" name="search"

                                            placeholder="What are you looking for?" type="text" class="" style="background: #2a2a2a;border: #2a2a2a;color: white;">

                                        <div class="divider-vertical"></div><button aria-haspopup="true"

                                            class="btn-search-filter mat-menu-trigger"><span>All </span><i

                                                class="icon-arrow"></i></button>

                                        <mat-menu class="" xposition="before">



                                        </mat-menu>

                                    

                                </div>
                            </form>
                            </div>

                            <div class="col-md-6 col-sm-10 margin-nav">

                                <div class="rigth-nav">

                                    <div class="nav-buttons">
                                    	<a class="margin-custom mt-3 mr-4" href="{{url('/')}}">

                                            Home

                                        </a>
                                        <a class="margin-custom mt-3 mr-4" href="{{route('beats.all')}}">

                                            Beats

                                        </a>
                                        <a class="margin-custom mt-3 mr-4" href="{{route('cart')}}">

                                            Cart

                                        </a>

                                        @if(Auth::guest())
                                        <a class="margin-custom mt-3 mr-4" href="{{route('user.signup')}}">

                                            Pricing

                                        </a>
                                        <a class="margin-custom mt-3 mr-4" href="{{route('login')}}">

                                            Log in

                                        </a>

                                        @else

                                        @role('seller')

                                        <a class="margin-custom mt-3 mr-4" href="{{route('seller.index')}}">

                                            Dashboard

                                        </a>

                                        @endrole

                                        @endif

                                    </div>
                                     @if(Auth::guest())
                                        <a class="btn btn-outline-white margin-custom sign-in mr-4" href="{{route('user.signup')}}">Sign

                                         Up</a>
                                    @endif
                                    <div class="icon-cart margin-custom text-center pr-3">

                                        <a class="text-center" href="{{route('cart')}}"> <i

                                                class="flaticon-shopping-bag"></i><span id="cart_order"

                                                class="cart-order"><?php echo Cart::getContent()->count();?></span></a>

                                    </div>

                                </div>

                            </div>

                        </div>

                        <div class="collapse navbar-collapse" id="navbar-classic">

                            <ul class="navbar-nav ml-auto mt-2 mt-lg-0 mr-3">

                                <li class="nav-item ">

                                    <a class="nav-link" href="#" id="menu-1">

                                        

                                    </a>

                                </li>

                                <li class="nav-item ">

                                    <a class="nav-link " href="" id="menu-4" >

                                        

                                    </a>

                                    <!-- <ul class="dropdown-menu mega-dropdown-menu" aria-labelledby="menu-4">

                                        <li class="row p-3 m-auto nav-shadow">

                                            <ul class="col mega-menu-cat">

                                                <div class="mb-3">

                                                    <h6>Browse</h6>

                                                </div>

                                                <li><a class="dropdown-item" href="#">

                                                        Free Beats </a>

                                                </li>

                                                <li><a class="dropdown-item" href="#">

                                                        Top Selling Beats</a>

                                                </li>

                                                <li><a class="dropdown-item" href="#">

                                                        Recently Added Beats</a>

                                                </li>

                                                <li><a class="dropdown-item" href="#">

                                                        Free Beats</a>

                                                </li>

                                                <li><a class="dropdown-item" href="#">

                                                        Browse Beats</a>

                                                </li>

                                            </ul>

                                            <ul class="col mega-menu-cat">

                                                <div class="mb-3">

                                                    <h6>Genres</h6>

                                                </div>

                                                <li><a class="dropdown-item" href="categories.html">

                                                        Cinematic</a>

                                                </li>

                                                <li><a class="dropdown-item" href="categories.html">

                                                        Classical</a>

                                                </li>

                                                <li><a class="dropdown-item" href="categories.html">

                                                        Country</a>

                                                </li>

                                                <li><a class="dropdown-item" href="categories.html">

                                                        Dance</a>

                                                </li>

                                                <li><a class="dropdown-item" href="categories.html">

                                                        Electronic</a>

                                                </li>

                                                <li><a class="dropdown-item" href="categories.html">

                                                        Hip-Hop</a>

                                                </li>

                                                <li><a class="dropdown-item" href="categories.html">

                                                        Jazz</a>

                                                </li>

                                                <li><a class="dropdown-item" href="categories.html">

                                                        Pop</a>

                                                </li>

                                            </ul>

                                            <ul class="col mega-menu-cat">

                                                <div class="mb-2">

                                                    <h6>Treanding Searches</h6>

                                                </div>

                                                <li><a class="dropdown-item" href="#">

                                                        Jay sean</a>

                                                </li>

                                                <li><a class="dropdown-item" href="#">

                                                        Music</a>

                                                </li>

                                                <li><a class="dropdown-item" href="#">

                                                        juic wrld</a>

                                                </li>

                                                <li><a class="dropdown-item" href="#">

                                                        Chris Brown</a>

                                                </li>

                                                <li><a class="dropdown-item" href="#">

                                                        Beats</a>

                                                </li>

                                                <li><a class="dropdown-item" href="#">

                                                        Love</a>

                                                </li>

                                            </ul>

                                            <ul class="col mega-menu-cat">

                                                <div class="mb-3">

                                                    <h6>Browse Beats</h6>

                                                </div>

                                                <li><a class="dropdown-item" href="#">

                                                        Free Beats </a>

                                                </li>

                                                <li><a class="dropdown-item" href="#">

                                                        Top Selling Beats</a>

                                                </li>

                                                <li><a class="dropdown-item" href="#">

                                                        Recently Added Beats</a>

                                                </li>

                                                <li><a class="dropdown-item" href="#">

                                                        Free Beats</a>

                                                </li>

                                                <li><a class="dropdown-item" href="#">

                                                        Browse Beats</a>

                                                </li>

                                            </ul>

                                        </li>

                                    </ul> -->

                                </li>

                            </ul>

                        </div>

                    </nav>

                </div>

            </div>

        </div>

        <!-- navigation close -->

    </div>