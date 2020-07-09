@extends('dashboard.layouts.default')

@section('content')



	<div class="container-fluid">

      <!-- Breadcrumbs-->

      	<div class="content-heading">

    		All Beats

    		<div class="sub-menu-wrapper hidden-sm hidden-xs">

		        <div class="sub-menu hidden-sm hidden-xs">

		            <div class="sub-menu__item active">

		                <a class="sub-menu__link" href="#"><i class="fa fa-list"></i> All Beats</a>

		            </div>

		            <div class="sub-menu__item ">

		                <a class="sub-menu__link" href="{{route('beat.upload')}}"><i class="fa fa-upload"></i> Upload</a>

		            </div>

		        </div>

    		</div>

		</div>

      	<hr>

      <!-- Icon Cards-->

      	<div class="container">

      		

      		@if(session()->has('success'))

			    <div class="alert alert-success">

			        {{ session()->get('success') }}

			        

			    </div>

			@endif

			@if(session()->has('error'))

                <div class="alert alert-danger">

                    {{ session()->get('error') }}

                </div>

            @endif

	      	<div class="">

	      		<h3 class="text-primary">All Beats</h3>

		        <div class="table-responsive">

		            <table class="table  table-bordered" id="dataTable" width="100%" cellspacing="0">

		              <thead>

		                <tr>

		                	<th></th>

		                  	<th></th>

		                </tr>

		              </thead>

		              

		              <tbody>

		              	@foreach($allbeats as $beat)

		                <tr>
		                	
		                  <td class="p0">

    						<div class="media" style="padding: 8px">

        						<a href="beat/{{$beat->id}}/edit" class="pull-left">
        							@if($beat->image)
        								<img class="artwork media-object img-responsive" src="{{$beat->image}}" style="height: 100px;width: 100px">
        							@else
            						<img class="artwork media-object img-responsive" src="{{asset('images/beat.jpg')}}" style="height: 100px;width: 100px">
            						@endif
        						</a>

        						<div class="media-body">

            						<div class="pull-right label bg-purple-light"><span class="badge badge-info">{{$beat->generation}}</span></div>
            						@if($beat->is_purchased == 1)
            							<div class="pull-right label bg-purple-light"><span class="badge badge-info">Sold</span></div>
            						@endif

        							<h4 class="media-heading name">

										<a href="{{route('beat.edit',$beat->id)}}">

											

											{{$beat->name}}

										</a>

									</h4>

        							<p>

        								<span class="label @if (isset($beat->format) and explode(',',$beat->format)[0] == 'wav')  label-default"  data-toggle="tooltip" title="" data-original-title="You don't have a mp3 file uploaded" @else label-info" @endif >
        								@if (isset($beat->format) and explode(',',$beat->format)[0] != 'wav')
        								<i class="fa fa-check"></i> @else <i class="fa fa-times"></i> 
        								@endif MP3</span>

										<span class="label label-info"><i class="fa fa-check"></i> Tagged</span>
										
                						<span class="label @if (isset($beat->format) and explode(',',$beat->format)[0] != 'wav')  label-default"  data-toggle="tooltip" title="" data-original-title="You don't have a WAV file uploaded"  @else label-info" @endif>
                						@if (isset($beat->format) and explode(',',$beat->format)[0] == 'wav')
                						<i class="fa fa-check"></i> @else <i class="fa fa-times"></i> @endif WAV</span>

                						<span class="label label-default" data-toggle="tooltip" title="" data-original-title="You don't have a trackout uploaded"><i class="fa fa-times"></i> Trackout</span>

        							</p>

        						</div>

    						</div>
    						@if($beat->basic_price)
    						<div class="row pricing-list">

       							<div class="col-sm-1"></div>

        						<div class="col-sm-2 text-center">

	            					<span>

										<span class="name">Basic</span>

	            						<br>

	            						<span class="price">${{$beat->basic_price}}</span>

	            					</span>

        						</div>

        						<div class="col-sm-2 text-center">

	            					<span>

										<span class="name">Premium</span>

	            						<br>

	            						<span class="price">${{$beat->premium_price}}</span>

	            					</span>

        						</div>

        						<div class="col-sm-2 text-center">

	            					<span>

										<span class="name">Unlimited</span>

	            						<br>

	           							 <span class="price">${{$beat->unlimited_price}}</span>

	            					</span>

        						</div>

						        <div class="col-sm-2 text-center">

						            <span>

										<span class="name">Exclusive</span>

            							<br>

            							<span class="price">${{$beat->exclusive_price}}</span>

            						</span>

        						</div>

        						<div class="col-sm-1"></div>

    						</div>
    						@endif
						</td>

		         		<td><a href="{{route('beat.delete',$beat->id)}}" class="btn btn-danger" style="color: white">Delete</a></td>

		                </tr>

		                @endforeach

		              </tbody>

		            </table>

		        </div>

	      	</div>

 	 	</div>

@stop