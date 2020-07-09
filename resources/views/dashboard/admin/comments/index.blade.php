@extends('dashboard.layouts.default')

@section('content')

	<div class="container-fluid">

      <!-- Breadcrumbs-->

      	<div class="content-heading">

    		All Comments

    		<div class="sub-menu-wrapper hidden-sm hidden-xs">

		        <div class="sub-menu hidden-sm hidden-xs">

		            <div class="sub-menu__item active">

		                <a class="sub-menu__link" href="#"><i class="fa fa-list"></i> All Comments</a>

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

	      		<h3 class="text-primary">All Commets</h3>

		        <div class="table-responsive">

		            <table class="table  table-bordered" id="dataTable" width="100%" cellspacing="0">

		              <thead>

		                <tr>

		                	<th>ID</th>

		                  	<th>Comment</th>
		                  	
		                  	<th>Status</th>
		                  	<th colspan="2">Action</th>

		                </tr>

		              </thead>

		              

		              <tbody>
		              	@if($getcomments)
		              	@foreach($getcomments as $comments)

		                <tr>

		                	

		                  <td>{{$comments->id}}</td>

		                  <td>{{$comments->comment}}</td>
		                  
		                  	
		                  <td>{{$comments->is_approved == 1 ? 'Approved' : 'DisApproved'}}</td>
		                  
		                 	 <td>
		                  		
		                  		<a href="{{route('comment.approve',$comments->id)}}" class="btn btn-primary" style="color: white">Approve</a>
		                  		
		                  		<a href="{{route('comment.disapprove',$comments->id)}}" class="btn btn-danger" style="color: white">Disapprove</a>
		                  		
		          			</td>
		                  
		                </tr>

		                @endforeach
		                @endif
		                
		              </tbody>

		            </table>

		        </div>

	      	</div>

 	 	</div>

@stop