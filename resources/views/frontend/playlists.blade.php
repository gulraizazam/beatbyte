@extends('frontend.layouts.default_black')
@section('content')

<style type="text/css">
.beat-container {
    display: inline-block;
    width: 25%;
    padding: 0 5px;
    margin-bottom: 10px;
    position: relative;
}
.beat-container .beat-container-content {
    color: #fff;
    overflow: hidden;
    position: relative;
}
.beat-container .top-info {
    border-radius: 3px 3px 0 0;
    padding: 0px;
    font-size: 13px;
}
.bg-mid-grey {
    background: #343035 !important;
}
.beat-container .top-info .top-info-icon {
    cursor: pointer;
}
.ph-sm, .pr-sm {
    padding-right: 5px!important;
}
.beat-container .comment {
    color: #fff;
    text-decoration: none;
}
.beat-container .comment i {
    font-size: 15px;
}
.beat-container .avatar {
    cursor: pointer;
    position: relative;
}
.beat-container .avatar img {
    width: 100%;
}
.beat-container .beat-info {
    position: relative;
    z-index: 5;
    border-radius: 0 0 3px 3px;
    padding: 15px 8px;
    text-align: left;
}
.beat-container .beat-name, .beat-container .user-name {
    overflow: hidden;
    white-space: nowrap;
    text-overflow: ellipsis;
}
.beat-container .beat-name, .beat-container .user-name {
    overflow: hidden;
    white-space: nowrap;
    text-overflow: ellipsis;
}
.beat-container .price-details {
    border-top: 1px solid #3B3D40;
    padding-top: 5px;
    display: flex;
    justify-content: space-between;
}
.beat-container .price-details .prices-link-wrapper {
    flex-grow: 2;
}
.recommended-beats .beat-container .hover-menu {
    width: calc(100% - 10px);
}
.hover-menu {
    display: flex;
    justify-content: space-around;
    position: absolute;
    width: calc(100% - 20px);
    transition: height 0.3s ease;
    overflow: hidden;
    height: 0;
    bottom: 83px;
    background: rgba(0, 0, 0, 0.2);
    overflow: visible;
    z-index: 0;
}
.hover-menu .hover-menu-icon {
    padding-top: 3px;
    padding-bottom: 3px;
    cursor: pointer;
}
.popup-menu {
    display: none;
}
.section-all a, .section-all .album_list_wrapper>ul>li>a {
        color: #151414;
    }
    .pagination{
        justify-content: center;
        
    }
</style>
<!-- top navi wrapper Start -->
    <div class="m24_main_wrapper">
        <!-- top song wrapper start -->
        <div class="section-all  album_inner_list auti m24_cover">
            <div class="container-fluid">
                <div class="row">
                	
                    <div class="col-md-12 col-lg-12">
                        <div class="section-top-charts">
                            <div class="treanding_songs_wrapper punjabi_sogns m24_cover">
                                <div class="container">
                                    <div class="row">
                                        <div class="col-lg-4 col-md-4 col-sm-4">
                                            <div class="m24_heading_wrapper">
                                                <h1>PLAYLISTS</h1>
                                            </div>
                                        </div>
                                        
                                        <div class="col-lg-12 col-md-12 col-xs-12 col-sm-12">
                                             @if(session()->has('error'))
                                                <div class="alert alert-danger">
                                                    {{ session()->get('error') }}
                                                </div>
                                            @endif
                                            
                                            @foreach($allplaylists as $playlists)
                                            <div class="beat-container">
                                            	<div class="beat-container-content">
                                            		<div class="top-info bg-mid-grey text-right" style="background-color: #000000 !important">
                                            			<span class="top-info-icon pr-sm">
                                            				</span> 
                                            				<span class="top-info-icon pl-sm">
                                            				</span>
                                            		 <!----> 
                                            		<div class="avatar"><!----> <!----> 
                                            			<a href="{{route('playlist',$playlists->id)}}" class="">
                                            			<img alt="Beat image" src="{{asset('images/beat.jpg')}}" lazy="loaded" style="height: 300px">
                                            		</a>
                                            		</div>
                                            		</div> 
                                            		<div class="beat-info bg-mid-grey m0 row">
                                            			<div class="details pb-sm" style="    margin-left: 23px;">
                                            				<div class="beat-name"  style="float: left;">
                                            					<a href="{{route('playlist',$playlists->id)}}" class="" style="color: white">{{$playlists->playlist_name}}</a>
                                            					
                                            				</div> 
                                            				
                                            			</div> 
                                            			<div class="user-name" style="float: right; margin-left: 80px;">
                                                                {{$playlists->name}}
                                                            </div>
                                            		</div>
                                            	</div> 
                                            </div>
                                            @endforeach
                                            {{$allplaylists->links()}}
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

@stop