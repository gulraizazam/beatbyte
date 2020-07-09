@extends('dashboard.layouts.default')

@section('content')

<style type="text/css">



.table-hover>tbody>tr:hover, .table-striped>tbody>tr:nth-of-type(odd), .table>tbody>tr.active>td, .table>tbody>tr.active>th, .table>tbody>tr>td.active, .table>tbody>tr>th.active, .table>tfoot>tr.active>td, .table>tfoot>tr.active>th, .table>tfoot>tr>td.active, .table>tfoot>tr>th.active, .table>thead>tr.active>td, .table>thead>tr.active>th, .table>thead>tr>td.active, .table>thead>tr>th.active {

    background-color: #fafbfc;

}

.table>tbody>tr>td {

    vertical-align: middle;

}

.table>tbody>tr>td, .table>tbody>tr>th, .table>tfoot>tr>td, .table>tfoot>tr>th, .table>thead>tr>td, .table>thead>tr>th {

    padding: 8px;

    line-height: 1.528571429;

    vertical-align: top;

    border-top: 1px solid #eee;

}

.label-primary {

    background-color: #5d9cec;

}

.panel.panel-default {

    padding: 15px;

}

</style>

	<div class="container-fluid">

		<div class="content-heading">

					Playlists &amp; Albums

			<div class="sub-menu-wrapper hidden-sm hidden-xs"></div>

		</div>

		<div class="container">

            @if(session()->has('success'))

                <div class="alert alert-success">

                    {{ session()->get('success') }}

                </div>

            @endif

            @if(session()->has('error'))

                <div class="alert alert-danger">

                    {{ session()->get('error') }}

                </div>

            @endif
            @if(session()->has('warning'))

                <div class="alert alert-warning">

                    {!! session()->get('warning') !!}

                </div>

            @endif
			<div class="row">

			    <div class="col-xs-12 collections-wrapper">

			        <a class="btn btn-success" data-toggle="modal" href="#add-collection"><i class="fa fa-plus"></i> Add</a>

			    </div>

			    <br>

			    <br>

			    <div class="col-sm-8">



                    @if(!count($getPlaylist))

    			        <div class="panel panel-default">

    			            <div class="panel-heading">

    			                <h3 class="panel-title">Playlists</h3>

    			            </div>

    			            <div class="panel-body">

    			                <p>You have not added any playlists yet.</p>

    			            </div>

    			        </div>

                    @else

                    @foreach($getPlaylist as $playlists)

                        <div class="panel panel-default">

                                <div class="panel-heading">

                                    <h3 class="panel-title">Playlists</h3>

                                </div>

                                <div class="panel-body">

                                    <table class="collections-table table table-striped">

                                        <tbody>

                                            <tr id="collection-row-5535">

                                                <td>

                                                    <a href="{{route('playlist.edit',$playlists->id)}}">{{$playlists->playlist_name}}</a>

                                                    <br>

                                                    

                                                    <span class="label label-primary"> Playlist</span>

                                                    

                                                    

                                                    

                                                </td>

                                                <td>

                                                    <a href="{{route('playlist.edit',$playlists->id)}}">

                                                        <i class="fa fa-music"></i> 

                                                        <?php

                                                        $songscount = explode(',', $playlists->song_id);

                                                        ?>

                                                        {{$playlists->song_id != null ? count($songscount) : 0}} Items

                                                    </a>

                                                </td>

                                                <td class="text-right">

                                                    <a href="{{route('playlist.delete',$playlists->id)}}" class="delete-collection text-danger" data-collection-id="5535"><i class="fa fa-trash"></i></a>

                                                </td>

                                            </tr>

                                        </tbody>

                                    </table>

                                </div>

                        </div>

                    @endforeach

                    @endif

                     @if(!count($getAlbums))

    			        <div class="panel panel-default">

    			            <div class="panel-heading">

    			                <h3 class="panel-title">Albums</h3>

    			            </div>

    			            <div class="panel-body">

    			                <p>You have not added any albums yet.</p>

    			            </div>

    			        </div>

                        @else

                        @foreach($getAlbums as $albums)

                        <div class="panel panel-default">

                            <div class="panel-heading">

                                <h3 class="panel-title">Albums</h3>

                            </div>

                            <div class="panel-body">

                                <table class="collections-table table table-striped">

                                    <tbody>

                                        <tr id="collection-row-5535">

                                            <td>

                                                <a href="{{route('album.edit',$albums->id)}}">{{$albums->album_name}}</a>

                                                <br>

                                                <span class="label label-primary">Album</span>

                                            </td>

                                            <td>

                                                <a href="#">

                                                    <?php

                                                        $albumcount = explode(',', $albums->song_id);

                                                        ?>

                                                    <i class="fa fa-music"></i> {{$albums->song_id != null ? count($albumcount) : 0}} Items

                                                </a>

                                            </td>

                                            <td>{{$albums->price}}</td>

                                            <td class="text-right">

                                                <a href="{{route('album.delete',$albums->id)}}" class="delete-collection text-danger" data-collection-id="5535"><i class="fa fa-trash"></i></a>

                                            </td>

                                        </tr>

                                    </tbody>

                                </table>

                            </div>

                        </div>

                    @endforeach

                    @endif

			    </div>



			    <div class="col-sm-4">

			        <div class="panel panel-default">

			            <div class="panel-heading">

			                <h3 class="panel-title">What are collections, playlists and albums?</h3>

			            </div>

			            <div class="panel-body">

			                <strong>Collections</strong>

			                <p>Collections is our umbrella term for any collection or bundled group of music, whether that be a playlist or an album.</p>



			                <strong>Playlists</strong>

			                <p>A playlist is a collection of beats or songs to display together on your store. The beats and songs are sold as individual items. For example, you may want to display a particular genre of music together or group together music you have included in a discount sale.</p>



			                <strong>Albums</strong>

			                <p>An album is a collection of beats or songs that you want to sell together as a whole. You can set a price for the album when you create it. You can add a tab to your store to display all your album collections.</p>

			            </div>

			        </div>

			    </div>



    

			</div>

		</div>

		<div class="modal fade" id="add-collection">

            <form method="POST" action="{{route('collection.add')}}" enctype="multipart/form-data">

                @csrf

                <input type="hidden" name="userid" value="{{Auth::user()->id}}">

                <div class="modal-dialog">

                    <div class="modal-content">

                        <div class="modal-header">

                            

                            <h4 class="modal-title">Add Collection</h4>

                        </div>

                        <div class="modal-body">

                            <div class="new-collection-wrapper">

                                <fieldset>

                                    <label for="new-collection-type">Collection Type</label>



                                    <select name="collection_type" class="form-control" id="new-collection-type" required="" tabindex="-1" class="select2-hidden-accessible" aria-hidden="true" aria-required="true">

                                        <option></option>

                                        <optgroup label="Collections For Playlist">

                                            <option value="beat_play">Playlist</option>



                                            

                                        </optgroup>

                                        <optgroup label="Collections For Sale">

                                            

                                            <option value="song">Album</option>

                                        </optgroup>

                                    </select>

                                    <span class="select2 select2-container select2-container--bootstrap" dir="ltr" style="width: auto;"><span class="selection"><span class="select2-selection select2-selection--single" role="combobox" aria-haspopup="true" aria-expanded="false" tabindex="0" aria-labelledby="select2-new-collection-type-container"><span class="select2-selection__rendered" id="select2-new-collection-type-container"><span class="select2-selection__placeholder">Select a collection type...</span></span><span class="select2-selection__arrow" role="presentation"><b role="presentation"></b></span></span>

                                    </span><span class="dropdown-wrapper" aria-hidden="true"></span></span>

                                </fieldset>

                                <fieldset>

                                    <div class="row">

                                        <div class="form-group col-sm-6">

                                            <label for="">Collection Name</label>

                                            <input id="new-collections-name" type="text" name="name" class="form-control" required="" aria-required="true">

                                        </div>

                                        <div id="new-collection-price-wrapper">

                                            <div class="form-group col-sm-6">

                                                <label for="">Price</label>

                                                <input id="new-collection-price" type="number" min="0" name="price" class="form-control" required="" aria-required="true">

                                            </div>

                                        </div>

                                    </div>
                                    <div class="row">
                                        <div class="col-md-12">
                                            <label>Image</label>
                                            <input type="file" name="albumimage" class="form-control">
                                        </div>
                                    </div>
                                </fieldset>

                            </div>

                        </div>

                        <div class="modal-footer">

                            <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>

                            <button type="submit" class="btn btn-success"><i class="fa fa-floppy-o"></i> Save</button>

                        </div>

                    </div>

                    <!-- /.modal-content -->

                </div>

                <!-- /.modal-dialog -->

            </form>



        </div>

@stop