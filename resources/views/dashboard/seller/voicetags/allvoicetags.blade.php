@extends('dashboard.layouts.default')

@section('content')



	<div class="container-fluid">

		<div class="content-heading">

      		Voice Tag

      		<div class="sub-menu-wrapper hidden-sm hidden-xs">

        	        <div class="sub-menu hidden-sm hidden-xs">

        	            <div class="sub-menu__item active">

        	                <a class="sub-menu__link" href="#"><i class="fa fa-list"></i>Voice Tag</a>

        	            </div>

        	        </div>

      		</div>

		</div>

      	<hr>

      	<div class="container">

      		@if(session()->has('success'))

              <div class="alert alert-success">

                  {{ session()->get('success') }}

              </div>

          @endif

          @if(session()->has('Error'))

              <div class="alert alert-danger">

                  {{ session()->get('Error') }}

              </div>

          @endif

          <div class="row">

            <div class="col-sm-12">

                <p>A voicetag is used to tag (watermark) your beats to protect them against unauthorised use. Once a voicetag is uploaded, <strong>all new beats</strong> added will have a tagged version automatically generated by our system. Our system will mix and loop your voicetag with your untagged MP3 to create a new Tagged MP3 which is used for streaming on your stores. All this is done using our free <a href="#" target="_blank">Autotag</a> feature.</p>



                <p>You can watermark existing untagged beats, or change the watermark on your current tagged beats by using <a href="#" target="_blank">Autotag</a>.</p>



                <p>If you haven't got a voicetag, you can <a href="#">buy custom made voicetags</a> from us. Please <a href="#">click here</a> to buy a custom voicetag. If you don't upload a voicetag, all beats uploaded will be automatically tagged with the default Airbit tag to make sure your beats are protected.</p>



                <a href="#" target="_blank" class="btn btn-block btn-info text-center"><i class="fa fa-info-circle"></i> Learn how to upload your voicetag correctly</a>

                  @if($getVoiceTag)

                  <div align="center" style="margin-top: 10px;">

                    <p>

                        <audio controls="">

                            <source src="{{URL::to('storage/app/uploads/files')}}/{{$getVoiceTag->voicetag_file}}" type="audio/mpeg"> Your browser does not support the audio tag.

                        </audio>

                    </p>

                    <p><strong>Your Current Voicetag</strong></p>

                    <a href="{{route('voicetag.delete',$getVoiceTag->id)}}" class="btn btn-danger" >Delete</a>

                </div>

                @else

                @endif

                <p class="alert alert-warning text-center"><i class="fa fa-exclamation-triangle" style="margin-top: 5px;"></i> Please ensure you add silence to your voicetag to ensure the loops have adequate spacing. <a href="#" target="_blank">Find out more here</a>.</p>

            </div>

            <div class="col-sm-12">

                <form method="POST" action="{{route('voicetag.add')}}" enctype="multipart/form-data" style="border: 3px dashed #039be5!important;min-height: 150px;background: #fff;padding: 20px;" >

                    @csrf

                    <input type="hidden" name="userid" value="{{Auth::user()->id}}">

                    <div class="dz-message" style="text-align: center;margin: 2em 0;">

                        <div class="dz-message-icon"><i class="fa fa-file-audio-o"></i></div>

                        <div class="dz-message-title">Upload Voicetag Here</div>

                        <div class="dz-message-body">

                          <input type="file" name="voicetag" class="form-control">

                        </div>

                    </div>

                    <button type="submit" class="btn btn-primary">Add Voicetag</button>

                </form>

            </div>

          </div>



        </div>

@stop