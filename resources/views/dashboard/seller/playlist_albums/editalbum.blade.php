@extends('dashboard.layouts.default')

@section('content')

<style type="text/css">

	.btn-default {

	    color: #333;

	    background-color: #fff;

	    border-color: #eaeaea;

	   border-color: #eaeaea;

	}

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

		    Edit Album

		    <br>

		    <a href="{{url('allalbums')}}" class="btn btn-default btn-xs"><i class="fa fa-list"></i> All Collections</a>



		    <div class="sub-menu-wrapper hidden-sm hidden-xs">

		    </div>

		</div>

		<div class="container">

			<div class="row">

				<div class="col-sm-6">

				    <div class="panel panel-default" style="padding: 10px;">

				        <div class="panel-heading">

				            

				            <h3 class="panel-title">Edit details</h3>

				        </div>

				        <div class="panel-body">

				            <div class="collection-editable-wrapper form-horizontal">

				            	<form action="{{url('updatealbum',$editalbum->id)}}" method="post">

				            		@csrf

					                <div class="form-group">

					                    <label for="collection-name-edit" class="control-label col-sm-5" id="collection-name-input-label">Name</label>

					                    <input type="text" name="name" value="{{$editalbum->album_name}}" class="form-control">

					                    

					                </div>

					                <div class="form-group">

					                    <label for="collection-name-edit" class="control-label col-sm-5" id="collection-name-input-label">Price</label>

					                    <input type="text" name="price" value="{{$editalbum->price}}" class="form-control">

					                    

					                </div>

					                <div class="form-group">

					                    <label for="collection-type-display" class="control-label col-sm-5" id="collection-price-input-label">Type</label>



					                    <select name="collection_type" class="form-control" id="new-collection-type" required="" tabindex="-1" class="select2-hidden-accessible" aria-hidden="true" aria-required="true">

	                                		<option></option>

			                                <optgroup label="Collections For Playlist">

			                                    <option value="beat_play" {{$editalbum->collection_type == "beat_play" ? 'selected' : ''}}>Beat Playlist</option>



			                                    <option value="song_play">Song Playlist</option>

			                                </optgroup>

			                                <optgroup label="Collections For Sale">

			                                    <option value="beat" {{$editalbum->collection_type == "beat" ? 'selected' : ''}}>Beat Tape</option>

			                                    <option value="song" {{$editalbum->collection_type == "song" ? 'selected' : ''}}>Album</option>

			                                </optgroup>

			                            </select>

					                </div>

					                <button type="submit" class="btn btn-primary">Update</button>

					            </form>

				            </div>

				        </div>
				        
				    </div>	

				</div>

				<div class="col-sm-6">

				    <div class="collection-items-panel panel panel-default" style="padding:10px;">

				        <div class="panel-heading">

				            <h3 class="panel-title">Collection Items </h3>

				        </div>

				        <div class="panel-body">

				            <a class="btn btn-success" data-toggle="modal" href="#add-music"><i class="fa fa-plus"></i> Manage Music</a>



				        </div>


				    </div>

				</div>

			</div>

		</div>
		 <div class="panel panel-default">

                            <div class="panel-heading">

                                <h3 class="panel-title">Album Songs</h3>

                            </div>

                            <div class="panel-body">

                                <table class="collections-table table table-striped">
                                	<thead>
                                		<th>Song</th>
                                		<th>Action</th>
                                	</thead>
                                    <tbody>
                                    	@if($albumsongs !=null)
                                    	@foreach($albumsongs as $albumsongs)
                                        <tr id="collection-row-5535">

                                            

                                            <td>{{$albumsongs->name}}</td>

                                            

                                            <td ><a href="{{url('removesong')}}/{{$editalbum->id}}/{{$albumsongs->id}}" class="btn btn-danger">Remove</a></td>

                                        </tr>
                                        @endforeach
                                        @endif
                                    </tbody>

                                </table>

                            </div>

                        </div>
		<div class="modal fade" id="add-music">

            <form method="POST" action="{{route('album.addsong',$editalbum->id)}}" >

                @csrf

                <div class="modal-dialog">

                    <div class="modal-content">

                        <div class="modal-header">

                            

                            <h4 class="modal-title">Add Songs</h4>

                        </div>

                        <div class="modal-body">

                            <div class="new-collection-wrapper">

                                <label>Add Songs</label>

                                <select name="addsong[]" class="form-control" multiple>

                                	@foreach($allsongs as $song)

                                		<option value="{{$song->id}}">{{$song->name}}</option>

                                	@endforeach

                                	

                                </select>

                                

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