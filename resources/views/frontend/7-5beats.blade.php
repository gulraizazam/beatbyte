@extends('frontend.layouts.default_black')
@section('content')

<style type="text/css">
    .section-all a, .section-all .album_list_wrapper>ul>li>a {
        color: #151414;
    }
    .pagination{
        justify-content: center;
        
    }
        .track-control-container {
    height: 62% !important;
    
}
.volume-container {
    position: relative;
    display: inline-block;
    /* top: -37px; */
    top: -32px !important;
    margin-left: 36px !important;
}
.track-seek-container {
    /* height: 40%; */
    height: 5% !important;
    display: block;
    width: 100%;
    /* padding: 0px 8px 0px 8px; */
}
.playerHeadPhone {
    font-size: 61px !important;
    }
.playerHeadPhone {
    height: 108px !important;
}
#vpplayer {
    height: 105px !important;
}
.track-picture-container {
    padding: 5px;
 }

.footer {
    height: 108px !important;
}
.modal-header {
    border-bottom: none;
}
.modal-dialog {
    max-width: 60%;
    margin: 1.75rem auto;
}
.modal-content {
    background-color: #000000;
    -webkit-box-shadow: 0 0 25px 0 rgba(0,0,0,0.15);
    box-shadow: 0 0 25px 0 rgba(50, 22, 61, 0.5);
}
.top_songs_list {
    background: #0e0e0e;
}
.track-picture-container img {
    width: 100%;
    height: 100%;
    padding: 0px
}
.mb-5{
    margin-bottom: 4rem!important;
}
</style>
 <link href="{{asset('css/vpplayer.css')}}" rel="stylesheet">
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
                                        
                                        @foreach($allgnerations as $generation)
                                            <div class="form-check">
                                                <label>
                                                    <input type="radio" name="radio" class=
                                                    "generation" data-id="{{$generation->id}}" onclick="getAjaxbeatsData();"> <span class="label-text">{{$generation->generation_name}}</span>
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
                                    <h2>Moods</h2>
                                    <div class="rd-btn">
                                        
                                        @foreach($allmoods as $mood)
                                            <div class="form-check">
                                                <label>
                                                    <input type="radio" name="radio" class=
                                                    "mood" data-id="{{$mood->id}}" onclick="getMoodsAjaxData();"> <span class="label-text">{{$mood->mood_name}}</span>
                                                </label>
                                            </div>
                                        @endforeach
                                    </div>
                                    <h2>Price</h2>
                                    <div class="cars-top-filters-box-left">
                                          <div class="price_slider_wrapper">                  
                                            <div class="price-slide">
                                              <div class="price">
                                                  <label for="dealer-slider-amount">Price Range</label
                                                  ><input
                                                    type="text"
                                                    id="amount"
                                                    readonly=""
                                                    style="border:0; color:#999999; font-weight:bold;"
                                                  />
                                                <div
                                                  id="slider-range"
                                                  class="slider-range ui-slider ui-slider-horizontal ui-widget ui-widget-content ui-corner-all"
                                                >
                                                  <div
                                                    class="ui-slider-range ui-widget-header ui-corner-all"
                                                    style="left: 0%; width: 100%;"
                                                  ></div>
                                                  <span
                                                    class="ui-slider-handle ui-state-default ui-corner-all"
                                                    tabindex="0"
                                                    style="left: 0%;"
                                                  ></span
                                                  ><span
                                                    class="ui-slider-handle ui-state-default ui-corner-all"
                                                    tabindex="0"
                                                    style="left: 100%;"
                                                  ></span>
                                                </div>
                                              </div>
                                            </div>
                                          </div>
                                          
                                            <button id="pgs_price_filter_btn" name="submitsearch" class="button">
                                              Filter
                                            </button>
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
                      
                         @if(session()->has('error'))
                                                <div class="alert alert-danger">
                                                    {{ session()->get('error') }}
                                                </div>
                                            @endif

                        <div class="top_songs_wrapper download_trending_track_wrapper m24_cover">
                            <div class="container-fluid">

                                <div class="row" id="ajaxgetdata">

                                    @foreach($allbeats as $beats)
                                    <div class="col-xl-12 col-lg-12 col-md-12 col-sm-12">
                                        <div class="top_songs_list free_music_wrapper m24_cover">
                                            <div class="top_songs_list_left">
                                                <div class="treanding_slider_main_box top_lis_left_content">
                                                    <div class="top_songs_list0img">
                                                        @if($beats->image)
                                                        <img src="{{$beats->image}}" class="d-none d-sm-block" alt="img" style="height: 50px;width: 60px">
                                                        @else
                                                        <img src="{{asset('images/tp1.png')}}" class="d-none d-sm-block" alt="img">
                                                        @endif
                                                        <div class="m24_treanding_box_overlay">
                                                            <div class="m24_tranding_box_overlay"></div>

                                                            <div class="tranding_play_icon">
                                                               <a href="javaScript:;" onclick="PlayAudio('{{$beats->file}}','{{$beats->beatname}}')" class="songname">
                                                                    <i class="flaticon-play-button"></i>
                                                                </a>
                                                            </div>
                                                        </div>
                                                    </div>
                                                    <div class="release_content_artist top_list_content_artist">
                                                        <p><a href="javaScript:;" onclick="PlayAudio('{{$beats->file}}','{{$beats->beatname}}')" class="songname">{{$beats->beatname}}</a></p>
                                                        
                                                        <p class="various_artist_text"><a href="#">{{$beats->username}}</a></p>
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="top_songs_list_right">
                                                <div class="top_list_tract_view">
                                                    @if($beats->is_free=="free")
                                                        <a href="{{url('downloadfreebeat',$beats->id)}}" id="addToCart" class=" button button-purpleX btn-primary btn"><i class="flaticon-download" style="margin-right: 5px;"></i> Free
                                                        
                                                    </a>
                                                    @else
                                                     <a  id="addToCart" class="button button-purpleX btn-primary btn"  data-toggle="modal" href="#add-collection-{{$beats->id}}"><i class="fas fa-shopping-cart"></i>
                                                        $ {{$beats->basic_price}}
                                                    </a>
                                                    @endif
                                                    <!-- <div class="price mt-2"> -->
                                                        
                                                     
                                                    <!-- </div> -->
                                                </div>
                                                
                                            </div>
                                        </div>
                                        
                                    </div>
                                    <div class="modal fade" id="add-collection-{{$beats->id}}">
                                        <?php
                                        $getSingleBeat = \App\Beat::join('users','users.id','=','beats.user_id')->select('beats.name as beatname','beats.basic_price','users.name as username','beats.is_free','beats.image','beats.file','beats.id','beats.premium_price','beats.unlimited_price')->where('beats.id',$beats->id)->get();


                                        ?>
                   
                <div class="modal-dialog">

                    <div class="modal-content">

                        <div class="modal-header">
                            

                        </div>
                        @foreach($getSingleBeat as $singlebeat)
                        <div class="modal-body">

                            <div class="new-collection-wrapper">

                                 <div class="col-xl-12 col-lg-12 col-md-12 col-sm-12">
                                        <div class="top_songs_list free_music_wrapper m24_cover">
                                            <div class="top_songs_list_left">
                                                <div class="treanding_slider_main_box top_lis_left_content">
                                                    <div class="">
                                                       <h3>Basic Price</h3>
                                                    </div>
                                                    
                                                </div>
                                            </div>
                                            <div class="top_songs_list_right">
                                                <div class="top_list_tract_view">
                                                   <form method="post" action="{{route('cart.addbeat', $singlebeat->id)}}">
                                                    @csrf
                                                    <input type="hidden" name="beatprice" value="{{ $singlebeat->basic_price}}">
                                                     <input type="hidden" name="beatid" value="{{ $singlebeat->id}}">
                                                       <button type="submit"  class="button button-purpleX btn-primary btn"  ><i class="fas fa-shopping-cart"></i>
                                                        $ {{ $singlebeat->basic_price}}
                                                    </button>
                                                   </form>
                                                     
                                                    
                                                    <!-- <div class="price mt-2"> -->
                                                        
                                                    
                                                    <!-- </div> -->
                                                </div>
                                                
                                            </div>
                                        </div>
                                        
                                    </div>
                                    <div class="col-xl-12 col-lg-12 col-md-12 col-sm-12">
                                        <div class="top_songs_list free_music_wrapper m24_cover">
                                            <div class="top_songs_list_left">
                                                <div class="treanding_slider_main_box top_lis_left_content">
                                                    <div class="">
                                                       <h3>Premium Price</h3>
                                                    </div>
                                                    
                                                </div>
                                            </div>
                                            <div class="top_songs_list_right">
                                                <div class="top_list_tract_view">
                                                   
                                                     <form method="post" action="{{route('cart.addbeat', $singlebeat->id)}}">
                                                    @csrf
                                                    <input type="hidden" name="beatprice" value="{{ $singlebeat->premium_price}}">
                                                     <input type="hidden" name="beatid" value="{{ $singlebeat->id}}">
                                                       <button type="submit"  class="button button-purpleX btn-primary btn"  ><i class="fas fa-shopping-cart"></i>
                                                        $ {{ $singlebeat->premium_price}}
                                                    </button>
                                                   </form>
                                                    
                                                    <!-- <div class="price mt-2"> -->
                                                        
                                                    
                                                    <!-- </div> -->
                                                </div>
                                                
                                            </div>
                                        </div>
                                        
                                    </div>
                                    <div class="col-xl-12 col-lg-12 col-md-12 col-sm-12">
                                        <div class="top_songs_list free_music_wrapper m24_cover">
                                            <div class="top_songs_list_left">
                                                <div class="treanding_slider_main_box top_lis_left_content">
                                                    <div class="">
                                                       <h3>Unlimited Price</h3>
                                                    </div>
                                                    
                                                </div>
                                            </div>
                                            <div class="top_songs_list_right">
                                                <div class="top_list_tract_view">
                                                   
                                                     <form method="post" action="{{route('cart.addbeat', $singlebeat->id)}}">
                                                    @csrf
                                                    <input type="hidden" name="beatprice" value="{{ $singlebeat->unlimited_price}}">
                                                     <input type="hidden" name="beatid" value="{{ $singlebeat->id}}">
                                                       <button type="submit"  class="button button-purpleX btn-primary btn"  ><i class="fas fa-shopping-cart"></i>
                                                        $ {{ $singlebeat->unlimited_price}}
                                                    </button>
                                                   </form>
                                                    
                                                    <!-- <div class="price mt-2"> -->
                                                        
                                                    
                                                    <!-- </div> -->
                                                </div>
                                                
                                            </div>
                                        </div>
                                        
                                    </div>
                            </div>

                        </div>
                        @endforeach
                        <div class="modal-footer" style="border-top: 1px solid black">

                           

                        </div>

                    </div>

                    <!-- /.modal-content -->

                </div>

                <!-- /.modal-dialog -->

            </form>



        </div>
                                    @endforeach

                                </div>
                                {{ $allbeats->links() }}

                            </div>

                            
                        </div>
                        
                    </div>
                    
                </div>

            </div>

        </div>
        
        
        <!-- top songs wrapper end -->
        <!-- language modal section -->
    </div>
    <div class="footer">
          <div class="store-player">
            <div id="player"></div>
          </div>
      </div>
