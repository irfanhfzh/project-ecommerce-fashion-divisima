@extends('index.layout.template')
@section('title', $title)

@section('content')
	<!-- Page info -->
	<div class="page-top-info pb-1 pt-5">
		<div class="container">
			<div class="site-pagination">
				<a href="/" class="text-danger">Home</a> /
				<a href="/product" class="text-danger">Product</a> /
				<a href="">Order List</a>
			</div>
			<hr class="my-50"/>
		</div>
	</div>
	<!-- Page info end -->

	<!-- cart section end -->
	<section class="cart-section">
		<div class="container">
			@if (session()->has('success'))
			<div class="py-2">
				<div class="alert alert-success alert-block">
					<button type="button" class="close" data-dismiss="alert">×</button>
						<strong>{{ session()->get('success') }}</strong>
				</div>
			</div>
			@endif
			@if($errors->any())
			<div class="py-2">
				<div class="alert alert-danger alert-block">
					<button type="button" class="close" data-dismiss="alert">×</button>
						<strong>{{$errors->first()}}</strong>
				</div>
			</div>
			@endif
			<div class="row">
				<div class="col-lg-12">
					<div class="cart-table">
						<h3>Your Order List</h3>
							@forelse ($orders as $item)
							<div class="row bg-light border rounded" style="padding: 20px 0px; margin: 10px 5px;">					
								<div class="col-sm-2 pr-0">
									<a href="{{ url('/detail-product/'.$item->product->id.'/'.$item->product->slug) }}"><img src="{{asset('images')}}/{{ $item->product->image1 }}"></a>
								</div>
								<div class="col-sm-3 pr-0">
									<h6 style="margin-bottom: 15px">#Order {{ $item->product->code }}</h6>
									<h4 style="margin-bottom: 5px">{{ $item->product->name }}</h4>
									<p style="margin-bottom: 5px">${{ number_format($item->product->price) }}</p>
									<p style="margin-bottom: 5px">Qty : {{ $item->qty }}</p>
									<p style="margin-bottom: 5px" class="pr-2">Size : {{ $item->size }}</p>
									<p style="margin-bottom: 5px" class="pr-2">Variant : {{ $item->variant }}</p>
									<p class="pr-2">Notes : {{ $item->notes }}</p>
								</div>
								<div class="col-sm-3 pl-3">
									<h5 style="margin-bottom: 15px">Shipping address</h5>
									<p style="margin-bottom: 5px">{{ auth()->user()->full_name }}</p>
									<p>{{ $item->address }}{{ $item->profile_address }}</p>
								</div>
								<div class="col-sm-2 pr-0 pl-0">
									<p style="margin-bottom: 5px">Subtotal ${{ number_format($item->product->price) }}</p>
									<p>Qty : x{{ $item->qty }}</p>
									<hr>
									<h5 style="margin-bottom: 5px">Total ${{ number_format($item->total_price) }}</h5>
									<p>Payment : <span class="text-info">{{ $item->payment_method }}</span></p>
								</div>
								<div class="col-sm-2">
									<h6 class="mb-5">Status : <span class="text-info">{{ $item->status->status }}</span></h6>
									<h6><a class="text-info" data-toggle="collapse" href="#collapseExample{{ $item->order_id }}" role="button" aria-expanded="false" aria-controls="collapseExample{{ $item->order_id }}">Write Review</a></h6>
								</div>
								<div class="container my-3">
									<div class="row">	
										<div class="col-sm-12">
											<div class="collapse" id="collapseExample{{ $item->order_id }}">
											<form action="/add-rate" method="POST"> 
												@csrf
												<input type="hidden" name="id" value="{{old('id', $item->id)}}">	

												<div class="d-flex my-3 ml-2">
													<div class="rateyo" id= "rating"
													data-rateyo-rating="{{ $item->rating }}"
													data-rateyo-num-stars="5"
													data-rateyo-score="{{ $item->rating }}">
													</div>						
													<span class='result' style="margin-top: 10px">{{ $item->rating }}</span>
													<input type="hidden" name="rating">	
												</div>

												<div class="col-md-12">
													<textarea class="form-control" name="reviews" id="reviews" rows="3" placeholder="Reviews">{{ $item->reviews }}</textarea>
													<button class="btn btn-success btn-md mt-2 px-5" style="float: right;">Submit</button>		
												</div>									
											</form>
											</div>
										</div>									
									</div>										
								</div>
							</div>									
							@empty
							<div class="text-center">
								<strong>No Orders List, <a href="/product">Go for Shopping</a></strong> 
							</div>
							@endforelse	
							<div class="text-center py-2">
								{{ $orders->appends(request()->input())->links() }}
							</div>							
							<div class="total-cost pr-0">
							</div>
					</div>
				</div>
			</div>
		</div>
	</section>
	<!-- cart section end -->
	
	<!-- Related product section -->
	<section class="related-product-section spad">
		<div class="container">
			<div class="section-title text-uppercase">
				<h2>Continue Shopping</h2>
			</div>
			<div class="row">
				<?php $count = 0; ?>
				@forelse ($productGet as $post_product)		
				<?php if($count == 4) break; ?>
				<div class="col-lg-3 col-sm-6">
					<div class="product-item">
						<div class="pi-pic">
							<a href="{{ url('/detail-product/'.$post_product->id.'/'.$post_product->slug) }}">
								<img src="{{ asset('images') }}/{{ $post_product->image1 }}" alt="">
							</a>
							<div class="row">
								<div class="pi-links d-flex">
									<div class="px-1">
										<button class="atc"><a href="{{ url('/detail-product/'.$post_product->id.'/'.$post_product->slug) }}" class="add-card"><i class="flaticon-bag"></i><span>ADD TO CART</span></a></button>
									</div>
									<div class="px-1">
										<form action="/add-to-wishlist" method="POST">			
											@csrf	
											<input type="hidden" name="product_id" value="{{ $post_product->id }}">		
											<button class="atc"><a class="add-card"><i class="flaticon-heart"></i><span>ADD WISHLIST</span></a></button>
										</form>
									</div>
								</div>
							</div>
						</div>
						<a href="{{ url('/detail-product/'.$post_product->id.'/'.$post_product->slug) }}">
							<div class="pi-text">
								<h6>$ {{ number_format($post_product->price) }}</h6>
								<p>{{ $post_product->name }} </p>
							</div>
						</a>
					</div>
				</div>
				@empty
				<strong>No Products List, <a href="/admin/product">Go for Create</a></strong> 
				<?php $count++; ?>			
				@endforelse
			</div>
		</div>
	</section>
	<!-- Related product section end -->
@endsection
@push('scriptRating')
<script>
    $(function () {
        $(".rateyo").rateYo().on("rateyo.change", function (e, data) {
            var rating = data.rating;
            $(this).parent().find('.score').text('score :'+ $(this).attr('data-rateyo-score'));
            $(this).parent().find('.result').text('Rating : '+ rating);
            $(this).parent().find('input[name=rating]').val(rating); //add rating value to input field
        });
    });
	$( "div.alert" ).fadeIn( 300 ).delay( 3500 ).fadeOut( 400 );
</script>
@endpush