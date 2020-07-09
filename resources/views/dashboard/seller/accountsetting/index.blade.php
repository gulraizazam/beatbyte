@extends('dashboard.layouts.default')

@section('content')


	<div class="container-fluid">

		<div class="content-heading">

    		Account Settings

    		<div class="sub-menu-wrapper hidden-sm hidden-xs">

		        <div class="sub-menu hidden-sm hidden-xs">

		            <div class="sub-menu__item active">

		                <a class="sub-menu__link" href="{{url('allbeats')}}"><i class="fa fa-list"></i> Account Settings</a>

		            </div>

		            

		        </div>

    		</div>

		</div>

      	<hr>

      	<div class="container">

      		<div class="row">
      			<div class="col-md-12">
      				@if(session()->has('success'))

			    		<div class="alert alert-success">

			        		{{ session()->get('success') }}

			    		</div>

					@endif	
      			
      			</div> 
      		

				

				<div class="col-md-12" style="padding-bottom: 20px;border: 3px solid #cfdbe2;">

					<h3>Account Settings</h3>

					<form action="{{route('setting.store')}}" method="POST" enctype="multipart/form-data">

						@csrf

						<input type="hidden" name="userid" value="{{Auth::user()->id}}">

						<div class="row">

							<div class="form-group col-md-6">

					            <label for="exampleInputEmail1">PAYPAL_LIVE_API_CLIENT_ID</label>

					            <input class="form-control" type="text" name="liveApiname"  placeholder="PAYPAL_LIVE_API_USERNAME">

					             @if ($errors->has('liveApiname'))

				                    <p class=" text-danger" >{{ $errors->first('liveApiname') }}</p>

				                 @endif

				          	</div>

				          	<div class="form-group col-md-6">
					            <label for="exampleInputEmail1">PAYPAL_LIVE_API_SECRET</label>

					            <input class="form-control" type="text" name="liveSecret"  placeholder="PAYPAL_LIVE_API_SECRET">

					            @if ($errors->has('liveSecret'))

				                    <p class=" text-danger" >{{ $errors->first('liveSecret') }}</p>

				                 @endif

				          	</div>
				          	

				          	
				     	</div>

				     	

				     	
				     	<button class="btn btn-primary" type="submit" style="float: right">Add Settings</button>

					</form>

				</div>

			</div>

		</div>

@stop
