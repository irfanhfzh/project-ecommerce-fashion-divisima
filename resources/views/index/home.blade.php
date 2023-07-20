@extends('index.layout.template')
@section('title', $title)

@section('content')
	<!-- Hero section -->
	<section class="hero-section">
		@if (session()->has('success'))
			<div class="alert alert-success alert-block mt-2" style="z-index: 999; position: fixed; margin-left: 485px;">
				<button type="button" class="close" data-dismiss="alert"> ×</button>
				<strong>{{ session()->get('success') }}</strong>
			</div>
		@endif
		@if($errors->any())
			<div class="alert alert-danger alert-block mt-2" style="z-index: 999; position: fixed; margin-left: 485px;">
				<button type="button" class="close" data-dismiss="alert"> ×</button>
				<strong>{{$errors->first()}}</strong>
			</div>
		@endif
		<div class="hero-slider owl-carousel">
			<div class="hs-item set-bg" data-setbg="{{asset('template-index')}}/img/bg.jpg">
				<div class="container">
					<div class="row">
						<div class="col-xl-6 col-lg-7 text-white">
							<span>New Arrivals</span>
							<h2>denim jackets</h2>
							<p>Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. Quis ipsum sus-pendisse ultrices gravida. Risus commodo viverra maecenas accumsan lacus vel facilisis. </p>
							<a href="#" class="site-btn sb-line">DISCOVER</a>
							<a href="#" class="site-btn sb-white">ADD TO CART</a>
						</div>
					</div>
					<div class="offer-card text-white">
						<span>from</span>
						<h2>$29</h2>
						<p>SHOP NOW</p>
					</div>
				</div>
			</div>
			<div class="hs-item set-bg" data-setbg="{{asset('template-index')}}/img/bg-2.jpg">
				<div class="container">
					<div class="row">
						<div class="col-xl-6 col-lg-7 text-white">
							<span>New Arrivals</span>
							<h2>denim jackets</h2>
							<p>Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. Quis ipsum sus-pendisse ultrices gravida. Risus commodo viverra maecenas accumsan lacus vel facilisis. </p>
							<a href="#" class="site-btn sb-line">DISCOVER</a>
							<a href="#" class="site-btn sb-white">ADD TO CART</a>
						</div>
					</div>
					<div class="offer-card text-white">
						<span>from</span>
						<h2>$29</h2>
						<p>SHOP NOW</p>
					</div>
				</div>
			</div>
		</div>
		<div class="container">
			<div class="slide-num-holder" id="snh-1"></div>
		</div>
	</section>
	<!-- Hero section end -->

	<!-- Features section -->
	<section class="features-section">
		<div class="container-fluid">
			<div class="row">
				<div class="col-md-4 p-0 feature">
					<div class="feature-inner">
						<div class="feature-icon">
							<img src="{{asset('template-index')}}/img/icons/1.png" alt="#">
						</div>
						<h2>Fast Secure Payments</h2>
					</div>
				</div>
				<div class="col-md-4 p-0 feature">
					<div class="feature-inner">
						<div class="feature-icon">
							<img src="{{asset('template-index')}}/img/icons/2.png" alt="#">
						</div>
						<h2>Premium Products</h2>
					</div>
				</div>
				<div class="col-md-4 p-0 feature">
					<div class="feature-inner">
						<div class="feature-icon">
							<img src="{{asset('template-index')}}/img/icons/3.png" alt="#">
						</div>
						<h2>Free & fast Delivery</h2>
					</div>
				</div>
			</div>
		</div>
	</section>
	<!-- Features section end -->

	<!-- letest product section -->
	<section class="top-letest-product-section">
		<div class="container">			
			<div class="section-title">
				<h2>LATEST PRODUCTS</h2>
			</div>
			<div class="product-slider owl-carousel">
				@forelse ($products as $post_product)					
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
					<a href="{{ url('/detail-product/'.$post_product->slug.'/'.$post_product->id) }}">
						<div class="pi-text">
							<h6>$ {{ number_format($post_product->price) }}</h6>
							<p>{{ $post_product->name }} </p>
						</div>
					</a>
				</div>
				@empty
				<strong>No Products List, <a href="/admin/product">Go for Create</a></strong> 
				@endforelse
			</div>
		</div>
	</section>
	<!-- letest product section end -->

	<!-- Product filter section -->
	<section class="product-filter-section">
		<div class="container">
			<div class="section-title">
				<h2  id="categoryProduct">BROWSE TOP SELLING PRODUCTS</h2>
			</div>
			<ul class="product-filter-menu mx-auto justify-content-center">
				<li><a href="{{ route('home.index') }}#categoryProduct">ALL</a></li>
				@foreach ($categories as $category)								
					<li><a href="{{ route('home.index', ['category' => $category->slug]) }}#categoryProduct">{{ $category->nama }}</a></li>
				@endforeach
			</ul>
			<div class="row">				
				@forelse ($product as $post_product)				
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
						<a href="{{ url('/detail-product/'.$post_product->slug.'/'.$post_product->id) }}">
							<div class="pi-text">
								<h6>$ {{ number_format($post_product->price) }}</h6>
								<p>{{ $post_product->name }} </p>
							</div>
						</a>
					</div>
				</div>
				@empty
				<strong>No Products List, <a href="/admin/product">Go for Create</a></strong> 
				@endforelse
			</div>
			<div class="text-center pt-5">
				<a class="site-btn sb-line sb-dark" href="/product">LOAD MORE</a>
			</div>
		</div>
	</section>
	<!-- Product filter section end -->

	<!-- Banner section -->
	<section class="banner-section">
		<div class="container">
			<div class="banner set-bg" data-setbg="{{asset('template-index')}}/img/banner-bg.jpg">
				<div class="tag-new">NEW</div>
				<span>New Arrivals</span>
				<h2>STRIPED SHIRTS</h2>
				<a href="#" class="site-btn">SHOP NOW</a>
			</div>
		</div>
	</section>
	<!-- Banner section end  -->
@endsection
@push('scriptRating')
<script>
	$( "div.alert" ).fadeIn( 300 ).delay( 3500 ).fadeOut( 400 );
</script>
@endpush