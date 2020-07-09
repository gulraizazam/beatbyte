
@foreach($allsongs as $song)
    <div class="col-xl-12 col-lg-12 col-md-12 col-sm-12">
        <div class="top_songs_list free_music_wrapper m24_cover">
            <div class="top_songs_list_left">
                <div class="treanding_slider_main_box top_lis_left_content">
                    <div class="top_songs_list0img">
                        @if($song->image)
                        <img src="{{$song->image}}" class="d-none d-sm-block" alt="img" style="height: 50px;width: 60px">
                        @else
                        <img src="{{asset('images/tp1.png')}}" class="d-none d-sm-block" alt="img">
                        @endif
                        <div class="m24_treanding_box_overlay">
                            <div class="m24_tranding_box_overlay"></div>

                            <div class="tranding_play_icon">
                                <a href="javaScript:;" onclick="PlayAudio('{{$song->song_file}}')" class="songname">
                                    <i class="flaticon-play-button"></i>
                                </a>
                            </div>
                        </div>
                    </div>
                    <div class="release_content_artist top_list_content_artist">
                        <p><a href="javaScript:;" onclick="PlayAudio('{{$song->song_file}}')" class="songname">{{$song->songname}}</a></p>
                        
                        <p class="various_artist_text"><a href="#">{{$song->name}}</a></p>
                    </div>
                </div>
            </div>
            <div class="top_songs_list_right">
                <div class="top_list_tract_view">
                    @if($song->song_category=="free")
                    <a href="{{url('downloadfree',$song->id)}}" id="addToCart" class=" button button-purpleX btn-primary btn"><i class="flaticon-download" style="margin-right: 5px;"></i> Free
                                                        
                                                    </a>
                    @else
                     <a href="{{route('cart.add',$song->id)}}" id="addToCart" class="button button-purpleX btn-primary btn"><i class="fas fa-shopping-cart"></i>
                        $ {{$song->song_price}}
                    </a>
                    @endif
                    <!-- <div class="price mt-2"> -->
                        
                    
                    <!-- </div> -->
                </div>
                
            </div>
        </div>
        
    </div>
@endforeach
