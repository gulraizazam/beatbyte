@extends('frontend.layouts.default')
@section('content')
	<!-- herobox section start -->
    <div class="back-color pb-5">
        <div class="section-herobox">
            <div class="container-fluid mt-3">
                <div class="row">
                    <div class="col-xl-6 col-lg-6 col-md-12 col-sm-12 col-12 pt-5">
                        <div class="content">
                            <h1 data-animation="animated fadeInUp" class="my-4">The Go To Marketplace To Buy And Sell Beats!</h1>
                            <p class="text-white font-size-16" data-animation="animated fadeInUp">
                                Upload & sell your music worldwide! It has never been easier to make a living from your
                                music.
                            </p>
                            <div>
                                <form id="mainsearchform">
                                    <button class="search-button" type="button"><i class="fas fa-search"></i></button>
                                    <input class="form-control search-input-home form-control-lg" name="search" placeholder="What type of beats are you looking for?" type="text" value="">
                                </form>
                            </div>
                            <div class="mt-3 pl-5">
                                <p class="text-white pl-5">OR</p>
                            </div>
                            <div class="slider_btn m24_cover mb-5">
                                <div class="lang_apply_btn">
                                    <ul>
                                        <li data-animation="animated fadeInUp">
                                            <a href="#"><i class="flaticon-play-button"></i>Upload Your Beats</a>
                                        </li>
                                    </ul>
                                </div>
                            </div>
                            <div class="clear"></div>
                        </div>
                    </div>
                    <div class="col-xl-6 col-lg-6 col-md-12 col-sm-12 col-12 text-right">
                        <img src="{{asset('images/project-images/main-image.png')}}" class="img-fluid mt-5" alt="img">
                    </div>
                </div>
            </div>
        </div>
        <!--slider wrapper end-->
    </div>
    <!-- herobox section end -->

    <!-- tabs section start -->
    <div class="section-tabs container-fluid mb-5 ">
        <div class="row" style="background: black">
            <div class="col-lg-8 m-auto">
                <h1 class="text-center my-3">Sell your music online</h1>
                <p class="aux-text mb-5 mt-3">Create your own custom Players & Widgets!
                </p>
            </div>
        </div>
        <div class="row section-tab py-3 ">
            <!-- <div class="col-lg-4 col-md-4 col-sm-12 m-auto">
                <div class="release_tabs_wrapper album_list_tab text-center">
                    <ul class="nav nav-tabs navtabs-fix">
                        <li class="nav-item"> <a class="nav-link active" data-toggle="tab" href="#menu1">Music
                                PLAYER</a>
                        </li>
                    </ul>
                </div>
            </div> -->
            <div class="col-xl-12 col-lg-12 col-md-12">
                <div class="tab-content">
                    <div id="menu1" class="tab-pane active">
                        <div class="row d-flex align-items-center">
                            <div class="col-xs-12 col-sm-12 col-md-7 col-lg-7 p-4">
                                <img src="{{asset('images/project-images/music-player.png')}}" class="img-fluid" alt="img">
                            </div>
                            <div class="col-xs-12 col-sm-12 col-md-5 col-lg-5 px-5 text-left">
                                <h4>Music Player</h4>
                                <p class="my-4">
                                    Do you sell beats on Wordpress, Wix or SoundClick?
                                </p>
                                <p class="my-4">
                                    Well our embeddable Music Players are the perfect solution for you to sell your beats or songs online!
                                </p>
                                <p class="mb-4">
                                    Our Music Player is an Instant Beat Store that allows your customers to lease beats & download free beats. You can create custom contracts, promo codes, deals, keep 100% of all your sales + much more!
                                </p>
                                <div class="buttons">
                                    <a href="#" class="btn btn-danger mr-3">Start Selling</a>
                                    <a href="categories.html" class="btn btn-outline">BROWSE BEATS</a>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!-- tabs section end -->

    <!-- online section start -->
    <div class="section-online mt-5 pt-5">
        <div class="back-img">
            <div class="container-fluid mt-5">
                <div class="row">
                    <div class="col-lg-10 m-auto">
                        <h1 class="text-center my-3">Ready to start your online music career?</h1>
                        <p class="text-center text-white mb-2">Join more than 4,000 amazing musicians using beat byte
                            today!
                        </p>
                    </div>
                </div>
                <div class="row mb-4 pb-5 pt-3">
                    <div class="col-md-4 m-auto">
                        <div class="buttons text-center">
                            <a href="#" class="btn btn-white mr-3">START SELLING</a>
                            <a href="categories.html" class="btn btn-outline">BROWSE BEATS</a>
                        </div>
                    </div>
                </div>
                <div class="row text-center">
                    <div class="col-md-8 m-auto">
                        <img src="{{asset('images/project-images/macbook-2.png')}}" class="img-fluid img-h-600" alt="Beat Byte">
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!-- online section end -->

    
@stop