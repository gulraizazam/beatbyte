@extends('dashboard.layouts.default')

@section('content')

	<div class="container-fluid">

      <!-- Breadcrumbs-->

      	<div class="content-heading">

    		All Users

    		<div class="sub-menu-wrapper hidden-sm hidden-xs">

		        <div class="sub-menu hidden-sm hidden-xs">

		            <div class="sub-menu__item active">

		                <a class="sub-menu__link" href="#"><i class="fa fa-list"></i> All Users</a>

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

	      		<h3 class="text-primary">All Users</h3>

		        <div class="table-responsive">

		            <table class="table  table-bordered" id="dataTable" width="100%" cellspacing="0">

		              <thead>

		                <tr>

		                	

		                	<th>Id</th>

		                  	<th>Name</th>

		                  	<th>Email</th>
		                  	<th>Role</th>
		                  	<th>Status</th>

		                  	

		                  	<th >Action</th>

		                </tr>

		              </thead>

		              

		              <tbody>

		              	@foreach($allusers as $users)

		                <tr>

		                	<td>{{$users->id}}</td>

		                  	<td>{{$users->username}}</td>

		                  	<td>{{$users->email}}</td>
		                  	<td>{{$users->name}}</td>
		                  	<td>{{$users->is_active == 1 ? 'Active' : 'Deactive'}}</td>

		                  

		                  	@if($users->is_active == 0)

		                  	<td><a href="{{route('users.active',$users->id)}}" class="btn btn-success" style="color: white">Activate</a></td>

		                  	@else

			                <td><a href="{{route('users.deactive',$users->id)}}" class="btn btn-danger" style="color: white">Deactivate</a></td>

			                @endif

		                </tr>

		                @endforeach

		              </tbody>

		            </table>

		        </div>

	      	</div>

 	 	</div>

@stop