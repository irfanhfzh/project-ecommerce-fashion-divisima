@extends('index.layout.template')
@section('title', $title)

@section('content')
	<!-- Page info -->
	<div class="page-top-info pb-1 pt-5">
		<div class="container">
			<div class="site-pagination">
				<a href="/" class="text-danger">Home</a> /
				<a href="/product" class="text-danger">Product</a> /
				<a href="" class="text-danger">Cart</a> /
				<a href="">Checkout</a> 
			</div>
			<hr class="my-50"/>
		</div>
	</div>
	<!-- Page info end -->

	<!-- checkout section  -->
	<section class="checkout-section">
		<div class="container">
			<div class="row">
				<div class="col-lg-8 order-2 order-lg-1">
					<form class="checkout-form" action="/checkout-success" method="POST">
						@csrf
						<input type="hidden" name="status_id" value="1">
						<div class="cf-title">Billing Address</div>
						<div class="row">
							<div class="col-md-7">
								<p>*Billing Information</p>
							</div>
							<div class="col-md-5">
								<?php $count = 0; ?>
								@foreach ($userAddress as $users)
								<?php if($count == 1) break; ?>	
								<label><Input class="radio" type = 'Radio' Name ='target' value= 'r1'><input type="hidden" name="profile_address" value="{{ $users->address }}" disabled> Use my regular address on Profile</label>	
								<?php $count++; ?>
								@endforeach
								<label><Input class="radio" type = 'Radio' checked Name ='target' value= 'r2'> Use a different address</label>
							</div>
						</div>
						<div class="row address-inputs">
							<div class="col-md-12">
								<input type="text" placeholder="Address" name="address[1]">
								<input type="text" placeholder="Address line 2" name="address[2]">
								<input type="text" placeholder="Country" name="address[3]">
							</div>
							<div class="col-md-6">
								<input type="text" placeholder="Zip code" name="address[4]">
							</div>
							<div class="col-md-6">
								<input type="text" placeholder="Phone no." name="address[5]">
							</div>
						</div>
						<div class="cf-title">Notes for Shop / Delivery</div>
						<div class="row shipping-btns">
							<div class="col-md-12">
								<textarea class="form-control" name="notes" id="notes" rows="5" placeholder="Notes"></textarea>
							</div>
						</div>
						<div class="cf-title">Payment</div>
						<ul class="payment-list">
							<li><input type="radio" name="payment_method" value="Paypal" id="one"> Paypal<a href="#"><img src="{{asset('template-index')}}/img/paypal.png" alt=""></a></li>
							<li><input type="radio" name="payment_method" value="Credit / Debit card" id="two"> Credit / Debit card<a href="#"><img src="{{asset('template-index')}}/img/mastercart.png" alt=""></a></li>
							<li><input type="radio" name="payment_method" value="Cash On Delivery" id="three" checked> Pay when you get the package</li>
						</ul>
						<button class="site-btn submit-order-btn mb-5">Place Order</button>
					</form>
				</div>
				<div class="col-lg-4 order-1 order-lg-2">
					<div class="checkout-cart">
						<h3>Your Cart</h3>					
						<ul class="product-list">
							@foreach ($products as $item)			
							<li>
								<div class="pl-thumb"><img src="{{asset('images')}}/{{ $item->image1 }}" alt=""></div>
								<h6>{{ $item->name }}</h6>
								<p>${{ number_format($item->price) }}</p>
								<p>Qty : {{ $item->order_qty }}</p>
								<p>Variant : {{ $item->variant }}</p>
								<p>Size : {{ $item->size }}</p>
							</li>
							@endforeach
						</ul>
						<ul class="price-list">
							<li>Shipping<span>free</span></li>
							<li class="total">Total<span style="margin-right: 55px;">${{ number_format($totals) }}</span></li>
						</ul>
					</div>
				</div>
			</div>
		</div>
	</section>
	<!-- checkout section end -->
@endsection
@push('scripts')
<script>
	$('.radio').click(function(e) {
        var val1 = $(this).val();
        var val2 = $(this).val();
		    if(val1=="r1") $('input[type="text"]').attr('disabled','disabled'); 
	    	else  $('input[type="text"]').removeAttr('disabled');
		    if(val2=="r2") $('input[type="hidden"]').attr('disabled','disabled'); 
	    	else  $('input[type="hidden"]').removeAttr('disabled');
    });
</script>
@endpush