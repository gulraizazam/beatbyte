@extends('dashboard.layouts.default')

@section('content')





<div class="container-fluid">

      <!-- Breadcrumbs-->

      	<div class="content-heading">

    		All Music Kits

    		<div class="sub-menu-wrapper hidden-sm hidden-xs">

		        <div class="sub-menu hidden-sm hidden-xs">

		            <div class="sub-menu__item ">

		                <a class="sub-menu__link" href="{{url('allkits')}}"><i class="fa fa-list"></i> All Music Kits</a>

		            </div>

		            

		            <div class="sub-menu__item active">

		                <a class="sub-menu__link" href="{{route('kits.uploadform')}}"><i class="fa fa-upload"></i> Upload</a>

		            </div>

		        </div>

    		</div>

		</div>

      	<hr>

      		<div class="container">

      			<div class="row">
      				<div class="col-md-12">
      					@if(session()->has('warning'))

			    			<div class="alert alert-warning">

			       				 {!! Session::get('warning') !!}

			    			</div>

						@endif
      				</div>
      				<div class="col-md-12"  style="padding-bottom: 20px;">

      					<form method="POST" action="{{route('kit.add')}}" enctype="multipart/form-data">

    						@csrf

    						<input type="hidden" name="userid" value="{{Auth::user()->id}}">

						    <div class="col-sm-12">

						        <div class="panel panel-default">

						            

						            <div class="panel-body" style="padding:0px;">

						                <div class="col-sm-6">

						                    <div class="form-group">

						                        <label class="control-label control-label-required" for="name">Name</label>

						                        <input type="text" name="name" id="name" class="form-control" placeholder="Name" >

						                        @if ($errors->has('name'))

								                    <p class=" text-danger" >{{ $errors->first('name') }}</p>

								                 @endif

						                    </div>

						                    <div class="form-group">

						                        <label class="control-label" for="description">Description</label>

						                        <textarea name="description" rows="10" cols="50" id="description" class="form-control" placeholder="Description"></textarea>



						                    </div>

						                    <div class="form-group">

						                        <label class="control-label" for="">

						                            Price

						                        </label>

						                        <div class="input-group">

						                            <div class="input-group-addon">$</div>

						                            <input type="text" class="form-control" aria-invalid="false" name="price"  aria-required="true">

						                            @if ($errors->has('price'))

									                    <p class=" text-danger" >{{ $errors->first('price') }}</p>

									                 @endif

						                        </div>

						                    </div>

						                </div>

						                <div class="col-sm-6">

						                    <div class="form-group">

						                        <label class="control-label" for="">

						                            Artwork

						                        </label>

						                        

						                        <div id="artwork-dropzone" class="dropzone dz-clickable">

						                        	<div class="dz-message">

						                                <div class="dz-message-title">

						                                    Upload Image

						                                </div>

						                                <div class="dz-message-body">

						                                    <input type="file" name="kitimage" class="form-control">

						                                    @if ($errors->has('kitimage'))

											                    <p class=" text-danger" >{{ $errors->first('kitimage') }}</p>

											                 @endif

						                                </div>

						                            </div>

						                        </div>



						                    </div>



						                    <div class="form-group">

						                        <label class="control-label" for="">

						                            Preview MP3

						                        </label>

						                       

						                        <p>Upload a demo of your Sound Kit for customers to preview to before purchasing.</p>

						                        <div id="demo-upload-dropzone" class="dropzone dz-clickable">

						                            <div class="dz-message">

						                                <div class="dz-message-title">

						                                    Upload MP3 Here

						                                </div>

						                                <div class="dz-message-body">

						                                    <input type="file" name="kitsong[]" class="form-control">

						                                    @if ($errors->has('kitsong'))

											                    <p class=" text-danger" >{{ $errors->first('kitsong') }}</p>

											                 @endif

						                                </div>

						                            </div>

						                        </div>



						                    </div>

						                    <div class="form-group">

						                        <label class="control-label" for="">

						                            Sound Kit Zip

						                        </label>

						                        

						                        <p>This is the file delivered to your customer after purchase.</p>

						                        <div id="kit-upload-dropzone" class="dropzone dz-clickable">

						                            <div class="dz-message">

						                                <div class="dz-message-title">

						                                    Upload ZIP Here

						                                </div>

						                                <div class="dz-message-body">

						                                    <input type="file" name="zipfile" class="form-control">

						                                </div>

						                            </div>

						                        </div>



						                    </div>

						                </div>

						            </div>

        						</div>

    						</div>

						    <div class="col-xs-12">

						        <button type="submit" class="btn btn-success pull-right" >

						            <i class="fa fa-floppy-o"></i> Save

						        </button>

						    </div>

						</form>

      				</div>

      			</div>

      		</div>





@stop