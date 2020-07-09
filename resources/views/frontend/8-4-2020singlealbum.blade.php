@extends('frontend.layouts.default_black')
@section('content')
<style type="text/css">
    ul > .nav.nav-tabs{

  border: none;
    color:#fff;
    background:#272e38;
    border-radius:0;

}
ul > div a.nav-item.nav-link,
ul > div a.nav-item.nav-link.active
{
  border: none;
    padding: 18px 25px;
    color:#fff;
    background:#272e38;
    border-radius:0;
}




ul > div a.nav-item.nav-link:hover,
ul > div a.nav-item.nav-link:focus
{
  border: none;
    background: #e74c3c;
    color:#fff;
    border-radius:0;
    transition:background 0.20s linear;
}
.tab-items{
    margin-left: 125px;
}





.comment {
    position: relative;
    display: flex;
    align-items: center;
    height: 54px;
    padding: 0 7px 0 12px;
    background-color: rgba(255,255,255,.08);
    border-radius: 3px;
    z-index: 1;
    margin-top: 10px;
}
.avatar {
    display: flex;
}
.image.ng-lazyloaded {
    width: 30px;
    height: 30px;
    max-width: 30px;
    border-radius: 50%;
    background-size: cover;
}
mp-input-mention.ng-star-inserted {
    display: block;
    width: 100%;
}
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

