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

    		Add Mood

    		<div class="sub-menu-wrapper hidden-sm hidden-xs">

		        <div class="sub-menu hidden-sm hidden-xs">

		            <div class="sub-menu__item ">

		                <a class="sub-menu__link" href="#"><i class="fa fa-list"></i> All Moods</a>

		            </div>

		           

		            <div class="sub-menu__item active">

		                <a class="sub-menu__link" href="{{route('mood.add')}}"><i class="fa fa-upload"></i> Add Mood</a>

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
					<h3>Add Mood</h3>

					<form action="{{route('mood.store')}}" method="POST" enctype="multipart/form-data" onsubmit="LoadForm()">

						@csrf

						

						<div class="row">

							<div class="form-group col-md-6">

					            <label for="exampleInputEmail1">Mood Name</label>

					            <input class="form-control" type="text" name="moodname"  placeholder="File Name">

					             @if ($errors->has('moodname'))

				                    <p class=" text-danger" >{{ $errors->first('moodname') }}</p>

				                 @endif

				          	</div>

				          

				          	

				     	</div>

				     	<button class="btn btn-primary" type="submit" >Add Mood</button>

					 </div>

				     

				</form>

			</div>

		</div>

	</div>

@stop