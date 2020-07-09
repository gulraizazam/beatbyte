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

    		Edit Beat

    		<div class="sub-menu-wrapper hidden-sm hidden-xs">

		        <div class="sub-menu hidden-sm hidden-xs">

		            <div class="sub-menu__item active">

		                <a class="sub-menu__link" href="#"><i class="fa fa-list"></i> Edit Beats</a>

		            </div>

		            <div class="sub-menu__item ">

		                <a class="sub-menu__link" href="{{route('beat.upload')}}"><i class="fa fa-upload"></i> Upload</a>

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
					@if(session()->has('warning'))

			    <div class="alert alert-warning">

			        {!! Session::get('warning') !!}

			    </div>

			@endif
      			</div>
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

				                    <strong>2</strong>

				                </div>

				                <div class="text-uppercase">Beats Uploaded</div>

				            </div>

				        </div>

				    </div>

				</div>

				<div class="col-md-12" style="padding-bottom: 20px;border: 3px solid #cfdbe2;">
					<div class="ajax-loader" style="display: none;">
                      <img src="{{ asset('images/tenor.gif') }}" class="img-responsive" />
                    </div>
					<h3>Edit Beat</h3>

					<form action="{{route('beat.update',$editbeat->id)}}" method="POST" enctype="multipart/form-data" onsubmit="LoadForm()">

						@csrf

						<input type="hidden" name="userid" value="{{Auth::user()->id}}">

						<div class="row">

							<div class="form-group col-md-5">

					            <label for="exampleInputEmail1">Name</label>

					            <input class="form-control" type="text" name="beatname"  placeholder="File Name" value="{{$editbeat->name}}">

					             @if ($errors->has('beatname'))

				                    <p class=" text-danger" >{{ $errors->first('beatname') }}</p>

				                 @endif

				          	</div>

				          	<div class="form-group col-md-2">

					            <label for="exampleInputEmail1">Tempo(BPM)</label>

					            <input class="form-control" type="text" name="tempo" placeholder="0"  value="{{$editbeat->tempo}}">

					             @if ($errors->has('tempo'))

				                    <p class=" text-danger" >{{ $errors->first('tempo') }}</p>

				                 @endif

				          	</div>

				          	<div class="form-group col-md-5">

					            <label for="exampleInputEmail1">Genre<span>*</span></label>

					            <select id="genre" class="form-control" name="musicgeneration">

					            	<option value="">Select</option>

					            	@foreach($allgen as $generation)

				            		<option value="{{$generation->generation_name}}" {{$editbeat->generation == $generation->generation_name ? 'selected' : ''}}>{{$generation->generation_name}}</option>

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

					            <select id="moods" class="form-control" name="musicmode">

					            	<option>Select</option>

				            		@foreach($allmoods as $mood)

				            		<option value="{{$mood->mood_name}}" {{$editbeat->mood_name == $mood->mood_name ? 'selected' : ''}}>{{$mood->mood_name}}</option>

                                    @endforeach   

					            </select>

					           

				          	</div>

				          	 @if ($errors->has('musicmode'))

			                    <p class=" text-danger" >{{ $errors->first('musicmode') }}</p>

			                 @endif
			                 <div class="col-md-3">
			                 	<label>Select Category</label>
			                 	<select id="categories" class="form-control selectprice" name="category" onchange="PriceChanges();">
			                 		<option value="">Select</option>
			                 		<option value="paid" {{$editbeat->is_free == "paid" ? 'selected' : ''}}>Paid</option>
			                 		<option value="free" {{$editbeat->is_free == "free" ? 'selected' : ''}}>Free</option>
			                 	</select>
			                 </div>
				          	<div class="form-group col-md-3 prices">

					            <label for="exampleInputEmail1">Basic Price</label>

					            <input class="form-control" type="text" name="basic_price"  placeholder="Price" value="{{$editbeat->basic_price}}">

					            @if ($errors->has('basic_price'))

				                    <p class=" text-danger" >{{ $errors->first('basic_price') }}</p>

				                 @endif

				          	</div>



				     	</div>

				     	<div class="row">

				     		<div class="form-group col-md-6">

					            <label for="exampleInputEmail1">Tags</label>

					            <input class="form-control" type="text" name="tags"  placeholder="Enter Comma Separated Tags" value="{{$editbeat->tags}}">

				          	</div>

				          	<div class="form-group col-md-6 prices">

					            <label for="exampleInputEmail1">Premium Price</label>

					            <input class="form-control" type="text" name="premium_price" placeholder="Premium Price" value="{{$editbeat->premium_price}}">

				          	</div>

				     	</div>

				     	<div class="row">

				     		<div class="form-group col-md-6 prices">

					            <label for="exampleInputEmail1">Unlimited Price</label>

					            <input class="form-control" type="text" name="unlimited_price" placeholder="Unlimited Price" value="{{$editbeat->unlimited_price}}">

				          	</div>

				          	<div class="form-group col-md-6 prices">

					            <label for="exampleInputEmail1">Exclusive Price</label>

					            <input class="form-control" type="text" name="exclusive_price"  placeholder="Exclusive Price" value="{{$editbeat->exclusive_price}}">

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



					            <input class="form-control" type="date" name="release_date"  placeholder="Release Date" required>

					            <p class="label label-success" style="background-color: green;"><i class="fa fa-check"></i>Published On:{{$editbeat->release_date}}</p>

				          	</div>



				     	</div>
				     	<div class="row">
				     		<div class="col-md-6">
				     			<label for="exampleInputEmail1">Beat Image</label>

					            <input class="form-control" type="file" name="file" >
				     		</div>
				     		<div class="col-md-6"></div>
				     	</div>
				     	

				     	<button class="btn btn-primary" type="submit" style="float: right">Update Beat</button>

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
	$('#genre').select2();
	$('#moods').select2();
	$('#categories').select2();
</script>
@endsection