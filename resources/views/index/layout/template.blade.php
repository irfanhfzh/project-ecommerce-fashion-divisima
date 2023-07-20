<?php
use App\Http\Controllers\index\DetailProductController;
$total = DetailProductController::cartItem();
?>

<!DOCTYPE html>
<html lang="zxx">
<head>
	<title>@yield('title') - Divisima | eCommerce Template</title>
	<meta charset="UTF-8">
	<meta name="description" content=" Divisima | eCommerce Template">
	<meta name="keywords" content="divisima, eCommerce, creative, html">
	<meta name="viewport" content="width=device-width, initial-scale=1.0">
	<!-- Font Awesome -->
	<link rel="stylesheet" href="{{asset('template-admin')}}/plugins/fontawesome-free/css/all.min.css">
	<!-- Favicon -->
	<link href="{{asset('template-index')}}/img/favicon.ico" rel="shortcut icon"/>

	<!-- Google Font -->
	<link href="https://fonts.googleapis.com/css?family=Josefin+Sans:300,300i,400,400i,700,700i" rel="stylesheet">

	<!-- Stylesheets -->
	<link rel="stylesheet" href="{{asset('template-index')}}/css/bootstrap.min.css"/>
	<link rel="stylesheet" href="{{asset('template-index')}}/css/font-awesome.min.css"/>
	<link rel="stylesheet" href="{{asset('template-index')}}/css/flaticon.css"/>
	<link rel="stylesheet" href="{{asset('template-index')}}/css/slicknav.min.css"/>
	<link rel="stylesheet" href="{{asset('template-index')}}/css/jquery-ui.min.css"/>
	<link rel="stylesheet" href="{{asset('template-index')}}/css/owl.carousel.min.css"/>
	<link rel="stylesheet" href="{{asset('template-index')}}/css/owl.carousel.min.css"/>
	<link rel="stylesheet" href="{{asset('template-index')}}/css/style.css"/>

	{{-- Custom Css --}}
	<link rel="stylesheet" href="{{ asset('css') }}/style.css">
	{{-- <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.4.0/css/bootstrap.min.css" integrity="sha384-SI27wrMjH3ZZ89r4o+fGIJtnzkAnFs3E4qz9DIYioCQ5l9Rd/7UAa8DHcaL8jkWt" crossorigin="anonymous"> --}}
	<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/rateYo/2.3.2/jquery.rateyo.min.css">

	<!-- Latest compiled and minified CSS -->
	<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/rateYo/2.3.2/jquery.rateyo.min.css">
	<!-- Latest compiled and minified JavaScript -->
	<script src="https://cdnjs.cloudflare.com/ajax/libs/rateYo/2.3.2/jquery.rateyo.min.js"></script>
</head>
<body>
	<!-- Page Preloder -->
	<div id="preloder">
		<div class="loader"></div>
	</div>

	<!-- Header section -->
	<header class="header-section">
		<div class="header-top">
			<div class="container">
				<div class="row">
					<div class="col-lg-2 text-center text-lg-left">
						<!-- logo -->
						<a href="/" class="site-logo">
							<img src="{{asset('template-index')}}/img/logo.png" alt="">
						</a>
					</div>
					<div class="col-xl-6 col-lg-6">
						<form class="header-search-form">
							<input type="text" placeholder="Search on divisima . . . .">
							<button><i class="flaticon-search"></i></button>
						</form>
					</div>
					<div class="col-xl-4 col-lg-6 text-center text-lg-right mr-0">
						<div class="user-panel">
							<div class="up-item">
								@guest									
								<div class="shopping-card">
									<i class="flaticon-bag"></i>
									<span>0</span>
								</div>
								@endguest
								@auth									
								<div class="shopping-card">
									<i class="flaticon-bag"></i>
									<span>{{$total}}</span>
								</div>
								@endauth
								<a href="/cart">Shopping Cart</a>
							</div>
							<div class="up-item">
								@guest														
								<i class="flaticon-profile"></i>
								<a href="{{route('login')}}">Sign</a> In | <a href="{{route('user.register')}}">Create Account</a>
								@endguest
								@auth							
								<ul class="main-menu">
									<li><i class="flaticon-profile"></i><a class="mr-0" href="#">Welcome, {{auth()->user()->full_name}}</a>
										<ul class="sub-menu" style="padding: 0; width: 170px;">
											<li><a href="#">Profile</a></li>
											<li><a href="{{ url('/wish-list') }}">Your Wishlist</a></li>
											<li><a href="{{url('/list-order')}}">Your Order List</a></li>
											<li><a href="{{route('user.logout')}}">Logout</a></li>
										</ul>
									</li>
								</ul>						
								@endauth
							</div>
						</div>
					</div>
				</div>
			</div>
		</div>
		<nav class="main-navbar">
			<div class="container">
				<!-- menu -->
				<ul class="main-menu">
					<li><a href="/">Home</a></li>
					<li><a href="/product">Product</a>	
						<ul class="sub-menu">
							@foreach ($categories as $category)								
							<li><a href="{{ route('product.index', ['category' => $category->slug]) }}#categoryProduct">{{ $category->nama }}</a></li>
							@endforeach		
						</ul>
					</li>
					<li><a href="#">Pages</a>
						<ul class="sub-menu">
							<li><a href="/product">Product Page</a></li>
							<li><a href="/cart">Cart Page</a></li>
							<li><a href="/checkout">Checkout Page</a></li>
							<li><a href="/contact">Contact Page</a></li>
						</ul>
					</li>
					<li><a href="#">Blog</a></li>
					<li><a href="/contact">Contact</a></li>
				</ul>
			</div>
		</nav>
	</header>
	<!-- Header section end -->

	<!-- Section Content Start -->
	@yield('content');
	<!-- Section Content End -->

	<!-- Footer section -->
	<section class="footer-section">
		<div class="container">
			<div class="footer-logo text-center">
				<a href="index.html"><img src="{{asset('template-index')}}/img/logo-light.png" alt=""></a>
			</div>
			<div class="row">
				<div class="col-lg-3 col-sm-6">
					<div class="footer-widget about-widget">
						<h2>About</h2>
						<p>Donec vitae purus nunc. Morbi faucibus erat sit amet congue mattis. Nullam frin-gilla faucibus urna, id dapibus erat iaculis ut. Integer ac sem.</p>
						<img src="{{asset('template-index')}}/img/cards.png" alt="">
					</div>
				</div>
				<div class="col-lg-3 col-sm-6">
					<div class="footer-widget about-widget">
						<h2>Questions</h2>
						<ul>
							<li><a href="">About Us</a></li>
							<li><a href="">Track Orders</a></li>
							<li><a href="">Returns</a></li>
							<li><a href="">Jobs</a></li>
							<li><a href="">Shipping</a></li>
							<li><a href="">Blog</a></li>
						</ul>
						<ul>
							<li><a href="">Partners</a></li>
							<li><a href="">Bloggers</a></li>
							<li><a href="">Support</a></li>
							<li><a href="">Terms of Use</a></li>
							<li><a href="">Press</a></li>
						</ul>
					</div>
				</div>
				<div class="col-lg-3 col-sm-6">
					<div class="footer-widget about-widget">
						<h2>Questions</h2>
						<div class="fw-latest-post-widget">
							<div class="lp-item">
								<div class="lp-thumb set-bg" data-setbg="{{asset('template-index')}}/img/blog-thumbs/1.jpg"></div>
								<div class="lp-content">
									<h6>what shoes to wear</h6>
									<span>Oct 21, 2018</span>
									<a href="#" class="readmore">Read More</a>
								</div>
							</div>
							<div class="lp-item">
								<div class="lp-thumb set-bg" data-setbg="{{asset('template-index')}}/img/blog-thumbs/2.jpg"></div>
								<div class="lp-content">
									<h6>trends this year</h6>
									<span>Oct 21, 2018</span>
									<a href="#" class="readmore">Read More</a>
								</div>
							</div>
						</div>
					</div>
				</div>
				<div class="col-lg-3 col-sm-6">
					<div class="footer-widget contact-widget">
						<h2>Questions</h2>
						<div class="con-info">
							<span>C.</span>
							<p>Your Company Ltd </p>
						</div>
						<div class="con-info">
							<span>B.</span>
							<p>1481 Creekside Lane  Avila Beach, CA 93424, P.O. BOX 68 </p>
						</div>
						<div class="con-info">
							<span>T.</span>
							<p>+53 345 7953 32453</p>
						</div>
						<div class="con-info">
							<span>E.</span>
							<p>office@youremail.com</p>
						</div>
					</div>
				</div>
			</div>
		</div>
		<div class="social-links-warp">
			<div class="container">
				<div class="social-links">
					<a href="" class="instagram"><i class="fa fa-instagram"></i><span>instagram</span></a>
					<a href="" class="google-plus"><i class="fa fa-google-plus"></i><span>g+plus</span></a>
					<a href="" class="pinterest"><i class="fa fa-pinterest"></i><span>pinterest</span></a>
					<a href="" class="facebook"><i class="fa fa-facebook"></i><span>facebook</span></a>
					<a href="" class="twitter"><i class="fa fa-twitter"></i><span>twitter</span></a>
					<a href="" class="youtube"><i class="fa fa-youtube"></i><span>youtube</span></a>
					<a href="" class="tumblr"><i class="fa fa-tumblr-square"></i><span>tumblr</span></a>
				</div>

				<!-- Link back to Colorlib can't be removed. Template is licensed under CC BY 3.0. --> 
				<p class="text-white text-center mt-5">Copyright &copy;<script>document.write(new Date().getFullYear());</script> All rights reserved | This template is made with <i class="fa fa-heart-o" aria-hidden="true"></i> by <a href="https://colorlib.com" target="_blank">Colorlib</a></p>
				<!-- Link back to Colorlib can't be removed. Template is licensed under CC BY 3.0. -->

			</div>
		</div>
	</section>
	<!-- Footer section end -->

	<!--====== Javascripts & Jquery ======-->
	<script src="{{asset('template-index')}}/js/jquery-3.2.1.min.js"></script>
	<script src="{{asset('template-index')}}/js/bootstrap.min.js"></script>
	<script src="{{asset('template-index')}}/js/jquery.slicknav.min.js"></script>
	<script src="{{asset('template-index')}}/js/owl.carousel.min.js"></script>
	<script src="{{asset('template-index')}}/js/jquery.nicescroll.min.js"></script>
	<script src="{{asset('template-index')}}/js/jquery.zoom.min.js"></script>
	<script src="{{asset('template-index')}}/js/jquery-ui.min.js"></script>
	<script src="{{asset('template-index')}}/js/main.js"></script>
	{{-- <script src="https://ajax.googleapis.com/ajax/libs/jquery/2.1.1/jquery.min.js"></script>
	<script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script> --}}
	<script src="https://cdnjs.cloudflare.com/ajax/libs/rateYo/2.3.2/jquery.rateyo.min.js"></script>
	{{-- Custom Scripts --}}
	@stack('scripts')
	@stack('scriptQuantity')
	@stack('scriptRating')
	@stack('scriptCheckbox')
	</body>
</html>
