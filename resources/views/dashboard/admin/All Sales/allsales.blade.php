@extends('dashboard.layouts.default')
<style>
.btn-primary {
    color: #fff;
    background-color: #71328b !important;
    border-color: #71328b !important;
}
.btn-primary:hover {
    color: #fff;
    background-color: #71328b !important;
    border-color: #71328b !important;
}
.btn-primary:not(:disabled):not(.disabled).active, .btn-primary:not(:disabled):not(.disabled):active, .show>.btn-primary.dropdown-toggle {
    color: #fff;
    background-color: #71328b !important;
    border-color: #71328b !important;
}
.page-item.active .page-link {
    z-index: 1;
    color: #fff;
    background-color: #71328b !important;
    border-color: #71328b !important;
}
.page-link:hover {
    z-index: 2;
    color: #71328b !important;
    text-decoration: none;
    background-color: #e9ecef;
    border-color: #dee2e6;
}
#dataTable_paginate {
    float: right;
}
</style>

@section('content')

	<div class="container-fluid">

      <!-- Breadcrumbs-->

      	<div class="content-heading">

    		All Sales

    		<div class="sub-menu-wrapper hidden-sm hidden-xs">

		        <div class="sub-menu hidden-sm hidden-xs">

		            <div class="sub-menu__item active">

		                <a class="sub-menu__link" href="#"><i class="fa fa-list"></i> All Sales</a>

		            </div>

		            

		             

		        </div>

    		</div>

		</div>

      	<hr>

      	<!-- Icon Cards-->

      	<div class="container">
      		<h3 class="text-primary">All Sales</h3>
      		<?php
      		$allusers = \App\User::join('role_user','users.id','=','role_user.user_id')->join('roles','roles.id','=','role_user.role_id')->select('users.name as username','roles.name','users.email','users.id','users.is_active')->where('roles.name','Seller')->get();

      		?>
      		<div class="row">
      			<div class="col-md-12">
	      			<div class="col-md-6" style="display: initial;">
	      			<form class="form-inline" action="{{route('sales.filter')}}" method="post">
	      				@csrf
					  <div class="" >
					    <label for="email" style="justify-content: left;">From Date</label>
					    <input type="date" class="form-control" id="email" placeholder="From Date" name="fromdate">
					  </div>
					  <div class="" style="margin-left: 5px;">
					    <label for="pwd" style="justify-content: left;">To Date</label>
					    <input type="date" class="form-control" id="pwd" placeholder="To Date" name="todate">
					    <button type="submit" class="btn btn-primary" style="margin-left: 3px;">Filter</button>
					  </div>
					</form>
	      			</div>
	      			<div class="col-md-6" style="float: right;">
	      				<form style="width: 40%;float: inherit;margin-top: -40px;">
	      					<label style="display: inline-flex;width: 100%;margin-top: 6px;">Select Seller</label>
			      			<select class="form-control" name="seller" id="chooseseller" onchange="GetSellerData()">
			      				<option value="all">All</option>
			      				@foreach($allusers as $users)
			      				<option value="{{$users->id}}">{{$users->username}}</option>
			      				@endforeach
			      			</select>
	      				</form>
	      			</div>
	      		</div>
      			
      		</div>
      		
	      	<div class="">

	      		

		        <div class="table-responsive">

		            <table class="table  table-bordered" id="dataTable" width="100%" cellspacing="0">

		              <thead>

		                <tr>

		                	
		                	<th>Payment ID</th>
		                	<th>Item Purchased</th>

		                  	<th>Price</th>

		                  	<th>Paid By</th>
		                  	<th>Seller Name</th>
		                  	<th>Selling Date</th>

		                </tr>

		              </thead>

		              

		              <tbody id="sales">

		              	@foreach($allsales as $sales)

		                <tr>
		                	<td>{{$sales->payment_id}}</td>
		                	<td>{{$sales->songname}}</td>

		                  	<td>&#36; {{$sales->price}}</td>

		                  	<td>{{$sales->selleremail}}</td>
		                  	<td>{{$sales->sellername}}</td>
		                  	<td>{{$sales->created_at}}</td>

			                  <!-- <td><a href="" class="btn btn-primary" style="color: white">Edit</a></td>

			                  <td><a href="" class="btn btn-danger" style="color: white">Delete</a></td> -->

		                </tr>

		                @endforeach

		              </tbody>

		            </table>

		        </div>

	      	</div>

 	 	</div>

@stop
@section('scripts')
	<script type="text/javascript">
		
		function GetSellerData() {
			
			var seller = $('#chooseseller').val();
			$.ajax({
      			url: "{{URL::to('getajaxsales')}}/"+ seller,
      			method: 'GET',
      
				success: function(response){
        			 $("#sales").html(response);
            
                
            
        		}
    		});
		}
		
	</script>
@stop