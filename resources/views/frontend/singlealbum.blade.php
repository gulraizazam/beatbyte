@extends('frontend.layouts.default_black')
@section('content')
<style type="text/css">
    .input-text {
    flex-direction: column;
    align-items: flex-start;
    justify-content: center;
    flex: 1;
    height: 40px;
    margin-right: 10px;
    padding: 0;
    background: 0 0;
    border: unset;
}
input.ng-untouched.ng-pristine.ng-invalid {
    padding: 0 80px 0 12px;
}
.comment .avatar.image {
    width: 30px;
    height: 30px;
    max-width: 30px;
    border-radius: 50%;
    background-size: cover;
}
[_nghost-mil-c47] {
    display: block;
    width: 100%;
}
.input-text[_ngcontent-mil-c47] {
    flex-direction: column;
    align-items: flex-start;
    justify-content: center;
    flex: 1;
    height: 40px;
    margin-right: 10px;
    padding: 0;
    background: 0 0;
    border: unset;
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
.footer{
    height: 108px !important;
}
.track-picture-container img {
    width: 70%;
    height: 100%;
    padding: 5px;
    margin-left: 30px;
}
.mb-5{
    margin-bottom: 4rem!important;
}
</style>

<div class="container-fluid">
<!-- top navi wrapper Start -->
    <div class="m24_main_wrapper">
        <!-- top song wrapper start -->
        <div class="section-all  album_inner_list auti m24_cover">
            <div class="row">
                <div class="col-md-12"><h1 class="text-center">{{$getalbumdetail->album_name}}</h1>

                </div>
                
            </div>
            <div class="container-fluid">
                <div class="top_songs_wrapper download_trending_track_wrapper m24_cover">
                <div class="row">
                    <div class="col-md-4">
                        @if($getalbumdetail->album_image)
                        <img src="{{URL::to('storage/app/uploads/images')}}/{{$getalbumdetail->album_image}}" class="d-none d-sm-block" alt="img" style="height: 300px;width: 60%;border-radius: 10px;margin: 0px auto;">
                        @else
                        <img src="{{asset('images/placeholder@100x.jpg')}}" class="d-none d-sm-block" alt="img" style="height: 200px;width: 80%;border-radius: 10px;margin: 0px auto;">
                        @endif
                       
                        
                    </div>
                    <div class="col-md-8">
                        <div class="row" id="ajaxgetdata">
                            
                            </div>
                            <div class="row">
                                <div class="col-md-12">
                                     @if(session()->has('error'))
                                                <div class="alert alert-danger">
                                                    {{ session()->get('error') }}
                                                </div>
                                            @endif
                                    <ul class="nav nav-tabs" id="myTab" role="tablist">
                                        <li class="nav-item col-md-6">
                                        <a class="nav-link active" id="home-tab" data-toggle="tab" href="#home" role="tab" aria-controls="home" aria-selected="true">All Items</a>
                                        </li>
                                        <li class="nav-item col-md-6" >
                                        <a class="nav-link" id="profile-tab" data-toggle="tab" href="#profile" role="tab" aria-controls="profile" aria-selected="false">Comments</a>
                                        </li>
                                        
                                    </ul>
                                    <div class="tab-content" id="myTabContent">
                                        <div class="tab-pane fade show active" id="home" role="tabpanel" aria-labelledby="home-tab">
                                             @foreach($allsongs as $songs)
                                            <div class="col-xl-12 col-lg-12 col-md-12 col-sm-12">
                                                <div class="top_songs_list free_music_wrapper m24_cover">
                                                    <div class="top_songs_list_left">
                                                        <div class="treanding_slider_main_box top_lis_left_content">
                                                            <div class="top_songs_list0img">
                                                                @if($songs->image)
                                                               
                                                                <a href="javaScript:;" onclick="PlayAudio('{{$songs->song_file}}','{{$songs->name}}')" class="songname"><img src="{{$songs->image}}" class="d-none d-sm-block" alt="img" style="height: 50px;width: 60px"></a>
                                                                @else
                                                                 <a href="javaScript:;" onclick="PlayAudio('{{$songs->song_file}}','{{$songs->name}}')" class="songname"><img src="{{asset('images/tp1.png')}}" class="d-none d-sm-block" alt="img" style="height: 50px;width: 60px"></a>
                                                                 @endif
                                                                <div class="m24_treanding_box_overlay">
                                                                    <div class="m24_tranding_box_overlay"></div>

                                                                    <div class="tranding_play_icon">
                                                                        <a href="javaScript:;" onclick="PlayAudio('{{$songs->song_file}}','{{$songs->name}}')">
                                                                            <i class="flaticon-play-button"></i>
                                                                        </a>
                                                                    </div>
                                                                </div>
                                                            </div>
                                                            <div class="release_content_artist top_list_content_artist">
                                                                <p><a href="javaScript:;" onclick="PlayAudio('{{$songs->song_file}}','{{$songs->name}}')" class="songname">{{$songs->name}}</a></p>

                                                                <p class="various_artist_text"><a href="javaScript:;" onclick="PlayAudio('{{$songs->song_file}}','{{$songs->name}}')" class="songname">{{$songs->name}}</a></p>
                                                            </div>
                                                        </div>
                                                    </div>
                                                    <div class="top_songs_list_right">
                                                        <div class="top_list_tract_view">
                                                            @if($songs->song_category=="free")
                                                   
                                                    <a href="{{url('downloadfree',$songs->id)}}" id="addToCart" class=" button button-purpleX btn-primary btn"><i class="flaticon-download" style="margin-right: 5px;"></i> Free
                                                        
                                                    </a>
                                                    @else
                                                     <a href="{{route('cart.add',$songs->id)}}" id="addToCart" class=" button button-purpleX btn-primary btn"><i class="fas fa-shopping-cart"></i>
                                                        $ {{$songs->song_price}}
                                                    </a>
                                                    @endif
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                            @endforeach
                                        </div>
                                        <?php
                                        $allcomments = \App\Comment::join('users','users.id','=','comments.userid')->where('albumid',$getalbumdetail->id)->where('comments.is_approved',1)->get();
                                        
                                        ?>
                                        <div class="tab-pane fade" id="profile" role="tabpanel" aria-labelledby="profile-tab">
                                            <form action="{{route('comment.add')}}" method="post">
                                               @csrf
                                                <input type="hidden" name="albumid" value="{{$getalbumdetail->id}}">
                                                <input type="hidden" name="userid" value="{{Auth::user() ? Auth::user()->id : ''}}">
                                                <div ngcontent-mil-c44="" class="comment">
                                                    <div ngcontent-mil-c44="" class="avatar">
                                                        <div ngcontent-mil-c44="" class="image ng-lazyloaded" style="background-image: url('/public/images/default-avatar1.svg');"></div>
                                                    </div>
                                                    <!---->
                                                    <mp-input-mention ngcontent-mil-c44="" nghost-mil-c47="" class="ng-star-inserted">
                                                        <div ngcontent-mil-c47="" class="input-text">
                                                            <input ngcontent-mil-c47="" autocomplete="off" name="comment" required="" type="text" placeholder="Write a comment..." maxlength="240" class="ng-untouched ng-pristine ng-invalid">
                                                            <!---->
                                                            <div ngcontent-mil-c47="" class="mention-list">
                                                                <ul _ngcontent-mil-c47="">
                                                                    <!---->
                                                                </ul>
                                                            </div>
                                                        </div>
                                                    </mp-input-mention>
                                                    <!---->
                                                    <button type="submit" class="btn btn-primary">Send</button>
                                                </div>
                                            </form>
                                           
                                            <div class="row" style="width: 100%;">
                                                <div class="panel panel-default widget" style="width: 100%">
                                                    <div class="panel-heading">
                                                        <span class="glyphicon glyphicon-comment"></span>
                                                        
                                                    </div>
                                                    <div class="panel-body">
                                                        <ul class="list-group">
                                                            @foreach($allcomments as $comment)
                                                            <li class="list-group-item" style=" background:black">
                                                                <div class="row" >
                                                                    <div class="col-md-2">
                                                                        <img src="{{asset('images/default-avatar1.svg')}}" alt="" style="height: 51px;width: 90px;" /></div>
                                                                    <div class="col-xs-10 col-md-9">
                                                                        <div>
                                                                            <a href="">
                                                                                {{ $comment->comment}}</a>
                                                                            <div class="mic-info">
                                                                                By: <a href="#">{{ $comment->name}}
                                                                            </div>
                                                                        </div>
                                                                        
                                                                       
                                                                    </div>
                                                                </div>
                                                            </li>
                                                            @endforeach
                                                        </ul>
                                                        
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                        
                                    </div>
                                    
                                </div>
                            </div>
                        </div>
                    </div>
                </div>    
            </div>
        </div>
    </div>
</div>
<div class="adonis-player-wrap index3_adoins_wrapper">
        <div id="adonis_jplayer_main" class="jp-jplayer"></div>
        <div id="adonis_jp_container" class="master-container-holder jp-audio" role="application" aria-label="media player">
            <div class="adonis-player-horizontal">
                <div class="master-container-fluid">
                    <div class="row adonis-player">
                        <div class="col-sm-12 col-lg-2 col-xl-2 col-xs-2 resp p-0 text-center">
                            <div class="player-controls">
                                <div class="control-primary">
                                    <a class="jp-previous" id="previousbutton" role="button" tabindex="0"><span
                                            class="adonis-icon icon-3x"><svg version="1.1"
                                                xmlns="http://www.w3.org/2000/svg" viewBox="0 0 58 32">
                                                <path
                                                    d="M55.064 0.272l-25.2 14.192c-0.555 0.299-0.925 0.876-0.925 1.54s0.371 1.241 0.916 1.535l0.009 0.005c1.336 0.784 23.64 13.344 25.256 14.216 0.265 0.162 0.585 0.258 0.928 0.258 0.986 0 1.787-0.793 1.8-1.777v-28.433c0-0.004 0-0.009 0-0.014 0-0.999-0.809-1.808-1.808-1.808-0.362 0-0.7 0.107-0.983 0.29l0.007-0.004zM26.12 0.272c-1.112 0.624-23.304 13.12-25.192 14.192-0.555 0.299-0.925 0.876-0.925 1.54s0.371 1.241 0.916 1.535l0.009 0.005c1.36 0.8 23.64 13.344 25.248 14.216 0.265 0.161 0.586 0.257 0.928 0.257 0.987 0 1.79-0.792 1.808-1.775l0-0.002v-28.432c0-0.001 0-0.003 0-0.005 0-1.003-0.813-1.816-1.816-1.816-0.362 0-0.7 0.106-0.983 0.289l0.007-0.004z">
                                                </path>
                                            </svg></span></a>
                                    <a class="jp-play" role="button" tabindex="0">
                                        <span class="adonis-icon icon-play icon-2x" style="padding-left: 3px;"><svg version="1.1"
                                                xmlns="http://www.w3.org/2000/svg" viewBox="0 0 29 32">
                                                <path
                                                    d="M27.703 14.461l-24.945-14.187c-0.272-0.174-0.604-0.278-0.96-0.278-0.993 0-1.798 0.805-1.798 1.798 0 0.001 0 0.002 0 0.004v-0 28.434c0.004 0.982 0.801 1.776 1.783 1.776 0.338 0 0.653-0.094 0.922-0.257l-0.008 0.004c1.524-0.869 23.65-13.44 25.006-14.217 0.549-0.303 0.914-0.878 0.914-1.539s-0.366-1.236-0.905-1.534l-0.009-0.005z">
                                                </path>
                                            </svg></span>
                                        <span class="adonis-icon icon-pause icon-2x"><svg version="1.1"
                                                xmlns="http://www.w3.org/2000/svg" viewBox="0 0 29 32">
                                                <path
                                                    d="M19.2 0h8c0.884 0 1.6 0.716 1.6 1.6v28.8c0 0.884-0.716 1.6-1.6 1.6h-8c-0.884 0-1.6-0.716-1.6-1.6v-28.8c0-0.884 0.716-1.6 1.6-1.6z">
                                                </path>
                                                <path
                                                    d="M1.6 0h8c0.884 0 1.6 0.716 1.6 1.6v28.8c0 0.884-0.716 1.6-1.6 1.6h-8c-0.884 0-1.6-0.716-1.6-1.6v-28.8c0-0.884 0.716-1.6 1.6-1.6z">
                                                </path>
                                            </svg></span></a>
                                    <a class="jp-next" id="nextbutton" role="button" tabindex="0"><span class="adonis-icon icon-3x"><svg
                                                version="1.1" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 58 32">
                                                <path
                                                    d="M28 14.464l-25.216-14.192c-0.276-0.179-0.614-0.286-0.976-0.286-0.999 0-1.808 0.809-1.808 1.808 0 0.005 0 0.010 0 0.015v-0.001 28.432c0.013 0.985 0.814 1.778 1.8 1.778 0.343 0 0.663-0.096 0.936-0.262l-0.008 0.005c1.6-0.872 23.896-13.432 25.256-14.216 0.559-0.298 0.934-0.877 0.934-1.544 0-0.66-0.367-1.235-0.908-1.531l-0.009-0.005zM56.944 14.464l-25.216-14.192c-0.276-0.179-0.614-0.286-0.976-0.286-0.999 0-1.808 0.809-1.808 1.808 0 0.005 0 0.010 0 0.015v-0.001 28.432c0.013 0.985 0.814 1.778 1.8 1.778 0.343 0 0.663-0.096 0.936-0.262l-0.008 0.005c1.6-0.872 23.888-13.432 25.256-14.216 0.55-0.303 0.917-0.879 0.917-1.54s-0.367-1.237-0.908-1.535l-0.009-0.005z">
                                                </path>
                                            </svg></span></a>
                                </div>
                            </div>
                        </div>
                        <div class="col-sm-1 col-lg-1 col-xl-1 col-1 p-0 d-none d-lg-block">
                            <div class="jp-volume-controls pt-3">
                                <a class="adonis-mute-control" role="button" tabindex="0">
                                    <span class="adonis-icon icon-volume icon-3x"><svg version="1.1" xmlns="http://www.w3.org/2000/svg"
                                            viewBox="0 0 48 32">
                                            <path
                                                d="M31.76 9.056l-1.36 2.592c1.265 1.020 2.071 2.567 2.080 4.302v0.002c0 1.896-0.456 3.616-1.952 4.648l1.28 2.184c1.962-1.642 3.202-4.092 3.202-6.831 0-2.776-1.272-5.254-3.266-6.884l-0.016-0.013zM36.664 4.424l-1.664 2.288c2.479 2.331 4.027 5.627 4.040 9.286v0.002c-0.027 3.717-1.634 7.053-4.182 9.375l-0.010 0.009 1.728 2.2c3.058-2.92 4.96-7.028 4.96-11.581 0-0.001 0-0.002 0-0.003v0c-0.017-4.532-1.877-8.626-4.87-11.574l-0.002-0.002zM41.6 0l-1.848 2.168c3.497 3.563 5.665 8.442 5.696 13.826l0 0.006c-0.043 5.368-2.202 10.223-5.683 13.779l0.003-0.003 1.832 2.168c3.946-4.151 6.373-9.778 6.373-15.972s-2.427-11.821-6.383-15.982l0.009 0.010zM0 10.888v10.4c0 1.328 1.2 3.016 2.688 3.016h8.080v-16.616h-8.080c-1.488 0-2.688 1.912-2.688 3.2zM23.272 0.136l-11.272 7.4v16.984l11.272 7.48c1.48 0 3.608-1.072 3.608-2.4v-27.072c0-1.32-2.128-2.392-3.608-2.392z">
                                            </path>
                                        </svg></span>
                                    <span class="adonis-icon icon-mute icon-3x"><svg version="1.1" xmlns="http://www.w3.org/2000/svg"
                                            viewBox="0 0 18.75 11.95">
                                            <g data-name="Layer 2">
                                                <g id="Group_4" data-name="Group 4">
                                                    <path
                                                        d="M18.75,8.12V9.61H17.26L15.38,7.73,13.49,9.61H12V8.12l1.88-1.89L12,4.35V2.86h1.49l1.89,1.88,1.88-1.88h1.49V4.35L16.87,6.23Z" />
                                                    <g id="sound_2" data-name="sound 2">
                                                        <path class="cls-1"
                                                            d="M0,4V7.92A1.16,1.16,0,0,0,1,9.05H4V2.83H1C.45,2.83,0,3.54,0,4ZM8.73,0,4.51,2.78V9.14L8.73,12c.55,0,1.35-.4,1.35-.9V.9C10.08.4,9.28,0,8.73,0Z" />
                                                    </g>
                                                </g>
                                            </g>
                                        </svg></span>
                                </a>
                                <div class="jp-volume-bar d-flex align-items-center">
                                    <div class="jp-volume-bar-value"></div>
                                </div>
                            </div>
                        </div>
                        
                        <div class="col-sm-12 col-xs-8 col-lg-8 pl-5">
                            <div class="jp-progress d-flex align-items-center jp-progress-pos-top pt-3">
                                <div class="jp-current-time pr-4" role="timer" aria-label="time"></div>
                                <div class="jp-seek-bar">
                                    <div class="jp-play-bar"></div>
                                </div>
                                <div class="jp-duration pl-1" role="timer" aria-label="duration"></div>
                            </div>
                        </div>
                    </div>
                </div>
                <!--./ container-fluid-->
                
            </div>
            <div id="adonis-playlist" class="adonis-playlist off-canvas off-canvas-right">
                <div class="adonis-playlist-player adonis-player player-bg-yellow">
                    <a class="close-offcanvas" data-target="#adonis-playlist" href="#"><span
                            class="adonis-icon icon-3x"><svg version="1.1" xmlns="http://www.w3.org/2000/svg"
                                viewBox="0 0 24 24">
                                <path
                                    d="M13.4 12l5.3-5.3c0.4-0.4 0.4-1 0-1.4s-1-0.4-1.4 0l-5.3 5.3-5.3-5.3c-0.4-0.4-1-0.4-1.4 0s-0.4 1 0 1.4l5.3 5.3-5.3 5.3c-0.4 0.4-0.4 1 0 1.4 0.2 0.2 0.4 0.3 0.7 0.3s0.5-0.1 0.7-0.3l5.3-5.3 5.3 5.3c0.2 0.2 0.5 0.3 0.7 0.3s0.5-0.1 0.7-0.3c0.4-0.4 0.4-1 0-1.4l-5.3-5.3z">
                                </path>
                            </svg></span>
                    </a>
                    <div class="blurred-bg-wrap">
                        <div class="blurred-bg"></div>
                    </div>
                    <div class="media current-item">
                        <div class="song-poster">
                            <img class="box-rounded-sm" src="js/mp3/browse/playlist-2.jpg" alt="">
                        </div>
                        <div class="player-details col-8">
                            <h3 class="jp-title">What Makes You Country</h3>
                            <p class="artist-name">Adonis Music R&amp;B</p>
                            <div class="controls">
                                <div class="side_bar_shuffle">
                                    <a class="jp-shuffle inactive-color" role="button" tabindex="0">
                                        <span class="adonis-icon icon-2x"><svg version="1.1"
                                                xmlns="http://www.w3.org/2000/svg" viewBox="0 0 38 32">
                                                <path
                                                    d="M28.070 17.363c-0.284-0.188-0.634-0.3-1.009-0.3-0.305 0-0.593 0.074-0.846 0.205l0.010-0.005c-0.576 0.304-0.962 0.899-0.962 1.584 0 0 0 0 0 0v0 4.251h-3.609c-1.161-0.002-2.258-0.276-3.23-0.761l0.042 0.019c-0.233-0.117-0.507-0.186-0.797-0.186-0.699 0-1.304 0.397-1.604 0.977l-0.005 0.010c-0.118 0.23-0.187 0.503-0.187 0.791 0 0.7 0.408 1.305 0.999 1.59l0.011 0.005c1.392 0.704 3.033 1.118 4.77 1.123h3.611v3.549c-0 0.005-0 0.011-0 0.017 0 0.675 0.388 1.259 0.953 1.542l0.010 0.005c0.243 0.135 0.533 0.216 0.841 0.221l0.001 0c0.003 0 0.007 0 0.011 0 0.37 0 0.713-0.112 0.998-0.305l-0.006 0.004 8.722-5.634c0.481-0.32 0.794-0.86 0.794-1.474s-0.313-1.153-0.788-1.47l-0.006-0.004zM28.872 26.887v-4.732l3.609 2.366zM1.804 8.882h1.804c1.163 0.010 2.259 0.29 3.23 0.781l-0.042-0.019c0.237 0.125 0.519 0.198 0.818 0.198 0.986 0 1.784-0.799 1.784-1.784 0-0.699-0.402-1.304-0.988-1.597l-0.010-0.005c-1.398-0.702-3.046-1.116-4.79-1.123h-1.807c-0.057-0.006-0.122-0.010-0.189-0.010-0.986 0-1.784 0.799-1.784 1.784s0.799 1.784 1.784 1.784c0.067 0 0.132-0.004 0.197-0.011l-0.008 0.001zM21.694 8.882h3.609v4.271c-0 0.005-0 0.011-0 0.017 0 0.675 0.388 1.259 0.953 1.542l0.010 0.005c0.243 0.135 0.533 0.216 0.841 0.221l0.001 0c0.36-0.006 0.692-0.118 0.969-0.305l-0.006 0.004 8.682-5.694c0.486-0.32 0.802-0.862 0.802-1.479 0-0.002 0-0.003 0-0.005v0c-0.006-0.617-0.32-1.158-0.796-1.48l-0.006-0.004-8.682-5.674c-0.265-0.155-0.583-0.247-0.922-0.247s-0.658 0.092-0.931 0.252l0.009-0.005c-0.576 0.304-0.962 0.899-0.962 1.584 0 0 0 0 0 0v0 3.449h-3.609c-0.012-0-0.026-0-0.040-0-5.925 0-10.733 4.786-10.767 10.704v0.003c-0.068 3.912-3.255 7.058-7.177 7.058-0.022 0-0.043-0-0.064-0l0.003 0h-1.804c-0.986 0-1.784 0.799-1.784 1.784s0.799 1.784 1.784 1.784h1.804c0.024 0 0.053 0 0.081 0 5.897 0 10.687-4.741 10.766-10.619l0-0.007c0.011-3.956 3.221-7.158 7.178-7.158 0.021 0 0.042 0 0.063 0l-0.003-0zM28.912 5.093l3.609 2.366-3.609 2.366z">
                                                </path>
                                            </svg></span>
                                    </a>
                                    <a class="jp-repeat inactive-color" role="button" tabindex="0"><span
                                            class="adonis-icon icon-3x"><svg version="1.1"
                                                xmlns="http://www.w3.org/2000/svg" viewBox="0 0 44 32">
                                                <path
                                                    d="M32.122 4.45c-0.055-0.001-0.119-0.001-0.184-0.001-6.422 0-11.64 5.155-11.742 11.553l-0 0.010c-0.068 4.436-3.68 8.006-8.126 8.006-0.050 0-0.101-0-0.151-0.001l0.008 0c-0.037 0.001-0.080 0.001-0.123 0.001-4.446 0-8.058-3.57-8.126-8l-0-0.006c0.024-3.503 2.299-6.467 5.45-7.521l0.056-0.016v2.194c0.022 0.665 0.408 1.235 0.965 1.519l0.010 0.005c0.26 0.136 0.567 0.218 0.892 0.223l0.002 0c0.014 0 0.031 0.001 0.047 0.001 0.325 0 0.631-0.083 0.897-0.229l-0.010 0.005 7.335-4.45c0.526-0.308 0.874-0.87 0.874-1.514s-0.348-1.206-0.866-1.509l-0.008-0.004-7.335-4.45c-0.273-0.16-0.601-0.254-0.952-0.254-0.32 0-0.622 0.079-0.887 0.218l0.010-0.005c-0.56 0.299-0.935 0.879-0.935 1.547 0 0.006 0 0.012 0 0.019v-0.001 2.987c-5.27 1.124-9.173 5.717-9.224 11.23l-0 0.006c0.114 6.409 5.336 11.562 11.762 11.562 0.058 0 0.115-0 0.173-0.001l-0.009 0c0.049 0.001 0.107 0.001 0.164 0.001 6.426 0 11.649-5.152 11.762-11.551l0-0.011c0.224-4.387 3.836-7.859 8.259-7.859s8.035 3.472 8.258 7.839l0.001 0.020c-0.026 3.497-2.302 6.455-5.45 7.501l-0.056 0.016v-2.194c-0.001-0.667-0.375-1.246-0.925-1.54l-0.009-0.005c-0.268-0.157-0.59-0.25-0.935-0.25s-0.666 0.093-0.943 0.255l0.009-0.005-7.335 4.592c-0.528 0.302-0.877 0.862-0.877 1.503s0.35 1.201 0.869 1.499l0.008 0.004 7.335 4.45c0.272 0.166 0.601 0.264 0.953 0.264 0.008 0 0.016-0 0.024-0h-0.001c0.006 0 0.013 0 0.021 0 0.984 0 1.785-0.787 1.808-1.766l0-0.002v-3.088c5.257-1.133 9.145-5.725 9.183-11.231l0-0.004c-0.114-6.409-5.336-11.562-11.762-11.562-0.058 0-0.115 0-0.173 0.001l0.009-0zM12.841 4.978l2.032 1.239-2.032 1.239zM31.126 27.022l-2.032-1.239 2.032-1.239z">
                                                </path>
                                            </svg></span></a>
                                </div>
                                <div class="sidebar_treanding_icon">
                                    <div class="m24_tranding_more_icon">
                                        <i class="fas fa-ellipsis-h"></i>
                                    </div>
                                    <ul class="tranding_more_option">
                                        <li><a href="#"><span class="opt_icon"><i
                                                        class="flaticon-playlist"></i></span>Add
                                                To playlist</a></li>
                                        <li><a href="#"><span class="opt_icon"><i
                                                        class="flaticon-star"></i></span>favourite</a></li>
                                        <li><a href="#"><span class="opt_icon"><i
                                                        class="flaticon-share"></i></span>share</a></li>

                                        <li><a href="#"><span class="opt_icon"><i
                                                        class="flaticon-trash"></i></span>delete</a></li>
                                    </ul>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="media controls jp_media_playlist">
                        <div class="playlist-player-control align-items-center col-4">
                            <a class="jp-previous" role="button" tabindex="0"><span class="adonis-icon icon-5x"><svg
                                        version="1.1" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 58 32">
                                        <path
                                            d="M55.064 0.272l-25.2 14.192c-0.555 0.299-0.925 0.876-0.925 1.54s0.371 1.241 0.916 1.535l0.009 0.005c1.336 0.784 23.64 13.344 25.256 14.216 0.265 0.162 0.585 0.258 0.928 0.258 0.986 0 1.787-0.793 1.8-1.777v-28.433c0-0.004 0-0.009 0-0.014 0-0.999-0.809-1.808-1.808-1.808-0.362 0-0.7 0.107-0.983 0.29l0.007-0.004zM26.12 0.272c-1.112 0.624-23.304 13.12-25.192 14.192-0.555 0.299-0.925 0.876-0.925 1.54s0.371 1.241 0.916 1.535l0.009 0.005c1.36 0.8 23.64 13.344 25.248 14.216 0.265 0.161 0.586 0.257 0.928 0.257 0.987 0 1.79-0.792 1.808-1.775l0-0.002v-28.432c0-0.001 0-0.003 0-0.005 0-1.003-0.813-1.816-1.816-1.816-0.362 0-0.7 0.106-0.983 0.289l0.007-0.004z">
                                        </path>
                                    </svg></span>
                            </a>
                            <a class="jp-play fs-4" role="button" tabindex="0">
                                <span class="adonis-icon icon-play icon-2x"><svg version="1.1"
                                        xmlns="http://www.w3.org/2000/svg" viewBox="0 0 29 32">
                                        <path
                                            d="M27.703 14.461l-24.945-14.187c-0.272-0.174-0.604-0.278-0.96-0.278-0.993 0-1.798 0.805-1.798 1.798 0 0.001 0 0.002 0 0.004v-0 28.434c0.004 0.982 0.801 1.776 1.783 1.776 0.338 0 0.653-0.094 0.922-0.257l-0.008 0.004c1.524-0.869 23.65-13.44 25.006-14.217 0.549-0.303 0.914-0.878 0.914-1.539s-0.366-1.236-0.905-1.534l-0.009-0.005z">
                                        </path>
                                    </svg></span>
                                <span class="adonis-icon icon-pause icon-2x"><svg version="1.1"
                                        xmlns="http://www.w3.org/2000/svg" viewBox="0 0 29 32">
                                        <path
                                            d="M19.2 0h8c0.884 0 1.6 0.716 1.6 1.6v28.8c0 0.884-0.716 1.6-1.6 1.6h-8c-0.884 0-1.6-0.716-1.6-1.6v-28.8c0-0.884 0.716-1.6 1.6-1.6z">
                                        </path>
                                        <path
                                            d="M1.6 0h8c0.884 0 1.6 0.716 1.6 1.6v28.8c0 0.884-0.716 1.6-1.6 1.6h-8c-0.884 0-1.6-0.716-1.6-1.6v-28.8c0-0.884 0.716-1.6 1.6-1.6z">
                                        </path>
                                    </svg></span>
                            </a>
                            <a class="jp-next" role="button" tabindex="0"><span class="adonis-icon icon-5x"><svg
                                        version="1.1" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 58 32">
                                        <path
                                            d="M28 14.464l-25.216-14.192c-0.276-0.179-0.614-0.286-0.976-0.286-0.999 0-1.808 0.809-1.808 1.808 0 0.005 0 0.010 0 0.015v-0.001 28.432c0.013 0.985 0.814 1.778 1.8 1.778 0.343 0 0.663-0.096 0.936-0.262l-0.008 0.005c1.6-0.872 23.896-13.432 25.256-14.216 0.559-0.298 0.934-0.877 0.934-1.544 0-0.66-0.367-1.235-0.908-1.531l-0.009-0.005zM56.944 14.464l-25.216-14.192c-0.276-0.179-0.614-0.286-0.976-0.286-0.999 0-1.808 0.809-1.808 1.808 0 0.005 0 0.010 0 0.015v-0.001 28.432c0.013 0.985 0.814 1.778 1.8 1.778 0.343 0 0.663-0.096 0.936-0.262l-0.008 0.005c1.6-0.872 23.888-13.432 25.256-14.216 0.55-0.303 0.917-0.879 0.917-1.54s-0.367-1.237-0.908-1.535l-0.009-0.005z">
                                        </path>
                                    </svg></span></a>
                        </div>
                        <div class="col-8">
                            <div class="jp-current-time jp-time" role="timer" aria-label="time"></div>
                            <div class="jp-progress jp_progress2">
                                <div class="jp-seek-bar">
                                    <div class="jp-play-bar"></div>
                                </div>
                            </div>
                            <div class="jp-duration" role="timer" aria-label="duration"></div>
                        </div>
                    </div>
                </div>
                <div class="jp-playlist scroll-y">
                    <ul>
                        <li>&nbsp;</li>
                    </ul>
                </div>
            </div>
        </div>
    </div>
@stop
@section('scripts')
<script type="text/javascript">
     var playlist = [
        <?php $count=1; ?>
        @foreach($allsongs as $song)
            { 
                @if(strpos($song->song_file, '.mp3') !== false) mp3 
                @elseif(strpos($song->song_file, '.wav') !== false) wav
                @endif
                : '{{$song->song_file}}'
            },
        @endforeach
    ];

    new adonisJPlayerPlaylist({
        jPlayer: "#adonis_jplayer_main",
        cssSelectorAncestor: "#adonis_jp_container"
    }, playlist , {
        swfPath: "../../dist/jplayer",
        supplied: "wav, mp3",
        autoBlur: false,
        smoothPlayBar: true,
        keyEnabled: true
    });   

</script>
@stop
