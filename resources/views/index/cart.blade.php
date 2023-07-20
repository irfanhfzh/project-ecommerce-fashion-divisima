@extends('index.layout.template')
@section('title', $title)

@section('content')
	<!-- Page info -->
	<div class="page-top-info pb-1 pt-5">
		<div class="container">
			<div class="site-pagination">
				<a href="/" class="text-danger">Home</a> /
				<a href="">Shopping Cart</a>
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
				<div class="col-lg-9">
					<div class="cart-table">
						<h3>Your Cart</h3>
						<div class="cart-table-warp">
						<table>
							<thead>
								<tr>
									<th class="product-th">Product</th>
									<th class="quy-th pr-0">Quantity</th>
									<th class="size-th pr-2">Size</th>
									<th class="total-th">Action</th>
								</tr>
							</thead>
							<tbody>
								@forelse ($products as $item)									
								<tr>
									<td class="product-col">
										<img src="{{asset('images')}}/{{ $item->image1 }}" alt="">
										<div class="pc-title">
											<h4>{{ $item->name }}</h4>
											<p>${{ number_format($item->price) }}</p>
											<p>Variant : {{ $item->cart_variant }}</p>
										</div>
									</td>
									<td class="quy-col p-0" style="text-align: center;">
										<h6 style="font-weight: 400;">Qty {{ $item->cart_qty }}</h6>
									</td>
									<td class="size-col"><h4 class="pr-2">Size {{ $item->cart_size }}</h4></td>
									<td class="total-col">
										<a class="btn btn-primary btn-sm" data-toggle="collapse" href="#collapseExample{{ $item->cart_id }}" role="button" aria-expanded="false" aria-controls="collapseExample{{ $item->cart_id }}"><i class="fas fa-edit"></i> Edit</a>
										<a href="{{url('/delete-product-cart/delete/'.$item->cart_id)}}" class="btn btn-danger btn-sm"><i class="fas fa-trash-alt"></i> Delete</a>
									</td>
								</tr>
								<tr>
									<td colspan="6" class="text-center">
										@if($errors->any())
											<span class="text-danger">{{$errors->first()}}</span>
										@endif
									</td>
								</tr>
								<tr>																	
									<td colspan="6" class="text-center">
										<form action="{{ url('/edit-to-cart') }}" method="POST">
											@csrf
											<div class="collapse" id="collapseExample{{ $item->cart_id }}">
											<input type="hidden" name="cart_id" value="{{ $item->cart_id }}">											
											<div class="card card-body mb-5">
												<div class="row">
													<div class="col-sm-3" style="margin-right: 35px;">
														<div class="form-group">				
															<label>Variant</label>					
															<select class="form-control" name="variantEdit" style="display: inline-block; width: 175px">
																<option holder>Choose Variant</option>
																@foreach (explode(", ", $item->variant) as $key => $value)
																	<option value="{{$value}}"  {{$item->cart_variant == $value ? 'selected' : ''}}>{{$value}}</option>
																@endforeach				
															</select>
														</div>
													</div>
													<input type="hidden" name="product_qty" value="{{ $item->product_qty }}">
													<div class="col-sm-3" style="margin-right: -55px;">
														<div class="quantity" style="display: block; float: left;">
															<label>Quantity</label>					
															<div class="qty">
																<div class="pro-qty">
																	<input type="text" name="qtyEdit" value="{{ $item->cart_qty }}">
																</div>
															</div>
														</div>
													</div>
													<div class="col-sm-3">
														<div class="form-group">
															<label>Size</label>
															<select class="form-control" name="sizeEdit" style="display: inline-block; width: 175px">
																<option holder>Choose Size</option>
																@foreach (explode(", ", $item->size) as $key => $value)
																	<option value="{{$value}}"  {{$item->cart_size == $value? 'selected' : ''}}>{{$value}}</option>
																@endforeach		
															</select>
														</div>
													</div>
													<div class="col-sm-3">
														<button class="btn btn-success btn-md ml-4 px-5" style="margin-top: 32px;">Submit</button>
													</div>
												</div>							
											</div>
											</div>
										</form>
									</td>
									@empty
									<td colspan="6" class="text-center"><strong>No Orders List, <a href="/product">Go for Shopping</a></strong> </td>								
								</tr>
								@endforelse
							</tbody>
						</table>
						</div>
						<div class="text-center py-2">
							{{ $products->appends(request()->input())->links() }}
						</div>
						<div class="total-cost">
							<h6>Total <span>${{ number_format($totals) }}</span></h6>
						</div>
					</div>
				</div>
				<div class="col-lg-3 card-right">
					<form class="promo-code-form">
						<input type="text" placeholder="Enter promo code">
						<button>Submit</button>
					</form>
					<a href="/checkout" class="site-btn">Proceed to checkout</a>
					<a href="/product" class="site-btn sb-dark">Continue shopping</a>
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
	$( "div.alert" ).fadeIn( 300 ).delay( 3500 ).fadeOut( 400 );
</script>
@endpush