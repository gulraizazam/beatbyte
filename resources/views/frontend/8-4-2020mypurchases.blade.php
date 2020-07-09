@extends('frontend.layouts.default_black')
@section('content')

<!-- top navi wrapper Start -->
    <div class="m24_main_wrapper">
        <!-- top song wrapper start -->
        <div class="section-all  album_inner_list auti m24_cover">
            <div class="container-fluid">
                <div class="row">
                    
                    <div class="col-md-12 col-lg-9">
                        
                        <div class="top_songs_wrapper download_trending_track_wrapper m24_cover">
                            <div class="container-fluid">
                                <div class="row">

                                    @foreach($allsongs as $song)
                                    <div class="col-xl-12 col-lg-12 col-md-12 col-sm-12">
                                        <div class="top_songs_list free_music_wrapper m24_cover">
                                            <div class="top_songs_list_left">
                                                <div class="treanding_slider_main_box top_lis_left_content">
                                                    <div class="top_songs_list0img">
                                                        <img src="{{asset('images/tp1.png')}}" class="d-none d-sm-block" alt="img">
                                                        <div class="m24_treanding_box_overlay">
                                                            <div class="m24_tranding_box_overlay"></div>

                                                            <div class="tranding_play_icon">
                                                                <a href="#">
                                                                    <i class="flaticon-play-button"></i>
                                                                </a>
                                                            </div>
                                                        </div>
                                                    </div>
                                                    <div class="release_content_artist top_list_content_artist">
                                                        <p><a href="javaScript:;" data-song="{{$song->song_file}}" class="songname">{{$song->name}}</a></p>
                                                        
                                                        
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="top_songs_list_right">
                                                <div class="top_list_tract_view">
                                                    
                                                    <a href="{{url('download',$song->id)}}" class="btn btn-primary"><i class="flaticon-download" style="margin-right: 5px;"></i>Download</a>
                                                    
                                                    
                                                    <!-- <div class="price mt-2"> -->
                                                        
                                                    
                                                    <!-- </div> -->
                                                </div>
                                                
                                            </div>
                                        </div>
                                        
                                    </div>
                                    @endforeach

                                </div>

                            </div>

                            
                        </div>
                        
                    </div>
                    
                </div>

            </div>

        </div>
        
        
        <!-- top songs wrapper end -->
        <!-- language modal section -->
    </div>
    <div class="audiodiv" style="display: none;">
            <h2>Beat Byte</h2>
            <div class="container-audio">
                <audio controls  loop autoplay id="audioplayer" controlsList="nodownload">
                   <source src="#">
                   Your browser dose not Support the audio Tag
               </audio>
            </div>
            <div class="container-audio">
                <div class="colum1">
                    <div class="row"></div>
                </div>
                <div class="colum1">
                    <div class="row"></div>
                </div>
                <div class="colum1">
                    <div class="row"></div>
                </div>
                <div class="colum1">
                    <div class="row"></div>
                </div>
                <div class="colum1">
                    <div class="row"></div>
                </div>
                <div class="colum1">
                    <div class="row"></div>
                </div>
                <div class="colum1">
                    <div class="row"></div>
                </div>
                <div class="colum1">
                    <div class="row"></div>
                </div>
                <div class="colum1">
                    <div class="row"></div>
                </div>
                <div class="colum1">
                    <div class="row"></div>
                </div>
                <div class="colum1">
                    <div class="row"></div>
                </div>
                <div class="colum1">
                    <div class="row"></div>
                </div>
                <div class="colum1">
                    <div class="row"></div>
                </div>
                <div class="colum1">
                    <div class="row"></div>
                </div>
                <div class="colum1">
                    <div class="row"></div>
                </div>
                <div class="colum1">
                    <div class="row"></div>
                </div>
                <div class="colum1">
                    <div class="row"></div>
                </div>
                <div class="colum1">
                    <div class="row"></div>
                </div>
                <div class="colum1">
                    <div class="row"></div>
                </div>
                <div class="colum1">
                    <div class="row"></div>
                </div>
                <div class="colum1">
                    <div class="row"></div>
                </div>
                <div class="colum1">
                    <div class="row"></div>
                </div>
                <div class="colum1">
                    <div class="row"></div>
                </div>
            </div>
    </div>

    
@stop
@section('scripts')
<script type="text/javascript">
            
    $('.songname').click(function(){
        $('.audiodiv').css("display","block");
       var song = $(this).attr('data-song');
       $('#audioplayer').attr('src',song);
       $('#audioplayer').play();
    });

</script>
@stop