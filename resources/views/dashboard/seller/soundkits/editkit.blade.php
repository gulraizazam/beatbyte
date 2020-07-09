@extends('dashboard.layouts.default')

@section('content')



	<div class="container-fluid">

      <!-- Breadcrumbs-->

      	<div class="content-heading">

    		Edit Music Kits

    		<div class="sub-menu-wrapper hidden-sm hidden-xs">

		        <div class="sub-menu hidden-sm hidden-xs">

		            <div class="sub-menu__item active">

		                <a class="sub-menu__link" href="#"><i class="fa fa-list"></i> Edit Kits</a>

		            </div>

		            

		            <div class="sub-menu__item ">

		                <a class="sub-menu__link" href="{{route('kits.uploadform')}}"><i class="fa fa-upload"></i> Upload</a>

		            </div>

		        </div>

    		</div>

		</div>

      	<hr>

      <!-- Icon Cards-->

      	<div class="container">

      		<div class="col-sm-12">

      			<form action="{{route('kit.update',$editkit->id)}}" method="post" enctype="multipart/form-data">

      				@csrf

      				<input type="hidden" name="userid" value="{{Auth::user()->id}}">

				    <div class="panel panel-default">

				        <div class="panel-heading">

				            <h3 class="text-center">

				                        {{$editkit->name}}</h3>

				        </div>

				        <div class="panel-body">

				            <div class="row" style="padding: 10px;">

				                

				                <div class="col-sm-12">

				                    <div class="form-group">

				                        <label class="control-label" for="name">Name</label>

				                        <input type="text" name="name" id="name" class="form-control" placeholder="Name" value="{{$editkit->name}}">

				                         @if ($errors->has('name'))

						                    <p class=" text-danger" >{{ $errors->first('name') }}</p>

						                 @endif

				                    </div>

				                    <div class="form-group">

				                        <label class="control-label" for="description">Description</label>

				                        <textarea name="description" rows="10" cols="50" id="description" class="form-control" placeholder="Description">{{$editkit->description}}</textarea>



				                    </div>

				                    <div class="form-group">

				                        <label class="control-label" for="">

				                            Price

				                        </label>

				                        <div class="input-group">

				                            <div class="input-group-addon">$</div>

				                            <input type="text" class="form-control" aria-invalid="false" name="price" value="{{$editkit->price}}">

				                             @if ($errors->has('price'))

							                    <p class=" text-danger" >{{ $errors->first('price') }}</p>

							                 @endif

				                        </div>

				                    </div>



				                    <div class="form-group">

				                        <label class="control-label" for="">

				                            Preview MP3

				                        </label>

				                        

				                       

			                            <?php

			                            $audio= explode('/files/',$editkit->kit_file);



			                            ?>

			                            <audio controls="" class="kit-audio-controls">

			                                <source src="{{URL::to('storage/app/uploads/files')}}/{{$audio['1']}}" type="audio/mpeg"> 

			                            </audio>



				                    </div>

				                    <div class="row">

				                    	<div class="form-group col-md-6">

					                        <label class="control-label" for="name">Upload New MP3</label>

					                        <input type="file" name="kit_file[]" id="name" class="form-control" >

					                        @if ($errors->has('kit_file'))

							                    <p class=" text-danger" >{{ $errors->first('kit_file') }}</p>

							                 @endif

					                    </div> 

					                    <div class="form-group col-md-6">

					                        <label class="control-label" for="name">Upload New Image</label>

					                        <input type="file" name="kitImage" id="name" class="form-control" >

					                    </div> 

				                    </div>  

				                    <div class="form-group">

				                        <label class="control-label" for="name">Upload New Zip File</label>

				                        <input type="file" name="Zip" id="name" class="form-control" >

				                    </div> 

					                   <button type="submit" class="btn btn-success pull-right">Update</button>  

					            </div>

				                

				            </div>

			            </div>

			        </div>

			    </div>

			</form>

		</div>

  	</div>

@stop