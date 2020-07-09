@extends('dashboard.layouts.default')

@section('content')
<style type="text/css">
.ajax-loader
{
  background: rgba( 255, 255, 255, 0.8 );
  top: 50%;
  position: fixed;
  left: 50%;
  z-index: 9999;
}

</style>
	<div class="container-fluid">

		<div class="content-heading">

    		Edit Packege

    		<div class="sub-menu-wrapper hidden-sm hidden-xs">

		        <div class="sub-menu hidden-sm hidden-xs">

		            <div class="sub-menu__item ">

		                <a class="sub-menu__link" href="#"><i class="fa fa-list"></i> All Packeges</a>

		            </div>

		           

		            <div class="sub-menu__item active">

		                <a class="sub-menu__link" href="{{route('packege.add')}}"><i class="fa fa-upload"></i> Add Packege</a>

		            </div>

		        </div>

    		</div>

		</div>

      	<hr>

      	<div class="container">

      		<div class="row">

				<div class="col-md-12" style="padding-bottom: 20px;border: 3px solid #cfdbe2;">
					<div class="ajax-loader" style="display: none;">
                      <img src="{{ asset('images/tenor.gif') }}" class="img-responsive" />
                    </div>
					<h3>Edit Packege</h3>

					<form action="{{route('packege.update',$editpkg->id)}}" method="POST" enctype="multipart/form-data" onsubmit="LoadForm()">

						@csrf

						

						<div class="row">

							<div class="form-group col-md-6">

					            <label for="exampleInputEmail1">Packege Name</label>

					            <input class="form-control" type="text" name="pkgname"  placeholder="File Name" value="{{$editpkg->packege_name}}">

					             @if ($errors->has('pkgname'))

				                    <p class=" text-danger" >{{ $errors->first('pkgname') }}</p>

				                 @endif

				          	</div>

				          	<div class="form-group col-md-6">

					            <label for="exampleInputEmail1">Packege Type</label>
					            	<select name="pkgcategory" id="pkgcategory" class="form-control" onchange="PackegeCategory()">
					            		<option value="paid" {{$editpkg->packege_price!=0 ? 'selected' : ''}}>Paid</option>
					            		<option value="free" {{$editpkg->packege_price ==0 ? 'selected' : ''}}>Free</option>
					            	</select>
					        </div>

				          	

				     	</div>



				     	<div class="row">

							<div class="form-group col-md-12" id="priceholder">

								<label>Price</label>

					           <input type="text" name="pkgprice" id="pkgprice" class="form-control" value="{{$editpkg->packege_price}}"> 
							</div>

				          	

				     	</div>
				     	<div class="row">
				     		<div class="col-md-12">

				     			<label>Packege Description</label>

				     			<textarea class="form-control" name="pkgdescription">{{$editpkg->packege_description}}</textarea>

				     		</div>
				     	</div>
				     	<button class="btn btn-primary" type="submit" style="float: right;margin-top: 10px;">Update Packege</button>

				    </div>

				     	

				     	

					</form>

				</div>

			</div>

		</div>

@stop
@section('scripts')
<script src="https://cdn.ckeditor.com/4.14.0/standard/ckeditor.js"></script>
<script type="text/javascript">
	function PackegeCategory() {
		if($('#pkgcategory').val()=='free'){
			$('#priceholder').css("display","none");
		}else{
			$('#priceholder').css("display","block");
		}
	}
	CKEDITOR.replace( 'pkgdescription' );
</script>
@stop
