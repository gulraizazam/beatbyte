@extends('dashboard.layouts.default')

@section('content')
<style type="text/css">
	.sub-menu-wrapper {
    float: right;
    position: relative;
    top: -20px;
}
.vc-pricing--dashboard[data-v-ef8c3486] {
    font-size: 0.9rem;
    padding: 2.5em;
}
.vc-pricing[data-v-ef8c3486] {
    display: flex;
    align-items: center;
    justify-content: center;
    flex-direction: column;
    font-size: 0.9rem;
}
.vc-pricing--dashboard .vc-pricing__subscription[data-v-ef8c3486] {
    background: white;
    box-shadow: rgba(0, 0, 0, 0.13) 0px 7px 10px;
    text-align: center;
}
.vc-pricing__subscription[data-v-ef8c3486] {
    line-height: 1;
    max-width: 55em;
    width: 100%;
    padding: 2em;
    box-sizing: border-box;
    box-shadow: rgba(0, 0, 0, 0.4) 0px 13px 56px;
    background-color: #221f23;
    background-image: url(/img/site/shape-abstract-lines.svg);
    background-position-y: 64px;
    background-size: 100%;
    background-repeat: no-repeat;
}
.vc-pricing--dashboard .vc-pricing__subscription[data-v-ef8c3486] {
    background: white;
    box-shadow: rgba(0, 0, 0, 0.13) 0px 7px 10px;
    text-align: center;
}
.vc-pricing--dashboard[data-v-ef8c3486] {
    font-size: 0.9rem;
    padding: 2.5em;
}
.vc-pricing--dashboard .vc-pricing__subscription__plans__plan[data-v-ef8c3486] {
    color: #656565;
}
.vc-pricing__subscription__plans__toggle[data-v-ef8c3486] {
    margin: 0 0.6em;
}
.vue-js-switch[data-v-25adc6c0] {
    display: inline-block;
    position: relative;
    vertical-align: middle;
    user-select: none;
    font-size: 10px;
    cursor: pointer;
}
.vue-js-switch .v-switch-input[data-v-25adc6c0] {
    opacity: 0;
    position: absolute;
    width: 1px;
    height: 1px;
}
.v-switch-core{
	    width: 59px;
    height: 28px;
    background-color: rgb(237, 237, 237);
    border-radius: 14px;
}
.vue-js-switch .v-switch-core[data-v-25adc6c0] {
    display: block;
    position: relative;
    box-sizing: border-box;
    outline: 0;
    margin: 0;
    transition: border-color .3s,background-color .3s;
    user-select: none;
}
.v-switch-button{
	width: 22px;
    height: 22px;
    transition: transform 300ms ease 0s;
    transform: translate3d(3px, 3px, 0px);
    background: rgb(0, 211, 138);
}
.vue-js-switch .v-switch-core .v-switch-button[data-v-25adc6c0] {
    display: block;
    position: absolute;
    overflow: hidden;
    top: 0;
    left: 0;
    border-radius: 100%;
    background-color: #fff;
    z-index: 2;
}
.vc-pricing--dashboard .vc-pricing__subscription__plans__plan[data-v-ef8c3486] {
    color: #656565;
}
.vc-pricing--dashboard .vc-pricing__subscription__summary[data-v-ef8c3486] {
    position: relative;
}
.vc-pricing--dashboard .vc-pricing__subscription__title[data-v-ef8c3486] {
    font-size: 1.6em;
    color: #656565;
    margin: 1em 0 0.05em 0;
}
.vc-pricing--dashboard .vc-pricing__subscription__price[data-v-ef8c3486] {
    font-size: 2em;
    color: #8f40b0;
}
.vc-pricing--dashboard .vc-pricing__subscription__price-subtitle[data-v-ef8c3486] {
    font-size: 1.7em;
    margin-top: 0.3em;
}
.vc-pricing--dashboard .vc-pricing__subscription__title[data-v-ef8c3486], .vc-pricing--dashboard .vc-pricing__subscription__price[data-v-ef8c3486], .vc-pricing--dashboard .vc-pricing__subscription__price-subtitle[data-v-ef8c3486], .vc-pricing--dashboard .vc-pricing__subscription__saving[data-v-ef8c3486] {
    text-align: left;
}
.vc-pricing__subscription__saving[data-v-ef8c3486] {
    font-size: 2.4em;
    color: #00d38a;
    margin-top: 0.4em;
}
.vc-pricing--dashboard .vc-pricing__subscription__types[data-v-ef8c3486] {
    
    margin: 2.4em 0;
    font-weight: 600;
}
.vc-pricing__subscription__types[data-v-ef8c3486] {
    display: flex;
    justify-content: center;
    margin: 3.2em 0;
}
.vc-pricing--dashboard .vc-pricing__subscription__types__type--active[data-v-ef8c3486] {
    color: white;
    background: #8f40b0;
}
.vc-pricing--dashboard .vc-pricing__subscription__types__type[data-v-ef8c3486] {
    font-size: 1.6em;
    color: #656565;
    padding: 0.8em 2.2em;
    background: #ededed;
}
.vc-pricing__subscription__types__type[data-v-ef8c3486]:first-child {
    border-top-left-radius: 5px;
    border-bottom-left-radius: 5px;
}
.vc-pricing--dashboard .vc-pricing__subscription__types__type[data-v-ef8c3486] {
    font-size: 1.6em;
    color: #656565;
    padding: 0.8em 2.2em;
    background: #ededed;
}
.vc-pricing__subscription__features[data-v-ef8c3486] {
    text-align: left;
    font-size: 1.0em;
}
.vc-pricing__subscription__features__feature__icon[data-v-ef8c3486] {
    width: 1.7em;
    margin-right: 0.6em;
    text-align: center;
    color: #bf34e6;
}
.vc-pricing__subscription__features__feature + .vc-pricing__subscription__features__feature[data-v-ef8c3486] {
    margin-top: 0.5em;
}
.vc-pricing__subscription__features__feature__icon[data-v-ef8c3486] {
    width: 1.7em;
    margin-right: 0.6em;
    text-align: center;
    color: #bf34e6;
}
.vc-pricing__subscription__features__feature--active[data-v-ef8c3486] {
    color: #bf34e6;
}
.vc-pricing__subscription__features__feature__link[data-v-ef8c3486], .vc-pricing__subscription__features__feature__link[data-v-ef8c3486]:visited, .vc-pricing__subscription__features__feature__link[data-v-ef8c3486]:hover, .vc-pricing__subscription__features__feature__link[data-v-ef8c3486]:active {
    color: inherit;
    text-decoration: none;
}
.vc-pricing--dashboard .vc-pricing__subscription__submit[data-v-ef8c3486] {
    font-weight: 600;
    padding: 0.4em 2.5em;
}
.vc-pricing__subscription__submit[data-v-ef8c3486] {
    margin: 1.5em 0 0 0;
    font-size: 1.7em;
    padding: 0.3em 2.5em;
}
.btn-purple {
    color: #fff;
    background-color: #8f40b0;
    border-color: transparent;
}
</style>
<div class="container-fluid">
	<div class="content-heading">Subscription
		<div class="sub-menu-wrapper hidden-sm hidden-xs"></div>
	</div>
	
	<div class="sub-menu-wrapper visible-sm visible-xs"></div>
		<div class="row">
			<div class="col-xs-12"></div>
		</div>
		<div class="row">
			<div id="subscription-packages">
				<div class="col-md-12">
					<div data-v-ef8c3486="" class="vc-pricing vc-pricing--dashboard">
					@foreach($getpackege as $packege)
					<div data-v-ef8c3486="" class="vc-pricing__subscription" style="width: 600px;margin-left: 200px">
						
						<div data-v-ef8c3486="" class="vc-pricing__subscription__summary">
							<div data-v-ef8c3486="" class="vc-pricing__subscription__title"><h3 class="text-center">{{$packege->packege_name}}</h3>
							</div> 
                            <div class="row">
                                <div class="col-md-6">
                                    <div data-v-ef8c3486="" class="vc-pricing__subscription__price"><input type="checkbox" name="monthlyprice" value="{{$packege->packege_price}}" onclick="GetPrice()" id="monthly"><h4 class="text-center">&#36; {{$packege->packege_price}} per month</h4>
                                </div> 
                             </div>
                             <div class="col-md-6">
                                 <div data-v-ef8c3486="" class="vc-pricing__subscription__price"><input type="checkbox" name="yearlyprice" value="90"  onclick="GetPrice()" id="yearly"><h4 class="text-center">&#36; 90 per Year</h4>
                            </div>
                             </div>
                            </div>
						</div> 
						<div data-v-ef8c3486="" class="vc-pricing__subscription__saving"></div> 
						
						<div data-v-ef8c3486="" class="vc-pricing__subscription__features">
							<div data-v-ef8c3486="" class="vc-pricing__subscription__features__feature">
								<img data-v-ef8c3486="" src="https://app.airbit.com/img/shared/pricing/icons/upload.svg" alt="" class="vc-pricing__subscription__features__feature__icon">Upload Unlimited Beats</div>
								<div data-v-ef8c3486="" class="vc-pricing__subscription__features__feature vc-pricing__subscription__features__feature--disabled">
									<img data-v-ef8c3486="" src="https://app.airbit.com/img/shared/pricing/icons/dollar-sign.svg" alt="" class="vc-pricing__subscription__features__feature__icon"> $100 of Free Promo Credit</div>
									<div data-v-ef8c3486="" class="vc-pricing__subscription__features__feature vc-pricing__subscription__features__feature--active">
										<img data-v-ef8c3486="" src="https://app.airbit.com/img/shared/pricing/icons/infinity.svg" alt="" class="vc-pricing__subscription__features__feature__icon"> 
										<a data-v-ef8c3486="" href="#" target="_blank" class="vc-pricing__subscription__features__feature__link">Infinity Store</a>
									</div>
									<div data-v-ef8c3486="" class="vc-pricing__subscription__features__feature vc-pricing__subscription__features__feature--active">
										<img data-v-ef8c3486="" src="https://app.airbit.com/img/shared/pricing/icons/star.svg" alt="" class="vc-pricing__subscription__features__feature__icon"> 
										<a data-v-ef8c3486="" href="#" target="_blank" class="vc-pricing__subscription__features__feature__link">Platinum Rewards</a>
									</div>
									<div data-v-ef8c3486="" class="vc-pricing__subscription__features__feature">
										<img data-v-ef8c3486="" src="https://app.airbit.com/img/shared/pricing/icons/layer-group.svg" alt="" class="vc-pricing__subscription__features__feature__icon"> Create Playlists, Beat Tapes &amp; Albums</div>
										<div data-v-ef8c3486="" class="vc-pricing__subscription__features__feature">
											<img data-v-ef8c3486="" src="https://app.airbit.com/img/shared/pricing/icons/microphone.svg" alt="" class="vc-pricing__subscription__features__feature__icon"> Sell Songs
										</div>
										<div data-v-ef8c3486="" class="vc-pricing__subscription__features__feature">
											<img data-v-ef8c3486="" src="https://app.airbit.com/img/shared/pricing/icons/music.svg" alt="" class="vc-pricing__subscription__features__feature__icon"> Sell Sound Kits</div>
											<div data-v-ef8c3486="" class="vc-pricing__subscription__features__feature">
												<img data-v-ef8c3486="" src="https://app.airbit.com/img/shared/pricing/icons/dollar-sign.svg" alt="" class="vc-pricing__subscription__features__feature__icon"> 0% Commission On Your Beat Store</div>
												<div data-v-ef8c3486="" class="vc-pricing__subscription__features__feature">
													<img data-v-ef8c3486="" src="https://app.airbit.com/img/shared/pricing/icons/paypal.svg" alt="" class="vc-pricing__subscription__features__feature__icon"> Accept PayPal and Credit Cards</div>
													<div data-v-ef8c3486="" class="vc-pricing__subscription__features__feature">
														<img data-v-ef8c3486="" src="https://app.airbit.com/img/shared/pricing/icons/user-friends.svg" alt="" class="vc-pricing__subscription__features__feature__icon"> </div>
														<div data-v-ef8c3486="" class="vc-pricing__subscription__features__feature">
															<img data-v-ef8c3486="" src="https://app.airbit.com/img/shared/pricing/icons/file-contract.svg" alt="" class="vc-pricing__subscription__features__feature__icon"> Custom Licenses &amp; e-Signed Contracts</div>
															<div data-v-ef8c3486="" class="vc-pricing__subscription__features__feature">
																<img data-v-ef8c3486="" src="https://app.airbit.com/img/shared/pricing/icons/badge-percent.svg" alt="" class="vc-pricing__subscription__features__feature__icon"> 
																Discounts &amp; Coupons
															</div>
															<div data-v-ef8c3486="" class="vc-pricing__subscription__features__feature">
																<img data-v-ef8c3486="" src="https://app.airbit.com/img/shared/pricing/icons/analytics.svg" alt="" class="vc-pricing__subscription__features__feature__icon"> Google Analytics / Facebook Pixel Integration
															</div>
															<div data-v-ef8c3486="" class="vc-pricing__subscription__features__feature">
																<img data-v-ef8c3486="" src="https://app.airbit.com/img/shared/pricing/icons/comments-alt-dollar.svg" alt="" class="vc-pricing__subscription__features__feature__icon">Accept Offers
															</div>
															<div data-v-ef8c3486="" class="vc-pricing__subscription__features__feature">
																<img data-v-ef8c3486="" src="https://app.airbit.com/img/shared/pricing/icons/clock.svg" alt="" class="vc-pricing__subscription__features__feature__icon"> Scheduled Releases
															</div>
															<div data-v-ef8c3486="" class="vc-pricing__subscription__features__feature">
																<img data-v-ef8c3486="" src="https://app.airbit.com/img/shared/pricing/icons/share-alt.svg" alt="" class="vc-pricing__subscription__features__feature__icon">Social Unlock Free Downloads
															</div>
														</div> 
                                                        <form method="post" action="{{url('upgrade',$packege->id)}}">
                                                            @csrf
                                                            <input type="hidden" name="packege_name" value="{{$packege->packege_name}}">
                                                            <input type="hidden" name="packege_id" value="{{$packege->id}}">
                                                            <input type="hidden" name="packegeprice" id="pkgprice">
                                                            <button type="submit" class="btn btn-primary">Subscribe</button>
                                                        </form>
														
													</div> <!----> 
													
													@endforeach
												</div>
				</div> 
				

			</div>
		</div>
</div>

@stop

@section('scripts')
    <script type="text/javascript">
        function GetPrice()
        {
            if($('#monthly').is(":checked")){
                $('#pkgprice').val($('#monthly').val());
            }else
           
            $('#pkgprice').val($('#yearly').val());
        }
    </script>
@stop