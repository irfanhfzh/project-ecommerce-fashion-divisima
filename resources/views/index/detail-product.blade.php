@extends('index.layout.template')
@section('title', $title)

@section('content')
	<!-- Page info -->
	@foreach ($data as $post_product)
	<div class="page-top-info pb-1 pt-5">
		<div class="container">
			<div class="site-pagination">
				<a href="/" class="text-danger">Home</a> /
				<a href="/product" class="text-danger">Product</a> /
				<a href="">{{ $post_product->name }}</a>
			</div>
			<hr class="my-50"/>
		</div>
	</div>
	<!-- Page info end -->

	<!-- product section -->
	<section>
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
				<div class="col-lg-6">
					<div class="product-pic-zoom">
						<img class="product-big-img" src="{{asset('images')}}/{{ $post_product->image1 }}" alt="">
					</div>
					<div class="product-thumbs" tabindex="1" style="overflow: hidden; outline: none;">
						<div class="product-thumbs-track">
							<div class="pt active" data-imgbigurl="{{asset('images')}}/{{ $post_product->image1 }}"><img src="{{asset('images')}}/{{ $post_product->image1 }}" alt=""></div>
							<div class="pt" data-imgbigurl="{{asset('images')}}/{{ $post_product->image2 }}"><img src="{{asset('images')}}/{{ $post_product->image2 }}" alt=""></div>
							<div class="pt" data-imgbigurl="{{asset('images')}}/{{ $post_product->image3 }}"><img src="{{asset('images')}}/{{ $post_product->image3 }}" alt=""></div>
							<div class="pt" data-imgbigurl="{{asset('images')}}/{{ $post_product->image4 }}"><img src="{{asset('images')}}/{{ $post_product->image4 }}" alt=""></div>
						</div>
					</div>
				</div>
				<div class="col-lg-6 product-details">					
					<h2 class="p-title">{{ $post_product->name }}</h2>
					<h3 class="p-price">${{ number_format($post_product->price) }}</h3>
					<h4 class="p-stock" style="font-size: 15px;">Available : {!! $stockLevel !!}</h4>
					<div class="p-rating">
						<div class="d-flex">
							<div class="rateyo" id= "rating"
							data-rateyo-rating="{{ $round }}"
							data-rateyo-num-stars="5"
							data-rateyo-score="{{ $round }}">
							</div>						
							<span class='result' style="margin-top: 10px;">{{ $round }}</span>
						</div>
					</div>
					<div class="p-review">				
					<a href="">{{ $getRatingCountUser }} reviews</a>|<a href="/list-order">Add your review</a>
					</div>					
					<form action="/add-to-cart" method="POST">
						@csrf	
						<div class="form-group">
							<label>Size</label>
							<select class="form-control" name="size" style="display: inline-block; width: 175px">
								<option value="">Select Size</option>
								@foreach (explode(", ", $post_product->size) as $key => $value)
									<option value="{{$value}}">{{$value}}</option>
								@endforeach		
							</select>
						</div>
						<div class="form-group">				
							<label>Variant</label>					
							<select class="form-control" name="variant" style="display: inline-block; width: 175px">
								<option value="">Select Variant</option>
								@foreach (explode(", ", $post_product->variant) as $key => $value)
									<option value="{{$value}}">{{$value}}</option>
								@endforeach				
							</select>
						</div>
						<input type="hidden" name="product_qty" value="{{ $post_product->product_qty }}">
						<div class="quantity">
							<p>Quantity</p>
							<div class="pro-qty">
								<input type="text" name="qty" value="1">
							</div>
						</div>										
							<input type="hidden" name="product_id" value="{{ $post_product->id }}">
							<button type="submit" name="submit" class="site-btn" value="addToCart">ADD TO CART</button>									
							<button type="submit" name="submit" class="site-btn" value="orderNow" style="margin-left: 15px;">SHOP NOW</button>
					</form>
					<div id="accordion" class="accordion-area">
						<div class="panel">
							<div class="panel-header" id="headingOne">
								<button class="panel-link active" data-toggle="collapse" data-target="#collapse1" aria-expanded="true" aria-controls="collapse1">information</button>
							</div>
							<div id="collapse1" class="collapse show" aria-labelledby="headingOne" data-parent="#accordion">
								<div class="panel-body">
									<p>{{ $post_product->description }}</p>
								</div>
							</div>
						</div>
						<div class="panel">
							<div class="panel-header" id="headingTwo">
								<button class="panel-link" data-toggle="collapse" data-target="#collapse2" aria-expanded="false" aria-controls="collapse2">care details </button>
							</div>
							<div id="collapse2" class="collapse" aria-labelledby="headingTwo" data-parent="#accordion">
								<div class="panel-body">
									<img src="{{asset('template-index')}}/img/cards.png" alt="">
									<p>Lorem ipsum dolor sit amet, consectetur adipiscing elit. Proin pharetra tempor so dales. Phasellus sagittis auctor gravida. Integer bibendum sodales arcu id te mpus. Ut consectetur lacus leo, non scelerisque nulla euismod nec.</p>
								</div>
							</div>
						</div>
						<div class="panel">
							<div class="panel-header" id="headingThree">
								<button class="panel-link" data-toggle="collapse" data-target="#collapse3" aria-expanded="false" aria-controls="collapse3">shipping & Returns</button>
							</div>
							<div id="collapse3" class="collapse" aria-labelledby="headingThree" data-parent="#accordion">
								<div class="panel-body">
									<h4>{{ $post_product->returns }} Days Returns</h4>
									<p>Cash on Delivery: <span>{{ $post_product->cash->cash }}</span> <br>Home Delivery <span>{{ $post_product->delivery }} days</span></p>
									<p>Lorem ipsum dolor sit amet, consectetur adipiscing elit. Proin pharetra tempor so dales. Phasellus sagittis auctor gravida. Integer bibendum sodales arcu id te mpus. Ut consectetur lacus leo, non scelerisque nulla euismod nec.</p>
								</div>
							</div>
						</div>
					</div>
					<div class="social-sharing">
						<a href=""><i class="fa fa-google-plus"></i></a>
						<a href=""><i class="fa fa-pinterest"></i></a>
						<a href=""><i class="fa fa-facebook"></i></a>
						<a href=""><i class="fa fa-twitter"></i></a>
						<a href=""><i class="fa fa-youtube"></i></a>
					</div>
				</div>
			</div>
		</div>
	</section>
	@endforeach
	<div class="container">
		<div class="row">		
			<div class="col-sm-12 my-5">
				<h4 class="p-title">Rating & Reviews</h4>
			</div>
			@forelse ($orderGet as $getOrder)	
			@if ($getOrder->rating == 0)
				{{-- Nothing In Here --}}
			@else				
			<div><p style="margin-top: 10px; margin-left: 15px;">{{ $getOrder->user->full_name }}</p></div>						
				<div class="rateyo" id= "rating"
				data-rateyo-rating="{{ $getOrder->rating }}"
				data-rateyo-num-stars="5"
				data-rateyo-score="{{ $getOrder->rating }}">
				</div>						
			<span class='result' style="margin-top: 10px;">{{ $getOrder->rating }}</span>
			<div class="col-md-12 mb-3">
				<textarea class="form-control" name="reviews" id="reviews" rows="4" placeholder="Reviews" readonly>{{ $getOrder->reviews }}</textarea>
			</div>									
			@endif
			@empty
			<strong>There are No Rating & Reviews</strong>
			@endforelse	
			<div class="col-md-12 text-center py-2">
				{{ $orderGet->appends(request()->input())->links() }}
			</div>	
		</div>										
	</div>
	<!-- product section end -->

	<!-- RELATED PRODUCTS section -->
	<section class="related-product-section spad">
		<div class="container">
			<div class="section-title">
				<h2>RELATED PRODUCTS</h2>
			</div>
			<div class="row">
				<?php $count = 0; ?>
				@foreach ($productGet as $post_product)	
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
				<?php $count++; ?>	
				@endforeach
			</div>
		</div>
	</section>
	<!-- RELATED PRODUCTS section end -->
@endsection
@push('scriptRating')
<script>
    $(function () {
        $(".rateyo").rateYo({readOnly: true})
            // var rating = data.rating;
            // $(this).parent().find('.score').text('score :'+ $(this).attr('data-rateyo-score'));
            // $(this).parent().find('.result').text('rating :'+ rating);
            // $(this).parent().find('input[name=rating]').val(rating); //add rating value to input field
    });
	$( "div.alert" ).fadeIn( 300 ).delay( 3500 ).fadeOut( 400 );
</script>
@endpush