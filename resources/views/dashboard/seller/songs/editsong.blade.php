@extends('dashboard.layouts.default')

@section('content')
<style type="text/css">
.ajax-loader
{
  background: rgba( 255, 255, 255, 0.8 );
  top: 50%;
  position: fixed;
  left: 50%;
  z-index: 9999;
}

</style>
	<div class="container-fluid">

		<div class="content-heading">

    		Edit Song

    		<div class="sub-menu-wrapper hidden-sm hidden-xs">

		        <div class="sub-menu hidden-sm hidden-xs">

		            <div class="sub-menu__item active">

		                <a class="sub-menu__link" href="#"><i class="fa fa-list"></i> Edit Song</a>

		            </div>

		           

		            <div class="sub-menu__item ">

		                <a class="sub-menu__link" href="{{route('songs.uploadform')}}"><i class="fa fa-upload"></i> Upload</a>

		            </div>

		        </div>

    		</div>

		</div>

      	<hr>

      	<div class="container">

      		<div class="row">

      			<div class="col-md-12">

      				<p class="alert  alert-info  text-center" style="font-size: 1.3em;">You have

							<strong>Unlimited</strong>

						uploads remaining in your account.</p>

      			</div>

      			

				<div class="col-md-12" style="padding-bottom: 20px;border: 3px solid #cfdbe2;">	
					<div class="ajax-loader" style="display: none;">
                      <img src="{{ asset('images/tenor.gif') }}" class="img-responsive" />
                    </div>
				 <form action="{{route('song.update',$editsong->id)}}" method="POST" enctype="multipart/form-data" onsubmit="LoadForm()">

				 @csrf

				 <input type="hidden" name="userid" value="{{Auth::user()->id}}">		

				    <div class="panel panel-default">

				        <div class="panel-heading">

				            <h3 class="panel-title">{{$editsong->name}}</h3>

				        </div>

				        <div class="panel-body" style="padding:10px;">

				            <div class="row">

				            	
				               

				                <div class="col-sm-12">

				                    <div class="form-group">

				                        <label class="control-label" for="name">Name</label>

				                        <input type="text" name="name" id="name" class="form-control" placeholder="Name" value="{{$editsong->name}}">

				                         @if ($errors->has('name'))

						                    <p class=" text-danger" >{{ $errors->first('name') }}</p>

						                 @endif

				                    </div>



				                    <div class="form-group">

				                        <label class="control-label" for="genre">Genre</label>

				                        <select id="genre" name="songmusicgeneration"  class="form-control">

				                            <option value="">Select</option>

				                           @foreach($allgen as $generation)

						            			<option value="{{$generation->id}}" {{$editsong->song_generation ==$generation->id ? 'selected' : '' }}>{{$generation->generation_name}}</option>

						            		@endforeach

				                        </select>

				                        @if ($errors->has('songmusicgeneration'))
						                    <p class=" text-danger" >{{ $errors->first('songmusicgeneration') }}</p>
						                 @endif

				                        

				                    </div>

				                 <div class="form-group ">
				     			<label>Category</label>
					           	<select id="categories" name="category" class="form-control selectsongprice" onchange="SelectSongPrice();">
					           		<option value="Paid" {{$editsong->song_category=='Paid' ? 'selected' : ''}}>Paid</option>
					           		<option value="free" {{$editsong->song_category=='free' ? 'selected' : ''}}>Free</option>
					           	</select>

				          	</div>

				                    <div class="form-group price">

				                        <label class="control-label" for="">Price</label>

				                        <div class="input-group">

				                            <div class="input-group-addon">$</div>

				                            <input type="text" name = "price" class="form-control" aria-invalid="false" name="price"  value="{{$editsong->song_price}}">

				                            @if ($errors->has('price'))

						                    	<p class=" text-danger" >{{ $errors->first('price') }}</p>

						                 	@endif

				                            
				                        </div>

				                    </div>
				                    <div class="form-group">

							            <label for="exampleInputEmail1">Linked To</label>

							            <select id="linked" class="form-control" name="linkedbeat">

							            	<option value="">Select Beat</option>

							            	@foreach($beats as $beat)

							            		<option {{$editsong->song_beat==$beat->name ? 'selected' : ''}} value="{{$beat->name}}">{{$beat->name}}</option>

							            	@endforeach

							            </select>

							            @if ($errors->has('linkedbeat'))

						                    <p class=" text-danger" >{{ $errors->first('linkedbeat') }}</p>

						                 @endif

						          	</div>
				                    <div class="form-group">

				                    	<label class="control-label" for="beat_id">Song File</label>

					                    <input type="file" name="audio" class="form-control">

					                    @if ($errors->has('audio'))

					                    	<p class=" text-danger" >{{ $errors->first('audio') }}</p>

					                 	@endif

				                    </div>
				                    
						     		<div class="form-group">
						     			
						     			<input type="checkbox" name="includestore" id="includestore" {{$editsong->include_store==1 ? 'checked' : ''}}>
						     			<label for="exampleInputEmail1">Include In Store</label>
						     		</div>
				     				
				     		<div class="form-group ">
				     			<label for="songimage">Song Image</label>
				     			<input type="file" name="songimage" class="form-control">
				     			@if($editsong->image)
				     			<img src="{{$editsong->image}}" style="height: 100px;width: 100px;margin-top: 10px">
				     			@endif
				     			 @if ($errors->has('songimage'))
				                    <p class=" text-danger" >{{ $errors->first('songimage') }}</p>
				                 @endif
				     		</div>
				     		
				     	
				                    <button class="btn btn-success pull-right">Update</button>



				                </div>

				            </div>

				        </div>

				    </div>

				</form>

				</div>

				</div>

			</div>

		</div>

@stop
@section('scripts')
<script type="text/javascript">
	function SelectSongPrice()
	{
		if($('.selectsongprice').val()=="free"){
			$(".price").css("display","none");
		}else{
			$(".price").css("display","block");
		}
	}
	$('#categories').select2();
	$('#genre').select2();
	$('#linked').select2();

</script>
@endsection