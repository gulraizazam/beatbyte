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
.brand_logo{
	height: 123px;
    width: 150px;
    border-radius: 20px;
    padding-bottom: 10px;
}
.widgetsetting{
	padding-bottom: 20px;
    border: 3px solid #cfdbe2;
    margin-bottom: 23px;
    padding: 39px;
    background-color: #fdfdfd;
    box-shadow: 3px 1px 20px -4px #b4b7b9;
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

				<div class="col-md-12 widgetsetting" >
					<div class="ajax-loader" style="display: none;">
                      <img src="{{ asset('images/tenor.gif') }}" class="img-responsive" />
                    </div>


					<h3>Brand Logo</h3>

					<form action="{{route('brand.store')}}" method="POST" enctype="multipart/form-data" onsubmit="LoadForm()">

						@csrf

						

						<div class="row">

							@if($getBrands)
							<div class="form-group col-md-4"></div>
				          	<div class="form-group col-md-4">
					            <img src="{{$getBrands->brand_logo}}" class="brand_logo">
					        </div>
					        <div class="form-group col-md-4"></div>
					        @else

					        @endif
				          	
				          	
				         </div>
				         <div class="row">
				         	
				         	<div class="form-inline ml-5">
							<input type="hidden" name="userid" value="{{Auth::user()->id}}">
					        <input class="form-control" type="file" name="brandlogo" >
					         @if ($errors->has('brandlogo'))
				                <p class=" text-danger" >{{ $errors->first('brandlogo') }}</p>

				            @endif
					        <button class="btn btn-primary ml-5 p-2 pl-4 pr-4" type="submit">Save</button>
					        
						</div>
				         	
				          	<div class="form-group col-md-6"></div>
				         </div>
						

					</form>

				</div>
				<div class="col-md-12 widgetsetting" >
					<div class="ajax-loader" style="display: none;">
                      <img src="{{ asset('images/tenor.gif') }}" class="img-responsive" />
                    </div>


					<h3>Widget Banner</h3>
					@if($getBanners)
			            <img src="{{$getBanners->banner_image}}" height="75%" width="100%"	class="p-5">
			        @endif
					<form action="{{route('banner.store')}}" method="POST" enctype="multipart/form-data" onsubmit="LoadForm()">

						@csrf
						<div class="form-inline ml-5">
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
