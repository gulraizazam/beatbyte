@extends('dashboard.layouts.default')
@section('content')

	<div class="container-fluid">
		<div class="content-heading">
      		Artwork
      		<div class="sub-menu-wrapper hidden-sm hidden-xs">
        	        <div class="sub-menu hidden-sm hidden-xs">
        	            <div class="sub-menu__item active">
        	                <a class="sub-menu__link" href="#"><i class="fa fa-list"></i>Artwork</a>
        	            </div>
        	        </div>
      		</div>
		</div>
      	<hr>
      	<div class="container">
      		@if(session()->has('success'))
	                <div class="alert alert-success">
	                    {{ session()->get('success') }}
	                </div>
	            @endif
      		<div class="row">
      			
      			<div class="col-xs-12">
    				<button class="add-artwork-button btn btn-success" data-toggle="modal" data-target="#add-artwork"><i class="fa fa-plus"></i> Add</button>

				    <div class="artwork-instructions">
				        <p>Add artwork to you songs, beats, sound kits and collections. To assign an artwork, click on the Assign button and click on the music items to select/deselect the music items.</p>
				    </div>

				    <div id="uploaded-artworks-wrapper" class="uploaded-artworks-wrapper">

				        <div class="row">
				        	@foreach($allartwork as $artwrorks)
				            <div class="col-xs-6">
				                <div id="uploaded-artwork-365024" class="uploaded-artwork col-lg-2 col-sm-3 col-xs-4" data-id="365024">
				                    <div class="artwork" style="width: 100%; height: auto;">
				                        <img src="{{URL::to('storage/app/uploads/images')}}/{{$artwrorks->image}}" alt="uploaded artwork">

				                        <i class="delete-artwork fa fa-trash" style="display: none;"></i>
				                    </div>
				                    <button class="assign-artwork-btn btn btn-success btn-xs" data-toggle="modal" data-target="#assign-{{$artwrorks->id}}"><i class="fa fa-plus"></i> Assign</button>
				                </div>
				                
				            </div>
				            <div class="modal fade" id="assign-{{$artwrorks->id}}">
					            <form method="POST" action="{{route('artwork.assign')}}" enctype="multipart/form-data">
					                @csrf
					                <input type="hidden" name="userid" value="{{Auth::user()->id}}">
					                <div class="modal-dialog">
					                    <div class="modal-content">
					                        <div class="modal-header">
					                            <input type="hidden" name="art_image" value="{{$artwrorks->image}}">
					                            <h4 class="modal-title">Assign Artwork</h4>
					                        </div>
					                        <div class="modal-body">
					                            <div class="new-collection-wrapper">
					                                <fieldset>
					                                    <label>Assign To Beat</label>
					                                    <select name="assignbeat" class="form-control">
					                                    	<option value="">Select</option>
					                                    	@foreach($allbeats as $beats)
					                                    		<option value="{{$beats->id}}">{{$beats->name}}</option>
					                                    	@endforeach
					                                    </select>
					                                    	
					                                </fieldset>
					                                <fieldset>
					                                    <label>Assign To Song</label>
					                                    <select name="assignsong" class="form-control">
					                                    	<option value="">Select</option>
					                                    	@foreach($allsongs as $songs)
					                                    		<option value="{{$songs->id}}">{{$songs->name}}</option>
					                                    	@endforeach
					                                    </select>
					                                    	
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
				            @endforeach
				        </div>

				    </div>
				</div>
      		</div>
      	</div>
      	<div class="modal fade" id="add-artwork">
            <form method="POST" action="{{route('artwork.add')}}" enctype="multipart/form-data">
                @csrf
                <input type="hidden" name="userid" value="{{Auth::user()->id}}">
                <div class="modal-dialog">
                    <div class="modal-content">
                        <div class="modal-header">
                            
                            <h4 class="modal-title">Add Artwork</h4>
                        </div>
                        <div class="modal-body">
                            <div class="new-collection-wrapper">
                                <fieldset>
                                    <label>Image</label>
                                    <input type="file" name="artwork" class="form-control">
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