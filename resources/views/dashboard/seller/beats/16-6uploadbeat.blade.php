@extends('dashboard.layouts.default')

@section('content')



	<div class="container-fluid">

		<div class="content-heading">

    		Upload Beats

    		<div class="sub-menu-wrapper hidden-sm hidden-xs">

		        <div class="sub-menu hidden-sm hidden-xs">

		            <div class="sub-menu__item ">

		                <a class="sub-menu__link" href="#"><i class="fa fa-list"></i> All Beats</a>

		            </div>

		       
		            <div class="sub-menu__item active">

		                <a class="sub-menu__link" href="{{route('beat.upload')}}"><i class="fa fa-upload"></i> Upload</a>

		            </div>

		        </div>

    		</div>

		</div>

      	<hr>

      	<div class="container">

      		<div class="row">

      			<div class="col-md-6">

				    <div class="panel widget bg-primary">

				        <div class="row row-table">

				            <div class="left-section col-xs-4 text-center bg-primary-dark pv-lg">

				                <em class="fa fa-upload fa-3x"></em>

				            </div>

				            <div class="right-section col-xs-8 pv-lg">

				                <div class="statistic h2 mt0" style="height: 33px">

				                    <strong>Unlimited</strong>

				                </div>

				                <div class="text-uppercase">Uploads Remaining</div>

				            </div>

				        </div>

				    </div>

				</div>

				<div class="col-md-6">

				    <div class="panel widget bg-purple">

				        <div class="row row-table">

				            <div class="left-section col-xs-4 text-center bg-purple-dark pv-lg">

				                <em class="fa fa-music fa-3x"></em>

				            </div>

				            <div class="right-section col-xs-8 pv-lg">

				                <div class="statistic h2 mt0" style="height: 33px">

				                    <?php

				                	$beatcount = count($allbeats);

				                	

				                	?>

				                	@if($beatcount==0)

				                    <strong>0</strong>

				                    @else

				                    <strong>{{$beatcount}}</strong>

				                    @endif

				                </div>

				                <div class="text-uppercase">Beats Uploaded</div>

				            </div>

				        </div>

				    </div>

				</div>

				<div class="col-md-12">

					<a href="{{route('beat.uploadform')}}" class="choicemusic" style="text-decoration: none;">

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