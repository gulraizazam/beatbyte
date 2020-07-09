@extends('dashboard.layouts.default')

@section('content')

	<div class="container-fluid">

      <!-- Breadcrumbs-->

      	<div class="content-heading">

    		All Packeges

    		<div class="sub-menu-wrapper hidden-sm hidden-xs">

		        <div class="sub-menu hidden-sm hidden-xs">

		            <div class="sub-menu__item active">

		                <a class="sub-menu__link" href="#"><i class="fa fa-list"></i> All Packeges</a>

		            </div>

		            

		            <div class="sub-menu__item ">

		                <a class="sub-menu__link" href="{{route('packege.add')}}"><i class="fa fa-upload"></i> Add Packege</a>

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

	      		<h3 class="text-primary">All Packeges</h3>

		        <div class="table-responsive">

		            <table class="table  table-bordered" id="dataTable" width="100%" cellspacing="0">

		              <thead>

		                <tr>

		                	<th>ID</th>

		                  	<th>Packege Name</th>

		                  	<th>Packege Price</th>

		                  	<th colspan="2">Action</th>

		                </tr>

		              </thead>

		              

		              <tbody>

		              	@foreach($allpackeges as $packeges)

		                <tr>

		                	

		                  <td>{{$packeges->id}}</td>

		                  <td>{{$packeges->packege_name}}</td>
		                  @if($packeges->packege_price)
		                  <td>&#36; {{$packeges->packege_price}}</td>
		                  @else
		                  <td>Free</td>
		                  @endif
		                  <td><a href="{{route('packege.edit',$packeges->id)}}" class="btn btn-primary" style="color: white">Edit</a></td>

		                  <td><a href="{{route('packege.delete',$packeges->id)}}" class="btn btn-danger" style="color: white">Delete</a></td>

		                </tr>

		                @endforeach

		              </tbody>

		            </table>

		        </div>

	      	</div>

 	 	</div>

@stop