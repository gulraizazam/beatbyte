@extends('dashboard.layouts.default')

@section('content')



	<div class="container-fluid">

      <!-- Breadcrumbs-->

      	<div class="content-heading">

    		All Songs

    		<div class="sub-menu-wrapper hidden-sm hidden-xs">

		        <div class="sub-menu hidden-sm hidden-xs">

		            <div class="sub-menu__item active">

		                <a class="sub-menu__link" href="{{route('seller.allsongs')}}"><i class="fa fa-list"></i> All Songs</a>

		            </div>

		            

		            <div class="sub-menu__item ">

		                <a class="sub-menu__link" href="{{route('songs.uploadform')}}"><i class="fa fa-upload"></i> Upload</a>

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

	      		<h3 class="text-primary">All Songs</h3>

		        <div class="table-responsive">

		            <table class="table  table-bordered" id="dataTable" width="100%" cellspacing="0">

		              <thead>

		                <tr>

		                	<th></th>

		                  	<th></th>

		                </tr>

		              </thead>

		              

		              <tbody id="tablecontents">

		              	@foreach($allsong as $song)

		                <tr class="row1" data-id="{{ $song->id }}">
		                	

		                  <td class="p0">

    						<div class="media" style="padding: 8px">

        						<a href="song/{{$song->id}}/edit" class="pull-left">
        							@if($song->image )
        							<img class="artwork media-object img-responsive" src="/storage/app/{{$song->image}}" style="height: 100px;width: 100px">
        							@elseif($song->image == null)
            						<img class="artwork media-object img-responsive" src="{{asset('images/beat.jpg')}}" style="height: 100px;width: 100px">
            						@endif

        						</a>

        						<div class="media-body">

            						<div class="pull-right label bg-purple-light"><span class="badge badge-info">{{$song->generation_name}}</span></div>

        							<h4 class="media-heading name">

										<a href="{{route('song.edit',$song->id)}}">

											{{$song->name}}

										</a>

									</h4>

        							<p>

        								<span class="label label-info"><i class="fa fa-check"></i> MP3</span>

										

                						

        							</p>

        						</div>

    						</div>

    						<div class="row pricing-list">

       							<div class="col-sm-1"></div>

        						<div class="col-sm-2 text-center">

	            					<span>

										<span class="name">Price</span>

	            						<br>

	            						<span class="price">{{$song->song_price??'-'}}</span>

	            					</span>

        						</div>

        						<div class="col-sm-2 text-center">

	            					<span>

										<span class="name">Category</span>

	            						<br>

	            						<span class="price">{{$song->song_category}}</span>

	            					</span>

        						</div>

        						<div class="col-sm-2 text-center">

	            					<span>

										<span class="name">Linked</span>

	            						<br>

	           							 <span class="price">{{$song->song_beat??'-'}}</span>

	            					</span>

        						</div>

						       

        						<div class="col-sm-1"></div>

    						</div>

						</td>

		         		<td><a href="{{route('song.delete',$song->id)}}" class="btn btn-danger" style="color: white">Delete</a></td>

		                </tr>

		               @endforeach

		              </tbody>

		            </table>

		        </div>

	      	</div>

 	 	</div>

@stop
@section('scripts')
<script type="text/javascript" src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.4.1/jquery.min.js"></script>
<script src="https://ajax.googleapis.com/ajax/libs/jqueryui/1.10.3/jquery-ui.min.js"></script>

<script type="text/javascript">
	$(function () {
        
		
        $( "#tablecontents" ).sortable({
          items: "tr",
          cursor: 'move',
          opacity: 0.6,
          update: function() {
              sendOrderToServer();
          }
        });

        function sendOrderToServer() {
          var order = [];
          var token = $('meta[name="csrf-token"]').attr('content');
          $('tr.row1').each(function(index,element) {
            order.push({
              id: $(this).attr('data-id'),
              position: index+1
            });
          });

          $.ajax({
            type: "POST", 
            dataType: "json", 
            url: "{{ url('song-sortable') }}",
                data: {
              order: order,
              _token: token
            },
            success: function(response) {
                if (response.status == "success") {
                  console.log(response);
                } else {
                  console.log(response);
                }
            }
          });
        }
      });
    </script>
    <script>
    $(document).ready(function(){
      $(".search input[name='search']").on("keyup", function() {
        var value = $(this).val().toLowerCase();
        $(".table-songs tr").filter(function() {
          $(this).toggle($(this).text().toLowerCase().indexOf(value) > -1)
        });
      });
    });
</script>

@endsection