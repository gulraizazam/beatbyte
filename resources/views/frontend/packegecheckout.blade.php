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
                                            <form action="{{route('packege.payment',$purchasePkg->id)}}" method="post">
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
                                                <input type="hidden" name="packegePrice" value="{{$purchasePkg->packege_price}}">
                                                <button type="submit" class="btn btn-primary" style="margin-top: 10px;">Submit</button>
                                            </form>
                                            
                                            
                                           
                                        </div>
                                        
                                         
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