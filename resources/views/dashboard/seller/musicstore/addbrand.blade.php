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

    		Upload Settings

    		<div class="sub-menu-wrapper hidden-sm hidden-xs">

		        <div class="sub-menu hidden-sm hidden-xs">

		          <!--   <div class="sub-menu__item ">

		                <a class="sub-menu__link" href="{{url('allsongs')}}"><i class="fa fa-list"></i> All Brands</a>

		            </div> -->

		           

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


					<h3>Add Brand</h3>

					<form action="{{route('brand.store')}}" method="POST" enctype="multipart/form-data" onsubmit="LoadForm()">

						@csrf

						<input type="hidden" name="userid" value="{{Auth::user()->id}}">

						<div class="row">

							@if($getBrands)
				          	<div class="form-group col-md-6">
					            <img src="{{$getBrands->brand_logo}}" style="height: 150px;width: 185px;margin-top: 30px;margin-left: 60px;">
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
						<button class="btn btn-primary" type="submit" style="float: right">Add Brand</button>

					</form>

				</div>
				<div class="col-md-12" style="padding-bottom: 20px;border: 3px solid #cfdbe2;">
					<div class="ajax-loader" style="display: none;">
                      <img src="{{ asset('images/tenor.gif') }}" class="img-responsive" />
                    </div>


					<h3>Add Banner</h3>

					<form action="{{route('banner.store')}}" method="POST" enctype="multipart/form-data" onsubmit="LoadForm()">

						@csrf

						<input type="hidden" name="userid" value="{{Auth::user()->id}}">

						<div class="row">

							@if($getBanners)
				          	<div class="form-group col-md-6">
					            <img src="{{$getBanners->banner_image}}" style="height: 150px;width: 185px;margin-top: 30px;margin-left: 60px;">
					        </div>
					        @else

					        @endif
				          	<div class="form-group col-md-6">

					            <label for="exampleInputEmail1">Banner Image</label>

					            <input class="form-control" type="file" name="bannerimage" >
					             @if ($errors->has('bannerimage'))

				                    <p class=" text-danger" >{{ $errors->first('bannerimage') }}</p>

				                 @endif
					             
				          	</div>
				          	
				         </div>
						<button class="btn btn-primary" type="submit" style="float: right;">Add Banner</button>

					</form>

				</div>

			</div>

		</div>

@stop
