@extends('frontend.layouts.default_black')
@section('content')

<!-- top navi wrapper Start -->
    <div class="m24_main_wrapper">
        <!-- top song wrapper start -->
        <div class="section-all  album_inner_list auti m24_cover">
            <div class="container-fluid">
                <div class="row">
                    <div class="col-lg-3 d-lg-block d-none">
                        <div class="filter-wraper">
                            <div class="row">
                                <div class="col-12">
                                    <h5 class="text-white text-left margin-right">FILTERS</h5>
                                    
                                    <h2>Genres</h2>
                                    <div class="rd-btn">
                                        <div class="form-check">
                                            <label>
                                                <input type="radio" name="radio" class=
                                                    "generation" data-id="all"  onclick="getAjaxData();"> <span class="label-text">ALL
                                                    GENRES</span>
                                            </label>
                                        </div>
                                        @foreach($allgnerations as $generation)
                                            <div class="form-check">
                                                <label>
                                                    <input type="radio" name="radio" class=
                                                    "generation" data-id="{{$generation->id}}" onclick="getAjaxData();"> <span class="label-text">{{$generation->generation_name}}</span>
                                                </label>
                                            </div>
                                        @endforeach
                                    </div>
                                    <h2>Free Beats</h2>
                                    <div class="form-check">
                                        <label>
                                            <input type="radio" name="radio" class=
                                                "generation" data-id="free"  onclick="getAjaxFreeBeats();"> <span class="label-text">Free Beats</span>
                                        </label>
                                    </div>
                                    
                                    
                                </div>
                            </div>
                        </div>
                    </div>
                    
                    <div class="col-md-12 col-lg-9">
                        <h2 class="text-center">All Beats</h2>
                        <div class="ajax-loader" style="display: none;">
                          <img src="{{ asset('images/tendor.gif') }}" class="img-responsive" />
                        </div>
                        
                        <div class="top_songs_wrapper download_trending_track_wrapper m24_cover">
                            <div class="container-fluid">

                                <div class="row" id="ajaxgetdata">

                                    @foreach($allbeats as $song)
                                    <div class="col-xl-12 col-lg-12 col-md-12 col-sm-12">
                                        <div class="top_songs_list free_music_wrapper m24_cover">
                                            <div class="top_songs_list_left">
                                                <div class="treanding_slider_main_box top_lis_left_content">
                                                    <div class="top_songs_list0img">
                                                        @if($song->image)
                                                        <img src="{{URL::to('storage/app/uploads/images')}}/{{$song->image}}" class="d-none d-sm-block" alt="img" style="height: 50px;width: 60px">
                                                        @else
                                                        <img src="{{asset('images/tp1.png')}}" class="d-none d-sm-block" alt="img">
                                                        @endif
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
                                                        <p><a href="javaScript:;" onclick="PlayAudio('{{$song->file}}')" class="songname">{{$song->name}}</a></p>
                                                        
                                                        <p class="various_artist_text"><a href="#">{{$song->name}}</a></p>
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="top_songs_list_right">
                                                <div class="top_list_tract_view">
                                                    @if($song->is_free=="free")
                                                    <a href="{{url('downloadfreebeat',$song->id)}}"><i class="flaticon-download"></i></a>
                                                    <a href="#" id="addToCart" class="button-purpleX btn-primary btn">Free
                                                        
                                                    </a>
                                                    @else
                                                     <a href="{{route('cart.add',$song->id)}}" id="addToCart" class="button-purpleX btn-primary btn"><i class="fas fa-shopping-cart"></i>
                                                        {{$song->basic_price}}
                                                    </a>
                                                    @endif
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
    <div class="audiodiv" >
            <h2>Beat Byte</h2>
            <div class="container-audio" style="background-color: #000;">
                <audio controls  loop autoplay id="audioplayer" controlsList="nodownload">
                   <source src="#">
                   Your browser dose not Support the audio Tag
               </audio>
            </div>
            <div class="container-audio" style="background-color: #000;">
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
function PlayAudio(src)
{
     $('.audiodiv').css("display","block");
     $('#audioplayer').attr('src',src);
       $('#audioplayer').play();
}          
function getAjaxData(){
    var id = $('.generation:checked').attr('data-id');
    $.ajax({
      url: "{{URL::to('getajaxrecord')}}/"+ id,
      method: 'GET',
      beforeSend: function(){
        $('.ajax-loader').css("display","block");
    },

    complete: function(){
        setTimeout(function () {
            $('.ajax-loader').css("display","none");
        }, 1000);
       
    },

      success: function(response){
        
            $("#ajaxgetdata").html(response);
        }
    });
}
function getAjaxFreeBeats()
{
    var id = $('.generation:checked').attr('data-id');
    $.ajax({
      url: "{{URL::to('getajaxbeatsrecord')}}/"+ id,
      method: 'GET',
      beforeSend: function(){
        $('.ajax-loader').css("display","block");
    },

    complete: function(){
        setTimeout(function () {
            $('.ajax-loader').css("display","none");
        }, 1000);
       
    },

      success: function(response){
        
            $("#ajaxgetdata").html(response);
        }
    });
}


</script>
@stop