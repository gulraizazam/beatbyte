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

    		Widget Settings

    		<div class="sub-menu-wrapper hidden-sm hidden-xs">

		        <div class="sub-menu hidden-sm hidden-xs">

		            <div class="sub-menu__item active">

		                <a class="sub-menu__link" href="#"><i class="fa fa-upload"></i> Widget Settings</a>

		            </div>

		        </div>

    		</div>

		</div>

      	<hr>

      	<div class="container">

      		<div class="row">

      			<div class="col-md-12">
      				
					@if(session()->has('error'))
						{!! Session::get('error') !!}
					@endif
					@if(session()->has('success'))

				    <div class="alert alert-success">

				        {{ session()->get('success') }}

				    </div>

				@endif

      			</div>

				<div class="col-md-12" style="padding-bottom: 20px;border: 3px solid #cfdbe2;">
					<div class="ajax-loader" style="display: none;">
                      <img src="{{ asset('images/tenor.gif') }}" class="img-responsive" />
                    </div>


					<h3>Brand Logo</h3>

					<form action="{{route('brand.store')}}" method="POST" enctype="multipart/form-data" onsubmit="LoadForm()">

						@csrf

						<input type="hidden" name="userid" value="{{Auth::user()->id}}">

						<div class="row">

							@if($getBrands)
				          	<div class="form-group col-md-6">
					            <img src="{{$getBrands->brand_logo}}" height="80" width="80">
					        </div>
					        @else

					        @endif
				          	<div class="form-group col-md-6">

					            <label for="exampleInputEmail1">Brand Logo</label>

					            <input class="form-control" type="file" name="brandlogo" >
					             @if ($errors->has('brandlogo'))

				                    <p class=" text-danger" >{{ $errors->first('brandlogo') }}</p>

				                 @endif
					             
				          	</div>
				          	
				         </div>
						<button class="btn btn-primary" type="submit" style="float: right">Save</button>

					</form>

				</div>
				<div class="col-md-12" style="padding-bottom: 20px;border: 3px solid #cfdbe2;">
					<div class="ajax-loader" style="display: none;">
                      <img src="{{ asset('images/tenor.gif') }}" class="img-responsive" />
                    </div>


					<h3>Widget Banner</h3>
					@if($getBanners)
			            <img src="{{$getBanners->banner_image}}" height="75%" width="100%"	class="p-5">
			        @endif
					<form action="{{route('banner.store')}}" method="POST" enctype="multipart/form-data" onsubmit="LoadForm()">

						@csrf
						<div class="form-inline">
							<input type="hidden" name="userid" value="{{Auth::user()->id}}">
					        <input class="form-control" type="file" name="bannerimage" >
					        <button class="btn btn-primary ml-5 p-2 pl-4 pr-4" type="submit">Save</button>
					        
						</div>
						
			            @if ($errors->has('bannerimage'))

		                    <p class=" text-danger" >{{ $errors->first('bannerimage') }}</p>

		                @endif
						
				          	
					</form>

				</div>

			</div>

		</div>

@stop
