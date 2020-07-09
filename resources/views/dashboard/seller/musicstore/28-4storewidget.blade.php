<!DOCTYPE html>

<html lang="en">

<head>

  <meta charset="utf-8">

  <meta http-equiv="X-UA-Compatible" content="IE=edge">

  <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">

  <meta name="description" content="">

  <meta name="author" content="">

  <title>Beat Byte</title>

  <!-- Bootstrap core CSS-->

  <link href="{{asset('css/bootstrap.min.css')}}" rel="stylesheet">

  <!-- Custom fonts for this template-->

  <link href="{{asset('css/font-awesome.min.css')}}" rel="stylesheet" type="text/css">
  <link href="{{asset('css/vpplayer.css')}}" rel="stylesheet">
  <link rel="stylesheet" type="text/css" href="{{asset('css/flaticon.css')}}">
  <link rel="stylesheet" type="text/css" href="{{asset('css/html5widget.css')}}">

  <!-- <link href="{{asset('css/dropzone.css')}}" rel="stylesheet"> -->

</head>

<body class="fixed-nav sticky-footer bg-dark" id="page-top">
  @if(!isset($error))
   <div id="player-wrapper" class="player-wrapper">
      <div class="top-bar">
          <a href="{{route('cart')}}" class="buy cart-icon" style="text-decoration: none;"><i class="fa fa-shopping-cart"></i> Buy Now</a>
      </div>
      <div>
          <div class="main-body main-body-with-side-pannel mCustomScrollbar _mCS_3 mCS-autoHide" style="overflow: visible;">
              <div id="mCSB_3" class="mCustomScrollBox mCS-minimal mCSB_vertical mCSB_outside" tabindex="0" style="max-height: none;">
                  <div id="mCSB_3_container" class="mCSB_container" style="position:relative; top:0; left:0;" dir="ltr">
                      <div class="profile">
                          <div class="left-col">
                              <div class="avatar"><img src="https://cdn.airbit.com/avatars/default@300x.jpg" class="mCS_img_loaded"></div>
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
                                      <div class="total-items-short-title">
                                          Beats
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
                                    <table class="table-songs table table-stipped table-hover">
                                      <thead>
                                        <tr>
                                          <th>Title</th>
                                          <th>Tags</th>
                                          <th>Buy</th>
                                        </tr>
                                      </thead>
                                      <tbody>
                                        @foreach($allbeats as $beats)
                                        <tr class="top_songs_list">
                                          <td>
                                            <div class="top_songs_list0img">
                                                @if($beats->image)
                                                <img src="{{URL::to('storage/app/uploads/images')}}/{{$beats->image}}" class="d-none d-sm-block" alt="img" style="height: 50px;width: 60px">
                                                @else
                                                <img src="{{asset('images/tp1.png')}}" class="d-none d-sm-block" alt="img">
                                                @endif
                                                <div class="m24_treanding_box_overlay">
                                                    <div class="m24_tranding_box_overlay"></div>

                                                    <div class="tranding_play_icon">
                                                       <a href="javaScript:;" onclick="changeAudio('{{$beats->file}}','{{$beats->name}}')" class="songname">
                                                            <i class="flaticon-play-button"></i>
                                                        </a>
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="release_content_artist top_list_content_artist">
                                                <p><a href="javaScript:;" onclick="changeAudio('{{$beats->file}}','{{$beats->name}}')" class="songname">{{$beats->name}}</a></p>
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
                                                   <a target="_blank" href="{{route('cart.addbeat',$beats->id)}}" id="addToCart" class="button button-purpleX btn-primary btn"><i class="fa fa-shopping-cart"></i>
                                                      {{$beats->basic_price}}
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
                                  {{ $allbeats->links() }}
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

    <script src="https://cdn.jsdelivr.net/npm/select2@4.0.13/dist/js/select2.min.js"></script>
    <!-- Custom scripts for all pages-->

    <script type="text/javascript">
      $(document).ready(function(){
        $("#player").vpplayer({
          src: "./audio/audio.mp3",
          trackName: "sample audio",
          playerName: "BeatByte",
          playerColor:"#71328b,#0000009c",
          displayColor:"#475c8a,#000710"

        });
      });
      function changeAudio(source, audio){
        $("#player").vpplayer({
          src: source,
          trackName: audio,
          playerColor:"#71328b,#0000009c",
          displayColor:"#475c8a,#000710"
        });
        setTimeout(function() {
          $('.track-control-group .play').trigger('click');
        }, 500);
        
      }
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

