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

    		Update Genre

    		<div class="sub-menu-wrapper hidden-sm hidden-xs">

		        <div class="sub-menu hidden-sm hidden-xs">

		            <div class="sub-menu__item ">

		                <a class="sub-menu__link" href="#"><i class="fa fa-list"></i> All Genres</a>

		            </div>

		           

		            <div class="sub-menu__item active">

		                <a class="sub-menu__link" href="{{route('generations.add')}}"><i class="fa fa-upload"></i> Update Genre</a>

		            </div>

		        </div>

    		</div>

		</div>

      	<hr>

      	<div class="container">

      		<div class="row">

				<div class="col-md-12" style="padding-bottom: 20px;border: 3px solid #cfdbe2;">
					<div class="ajax-loader" style="display: none;">
                      <img src="{{ asset('images/tenor.gif') }}" class="img-responsive" />
                    </div>
					<h3>Update Genre</h3>

					<form action="{{route('generations.update',$editgen->id)}}" method="POST" enctype="multipart/form-data" onsubmit="LoadForm()">

						@csrf

						

						<div class="row">

							<div class="form-group col-md-6">

					            <label for="exampleInputEmail1">Genre</label>

					            <input class="form-control" type="text" name="generationname"  placeholder="Generation Name" value="{{$editgen->generation_name}}">

					             @if ($errors->has('generationname'))

				                    <p class=" text-danger" >{{ $errors->first('generationname') }}</p>

				                 @endif

				          	</div>

				          

				          	

				     	</div>

				     	<button class="btn btn-primary" type="submit" >Update Genre</button>

					 </div>

				     

				</form>

			</div>

		</div>

	</div>

@stop