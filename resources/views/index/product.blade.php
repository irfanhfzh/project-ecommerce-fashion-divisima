@extends('index.layout.template')
@section('title', $title)

@section('content')
	<!-- Page info -->
	<div class="page-top-info pb-1 pt-5">
		<div class="container">
			<div class="site-pagination">
				<a href="/" class="text-danger">Home</a> /
				<a href="/product">Product</a>
			</div>
			<hr class="my-50"/>
		</div>
	</div>
	<!-- Page info end -->

	<!-- Category section -->
	<section class="category-section">
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
				<div class="col-lg-3 order-2 order-lg-1">
					<div class="filter-widget">
						<h2 class="fw-title">Categories</h2>
						<ul class="category-menu">
							<li><a href="/product">All Categories</a></li>
							@foreach ($categories as $category)								
							<li class="{{ request()->category == $category->slug ? 'activeCategories' : '' }}"><a href="{{ route('product.index', ['category' => $category->slug]) }}">{{ $category->nama }}</a></li>
							@endforeach
						</ul>
					</div>
					<div class="filter-widget mb-0">
						<h2 class="fw-title">refine by</h2>
						<div class="price-range-wrap">
							<h4>Price</h4>
							<a href="{{ route('product.index', ['category' => request()->category, 'sort' => 'low_high']) }}" class="text-dark">Low to High</a>
							|
							<a href="{{ route('product.index', ['category' => request()->category, 'sort' => 'high_low']) }}" class="text-dark">High to Low</a>
                        </div>
					</div>
				</div>
				{{-- Product List --}}
				<div class="col-lg-9 order-1 order-lg-2 mb-5 mb-lg-0">	
					<div class="filter-widget">
						<h2 class="fw-title" style="margin-bottom: -65px;">{{ $categoryName }}</h2>				
					</div>
					<div class="row">
						@forelse ($product as $post_product)
						<div class="col-lg-4 col-sm-6">
							<div class="product-item">
								<div class="pi-pic">
									<a href="{{ url('/detail-product/'.$post_product->id.'/'.$post_product->slug) }}">			
										<img src="{{asset('images')}}/{{ $post_product->image1 }}" alt="">
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
										<h6>${{ number_format($post_product->price) }}</h6>
										<p>{{ $post_product->name }}</p>
									</div>
								</a>
							</div>
						</div>
						@empty
						<strong>No Products List, <a href="/admin/product">Go for Create</a></strong> 
						@endforelse
						<div class="text-center w-100 pt-3">
							{{ $product->appends(request()->input())->links() }}
						</div>						
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