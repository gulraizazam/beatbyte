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
    margin-left: 165px;
}
.comment[_ngcontent-mil-c44] {
    position: relative;
    display: flex;
    align-items: center;
    height: 54px;
    padding: 0 7px 0 12px;
    background-color: rgba(255,255,255,.08);
    border-radius: 3px;
    z-index: 1;
}
.comment[_ngcontent-mil-c44] .avatar[_ngcontent-mil-c44] .image[_ngcontent-mil-c44] {
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
.input-text[_ngcontent-mil-c47] input[_ngcontent-mil-c47] {
    padding: 0 80px 0 12px;
}
.input-text[_ngcontent-mil-c47] > span[_ngcontent-mil-c47] {
    position: absolute;
    display: block;
    right: 15px;
    font-size: 14px;
}
.mention-list[_ngcontent-mil-c47] {
    position: relative;
    z-index: 200;
    opacity: 0;
}
ul[_ngcontent-mil-c47] {
    position: absolute;
    top: 1px;
    left: 0;
    right: 0;
    width: -webkit-fit-content;
    width: -moz-fit-content;
    width: fit-content;
    max-width: 600px;
    box-shadow: 0 3px 1px -2px rgba(0,0,0,.2), 0 2px 2px 0 rgba(0,0,0,.14), 0 1px 5px 0 rgba(0,0,0,.12);
    background: #1b1b1b;
}
.comment-card[_ngcontent-mil-c52] {
    width: 100%;
    max-width: 1300px;
    margin: 28px auto auto;
    padding: 0!important;
    box-shadow: unset!important;
    background-color: #080808;
}
mat-card-content[_ngcontent-mil-c52] {
    display: flex;
    flex-direction: column;
    margin-bottom: 0;
}
mat-card-content[_ngcontent-mil-c52] .main-comment[_ngcontent-mil-c52] {
    display: flex;
}
mat-card-content[_ngcontent-mil-c52] .avatar[_ngcontent-mil-c52] {
    flex-basis: 5%;
}
.avatar[_ngcontent-mil-c52] {
    display: block;
}
.avatar[_ngcontent-mil-c52] img[_ngcontent-mil-c52] {
    width: 100%;
    height: 100%;
    border-radius: 50%;
}
mat-card-content[_ngcontent-mil-c52] .content[_ngcontent-mil-c52] {
    flex-basis: 95%;
}
mat-card-content[_ngcontent-mil-c52] .content[_ngcontent-mil-c52] {
    display: flex;
    flex-direction: column;
    flex-basis: 85%;
    height: auto;
    margin-left: 12px;
}
mat-card-content[_ngcontent-mil-c52] .content[_ngcontent-mil-c52] .posted-by[_ngcontent-mil-c52] {
    display: flex;
    flex-wrap: wrap;
    align-items: center;
    padding-right: 25px;
    font-size: 15px;
    word-wrap: break-word;
    word-break: break-word;
    color: #707070;
}
[_nghost-mil-c38] {
    position: relative;
    overflow: hidden;
}
.wrapper.flex[_ngcontent-mil-c38] {
    display: flex;
    align-items: center;
    overflow: hidden;
}
mat-card-content[_ngcontent-mil-c52] .content[_ngcontent-mil-c52] .comment[_ngcontent-mil-c52] {
    font-size: 15px;
    padding-right: 15px;
    word-wrap: break-word;
    word-break: break-word;
}
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
                                        <source src="#"> Your browser dose not Support the audio Tag
                                    </audio>
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
                                <div class="col-md-12 ">

                                    <ul>
                                        <div class="nav nav-tabs nav-fill" id="nav-tab" role="tablist">
                                            <li class="tab-items"><a class="nav-item nav-link active show" id="nav-home-tab" data-toggle="tab" href="#nav-home" role="tab" aria-controls="nav-home" aria-selected="true">All Items</a></li>
                                            <li class="tab-items"><a class="nav-item nav-link active show" id="nav-profile-tab" data-toggle="tab" href="#nav-profile" role="tab" aria-controls="nav-profile" aria-selected="true">Comments</a></li>
                                            <li class="tab-items"><a class="nav-item nav-link active show" id="nav-contact-tab" data-toggle="tab" href="#nav-contact" role="tab" aria-controls="nav-contact" aria-selected="true">Fans</a></li>

                                        </div>
                                    </ul>
                                    <div class="tab-content py-3 px-3 px-sm-0" id="nav-tabContent">
                                        <div class="tab-pane fade active show" id="nav-home" role="tabpanel" aria-labelledby="nav-home-tab">
                                            <div class="col-xl-12 col-lg-12 col-md-12 col-sm-12">
                                                <div class="top_songs_list free_music_wrapper m24_cover">
                                                    <div class="top_songs_list_left">
                                                        <div class="treanding_slider_main_box top_lis_left_content">
                                                            <div class="top_songs_list0img">
                                                                <img src="/public/images/tp1.png" class="d-none d-sm-block" alt="img">
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
                                                                <p><a href="javaScript:;" onclick="PlayAudio('http://beatbyte.co/storage/app/uploads/files/tune_new.mp3')" class="songname">sss</a></p>

                                                                <p class="various_artist_text"><a href="#">sss</a></p>
                                                            </div>
                                                        </div>
                                                    </div>
                                                    <div class="top_songs_list_right">
                                                        <div class="top_list_tract_view">
                                                            <a href="http://beatbyte.co/addcart/49" id="addToCart" class="button-purpleX btn-primary btn"><i class="fas fa-shopping-cart"></i>333</a>
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
                                                            <div class="top_songs_list0img">
                                                                <img src="/public/images/tp1.png" class="d-none d-sm-block" alt="img">
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
                                                                <p><a href="javaScript:;" onclick="PlayAudio('http://beatbyte.co/storage/app/uploads/files/tune_new.mp3')" class="songname">dd</a></p>

                                                                <p class="various_artist_text"><a href="#">dd</a></p>
                                                            </div>
                                                        </div>
                                                    </div>
                                                    <div class="top_songs_list_right">
                                                        <div class="top_list_tract_view">
                                                            <a href="http://beatbyte.co/addcart/50" id="addToCart" class="button-purpleX btn-primary btn"><i class="fas fa-shopping-cart"></i>333</a>
                                                            <!-- <div class="price mt-2"> -->

                                                            <!-- </div> -->
                                                        </div>

                                                    </div>
                                                </div>

                                            </div>
                                        </div>
                                        <div class="tab-pane fade" id="nav-profile" role="tabpanel" aria-labelledby="nav-profile-tab">
                                            <form action="http://beatbyte.co/addcomment" method="post">
                                                <input type="hidden" name="_token" value="ScPUKPBO2gj0fEb66NgZALib0EuRlEUGI8JEKa5c">
                                                <input type="hidden" name="albumid" value="12">
                                                <input type="hidden" name="userid" value="4">
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
                                        </div>
                                        <div class="tab-pane fade" id="nav-contact" role="tabpanel" aria-labelledby="nav-contact-tab">
                                            Et et consectetur ipsum labore excepteur est proident excepteur ad velit occaecat qui minim occaecat veniam. Fugiat veniam incididunt anim aliqua enim pariatur veniam sunt est aute sit dolor anim. Velit non irure adipisicing aliqua ullamco irure incididunt irure non esse consectetur nostrud minim non minim occaecat. Amet duis do nisi duis veniam non est eiusmod tempor incididunt tempor dolor ipsum in qui sit. Exercitation mollit sit culpa nisi culpa non adipisicing reprehenderit do dolore. Duis reprehenderit occaecat anim ullamco ad duis occaecat ex.
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



</script>
@stop