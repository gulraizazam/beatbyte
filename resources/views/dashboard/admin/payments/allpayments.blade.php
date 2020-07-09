@extends('dashboard.layouts.default')

@section('content')

	<div class="container-fluid">

      <!-- Breadcrumbs-->

      	<div class="content-heading">

    		Buyer Payments

    		<div class="sub-menu-wrapper hidden-sm hidden-xs">

		        <div class="sub-menu hidden-sm hidden-xs">

		            <div class="sub-menu__item active">

		                <a class="sub-menu__link" href="#"><i class="fa fa-list"></i> Buyer Payments</a>

		            </div>

		            

		             

		        </div>

    		</div>

		</div>

      	<hr>

      	<!-- Icon Cards-->
      	<?php
      		$allusers = \App\User::join('role_user','users.id','=','role_user.user_id')->join('roles','roles.id','=','role_user.role_id')->select('users.name as username','roles.name','users.email','users.id','users.is_active')->where('roles.name','Seller')->get();

      		?>
      	<div class="container">
      		<h3 class="text-primary">Buyer Payments</h3>
      		<div class="row">
      			<div class="col-md-12">
	      			<div class="col-md-6" style="display: initial;">
	      			
	      			</div>
	      			<div class="col-md-6" style="float: right;padding-bottom: 7px">
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
		                	<th>Id</th>
		                	<th>Order Id</th>

		                	<th>Item Purchased</th>

		                  	<th>Order Total</th>

		                  	<th>Paid By</th>
		                  	<th>Payment Date</th>
		                  	

		                </tr>

		              </thead>

		              

		              <tbody id="sales">

		              	@foreach($allorders as $orders)

		                <tr>

		                
		                	<td>{{$orders->id}}</td>
		                  <td>{{$orders->order_id}}</td>

		                  <td>{{$orders->name}}</td>

		                  <td>&#36; {{$orders->Total}}</td>

		                  <td>{{$orders->email}}</td>
		                  <td>{{$orders->created_at}}</td>
		                  

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
      			url: "{{URL::to('getajaxpayments')}}/"+ seller,
      			method: 'GET',
      
				success: function(response){
        			 $("#sales").html(response);
            
                
            
        		}
    		});
		}
		
	</script>
@stop