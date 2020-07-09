@extends('dashboard.layouts.default')

@section('content')



	<div class="container-fluid">

      <!-- Breadcrumbs-->

      	<div class="content-heading">

    		All Music Kits

    		<div class="sub-menu-wrapper hidden-sm hidden-xs">

		        <div class="sub-menu hidden-sm hidden-xs">

		            <div class="sub-menu__item active">

		                <a class="sub-menu__link" href="#"><i class="fa fa-list"></i>All Music Kits</a>

		            </div>

		            

		            <div class="sub-menu__item ">

		                <a class="sub-menu__link" href="{{route('kits.uploadform')}}"><i class="fa fa-upload"></i> Upload</a>

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

	      		<h3 class="text-primary">All Music Kits</h3>

		        <div class="table-responsive">

		            <table class="table  table-bordered" id="dataTable" width="100%" cellspacing="0">

		              <thead>

		                <tr>

		                	<th></th>

		                  	<th></th>

		                  	<th></th>

		                </tr>

		              </thead>

		              

		              <tbody>

		              	@foreach($getkits as $kit)

		                <tr>

		                	

		                  <td></td>

		                  <td class="p0">

    						<div class="media" style="padding: 8px">

        						<a href="#" class="pull-left">

            						<img class="artwork media-object img-responsive" src="{{asset('images/placeholder@100x.jpg')}}">

        						</a>

        						<div class="media-body">

            						

        							<h4 class="media-heading name">

										<a href="{{route('kit.edit',$kit->id)}}">

											{{$kit->name}}

										</a>

									</h4>

        							

        						</div>

    						</div>

    						<div class="row pricing-list">

       							<div class="col-sm-1"></div>

        						<div class="col-sm-2 text-center">

	            					<span>

										<span class="name">Price</span>

	            						<br>

	            						<span class="price">{{$kit->price}}</span>

	            					</span>

        						</div>

        						

        						

						       

        						<div class="col-sm-1"></div>

    						</div>

						</td>

		         		<td><a href="{{route('kitt.delete',$kit->id)}}" class="btn btn-danger" style="color: white">Delete</a></td>

		                </tr>

		              @endforeach

		              </tbody>

		            </table>

		        </div>

	      	</div>

 	 	</div>

@stop