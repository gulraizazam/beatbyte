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