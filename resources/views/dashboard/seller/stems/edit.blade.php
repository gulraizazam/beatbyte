@extends('dashboard.layouts.default')

@section('content')





<div class="container-fluid">

      <!-- Breadcrumbs-->

      	<div class="content-heading">

    		Upload Stems

    		<div class="sub-menu-wrapper hidden-sm hidden-xs">

		        <div class="sub-menu hidden-sm hidden-xs">

		            <div class="sub-menu__item ">

		                <a class="sub-menu__link" href="{{url('allkits')}}"><i class="fa fa-list"></i> All Stems & Trackouts</a>

		            </div>

		            

		            <div class="sub-menu__item active">

		                <a class="sub-menu__link" href="{{route('stem.upload')}}"><i class="fa fa-upload"></i> Upload</a>

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

      					<form method="POST" action="{{route('stem.update',$editstem->id)}}" enctype="multipart/form-data">

    						@csrf

    						<input type="hidden" name="userid" value="{{Auth::user()->id}}">

						    <div class="col-sm-12">

						        <div class="panel panel-default">

						            

						            <div class="panel-body" style="padding:10px;">

						                

						                    <div class="form-group">

						                        <label class="control-label control-label-required" for="name">Name</label>

						                        <input type="text" name="name" id="name" class="form-control" placeholder="Name" value="{{$editstem->stem_name}}">

						                       

						                    </div>

						                    

						                    <div class="form-group">

						                        <label class="control-label" for="">

						                            Price

						                        </label>

						                        <div class="input-group">

						                            <div class="input-group-addon">$</div>

						                            <input type="text" class="form-control" aria-invalid="false" name="price"  aria-required="true" value="{{$editstem->price}}">

						                           

						                        </div>

						                    </div>

						                

						                

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

						                                    <input type="file" name="image" class="form-control">

						                                    <img src="{{$editstem->image}}" style="height: 100px;width: 100px;margin-top: 10px;">

						                                    

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