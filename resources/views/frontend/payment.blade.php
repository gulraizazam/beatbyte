@extends('frontend.layouts.default_black')
@section('content')

<form action="#" method="post" name="frmTransaction" id="frmTransaction">
	@csrf
   <input type="hidden" name="business" value="">
   <input type="hidden" name="cmd" value="_xclick">
    <input type="hidden" name="item_name" value="">
   <input type="hidden" name="item_number" value="">
   <input type="hidden" name="amount" value="">   
   <input type="hidden" name="currency_code" value="USD">   
   <input type="hidden" name="cancel_return" value="http://demo.expertphp.in/payment-cancel">
   <input type="hidden" name="return" value="http://demo.expertphp.in/payment-status">
</form>
<script>document.frmTransaction.submit();</script>
@stop