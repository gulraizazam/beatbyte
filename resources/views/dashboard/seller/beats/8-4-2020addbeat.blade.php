@extends('dashboard.layouts.default')

@section('content')

	<div class="container-fluid">

		<div class="content-heading">

    		Upload Beats

    		<div class="sub-menu-wrapper hidden-sm hidden-xs">

		        <div class="sub-menu hidden-sm hidden-xs">

		            <div class="sub-menu__item ">

		                <a class="sub-menu__link" href="{{url('allbeats')}}"><i class="fa fa-list"></i> All Beats</a>

		            </div>

		            <div class="sub-menu__item ">

		                <a class="sub-menu__link" href="#"><i class="fa fa-download"></i> Free Download Settings</a>

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

				<div class="col-md-12" style="padding-bottom: 20px;border: 3px solid #cfdbe2;">

					<h3>Add Beat</h3>

					<form action="{{route('beat.store')}}" method="POST" enctype="multipart/form-data">

						@csrf

						<input type="hidden" name="userid" value="{{Auth::user()->id}}">

						<div class="row">

							<div class="form-group col-md-5">

					            <label for="exampleInputEmail1">Name</label>

					            <input class="form-control" type="text" name="beatname"  placeholder="File Name">

					             @if ($errors->has('beatname'))

				                    <p class=" text-danger" >{{ $errors->first('beatname') }}</p>

				                 @endif

				          	</div>

				          	<div class="form-group col-md-2">

					            <label for="exampleInputEmail1">Tempo(BPM)</label>

					            <input class="form-control" type="text" name="tempo" placeholder="0">

					             @if ($errors->has('tempo'))

				                    <p class=" text-danger" >{{ $errors->first('tempo') }}</p>

				                 @endif

				          	</div>

				          	<div class="form-group col-md-5">

					            <label for="exampleInputEmail1">Generation<span>*</span></label>

					            <select class="form-control" name="musicgeneration">

					            	<option>Select</option>

					            	@foreach($allgen as $generation)

				            		<option value="{{$generation->generation_name}}">{{$generation->generation_name}}</option>

                                    @endforeach

					            </select>

					            

				          	</div>

				          	@if ($errors->has('musicgeneration'))

			                    <p class=" text-danger" >{{ $errors->first('musicgeneration') }}</p>

			                 @endif

				     	</div>

				     	<div class="row">

				     		<div class="form-group col-md-6">

					            <label for="exampleInputEmail1">Moods</label>

					            <select class="form-control" name="musicmode">

					            	<option>Select</option>

				            		@foreach($allmoods as $mood)

				            		<option value="{{$mood->mood_name}}">{{$mood->mood_name}}</option>

                                    @endforeach   

					            </select>

					           

				          	</div>

				          	 @if ($errors->has('musicmode'))

			                    <p class=" text-danger" >{{ $errors->first('musicmode') }}</p>

			                 @endif
			                 <div class="col-md-3">
			                 	<label>Select Category</label>
			                 	<select class="form-control selectprice" name="category" onchange="PriceChanges();">
			                 		<option value="">Select</option>
			                 		<option value="paid">Paid</option>
			                 		<option value="free">Free</option>
			                 	</select>
			                 </div>

				          	<div class="form-group col-md-3 prices">

					            <label for="exampleInputEmail1">Basic Price</label>

					            <input class="form-control" type="text" name="basic_price"  placeholder="Price">

					            @if ($errors->has('basic_price'))

				                    <p class=" text-danger" >{{ $errors->first('basic_price') }}</p>

				                 @endif

				          	</div>



				     	</div>

				     	<div class="row">

				     		<div class="form-group col-md-6">

					            <label for="exampleInputEmail1">Tags</label>

					            <input class="form-control" type="text" name="tags"  placeholder="Enter Comma Separated Tags">

				          	</div>

				          	<div class="form-group col-md-6 prices">

					            <label for="exampleInputEmail1">Premium Price</label>

					            <input class="form-control" type="text" name="premium_price" placeholder="Premium Price">

				          	</div>

				          	<!-- <div class="form-group col-md-3" style="margin-top: 30px;">

					            <label for="exampleInputEmail1">Is Free</label>

					            <input  type="checkbox" name="free" value="Free">

				          	</div> -->

				     	</div>

				     	<div class="row">

				     		<div class="form-group col-md-6 prices">

					            <label for="exampleInputEmail1">Unlimited Price</label>

					            <input class="form-control" type="text" name="unlimited_price" placeholder="Unlimited Price">

				          	</div>

				          	<div class="form-group col-md-6  prices">

					            <label for="exampleInputEmail1">Exclusive Price</label>

					            <input class="form-control" type="text" name="exclusive_price"  placeholder="Exclusive Price">

				          	</div>

				     	</div>

				     	<div class="row">

				     		<div class="form-group col-md-6">

					            <label for="exampleInputEmail1">Beat File</label>

					            <input class="form-control" type="file" name="audios[]" multiple="">

					            @if ($errors->has('audios'))

				                    <p class=" text-danger" >{{ $errors->first('audios') }}</p>

				                 @endif

				          	</div>

				          	<div class="form-group col-md-6">

					            <label for="exampleInputEmail1">Release Date</label>

					            <input class="form-control" type="date" name="release_date"  placeholder="Release Date">

				          	</div>

				     	</div>

				     	<button class="btn btn-primary" type="submit" style="float: right">Add Beat</button>

					</form>

				</div>

			</div>

		</div>

@stop
@section('scripts')
<script type="text/javascript">
	function PriceChanges()
	{
		if($('.selectprice').val()=="free"){
			$(".prices").css("display","none");
		}else{
			$(".prices").css("display","block");
		}
	}
</script>
@endsection