@stop
@section('scripts')
<script src="{{asset('js/vpplayer.js')}}"></script>
<script src="https://code.jquery.com/ui/1.12.1/jquery-ui.js"></script>
<script type="text/javascript"> 
$( function() {
    $( "#slider-range" ).slider({
      range: true,
      min: 0,
      max: 1000,
      values: [ 0, 1000 ],
      slide: function( event, ui ) {
        $( "#amount" ).val( "$" + ui.values[ 0 ] + " - $" + ui.values[ 1 ] );
      }
    });
    $( "#amount" ).val( "$" + $( "#slider-range" ).slider( "values", 0 ) +
      " - $" + $( "#slider-range" ).slider( "values", 1 ) );
    } );
$('#pgs_price_filter_btn').on('click', function(){
    var prices = $( "#slider-range" ).slider( "option", "values" );
    $('#pgs_min_price').val(prices[0]);
    $('#pgs_max_price').val(prices[1]);

     $.ajax({
        url: "{{URL::to('getajaxpricedata')}}?minPrice="+ prices[0] + "&maxPrice="+prices[1],
        method: 'GET',
        beforeSend: function(){
            $('.ajax-loader').css("display","block");
        },
        complete: function(){
            setTimeout(function () {
                $('.ajax-loader').css("display","none");
                $('html,body').animate({
                      scrollTop:0
                  },800);
            }, 1000);
        },
        success: function(response){
            if(response.error){
                $("#ajaxgetdata").html('<div class="col-md-12"><div class="alert alert-danger">'+response.error+'</div></div>');
            }else{

                $("#ajaxgetdata").html(response);
            }
        }
    });
});       
$(document).ready(function(){
        $("#player").vpplayer({
          src: "./audio/audio.mp3",
          trackName: "sample audio",
          playerName: "BeatByte",
          playerColor:"#71328b,#0000009c",
          displayColor:"#475c8a,#000710"

        });
      }); 
