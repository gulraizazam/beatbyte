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

                                        

                                        <div class="top_songs_list no-hover free_music_wrapper m24_cover bottom-border">

                                            <form action="{{route('payment')}}" method="post">

                                                @csrf

                                               

                                                <div class="row">

                                                    <div class="col-md-6">

                                                        <label> First Name</label>

                                                        <input type="text" name="firstname" class="form-control">

                                                         @if ($errors->has('firstname'))

                                                            <p class=" text-danger" >{{ $errors->first('firstname') }}</p>

                                                         @endif

                                                    </div>

                                                    <div class="col-md-6">

                                                        <label> Last Name</label>

                                                        <input type="text" name="lastname" class="form-control">

                                                        @if ($errors->has('lastname'))

                                                            <p class=" text-danger" >{{ $errors->first('lastname') }}</p>

                                                         @endif

                                                    </div>

                                                </div>

                                                <div class="row">

                                                    <div class="col-md-6">

                                                        <label>Phone</label>

                                                        <input type="text" name="phone" class="form-control">

                                                        @if ($errors->has('phone'))

                                                            <p class=" text-danger" >{{ $errors->first('phone') }}</p>

                                                         @endif

                                                    </div>

                                                    <div class="col-md-6">

                                                        <label>Email</label>

                                                        <input type="email" name="email" class="form-control">

                                                        @if ($errors->has('email'))

                                                            <p class=" text-danger" >{{ $errors->first('email') }}</p>

                                                         @endif

                                                    </div>

                                                </div>

                                                <div class="row">

                                                    <div class="col-md-12">

                                                        <label>Address</label>

                                                        <textarea class="form-control" name="address"></textarea>

                                                    </div>

                                                     @if ($errors->has('address'))

                                                            <p class=" text-danger" >{{ $errors->first('address') }}</p>

                                                         @endif

                                                </div>

                                                <button type="submit" class="btn btn-primary" style="margin-top: 10px;">Checkout</button>

                                            </form>

                                            

                                            

                                           

                                        </div>

                                        

                                         

                                    </div>

                                </div>

                            </div>

                        </div>

                    </div>

                   

                    <div class="col-lg-4 col-md-4 col-sm-12">

                        <div class="filter-wraper">

                            <div class="row">

                                <div class="col-md-12 col-lg-12">

                                    <h1 class="font-s-25 font-w-600">Checkout</h1>

                                    @foreach(Cart::getContent() as $item)

                                    <div class="top_list_tract_view display-space-between">

                                        <div class="treanding_slider_main_box top_lis_left_content">

                                            @if($item->attributes->image)

                                            <div class="top_songs_list0img">

                                                <img src="{{$item->attributes->image}}" class="circle d-none d-sm-block" alt="img" style="height: 100px;width: 100%;">

                                            </div>

                                            @else

                                            <div class="top_songs_list0img">

                                                <img src="{{asset('images/tp1.png')}}" class="circle d-none d-sm-block" alt="img" style="height: 100px;width: 100%;">

                                            </div>

                                            @endif

                                            <div class="release_content_artist top_list_content_artist">

                                                <p class="mt-3 font-w-600"><a href="#">{{$item->name}}</a></p>

                                            </div>

                                        </div>

                                        <p class="text-white">$ {{$item->price}}</p>

                                    </div>



                                    <hr>

                                     @endforeach

                                    <div class="top_list_tract_view display-space-between">

                                        <p class="text-white font-w-600">Total Gross</p>

                                        <p class="text-white">$ <?php echo Cart::getSubTotal();?></p>

                                    </div>

                                    <!-- <div class="top_list_tract_view display-space-between">

                                        <p class="text-white font-w-600">Discount</p>

                                        <p class="text-white">-$0.00</p>

                                    </div> -->

                                    <div class="top_list_tract_view display-space-between mb-4">

                                        <p class="text-primary font-w-600 font-s-20">Total</p>

                                        <p class="text-primary font-w-600 font-s-20">$ <?php echo Cart::getTotal();?></p>

                                    </div>

                                    

                                   

                                </div>

                            </div>

                        </div>

                    </div>

                </div>

            </div>

        </div>

        <!-- top songs wrapper end -->

    </div>



@stop