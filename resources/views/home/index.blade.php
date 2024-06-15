<!DOCTYPE html>
<html lang="en">
<head>
    @include('home.template.head')
    <style>
        .shop .shop-img {
            height: 160px;
        }
    </style>
</head>
<body>
    <!-- HEADER -->
    @include('home.template.header')
    <!-- /HEADER -->

    <!-- NAVIGATION -->
    @include('home.template.nav')
    <!-- /NAVIGATION -->

    <!-- SECTION -->
	<div class="section">
		<!-- container -->
		<div class="container">
			<!-- row -->
			<div class="row">
				<!-- shop -->
				@foreach ($category as $cat)
					<div class="col-md-4 col-xs-6">
						<div class="shop">
							<div class="shop-img">
								<img src="{{ asset('karegoriimg/'.$cat->name.'.png') }}" alt="">
							</div>
							<div class="shop-body">
								<h3>{{ $cat->name }}</h3>
								<a href="{{ route('category.show', ['categoryName' => $cat->name]) }}" class="cta-btn">
									Lihat<i class="fa fa-arrow-circle-right"></i>
								</a>
							</div>
						</div>
					</div>
				@endforeach
				<!-- /shop -->
			</div>
			<!-- /row -->
		</div>
		<!-- /container -->
	</div>
	<br><br><br>
	<!-- /SECTION -->


    <!-- SECTION -->
    <div class="section">
        <!-- container -->
        <div class="container">
            <!-- row -->
            <div class="row">

                <!-- section title -->
                <div class="col-md-12">
                    <div class="section-title">
                        <h3 class="title">Latest Event</h3>
                        <div class="section-nav">
                        </div>
                    </div>
                </div>
                <!-- /section title -->

                <!-- Products tab & slick -->
                <div class="col-md-12">
                    <div class="row">
                        <div class="products-tabs">
                            <!-- tab -->
                            <div id="tab1" class="tab-pane active">
                                <div class="products-slick" data-nav="#slick-nav-1">
                                    <!-- product -->
                                    @foreach ($data as $p)
                                    <div class="product">
                                        <div class="product-img">
                                            <img src="/events/{{ $p->image }}" alt="">
                                        </div>
                                        <div class="product-body">
                                            <p class="product-category">{{ $p->category->name }}</p>
                                            <h3 class="product-name"><a href="#">{{ $p->name }}</a></h3>
                                            @if($p->tickets->isNotEmpty())
                                                <h4 class="product-price">{{ 'Rp' . number_format($p->tickets->first()->price, 0, ',', '.') }}</h4>
                                                <p class="product-category">{{ $p->tickets->first()->type }}</p>
                                            @else
                                                <h4 class="product-price">No ticket available</h4>
                                            @endif
                                            <div class="product-rating">
                                                <i class="fa fa-star"></i>
                                                <i class="fa fa-star"></i>
                                                <i class="fa fa-star"></i>
                                                <i class="fa fa-star"></i>
                                                <i class="fa fa-star"></i>
                                            </div>
                                        </div>
                                        <div class="add-to-cart">
                                            <a href="{{ url('event_detail',$p->id) }}"><button class="add-to-cart-btn"><i class="fa fa-eye"></i> lihat</button></a>
                                        </div>
                                    </div>
                                    @endforeach
                                    <!-- /product -->
                                </div>									
                                <div id="slick-nav-1" class="products-slick-nav"></div>
                            </div>
                            <!-- /tab -->
                        </div>
                    </div>
                </div>
                <!-- Products tab & slick -->
            </div>
            <!-- /row -->
        </div>
        <!-- /container -->
    </div>
	<br><br><br>
    <!-- /SECTION -->

    <!-- FOOTER -->
    @include('home.template.footer')
    </footer>
    <!-- /FOOTER -->

    <!-- jQuery Plugins -->
    <script src="{{ asset('electro-master/js/jquery.min.js') }}"></script>
    <script src="{{ asset('electro-master/js/bootstrap.min.js') }}"></script>
    <script src="{{ asset('electro-master/js/slick.min.js') }}"></script>
    <script src="{{ asset('electro-master/js/nouislider.min.js') }}"></script>
    <script src="{{ asset('electro-master/js/jquery.zoom.min.js') }}"></script>
    <script src="{{ asset('electro-master/js/main.js') }}"></script>

</body>
</html>