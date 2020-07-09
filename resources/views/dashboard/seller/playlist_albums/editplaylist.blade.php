@extends('dashboard.layouts.default')

@section('content')

<style type="text/css">

	.btn-default {

	    color: #333;

	    background-color: #fff;

	    border-color: #eaeaea;

	   border-color: #eaeaea;

	}

</style>

	<div class="container-fluid">

		<div class="content-heading">

		    Edit Playlist

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

				            	<form action="{{route('playlist.update',$editplaylist->id)}}" method="post">

				            		@csrf

					                <div class="form-group">

					                    <label for="collection-name-edit" class="control-label col-sm-5" id="collection-name-input-label">Name</label>

					                    <input type="text" name="name" value="{{$editplaylist->playlist_name}}" class="form-control">

					                    

					                </div>



					                <div class="form-group">

					                    <label for="collection-type-display" class="control-label col-sm-5" id="collection-price-input-label">Type</label>



					                    <select name="collection_type" class="form-control" id="new-collection-type" required="" tabindex="-1" class="select2-hidden-accessible" aria-hidden="true" aria-required="true">

	                                		<option></option>

			                                <optgroup label="Collections For Playlist">

			                                    <option value="beat_play" {{$editplaylist->playlist_type == "beat_play" ? 'selected' : ''}}> Playlist</option>



			                                    

			                                </optgroup>

			                                <optgroup label="Collections For Sale">

			                                   <option value="song" {{$editplaylist->playlist_type == "song" ? 'selected' : ''}}>Album</option>

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
                                    	@if($playlistsongs)
                                    	@foreach($playlistsongs as $albumsongs)
                                        <tr id="collection-row-5535">

                                            

                                            <td>{{$albumsongs->name}}</td>

                                            

                                            <td ><a href="{{url('removeplaylistsong')}}/{{$editplaylist->id}}/{{$albumsongs->id}}" class="btn btn-danger">Remove</a></td>

                                        </tr>
                                        @endforeach
                                        @endif
                                    </tbody>

                                </table>

                            </div>

                        </div>
		<div class="modal fade" id="add-music">

            <form method="POST" action="{{route('playlist.addsong',$editplaylist->id)}}" >

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