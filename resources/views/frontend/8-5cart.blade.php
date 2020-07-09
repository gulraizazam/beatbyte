@extends('frontend.layouts.default_black')

@section('content')



<!-- top navi wrapper Start -->

    <div class="m24_main_wrapper" >

        <!-- top song wrapper start -->

        <div class="section-all shopping-cart album_inner_list auti m24_cover">

            <div class="container-fluid">

                <div class="row">

                	

                    <div class="col-md-8 col-lg-8">

                        <div class="top_songs_wrapper download_trending_track_wrapper m24_cover">

                            <div class="container-fluid">

                                <div class="row">

                                    <div class="col-xl-12 col-lg-12 col-md-12 col-sm-12">

                                    	@if(Session::has('success'))

										    <div class="alert alert-success"><span class="glyphicon glyphicon-ok"></span><em> {!! session('success') !!}</em></div>

										    {{Session::forget('success')}}

										@endif

                                        @if(Session::has('warning'))

                                            <div class="alert alert-warning"><span class="glyphicon glyphicon-ok"></span><em> {!! session('warning') !!}</em></div>

                                            {{Session::forget('success')}}

                                        @endif

                                    	@if(Cart::isEmpty())

                                    	<div class="top_songs_list no-hover free_music_wrapper m24_cover bottom-border">

                                    		<p class="text-info">Your cart Is Empty !</p>

                                    	</div>

                                    	@else

                                    	@foreach(Cart::getContent() as $item)

                                        <div class="top_songs_list no-hover free_music_wrapper m24_cover bottom-border">

                                            <div class="top_songs_list_left">

                                                <div class="treanding_slider_main_box top_lis_left_content">
                                                    @if($item->attributes->stem_image)
                                                	   

                                                        <div class="top_songs_list0img">

                                                            <img src="{{$item->attributes->stem_image}}" class="circle d-none d-sm-block"

                                                                alt="img" style="height: 63px;width: 100%;">

                                                        </div>

                                                       
                                                    @elseif($item->attributes->image)
                                                    <div class="top_songs_list0img">

                                                            <img src="{{$item->attributes->image}}" class="circle d-none d-sm-block"

                                                                alt="img" style="height: 63px;width: 100%;">

                                                        </div>

                                                        @else

                                                        <div class="top_songs_list0img">

                                                            <img src="{{asset('images/tp1.png')}}" class="circle d-none d-sm-block"

                                                                alt="img" style="height: 63px;width: 100%;">

                                                        </div>
                                                    @endif

                                                    <div class="release_content_artist top_list_content_artist">
                                                        @if($item->stem_name)
                                                        <p class="mt-3 h1"><a href="#">{{$item->stem_name}}</a></p>
                                                        @else
                                                        <p class="mt-3 h1"><a href="#">{{$item->name}}</a></p>
                                                        @endif
                                                    </div>

                                                </div>



                                            </div>

                                            

                                            <div class="top_songs_list_right">



                                                <div class="top_list_tract_view">

                                                     
                                                    @if($item->stem_price)
                                                    <p class="text-white mr-3"> $ {{$item->stem_price}}</p>
                                                    @else
                                                    <p class="text-white mr-3"> $ {{$item->price}}</p>
                                                    @endif
                                                    <a href="{{route('cart.destroy',$item->id)}}"><i class="fas fa-times" aria-hidden="true"></i></a>

                                                </div>

                                            </div>

                                        </div>

                                         @endforeach

                                         @endif

                                         

                                    </div>

                                </div>

                            </div>

                        </div>

                    </div>

                   

                    <div class="col-lg-4 col-md-4 col-sm-12">

                        <div class="filter-wraper">

                            <div class="row">

                                <div class="col-md-12 col-lg-12">

                                    <h1 class="font-s-25 font-w-600">Cart Summary</h1>

                                    @foreach(Cart::getContent() as $item)
                                    
                                    <div class="top_list_tract_view display-space-between">

                                        <div class="treanding_slider_main_box top_lis_left_content">
                                            @if($item->attributes->stem_image)
                                            <div class="top_songs_list0img">

                                                <img src="{{$item->attributes->stem_image}}" class="circle d-none d-sm-block" alt="img" style="height: 63px;width: 100%;">

                                            </div>
                                        	@elseif($item->attributes->image)

                                            <div class="top_songs_list0img">

                                                <img src="{{$item->attributes->image}}" class="circle d-none d-sm-block" alt="img" style="height: 63px;width: 100%;">

                                            </div>

                                            @else

                                            <div class="top_songs_list0img">

                                                <img src="{{asset('images/tp1.png')}}" class="circle d-none d-sm-block" alt="img" style="height: 63px;width: 100%;">

                                            </div>

                                            @endif

                                            <div class="release_content_artist top_list_content_artist">

                                                @if($item->stem_name)
                                                        <p class="mt-3 font-w-600"><a href="#">{{$item->stem_name}}</a></p>
                                                        @else
                                                        <p class="mt-3 font-w-600"><a href="#">{{$item->name}}</a></p>
                                                        @endif

                                            </div>

                                        </div>

                                        @if($item->stem_name)
                                        <p class="text-white "> $ {{$item->stem_price}}</p>
                                        @else
                                        <p class="text-white "> $ {{$item->price}}</p>
                                        @endif

                                    </div>



                                    <hr>

                                    

                                    <div class="top_list_tract_view display-space-between">

                                        <p class="text-white font-w-600">Total Gross</p>

                                        <p class="text-white"><?php echo Cart::getSubTotal();?></p>

                                    </div>

                                    <div class="top_list_tract_view display-space-between">

                                        <p class="text-white font-w-600">Discount</p>

                                        <p class="text-white">-$0.00</p>

                                    </div>

                                    <div class="top_list_tract_view display-space-between mb-4">

                                        <p class="text-primary font-w-600 font-s-20">Total</p>

                                        <p class="text-primary font-w-600 font-s-20">$ <?php echo Cart::getTotal();?></p>

                                    </div>
                                    
                                    @if($item->attributes->stem_image )

                                    <button class="login-button centered-aligned mt-3"><a href="{{route('cart.checkoutstem')}}" class="text-white ">Checkout </a></button>
                                    @else
                                    <button class="login-button centered-aligned mt-3"><a href="{{route('cart.checkout')}}" class="text-white ">Checkout </a></button>
                                   @endif
                                    

                                </div>
                                 @endforeach
                            </div>

                        </div>

                    </div>

                </div>

            </div>

        </div>

        <!-- top songs wrapper end -->

    </div>

    @stop