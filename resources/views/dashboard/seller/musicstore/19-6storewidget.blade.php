<!DOCTYPE html>

<html lang="en">

<head>

  <meta charset="utf-8">

  <meta http-equiv="X-UA-Compatible" content="IE=edge">

  <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">

  <meta name="description" content="">
 <meta name="csrf-token" content="{{ csrf_token() }}">
  <meta name="author" content="">

  <title>Beat Byte</title>
  <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/css/bootstrap.min.css" integrity="sha384-Gn5384xqQ1aoWXA+058RXPxPg6fy4IWvTNh0E263XmFcJlSAwiGgFAW/dAiS6JXm" crossorigin="anonymous">
    <link rel="stylesheet" type="text/css" href="https://cdn.datatables.net/v/dt/dt-1.10.12/datatables.min.css"/>
    <link rel="stylesheet" type="text/css" href="https://stackpath.bootstrapcdn.com/font-awesome/4.7.0/css/font-awesome.min.css"/>
  <!-- Bootstrap core CSS-->

  <link href="{{asset('css/bootstrap.min.css')}}" rel="stylesheet">

  <!-- Custom fonts for this template-->

  <link href="{{asset('css/font-awesome.min.css')}}" rel="stylesheet" type="text/css">
  <link href="{{asset('css/vpplayer.css')}}" rel="stylesheet">
  <link rel="stylesheet" type="text/css" href="{{asset('css/flaticon.css')}}">
  <link rel="stylesheet" type="text/css" href="{{asset('css/html5widget.css')}}">

  <!-- <link href="{{asset('css/dropzone.css')}}" rel="stylesheet"> -->
<style type="text/css">
  .modal-backdrop{
    position: relative;
  }
  .track-picture-container{
    padding:15px;
  }
  .track-picture-container img {
    height: 100%;
    width: 100%;
  }
  .play{
    margin-top: -4px !important;
  }
</style>
</head>

