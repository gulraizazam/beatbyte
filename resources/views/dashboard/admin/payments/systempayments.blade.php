@extends('dashboard.layouts.default')

@section('content')

	<div class="container-fluid">

      <!-- Breadcrumbs-->

      	<div class="content-heading">

    		System Payments

    		<div class="sub-menu-wrapper hidden-sm hidden-xs">

		        <div class="sub-menu hidden-sm hidden-xs">

		            <div class="sub-menu__item active">

		                <a class="sub-menu__link" href="#"><i class="fa fa-list"></i> System Payments</a>

		            </div>

		            

		             

		        </div>

    		</div>

		</div>

      	<hr>

      	<!-- Icon Cards-->

      	<div class="container">
      		<h3 class="text-primary">System Payments</h3>
      		<div class="row">
      			<div class="col-md-12">
	      			<div class="col-md-6" style="display: initial;">
	      			<form class="form-inline" action="{{route('payment.filter')}}" method="post">
	      				@csrf
					  <div class="" >
					    <label for="email" style="justify-content: left">From Date</label>
					    <input type="date" class="form-control" id="email" placeholder="From Date" name="fromdate">
					  </div>
					  <div class="" style="margin-left: 5px;">
					    <label for="pwd" style="justify-content: left">To Date</label>
					    <input type="date" class="form-control" id="pwd" placeholder="To Date" name="todate">
					    <button type="submit" class="btn btn-primary" style="margin-left: 3px;">Filter</button>
					  </div>
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
		                	<th>Payment Id</th>

		                	<th>User Email</th>

		                  	<th>Packege Name</th>

		                  	<th>Packege Price</th>
		                  	<th>Expiry Date</th>
		                  	

		                </tr>

		              </thead>

		              

		              <tbody>

		              	@foreach($systempaymets as $payments)

		                <tr>

		                		
		                	<td>{{$payments->id}}</td>
		                  <td>{{$payments->payment_id}}</td>

		                  <td>{{$payments->email}}</td>

		                  <td> {{$payments->packege_name}}</td>

		                  <td>&#36; {{$payments->packege_price}}</td>

		                  	<td> {{$payments->expires_on}}</td>

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