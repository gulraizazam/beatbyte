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