<body class="fixed-nav sticky-footer bg-dark" id="page-top">
  @if(!isset($error))
   <div id="player-wrapper" class="player-wrapper">
      <div class="top-bar">
          <a href="{{route('cart')}}" class="buy cart-icon" style="text-decoration: none;"><i class="fa fa-shopping-cart"></i> Buy Now</a>
      </div>
      <div>
          <div class="main-body main-body-with-side-pannel mCustomScrollbar _mCS_3 mCS-autoHide" style="overflow: visible;padding-bottom: 12%;">
              <div id="mCSB_3" class="mCustomScrollBox mCS-minimal mCSB_vertical mCSB_outside" tabindex="0" style="max-height: none;">
                  <div id="mCSB_3_container" class="mCSB_container" style="position:relative; top:0; left:0;" dir="ltr">
                    @if(isset($getbanner->banner_image))
                      <div class="profile" style="background:url({{$getbanner->banner_image}});">
                    @else
                    <div class="profile">
                      @endif
                          <div class="left-col">
                              <div class="avatar">
                                @if(isset($getbrand->brand_logo))
                                   <img src="{{$getbrand->brand_logo}}" class="mCS_img_loaded">
                                @else
                                <img src="https://cdn.airbit.com/avatars/default@300x.jpg" class="mCS_img_loaded">
                                @endif

                              </div>
                          </div>
                          <div class="right-col">
                              <div class="name">
                                @if(isset($widgetUser))
                                  {{$widgetUser->name}}
                                @endif
                              </div>
                              <div class="status"></div>
                              <div class="tab-stats">
                                  <div class="total-items">
                                      <div class="total-items-title">Total Beats: </div>
                                      <div class="total-items-number">
                                        @if(isset($allbeats))
                                          {{count($allbeats)}}
                                        @endif
                                      </div>
                                      <div class="total-items-short-title" style="color: white">
                                          Beats
                                      </div>
                                  </div>
                                  <div class="total-items">
                                      <div class="total-items-title">Total Beats: </div>
                                      <div class="total-items-number">
                                        @if(isset($allsongs))
                                          {{count($allsongs)}}
                                        @endif
                                      </div>
                                      <div class="total-items-short-title" style="color: white">
                                          Songs
                                      </div>
                                  </div>
                              </div>
                              <div class="discounts-applied" style="display: none;">Discounts Applied</div>
                              <div class="coupon-applied" style="display: none;">false</div>
                          </div>
                      </div>
                      <!---->
                      <div class="search">
                          <input type="text" name="search" placeholder="Search..." class="form-control search-field"> <i class="search-icon fa fa-search"></i> <span id="search-clear" class="search-clear fa fa-times-circle-o"></span></div>
                      <div class="playlist">
                          <h2 class="text-center" style="color: rgb(143, 64, 176);text-align: center;padding: 20px;">LATEST BEATS</h2>
                          <div class="top_songs_wrapper download_trending_track_wrapper m24_cover">
                              <div class="container-fluid">

                                  <div class="row" id="ajaxgetdata">
                                    <table class="table-songs table table-stipped table-hover" id="tablecontents">
                                      <thead>
                                        <tr>
                                          <th>Title</th>
                                          <th>Tags</th>
                                          <th>Buy</th>
                                        </tr>
                                      </thead>
                                      <tbody>
                                        @foreach($allbeats as $beats)

                                        <tr class="top_songs_list row1" data-id="{{ $beats->id }}">
                                          <td>
                                            <div class="top_songs_list0img">
                                                @if($beats->image)
                                                <img src="{{$beats->image}}" class="d-none d-sm-block" alt="img" style="height: 50px;width: 60px">
                                                @else
                                                <img src="{{asset('images/tp1.png')}}" class="d-none d-sm-block" alt="img">
                                                @endif
                                                <div class="m24_treanding_box_overlay">
                                                    <div class="m24_tranding_box_overlay"></div>

                                                    <div class="tranding_play_icon">
                                                       <a href="javaScript:;" onclick="changeAudio('{{$beats->file}}','{{$beats->name}}','{{$beats->image ?$beats->image : asset('images/tp1.png') }}')" class="songname">
                                                            <i class="flaticon-play-button"></i>
                                                        </a>
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="release_content_artist top_list_content_artist">
                                                <p><a href="javaScript:;" onclick="changeAudio('{{$beats->file}}','{{$beats->name}}','{{$beats->image ?$beats->image : asset('images/tp1.png') }}')" class="songname">{{$beats->name}}</a></p>
                                            </div>
                                          </td>
                                          <td>
                                            <div class="tags">
                                              {{$beats->tags}}
                                            </div>
                                          </td>
                                          <td>
                                            <div class="top_songs_list_right">
                                               <div class="top_list_tract_view">
                                                  @if($beats->is_free=="free")
                                                      <a href="{{url('downloadfreebeat',$beats->id)}}" id="addToCart" class=" button button-purpleX btn-primary btn"><i class="flaticon-download" style="margin-right: 5px;"></i> Free 
                                                  </a>
                                                  @else
                                                   <a  id="addToCart" class="button button-purpleX btn-primary btn"  data-toggle="modal" href="#add-collection-{{$beats->id}}"><i class="fa fa-shopping-cart"></i>
                                                        + ${{$beats->basic_price}}
                                                    </a>
                                                  @endif
                                              </div>
                                            </div>
                                          </td>
                                        </tr>
                                        <div class="modal fade1" id="add-collection-{{$beats->id}}" style="overflow-y: scroll;">
                                        <?php
                                        $getSingleBeat = \App\Beat::join('users','users.id','=','beats.user_id')->select('beats.name as beatname','beats.basic_price','users.name as username','beats.is_free','beats.image','beats.file','beats.id','beats.premium_price','beats.unlimited_price','beats.exclusive_price')->where('beats.id',$beats->id)->get();


                                        ?>
                   
                                                <div class="modal-dialog" >

                                                    <div class="modal-content" >

                                                        <div class="modal-header">
                                                            

                                                        </div>
                                                       @foreach($getSingleBeat as $singlebeat)
                                                        <div class="modal-body" >
                                                          <div class="new-collection-wrapper">
                                                            <div class="col-xl-12 col-lg-12 col-md-12 col-sm-12">
                                                               <div class="top_songs_list free_music_wrapper m24_cover">
                                                                 <div class="top_songs_list_left" style="width: 50%">
                                                                      <div class="treanding_slider_main_box top_lis_left_content">
                                                                          <div class="">
                                                                             <h3 style="color: white">Basic Price</h3>
                                                                          </div>
                                                                          
                                                                      </div>
                                                                  </div>
                                                                   <div class="top_songs_list_right" style="width: 27%;float: right">
                                                                      <div class="top_list_tract_view">
                                                                         <form method="post" action="{{route('cart.addbeat', $singlebeat->id)}}">
                                                                          @csrf
                                                                          <input type="hidden" name="beatprice" value="{{ $singlebeat->basic_price}}">
                                                                           <input type="hidden" name="beatid" value="{{ $singlebeat->id}}">
                                                                             <button type="submit"  class="button button-purpleX btn-primary btn"  ><i class="fa fa-shopping-cart"></i>
                                                                              $ {{ $singlebeat->basic_price}}
                                                                          </button>
                                                                         </form>
                                                                           
                                                                          
                                                                          <!-- <div class="price mt-2"> -->
                                                                              
                                                                          
                                                                          <!-- </div> -->
                                                                      </div> 
                                                                  </div>
                                                                  <div class="features" style="color: white;margin-top: 33px;">
                                                                    <div class="feature-container ng-star-inserted" style="">
                                                                        <div class="row">
                                                                            <div class="col-md-6">
                                                                                <div class="feature ng-star-inserted">
                                                                                     
                                                                                     <i><img src="/public/images/icon-bcon-record.png" width="20" height="auto"></i>
                                                                                    <span>Used for Music Recording</span>
                                                                               </div>
                                                                                <div class="feature ng-star-inserted">
                                                                                    <i><img src="/public/images/icon-bcon-stream-music.png" width="25" height="auto"></i>

                                                                                    <span>50000 Online Audio Streams</span>
                                                                                </div>
                                                                                
                                                                            <div class="feature ng-star-inserted">
                                                                                    <i><img src="/public/images/icon-bcon-live-performance.png" width="20" height="auto"></i>
                                                                                    <span>For Profit Live Performances</span>
                                                                                </div></div>
                                                                            <div class="col-md-6">
                                                                                <div class="feature ng-star-inserted">
                                                                                    <i><img src="/public/images/icon-bcon-distribute.png" width="20" height="auto"></i>
                                                                                    <span>Distribute up to 250 copies</span>
                                                                                </div><div class="feature ng-star-inserted">
                                                                                    <i><img src="/public/images/icon-bcon-video.png" width="20" height="auto"></i>
                                                                                    <span>1 Music Video</span>
                                                                                </div>
                                                                                
                                                                                <div class="feature ng-star-inserted">
                                                                                    <i><img src="/public/images/icon-bcon-broadcasting.png" width="20" height="auto"></i>

                                                                                    <span>Radio Broadcasting rights (1 Stations)</span>
                                                                                </div>
                                                                            </div>
                                                                        </div>
                                                                    </div>
                                                                </div>
                                                               </div>
                                                            </div>
                                                            <div class="col-xl-12 col-lg-12 col-md-12 col-sm-12">
                                                                        <div class="top_songs_list free_music_wrapper m24_cover">
                                                                            <div class="top_songs_list_left" style="width: 50%">
                                                                                <div class="treanding_slider_main_box top_lis_left_content">
                                                                                    <div class="">
                                                                                       <h3 style="color: white">Premium Price</h3>
                                                                                    </div>
                                                                                    
                                                                                </div>
                                                                            </div>
                                                                            <div class="top_songs_list_right" style="width: 27%;float: right">
                                                                                <div class="top_list_tract_view">
                                                                                   
                                                                                     <form method="post" action="{{route('cart.addbeat', $singlebeat->id)}}">
                                                                                    @csrf
                                                                                    <input type="hidden" name="beatprice" value="{{ $singlebeat->premium_price}}">
                                                                                     <input type="hidden" name="beatid" value="{{ $singlebeat->id}}">
                                                                                       <button type="submit"  class="button button-purpleX btn-primary btn"  ><i class="fa fa-shopping-cart"></i>
                                                                                        $ {{ $singlebeat->premium_price}}
                                                                                    </button>
                                                                                   </form>
                                                                                    
                                                                                    <!-- <div class="price mt-2"> -->
                                                                                        
                                                                                    
                                                                                    <!-- </div> -->
                                                                                </div>
                                                                                
                                                                            </div>
                                                                            <div class="features" style="color: white;margin-top: 33px;">
                                                                                <div class="feature-container ng-star-inserted" style="">
                                                                                    <div class="row">
                                                                                        <div class="col-md-6">
                                                                                            <div class="feature ng-star-inserted">
                                                                                                 
                                                                                                 <i><img src="/public/images/icon-bcon-record.png" width="20" height="auto"></i>
                                                                                                <span>Used for Music Recording</span>
                                                                                           </div>
                                                                                            <div class="feature ng-star-inserted">
                                                                                                <i><img src="/public/images/icon-bcon-stream-music.png" width="25" height="auto"></i>

                                                                                                <span>100000 Online Audio Streams</span>
                                                                                            </div>
                                                                                            
                                                                                        <div class="feature ng-star-inserted">
                                                                                                <i><img src="/public/images/icon-bcon-live-performance.png" width="20" height="auto"></i>
                                                                                                <span>For Profit Live Performances</span>
                                                                                            </div></div>
                                                                                        <div class="col-md-6">
                                                                                            <div class="feature ng-star-inserted">
                                                                                                <i><img src="/public/images/icon-bcon-distribute.png" width="20" height="auto"></i>
                                                                                                <span>Distribute up to 500 copies</span>
                                                                                            </div><div class="feature ng-star-inserted">
                                                                                                <i><img src="/public/images/icon-bcon-video.png" width="20" height="auto"></i>
                                                                                                <span>1 Music Video</span>
                                                                                            </div>
                                                                                            
                                                                                            <div class="feature ng-star-inserted">
                                                                                                <i><img src="/public/images/icon-bcon-broadcasting.png" width="20" height="auto"></i>

                                                                                                <span>Radio Broadcasting rights (2 Stations)</span>
                                                                                            </div>
                                                                                        </div>
                                                                                    </div>
                                                                                </div>
                                                                            </div>
                                                                        </div>
                                                                        
                                                            </div>
                                                             <div class="col-xl-12 col-lg-12 col-md-12 col-sm-12">
                                                                  <div class="top_songs_list free_music_wrapper m24_cover">
                                                                      <div class="top_songs_list_left" style="width: 50%">
                                                                          <div class="treanding_slider_main_box top_lis_left_content">
                                                                              <div class="">
                                                                                 <h3 style="color: white">Unlimited Price</h3>
                                                                              </div>
                                                                              
                                                                          </div>
                                                                      </div>
                                                                      <div class="top_songs_list_right" style="width: 27%;float: right">
                                                                          <div class="top_list_tract_view">
                                                                             
                                                                               <form method="post" action="{{route('cart.addbeat', $singlebeat->id)}}">
                                                                              @csrf
                                                                              <input type="hidden" name="beatprice" value="{{ $singlebeat->unlimited_price}}">
                                                                               <input type="hidden" name="beatid" value="{{ $singlebeat->id}}">
                                                                                 <button type="submit"  class="button button-purpleX btn-primary btn"  ><i class="fa fa-shopping-cart"></i>
                                                                                  $ {{ $singlebeat->unlimited_price}}
                                                                              </button>
                                                                             </form>
                                                                              
                                                                              <!-- <div class="price mt-2"> -->
                                                                                  
                                                                              
                                                                              <!-- </div> -->
                                                                          </div>
                                                                          
                                                                      </div>
                                                                      <div class="features"  style="color: white;margin-top: 33px;">
                                                                          <div class="feature-container ng-star-inserted" style="">
                                                                              <div class="row">
                                                                                  <div class="col-md-6">
                                                                                      <div class="feature ng-star-inserted">
                                                                                           
                                                                                           <i><img src="/public/images/icon-bcon-record.png" width="20" height="auto"></i>
                                                                                          <span>Used for Music Recording</span>
                                                                                     </div>
                                                                                      <div class="feature ng-star-inserted">
                                                                                          <i><img src="/public/images/icon-bcon-stream-music.png" width="25" height="auto"></i>

                                                                                          <span>200000 Online Audio Streams</span>
                                                                                      </div>
                                                                                      
                                                                                  <div class="feature ng-star-inserted">
                                                                                          <i><img src="/public/images/icon-bcon-live-performance.png" width="20" height="auto"></i>
                                                                                          <span>For Profit Live Performances</span>
                                                                                      </div></div>
                                                                                  <div class="col-md-6">
                                                                                      <div class="feature ng-star-inserted">
                                                                                          <i><img src="/public/images/icon-bcon-distribute.png" width="20" height="auto"></i>
                                                                                          <span>Distribute up to 1000 copies</span>
                                                                                      </div><div class="feature ng-star-inserted">
                                                                                          <i><img src="/public/images/icon-bcon-video.png" width="20" height="auto"></i>
                                                                                          <span>1 Music Video</span>
                                                                                      </div>
                                                                                      
                                                                                      <div class="feature ng-star-inserted">
                                                                                          <i><img src="/public/images/icon-bcon-broadcasting.png" width="20" height="auto"></i>

                                                                                          <span>Radio Broadcasting rights (3 Stations)</span>
                                                                                      </div>
                                                                                  </div>
                                                                              </div>
                                                                          </div>
                                                                      </div>
                                                                  </div>
                                                                        
                                                              </div>
                                                              <div class="col-xl-12 col-lg-12 col-md-12 col-sm-12">
                                                                        <div class="top_songs_list free_music_wrapper m24_cover">
                                                                            <div class="top_songs_list_left" style="width: 50%">
                                                                                <div class="treanding_slider_main_box top_lis_left_content">
                                                                                    <div class="">
                                                                                       <h3 style="color: white">Exclusive Price</h3>
                                                                                    </div>
                                                                                    
                                                                                </div>
                                                                            </div>
                                                                            <div class="top_songs_list_right" style="width: 27%;float: right">
                                                                                <div class="top_list_tract_view">
                                                                                   
                                                                                     <form method="post" action="{{route('cart.addbeat', $singlebeat->id)}}">
                                                                                    @csrf
                                                                                    <input type="hidden" name="beatprice" value="{{ $singlebeat->exclusive_price}}">
                                                                                     <input type="hidden" name="beatid" value="{{ $singlebeat->id}}">
                                                                                       <button type="submit"  class="button button-purpleX btn-primary btn"  ><i class="fa fa-shopping-cart"></i>
                                                                                        $ {{ $singlebeat->
                                                                                        exclusive_price}}
                                                                                    </button>
                                                                                   </form>
                                                                                    
                                                                                    <!-- <div class="price mt-2"> -->
                                                                                        
                                                                                    
                                                                                    <!-- </div> -->
                                                                                </div>
                                                                                
                                                                            </div>
                                                                            <div class="features" style="color: white;margin-top: 33px;">
                                                                                 <div class="feature-container ng-star-inserted" style="">
                                                                                    <div class="row">
                                                                                        <div class="col-md-6">
                                                                                               <div class="feature ng-star-inserted">
                                                                                                    <i style="margin-right: 12px;"><img src="/public/images/icon-bcon-record.png" width="20"height="auto"></i>
                                                                                                    <span>Used for Music Recording</span>
                                                                                               </div>
                                                                                               <div class="feature ng-star-inserted">
                                                                                                    <i style="margin-right: 12px;"><img src="/public/images/icon-bcon-stream-music.png"width="25" height="auto"></i>
                                                                                                    <span>Unlimited Online Audio Streams</span>
                                                                                               </div>
                                                                                               <div class="feature ng-star-inserted">
                                                                                                    <i style="margin-right: 12px;"><img src="/public/images/icon-bcon-live-performance.png"width="20" height="auto"></i>
                                                                                                    <span>For Profit Live Performances</span>
                                                                                               </div>
                                                                                        </div>
                                                                                        <div class="col-md-6">
                                                                                            <div class="feature ng-star-inserted">
                                                                                                <i style="margin-right: 12px;"><img src="/public/images/icon-bcon-distribute.png" width="20" height="auto"></i>
                                                                                                <span>Distribute up to Unlimited copies</span>
                                                                                            </div><div class="feature ng-star-inserted">
                                                                                                <i style="margin-right: 12px;"><img src="/public/images/icon-bcon-video.png" width="20" height="auto"></i>
                                                                                                <span>1 Music Video</span>
                                                                                            </div>
                                                                                            
                                                                                            <div class="feature ng-star-inserted">
                                                                                                <i style="margin-right: 12px;"><img src="/public/images/icon-bcon-broadcasting.png" width="20" height="auto"></i>

                                                                                                <span>Radio Broadcasting rights (Unlimited Stations)</span>
                                                                                            </div>
                                                                                        </div>
                                                                                    </div>
                                                                                </div>
                                                                            </div>
                                                                        </div>
                                                                        
                                                                    </div>
                                                          </div>
                                                           

                                                        </div>
                                                       @endforeach
                                                        <div class="modal-footer" >

                                                           

                                                        </div>

                                                    </div>

                                                    <!-- /.modal-content -->

                                                </div>

                                                <!-- /.modal-dialog -->

                                            
                                        </div>
                                      @endforeach
                                      </tbody>
                                    </table>
                                      
                                  </div>
                                  {{ $allbeats->links() }}
                              </div>
                          </div>
                      </div>
                      <div class="playlist">
                          <h2 class="text-center" style="color: rgb(143, 64, 176);text-align: center;padding: 20px;">LATEST Songs</h2>
                          <div class="top_songs_wrapper download_trending_track_wrapper m24_cover">
                              <div class="container-fluid">

                                  <div class="row" id="ajaxgetdata">
                                    <table class="table-songs table table-stipped table-hover">
                                      <thead>
                                        <tr>
                                          <th>Title</th>
                                          <th>Tags</th>
                                          <th>Buy</th>
                                        </tr>
                                      </thead>
                                      <tbody>
                                        @foreach($allsongs as $songs)
                                        <tr class="top_songs_list">
                                          <td>
                                            <div class="top_songs_list0img">
                                                @if($songs->image)
                                                <img src="{{URL::to('storage/app/uploads/images')}}/{{$songs->image}}" class="d-none d-sm-block" alt="img" style="height: 50px;width: 60px">
                                                @else
                                                <img src="{{asset('images/tp1.png')}}" class="d-none d-sm-block" alt="img">
                                                @endif
                                                <div class="m24_treanding_box_overlay">
                                                    <div class="m24_tranding_box_overlay"></div>

                                                    <div class="tranding_play_icon">
                                                       <a href="javaScript:;" onclick="changeAudio('{{$songs->song_file}}','{{$songs->name}}')" class="songname">
                                                            <i class="flaticon-play-button"></i>
                                                        </a>
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="release_content_artist top_list_content_artist">
                                                <p><a href="javaScript:;" onclick="changeAudio('{{$songs->song_file}}','{{$songs->name}}')" class="songname">{{$songs->name}}</a></p>
                                            </div>
                                          </td>
                                          <td>
                                            
                                          </td>
                                          <td>
                                            <div class="top_songs_list_right">
                                               <div class="top_list_tract_view">
                                                  @if($songs->song_category=="free")
                                                      <a href="{{url('downloadfree',$songs->id)}}" id="addToCart" class=" button button-purpleX btn-primary btn"><i class="flaticon-download" style="margin-right: 5px;"></i> Free 
                                                  </a>
                                                  @else
                                                   <a target="_blank" href="{{route('cart.add',$songs->id)}}" id="addToCart" class="button button-purpleX btn-primary btn"><i class="fa fa-shopping-cart"></i>
                                                      {{$songs->song_price}}
                                                  </a>
                                                  @endif
                                              </div>
                                            </div>
                                          </td>
                                        </tr>
                                      @endforeach
                                      </tbody>
                                    </table>
                                      
                                  </div>
                                  
                              </div>
                          </div>
                      </div>
                  </div>
              </div>
          </div>
      </div>
      <div class="footer">
          <div class="store-player">
            <div id="player"></div>
          </div>
      </div>
    </div>
    <div id="login" class="login-modal modal fade">
       <div class="modal-dialog">
          <div class="modal-content">
             <div class="modal-header">
                <h4 class="modal-title">Sign In To Continue</h4>
                <button type="button" data-dismiss="modal" aria-hidden="true" class="close">×</button> 

             </div>
             <div class="modal-body">
                <div class="login-wrapper show">
                  <form method="POST" action="{{route('postlogin')}}">
                    @csrf
                   <!----> 
                   <div class="form-group has-feedback">
                      <input type="email" autocomplete="off" name="email" placeholder="Enter username or email" class="form-control" required> 
                   </div>
                   <div class="form-group has-feedback">
                      <input type="password" name="password" placeholder="Password" class="form-control" required> 
                   </div>
                   <div class="clearfix">
                      <div class="checkbox">
                         <label><input type="checkbox"> Remember Me
                         </label> 
                         <div class="pull-right"><a href="https://airbit.com/password/reset" target="_blank" class="text-muted">Forgot your password?</a></div>
                      </div>
                   </div>
                   <button class="login-button btn btn-block btn-primary">
                      <!----> Login
                   </button>
                   <p class="button-label">Need to Signup?</p>
                   <a href="#" class="btn btn-block btn-default">Register Now</a>
                </div>
                <div class="register-wrapper">
                   <!----> 
                   <p>Please enter your registration details below.</p>
                   <div class="form-group has-feedback">
                      <input type="text" placeholder="Name" class="form-control"> <span class="fa fa-user form-control-feedback text-muted"></span> <!---->
                   </div>
                   <div class="form-group has-feedback">
                      <input type="text" placeholder="Username" class="form-control"> <span class="fa fa-user form-control-feedback text-muted"></span> <!---->
                   </div>
                   <div class="form-group has-feedback">
                      <input type="email" placeholder="Email Address" class="form-control"> <span class="fa fa-at form-control-feedback text-muted"></span> <!---->
                   </div>
                   <div class="form-group has-feedback">
                      <input type="password" placeholder="Password" class="form-control"> <span class="fa fa-lock form-control-feedback text-muted"></span> 
                      <span class="help-block">
                         <span>Min. 6 characters </span> <!---->
                      </span>
                   </div>
                   <div class="form-group has-feedback">
                      <input type="password" placeholder="Confirm Password" class="form-control"> <span class="fa fa-lock form-control-feedback text-muted"></span> <!---->
                   </div>
                   <div class="form-group">
                      <button type="submit" class="btn btn-primary btn-block">
                         <!----> Register
                      </button>
                   </div>
                   <p class="button-label">Already have an account?</p>
                   <a href="#" class="btn btn-block btn-default">Login Now</a>
                </div>
             </div>
          </div>
       </div>
    </div>

    <!-- Bootstrap core JavaScript-->

    <script src="{{asset('js/jquery.min.js')}}"></script>

    <script src="{{asset('js/bootstrap.bundle.min.js')}}"></script>

     <script src="{{asset('js/vpplayer.js')}}"></script>

    <!-- Core plugin JavaScript-->

    <script src="https://ajax.googleapis.com/ajax/libs/jqueryui/1.10.3/jquery-ui.min.js"></script>
    <script type="text/javascript" src="https://cdn.datatables.net/v/dt/dt-1.10.12/datatables.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/select2@4.0.13/dist/js/select2.min.js"></script>
    <!-- Custom scripts for all pages-->

    <script type="text/javascript">
      $(document).ready(function(){
        $("#player").vpplayer({
          src: "./audio/audio.mp3",
          trackName: "sample audio",
          playerName: "BeatByte",
          playerColor:"#71328b,#0000009c",
          displayColor:"#475c8a,#000710",
          trackPoster:"/../public/images/rt1.png",

        });
      });
      function changeAudio(source, audio,image){
        $("#player").vpplayer({
          src: source,
          trackName: audio,
          playerColor:"#71328b,#0000009c",
          displayColor:"#475c8a,#000710",
          trackPoster:image

        });
        setTimeout(function() {
          $('.track-control-group .play').trigger('click');
        }, 500);
        
      }
       $(function () {
        

        $( "#tablecontents" ).sortable({
          items: "tr",
          cursor: 'move',
          opacity: 0.6,
          update: function() {
              sendOrderToServer();
          }
        });

        function sendOrderToServer() {
          var order = [];
          var token = $('meta[name="csrf-token"]').attr('content');
          $('tr.row1').each(function(index,element) {
            order.push({
              id: $(this).attr('data-id'),
              position: index+1
            });
          });

          $.ajax({
            type: "POST", 
            dataType: "json", 
            url: "{{ url('beat-sortable') }}",
                data: {
              order: order,
              _token: token
            },
            success: function(response) {
                if (response.status == "success") {
                  console.log(response);
                } else {
                  console.log(response);
                }
            }
          });
        }
      });
    </script>
    <script>
    $(document).ready(function(){
      $(".search input[name='search']").on("keyup", function() {
        var value = $(this).val().toLowerCase();
        $(".table-songs tr").filter(function() {
          $(this).toggle($(this).text().toLowerCase().indexOf(value) > -1)
        });
      });
    });
</script>
    </div>
    @else
      <p style="color: #fff;font-size: 13px;">{{$error}}</p>
    @endif

</body>

</html>