function PlayAudio(source,audio)
{
     $("#player").vpplayer({
          src: source,
          trackName: audio,
          playerColor:"#71328b,#0000009c",
          displayColor:"#475c8a,#000710"
        });
        setTimeout(function() {
          $('.track-control-group .play').trigger('click');
        }, 500);

        $('.track-picture-container').html('<img src="{{asset("images/rt1.png")}}" class="musicplayimage">');
}    

function getAjaxbeatsData(){
    var id = $('.generation:checked').attr('data-id');
    $.ajax({
        url: "{{URL::to('getajaxbeats')}}/"+ id,
        method: 'GET',
        beforeSend: function(){
            $('.ajax-loader').css("display","block");
        },
        complete: function(){
            setTimeout(function () {
                $('.ajax-loader').css("display","none");
                $('html,body').animate({
                      scrollTop:0
                  },800);
            }, 1000);
        },
        success: function(response){
            if(response.error){
                $("#ajaxgetdata").html('<div class="col-md-12"><div class="alert alert-danger">'+response.error+'</div></div>');
            }else{
                $("#ajaxgetdata").html(response);
            }
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
            $('html,body').animate({
                  scrollTop:0
              },800);
        }, 1000);
       
    },

      success: function(response){
            if(response.error){
                $("#ajaxgetdata").html('<div class="col-md-12"><div class="alert alert-danger">'+response.error+'</div></div>');
            }else{
                $("#ajaxgetdata").html(response);
            }
            
        }
    });
}
function getMoodsAjaxData()
{
    var id = $('.mood:checked').attr('data-id');
    $.ajax({
      url: "{{URL::to('getmoodsajaxrecord')}}/"+ id,
      method: 'GET',
      beforeSend: function(){
        $('.ajax-loader').css("display","block");
    },

    complete: function(){
        setTimeout(function () {
            $('.ajax-loader').css("display","none");
            $('html,body').animate({
                  scrollTop:0
              },800);
        }, 1000);
       
    },

      success: function(response){
        
            if(response.error){
                $("#ajaxgetdata").html('<div class="col-md-12"><div class="alert alert-danger">'+response.error+'</div></div>');
            }else{
                $("#ajaxgetdata").html(response);
            }
        }
    });
}
function GetSearchData()
{
    var searchitem = $('#input-search-top-nav1').val();

    $.ajax({
      url: "{{URL::to('getajaxsearch')}}",
      data:{searcdata:searchitem,_token:'{{ csrf_token() }}'},
      method: 'POST',
      beforeSend: function(){
        $('.ajax-loader').css("display","block");
    },

    complete: function(){
        setTimeout(function () {
            $('.ajax-loader').css("display","none");
            $('html,body').animate({
                  scrollTop:0
              },800);
        }, 1000);
       
    },
    success: function(response){
    
       if(response.error){
            $("#ajaxgetdata").html('<div class="col-md-12"><div class="alert alert-danger">'+response.error+'</div></div>');
        }else{
            $("#ajaxgetdata").html(response);
        }
     }
    });
}
</script>
@stop