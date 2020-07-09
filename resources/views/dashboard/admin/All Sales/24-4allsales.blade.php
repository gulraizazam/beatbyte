@extends('dashboard.layouts.default')

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

      		<?php
      		$allusers = \App\User::join('role_user','users.id','=','role_user.user_id')->join('roles','roles.id','=','role_user.role_id')->select('users.name as username','roles.name','users.email','users.id','users.is_active')->where('roles.name','Seller')->get();

      		?>
      		<div class="row">
      			<div class="col-md-6"></div>
      			<div class="col-md-6">
      				<form>
      					<label>Select Seller</label>
		      			<select class="form-control" name="seller" id="chooseseller" onchange="GetSellerData()">
		      				<option value="all">All</option>
		      				@foreach($allusers as $users)
		      				<option value="{{$users->id}}">{{$users->username}}</option>
		      				@endforeach
		      			</select>
      				</form>
      			</div>
      			
      		</div>
      		
	      	<div class="">

	      		<h3 class="text-primary">All Sales</h3>

		        <div class="table-responsive">

		            <table class="table  table-bordered" id="dataTable" width="100%" cellspacing="0">

		              <thead>

		                <tr>

		                	
		                	<th>Payment ID</th>
		                	<th>Item Purchased</th>

		                  	<th>Price</th>

		                  	<th>Paid By</th>

		                  	<th>Selling Date</th>

		                </tr>

		              </thead>

		              

		              <tbody id="sales">

		              	@foreach($allsales as $sales)

		                <tr>
		                	<td>{{$sales->payment_id}}</td>
		                	<td>{{$sales->name}}</td>

		                  	<td>&#36; {{$sales->price}}</td>

		                  	<td>{{$sales->email}}</td>

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
			$('#chooseseller').select2();
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