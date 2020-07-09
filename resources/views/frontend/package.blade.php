@extends('frontend.layouts.default')

@section('content')

	<!-- tabs section start -->

    <div class="section-tabs container-fluid my-5 pt-5 bg-transparent" >

        <div class="row">

            <div class="col-lg-8 m-auto">

                <h1 class="text-center my-3">Sell your music online</h1>

                <p class="aux-text mb-5 mt-3 text-white">Sell your music on Beat Byte</p>

            </div>

        </div>

        <!-- pricing plan wrapper start-->

        <div class="pricing_plan_wrapper p-0">

            <div class="container">

                <div class="row">

                	@foreach($getPackege as $packege)

                    <div class="col-lg-6 col-md-6 col-sm-12 col-12">

                        <div class="pricing_box_wrapper pricing-card-background-color">

                            <h1 class="primary-color text-shadow">{{$packege->packege_name}}</h1>

                            <div class="main_pdet">

                                <h2><span class="dollarr"> $ </span> {{$packege->packege_price}} </h2> <span class="monthly">

                                    /

                                    per month</span>

                            </div>

                           {!!$packege->packege_description !!}

                            <input type="hidden" value="{{$packege->id}}" name="packegename">

                            

                            @if($packege->packege_price==0)

                            <a href="{{url('register')}}" class="price_btn">select plan</a>

                            @else

                            <a href="{{url('register',$packege->id)}}" class="price_btn">select plan</a>

                            @endif

                        </div>



                    </div>

                    @endforeach

                    

                </div>

            </div>

        </div>

        <!-- pricing plan wrapper end-->

    </div>

    <!-- tabs section end -->



    



@stop