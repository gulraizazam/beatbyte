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

      	<div class="container">

      		<div class="row">
                      <div class="col-md-12">
                        <div class="col-md-6"style="display: initial;">
                        <form class="form-inline" action="{{route('seller.filter')}}" method="post">
                              @csrf
                          <div class="" style="">
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
                      </div>
      			<div class="col-md-12">

      				<table class="table " id="dataTable">

      					<thead>

      						<th> Id</th>

      						<th>Payment Id</th>

      						<th>Item Name</th>

      						<th>Order Total</th>
                  <th>Date Of Sale</th>
      					</thead>

      					<tbody>

      						@foreach($allsales as $sales)

      						<tr>

      							<td>{{$sales->id}}</td>

      							<td>{{$sales->payment_id}}</td>

      							<td>{{$sales->name}}</td>

      							<td>&#36; {{$sales->price}}</td>

      							 <td>{{$sales->created_at}}</td>

      						</tr>

      						@endforeach
                  @foreach($allbeatssales as $beatsales)

                  <tr>

                    <td>{{$beatsales->id}}</td>

                    <td>{{$beatsales->payment_id}}</td>

                    <td>{{$beatsales->name}}</td>

                    <td>&#36; {{$beatsales->price}}</td>

                     <td>{{$beatsales->created_at}}</td>

                  </tr>

                  @endforeach

      					</tbody>

      				</table>

      			</div>

      		</div>

      	</div>

@stop