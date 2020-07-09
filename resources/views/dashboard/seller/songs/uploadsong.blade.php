@extends('dashboard.layouts.default')

@section('content')
<style type="text/css">
.ajax-loader
{
  background: rgba( 255, 255, 255, 0.8 );
  top: 35%;
  position: fixed;
  left: 50%;
  z-index: 9999;
}

</style>
	<div class="container-fluid">

		<div class="content-heading">

    		Upload Song

    		<div class="sub-menu-wrapper hidden-sm hidden-xs">

		        <div class="sub-menu hidden-sm hidden-xs">

		            <div class="sub-menu__item ">

		                <a class="sub-menu__link" href="{{url('allsongs')}}"><i class="fa fa-list"></i> All Songs</a>

		            </div>

		           

		            <div class="sub-menu__item active">

		                <a class="sub-menu__link" href="#"><i class="fa fa-upload"></i> Upload</a>

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
			@if(session()->has('error'))
						{!! Session::get('error') !!}
					@endif
      				<p class="alert  alert-info  text-center" style="font-size: 1.3em;">You have

							<strong>Unlimited</strong>

						uploads remaining in your account.</p>

      			</div>

      			

				<div class="col-md-12" style="padding-bottom: 20px;border: 3px solid #cfdbe2;">
					<div class="ajax-loader" style="display: none;">
                      <img src="{{ asset('images/tenor.gif') }}" class="img-responsive" />
                    </div>


					<h3>Add Song</h3>

					<form action="{{route('songs.store')}}" method="POST" enctype="multipart/form-data" onsubmit="LoadForm()">

						@csrf

						<input type="hidden" name="userid" value="{{Auth::user()->id}}">

						<div class="row">

							<div class="form-group col-md-6">

					            <label for="exampleInputEmail1">Name</label>

					            <input class="form-control" type="text" name="songname"  placeholder="File Name">

					             @if ($errors->has('songname'))

				                    <p class=" text-danger" >{{ $errors->first('songname') }}</p>

				                 @endif

				          	</div>

				          	

				          	<div class="form-group col-md-6">

					            <label for="exampleInputEmail1">Genre<span>*</span></label>

					            <select id="categories" class="form-control" name="songmusicgeneration">

					            	<option value="">Select</option>

				            		@foreach($allgen as $generation)

				            			<option value="{{$generation->id}}">{{$generation->generation_name}}</option>

				            		@endforeach

					            </select>
					            @if ($errors->has('songmusicgeneration'))

			                    <p class=" text-danger" >{{ $errors->first('songmusicgeneration') }}</p>

			                 @endif
					            

				          	</div>

				          	

				     	</div>

				     	<div class="row">
				     		<div class="form-group col-md-6">
				     			<label>Category</label>
					           	<select name="Category" class="form-control selectsongprice" onchange="SelectSongPrice();">
					           		<option value="Paid">Paid</option>
					           		<option value="free">Free</option>
					           	</select>

				          	</div>
				     		<div class="form-group col-md-6 price">

					             <label for="exampleInputEmail1">Price</label>

					            <input class="form-control" type="text" name="price"  placeholder="0">

					            

					           

				          	</div>

				          	

				          	



				     	</div>

				     	<div class="row">

				     		<div class="col-md-6">

				     			<label for="exampleInputEmail1">Song File</label>

				     			<input type="file" name="audios" class="form-control">

				     			 @if ($errors->has('audios'))

				                    <p class=" text-danger" >{{ $errors->first('audios') }}</p>

				                 @endif

				     		</div>

				     		<div class="form-group col-md-6">
					            <label for="exampleInputEmail1">Linked To</label>
					            <select id="linked" class="form-control" name="linkedbeat">

					            	<option value="">Select Beat</option>
					            	@foreach($beats as $beat)
					            		<option value="{{$beat->name}}">{{$beat->name}}</option>
					            	@endforeach
					            </select>
				          	</div>
				     	</div>

				     	<div class="row">
				     		<div class="form-group col-md-6">
				     			<label for="songimage">Song Image</label>
				     			<input type="file" name="songimage" class="form-control">
				     			 @if ($errors->has('songimage'))
				                    <p class=" text-danger" >{{ $errors->first('songimage') }}</p>
				                 @endif
				     		</div>
				     		<div class="form-group col-md-6">
				     			<input type="checkbox" name="includestore" id="includestore">
				     			<label for="exampleInputEmail1">Include In Store</label>
				     		</div>
				     	</div>

				     	<button class="btn btn-primary" type="submit" style="float: right">Add Song</button>

					</form>

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
	$('#linked').select2();

</script>
@endsection