.widget .panel-body { padding:0px; }
.widget .list-group { margin-bottom: 0; }
.widget .panel-title { display:inline }
.widget .label-info { float: right; }
.widget li.list-group-item {border-radius: 0;border: 0;border-top: 1px solid #ddd;}
.widget li.list-group-item:hover { background-color: rgba(86,61,124,.1); }
.widget .mic-info { color: #666666;font-size: 11px; }
.widget .action { margin-top:5px; }
.widget .comment-text { font-size: 12px; }
.widget .btn-block { border-top-left-radius:0px;border-top-right-radius:0px; }
</style>
<div class="container-fluid">
<!-- top navi wrapper Start -->
    <div class="m24_main_wrapper">
        <!-- top song wrapper start -->
        <div class="section-all  album_inner_list auti m24_cover">
            <div class="row">
                <div class="col-md-12"><h1 class="text-center">{{$getalbumdetail->album_name}}</h1></div>
                
            </div>
            <div class="container-fluid">
                <div class="top_songs_wrapper download_trending_track_wrapper m24_cover">
                <div class="row">
                    <div class="col-md-4">
                        <img src="http://beatbyte.co/storage/app/uploads/images/2.jpg" class="d-none d-sm-block" alt="img" style="height: 200px;width: 80%;border-radius: 10px;margin: 0px auto;">
                        <div class="audiodiv">

                            <div class="container-audio" style="background-color: #000;">
                                <audio controls="" loop="" autoplay="" id="audioplayer" controlslist="nodownload">
                                <source src="#">Your browser dose not Support the audio Tag</audio>
                            </div>
                            <div class="container-audio" style="height: 105px;background-color: #000;margin: 0px !important;">
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
                    </div>
                    <div class="col-md-8">
                        <div class="row" id="ajaxgetdata">
                            
                            </div>
                            <div class="row">
                                <div class="col-md-12">
                                    <ul>
                                        <div class="nav nav-tabs nav-fill" id="nav-tab" role="tablist">
                                             <li class="tab-items"><a class="nav-item nav-link " id="nav-home-tab" data-toggle="tab" href="#nav-home" role="tab" aria-controls="nav-home" aria-selected="true" onclick="First()">All Items</a></li>
                                             <li class="tab-items"><a class="nav-item nav-link" id="nav-profile-tab" data-toggle="tab" href="#nav-profile" role="tab" aria-controls="nav-profile" aria-selected="false" onclick="Second()">Comments</a></li>
                                             <li class="tab-items"><a class="nav-item nav-link" id="nav-contact-tab" data-toggle="tab" href="#nav-contact" role="tab" aria-controls="nav-contact" aria-selected="false" onclick="Third()">Fans</a></li>
                                        </div>
                                    </ul>
                                    <div class="tab-content" id="nav-tabContent">
                                        
                                        <div class="tab-pane fade show active" id="nav-home" role="tabpanel" aria-labelledby="nav-home-tab">
                                            @foreach($allsongs as $songs)
                                            <div class="col-xl-12 col-lg-12 col-md-12 col-sm-12">
                                                <div class="top_songs_list free_music_wrapper m24_cover">
                                                    <div class="top_songs_list_left">
                                                        <div class="treanding_slider_main_box top_lis_left_content">
                                                            <div class="top_songs_list0img">
                                                                <img src="{{URL::to('storage/app/uploads/images')}}/{{$getalbumdetail->album_image}}" class="d-none d-sm-block" alt="img" style="height: 50px;width: 60px">
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
                                                                <p><a href="javaScript:;" onclick="PlayAudio('{{$songs->song_file}}')" class="songname">{{$songs->name}}</a></p>

                                                                <p class="various_artist_text"><a href="javaScript:;" onclick="PlayAudio('{{$songs->song_file}}')" class="songname">{{$songs->name}}</a></p>
                                                            </div>
                                                        </div>
                                                    </div>
                                                    <div class="top_songs_list_right">
                                                        <div class="top_list_tract_view">
                                                            <a href="http://beatbyte.co/addcart/49" id="addToCart" class="button-purpleX btn-primary btn"><i class="fas fa-shopping-cart"></i>333</a>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                            @endforeach
                                        </div>
                                        <?php
                                        $allcomments = \App\Comment::where('albumid',$getalbumdetail->id)->get();

                                        ?>
                                        <div class="tab-pane fade" id="nav-profile" role="tabpanel" aria-labelledby="nav-profile-tab">
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
                                                                    <div class="col-xs-2 col-md-3">
                                                                        <img src="{{asset('images/default-avatar1.svg')}}" alt="" style="height: 100px;width: 100px;border-radius: 60px" /></div>
                                                                    <div class="col-xs-10 col-md-9">
                                                                        <div>
                                                                            <a href="">
                                                                                {{ $comment->comment}}</a>
                                                                            <div class="mic-info">
                                                                                By: <a href="#">{{ $comment->comment}}
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
                                        <div class="tab-pane fade" id="nav-contact" role="tabpanel" aria-labelledby="nav-contact-tab">
                                            <table class="table" cellspacing="0">
                                                <thead>
                                                    <tr>
                                                        <th>3</th>
                                                        <th>Date</th>
                                                        <th>Award Position</th>
                                                    </tr>
                                                </thead>
                                                <tbody>
                                                    <tr>
                                                        <td><a href="#">Work 1</a></td>
                                                        <td>Doe</td>
                                                        <td>john@example.com</td>
                                                    </tr>
                                                    <tr>
                                                        <td><a href="#">Work 2</a></td>
                                                        <td>Moe</td>
                                                        <td>mary@example.com</td>
                                                    </tr>
                                                    <tr>
                                                        <td><a href="#">Work 3</a></td>
                                                        <td>Dooley</td>
                                                        <td>july@example.com</td>
                                                    </tr>
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
    function First()
    {
        var addclass = document.getElementById("nav-home");
        addclass.classList.add("active");
        ddclass.classList.add("show");
        var addclass1 = document.getElementById("nav-home-tab");
        addclass1.classList.add("active");
        ddclass1.classList.add("show");
        var removeclasslasttab = document.getElementById("nav-contact-tab");
        removeclasslasttab.classList.remove("active");
        var removeclasslasttabshow = document.getElementById("nav-contact");
        removeclasslasttabshow.classList.remove("show");
        removeclasslasttabshow.classList.remove("active");
        var removeclasssectab = document.getElementById("nav-profile-tab");
        removeclasssectab.classList.remove("active");
        removeclasssectab.classList.remove("show");
         var removeclasssectabshow = document.getElementById("nav-profile");
        removeclasssectabshow.classList.remove("show");
        removeclasssectabshow.classList.remove("active");
    }  
    function Second()
    {
        var activesecond = document.getElementById("nav-profile");
        activesecond.classList.add("active");
        var removeshowthird = document.getElementById("nav-contact");
        removeshowthird.classList.remove("show");
        var removeshowthirdactive = document.getElementById("nav-contact-tab");
        removeshowthirdactive.classList.remove("active");
        var removeclassfirst = document.getElementById("nav-home-tab");
        removeclassfirst.classList.remove("active");
        
    } 
    function Third()
    {
        var removeclassthirdactive = document.getElementById("nav-contact");
        removeclassthirdactive.classList.remove("active");
        var removeclassfirstactive = document.getElementById("nav-home");
        removeclassfirstactive.classList.remove("active");
         var removeclasssecactive = document.getElementById("nav-profile");
        removeclasssecactive.classList.remove("active");
    }      
</script>
@stop