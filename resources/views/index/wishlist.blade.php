@extends('index.layout.template')
@section('title', $title)

@section('content')
	<!-- Page info -->
	<div class="page-top-info pb-1 pt-5">
		<div class="container">
			<div class="site-pagination">
				<a href="/" class="text-danger">Home</a> /
				<a href="/product" class="text-danger">Product</a> /
				<a href="">Your Wishlist</a> 
			</div>
			<hr class="my-50"/>
		</div>
	</div>
	<!-- Page info end -->

	<!-- Category section -->
	<section class="category-section">
		<div class="container">
			<h3 class="mb-5">Your Wishlist</h3>
			@if (session()->has('delete'))
			<div class="py-2">
				<div class="alert alert-danger alert-block">
					<button type="button" class="close" data-dismiss="alert">×</button>
						<strong>{{ session()->get('delete') }}</strong>
				</div>
			</div>
			@endif
			<div class="row">
				{{-- Product List --}}
				<div class="col-lg-12 order-1 order-lg-2 mb-5 mb-lg-0">
					<div class="row">
						@forelse ($wishlists as $post_product)
						<div class="col-lg-3 col-sm-6">
							<div class="product-item">
								<div class="pi-pic">
									<a href="{{ url('/detail-product/'.$post_product->product->id.'/'.$post_product->product->slug) }}">			
										<img src="{{asset('images')}}/{{ $post_product->product->image1 }}" alt="">
									</a>
									<div class="row">
										<div class="pi-links d-flex">
											<div class="px-1">
												<button class="atc"><a href="{{ url('/detail-product/'.$post_product->id.'/'.$post_product->slug) }}" class="add-card"><i class="flaticon-bag"></i><span>ADD TO CART</span></a></button>
											</div>
											<div class="px-1">
												<button class="atc"><a href="{{url('/delete-product-wishlist/delete/'.$post_product->wish_id)}}" class="add-card"><i class="far fa-trash-alt"></i><span class="ml-5">DELETE LIST</span></a></button>
											</div>
										</div>
									</div>
								</div>
								<a href="{{ url('/detail-product/'.$post_product->product->id.'/'.$post_product->product->slug) }}">
									<div class="pi-text">
										<h6>${{ number_format($post_product->product->price) }}</h6>
										<p>{{ $post_product->product->name }}</p>
									</div>
								</a>
							</div>
						</div>
						@empty
						<strong class="text-center">You nothing have Wishlist Products</strong> 
						@endforelse					
					</div>
				</div>
			</div>
		</div>
	</section>
	<!-- Category section end -->
@endsection
@push('scriptRating')
<script>
	$( "div.alert" ).fadeIn( 300 ).delay( 3500 ).fadeOut( 400 );
</script>
@endpush