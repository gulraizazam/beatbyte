@extends('dashboard.layouts.default')

@section('content')

	<div class="container-fluid">

      <!-- Breadcrumbs-->

      	<div class="content-heading">

    		My Account

    		<div class="sub-menu-wrapper hidden-sm hidden-xs">

		        <div class="sub-menu hidden-sm hidden-xs">

		            <div class="sub-menu__item active">

		                <a class="sub-menu__link" href="#"><i class="fa fa-list"></i> My Profile</a>

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

      		<div class="col-xs-12">

		    <div class="col-md-12">

		        <form method="post" action="{{url('updateaccount',$user->id)}}" enctype="multipart/form-data">

		            @csrf

		            

		            <div class="panel panel-default" style="padding: 10px">

		                <div class="panel-heading">

		                    <h3 class="panel-title">Account Settings</h3>

		                </div>

		                <div class="panel-body">

		                    <div class="form-group">

		                        <label class="control-label" for="user[username]">Username</label>

		                        <input type="text" name="username" id="user[username]" class="form-control"  placeholder="Username" value="{{$user->name}}">

		                    </div>

		                    

		                    

		                    <div class="form-group">

		                        <label class="control-label" for="user[email]">Email Address</label>

		                        <input type="email" name="useremail" id="user[email]" class="form-control"  placeholder="Email Address" value="{{$user->email}}">

		                    </div>



		                    <div class="form-group">

		                        <label class="control-label" for="password">New Password</label>

		                        <input type="password" name="password" id="password" class="form-control" placeholder="New Password">

		                    </div>

		                    <div class="form-group">

		                        <label class="control-label" for="password2">Re-enter New Password</label>

		                        <input type="password" name="password2" id="password2" class="form-control" placeholder="Re-enter New Password">

		                    </div>

						</div>

		                <div class="panel-footer text-right">

		                    <button type="submit" class="btn btn-success"><i class="fa fa-floppy-o"></i> Update</button>

		                </div>

		            </div>

		        </form>



		        

		    </div>

		</div>

	      	

 	 	</div>

@stop