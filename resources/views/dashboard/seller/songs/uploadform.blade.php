@extends('dashboard.layouts.default')

@section('content')



	<div class="container-fluid">

		<div class="content-heading">

    		Upload Songs

    		<div class="sub-menu-wrapper hidden-sm hidden-xs">

		        <div class="sub-menu hidden-sm hidden-xs">

		            <div class="sub-menu__item ">

		                <a class="sub-menu__link" href="{{url('allsongs')}}"><i class="fa fa-list"></i> All Songs</a>

		            </div>

		           

		            <div class="sub-menu__item active">

		                <a class="sub-menu__link" href="{{URL::to('songupload')}}"><i class="fa fa-upload"></i> Upload</a>

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

				<div class="col-md-12">

					<a href="{{route('song.showupload')}}" class="choicemusic" style="text-decoration: none;">

						<div class="music-upload-choice">

							<div class="choice choice-new" data-choice="new">

								<i class="fa fa-plus"></i>



								<h3>New</h3>



								<p>Upload WAV or MP3 audio to create new beats. WAV files will automatically convert to 320kbps MP3 and tagged versions will be generated for streaming.</p>

							</div>

						</div>

					</a>

					

				</div>

      		</div>

      	</div>



@stop