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
                                    <h2>Free Songs</h2>
                                    <div class="form-check">
                                        <label>
                                            <input type="radio" name="radio" class=
                                                "freesongs" data-id="free"  onclick="getAjaxFreeSongs();"> <span class="label-text">Free Songs</span>
                                        </label>
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
                                          
                                            <button id="pgs_price_filter_btn" type="submit" name="submitsearch" class="button">
                                              Filter
                                            </button>
                                          
                                        </form>
                                      </div>
                                    
                                </div>
                            </div>
                        </div>
                    </div>
                    
                    <div class="col-md-12 col-lg-9">
                        <div class="section-top-charts">
                            <div class="treanding_songs_wrapper punjabi_sogns m24_cover">
                                <div class="container">
                                    <div class="row">
                                        <div class="col-lg-4 col-md-4 col-sm-4">
                                            <div class="m24_heading_wrapper">
                                                <h1>TOP CHARTS</h1>
                                            </div>
                                        </div>
                                        
                                        <div class="col-lg-12 col-md-12 col-xs-12 col-sm-12">
                                             @if(session()->has('error'))
                                                <div class="alert alert-danger">
                                                    {{ session()->get('error') }}
                                                </div>
                                            @endif
                                            <h3 class="text-center" style="padding-bottom: 20px;">ALL ALBUMS</h3>
                                            <div class="ajax-loader" style="display: none;">
                                              <img src="{{ asset('images/tendor.gif') }}" class="img-responsive" />
                                            </div>

                                            <div class="treanding_song_slider playlist_songs_list">
                                                <div class="owl-carousel owl-theme">

                                                    @foreach($allalbums as $beat)
                                                    <div class="item">
                                                        <div class="treanding_slider_main_box m24_cover">
                                                            @if($beat->image)
                                                            <a href="{{url('album',$beat->id)}}"><img src="{{ $beat->album_image}}" alt="img"></a>
                                                            @else
                                                                <a href="{{url('album',$beat->id)}}"><img src="{{asset('images/beat.jpg')}}" alt="img" style="height: 164px;"></a>
                                                            @endif
                                                            
                                                            <div class="various_song_playlist">
                                                                
                                                                <p><a href="{{url('album',$beat->id)}}" class="playbeat">{{$beat->album_name}}</a></p>
                                                                
                                                                <p class="descp"><a href="#"> ${{$beat->price}}  </a>
                                                                </p>
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
                         <h3 class="text-center" style="padding-bottom: 20px;">ALL SONGS</h3>
                        <div class="top_songs_wrapper download_trending_track_wrapper m24_cover">
                            <div class="container-fluid">

                                <div class="row" id="ajaxgetdata">

                                    @foreach($allsongs as $song)
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
                                                     <a href="{{route('cart.add',$song->id)}}" id="addToCart" class=" button button-purpleX btn-primary btn"><i class="fas fa-shopping-cart"></i>
                                                        {{$song->song_price}}
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
            
    </div>
<div class="container-audio" id="bars" style="background-color: #000;display: none;">
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
    
@stop
@section('scripts')
<script src="https://code.jquery.com/ui/1.12.1/jquery-ui.js"></script>
  <script>
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
        $('#pgs_price_filter_btn').click(function(){
            var prices = $( "#slider-range" ).slider( "option", "values" );
            $('#pgs_min_price').val(prices[0]);
            $('#pgs_max_price').val(prices[1]);
            $('#price_search_filter').submit();
            });
  </script>
<script type="text/javascript">  
function PlayAudio(src)
{
     $('.audiodiv').css("display","block");
     $('#bars').css("display","block");
     $('#audioplayer').attr('src',src);
    $('#audioplayer').play();
    $('#bars').css("display","block");
}    
$('#pgs_price_filter_btn').on('click', function(){
    var prices = $( "#slider-range" ).slider( "option", "values" );
    $('#pgs_min_price').val(prices[0]);
    $('#pgs_max_price').val(prices[1]);

     $.ajax({
        url: "{{URL::to('pricefilter')}}?minPrice="+ prices[0] + "&maxPrice="+prices[1],
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
        
            if(response.error){
                $("#ajaxgetdata").html('<div class="col-md-12"><div class="alert alert-danger">'+response.error+'</div></div>');
            }else{
                $("#ajaxgetdata").html(response);
            }
        }
    });
}
function getAjaxFreeSongs()
{
    var id = $('.freesongs:checked').attr('data-id');
    $.ajax({
      url: "{{URL::to('getfreesongs')}}/"+ id,
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