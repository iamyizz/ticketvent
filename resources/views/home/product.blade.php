<!DOCTYPE html>
<html lang="en">
<head>
    @include('home.template.head')
    <style>
        .shop .shop-img {
            height: 160px;
        }

        /* Custom modal styling */
        .modal-header {
            background-color: ##ef233c;
            color: white;
            border-bottom: none;
        }
        
        .modal-header .close {
            color: white;
        }

        .modal-title {
            font-weight: bold;
        }

        .modal-body {
            font-size: 16px;
        }

        .modal-footer {
            border-top: none;
        }

        .btn-primary {
            background-color: ##ef233c;
            border-color: ##ef233c;
        }

        .btn-primary:hover,
        .btn-primary:focus {
            background-color: ##ef233c;
            border-color: ##ef233c;
        }

        .btn-default {
            border-color: #ccc;
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
                <!-- Product main img -->
                <div class="col-md-5 col-md-push-2">
                    <div id="product-main-img">
                        <div class="product-preview">
                            <img src="/events/{{ $data->image }}" alt="">
                        </div>
                    </div>
                </div>
                <!-- /Product main img -->
                <div class="col-md-2 col-md-pull-5">
                    <div id="product-imgs">
                    </div>
                </div>
                <!-- Product details -->
                <div class="col-md-5">
                    <div class="product-details">
                        <h2 class="product-name">{{ $data->name }}</h2>
						<p>{{ $ticket->type }}</p>
                        <div>
                            <div class="product-rating">
                                <i class="fa fa-star"></i>
                                <i class="fa fa-star"></i>
                                <i class="fa fa-star"></i>
                                <i class="fa fa-star"></i>
                                <i class="fa fa-star"></i>
                            </div>
                        </div>
                        <div>
                            <h3 class="product-price">{{ 'Rp' . number_format($ticket->price, 0, ',', '.') }}</h3>
                            @if($ticket->quantity > 0 )
                                <span class="product-available">In Stock</span>
                            @else
                                <span class="product-available">Out Of Stock</span>
                            @endif
                        </div>
                        <div class="add-to-cart">
                            <form id="buy-form" action="{{ route('order.store') }}" method="POST">
                                @csrf
                                <input type="hidden" name="ticket_id" value="{{ $ticket->id }}">
                                <div class="qty-label">
                                    Qty
                                    <div class="input-number">
                                        <input type="number" name="quantity" value="1" min="1" max="{{ $ticket->quantity }}" id="quantity">
                                        <span class="qty-up">+</span>
                                        <span class="qty-down">-</span>
                                    </div>
                                </div>
                                <button type="button" class="add-to-cart-btn" onclick="openConfirmationModal()"><i class="fa fa-shopping-cart"></i> Buy</button>
                            </form>
                        </div>

                        <ul class="product-links">
                            <li>Category:</li>
                            <li><a href="#">{{ $data->category->name }}</a></li>
                        </ul>

                        <ul class="product-links">
                            <li>Share:</li>
                            <li><a href="#"><i class="fa fa-facebook"></i></a></li>
                            <li><a href="#"><i class="fa fa-twitter"></i></a></li>
                            <li><a href="#"><i class="fa fa-google-plus"></i></a></li>
                            <li><a href="#"><i class="fa fa-envelope"></i></a></li>
                        </ul>

                    </div>
                </div>
                <!-- /Product details -->

                <!-- Product tab -->
                <div class="col-md-12">
                    <div id="product-tab">
                        <!-- product tab nav -->
                        <ul class="tab-nav">
                            <li class="active"><a data-toggle="tab" href="#tab1">Description</a></li>
                        </ul>
                        <!-- /product tab nav -->

                        <!-- product tab content -->
                        <div class="tab-content">
                            <!-- tab1  -->
                            <div id="tab1" class="tab-pane fade in active">
                                <div class="row">
                                    <div class="col-md-12">
                                        <p>{{ $data->description }}</p>
                                    </div>
                                </div>
                            </div>
                            <!-- /tab1  -->
                        </div>
                        <!-- /product tab content  -->
                    </div>
                </div>
                <!-- /product tab -->
            </div>
            <!-- /row -->
        </div>
        <!-- /container -->
    </div>
    <!-- /SECTION -->

    <!-- Modal -->
    <div id="confirmationModal" class="modal fade" role="dialog">
        <div class="modal-dialog">

            <!-- Modal content-->
            <div class="modal-content">
                <div class="modal-header">
                    <button type="button" class="close" data-dismiss="modal">&times;</button>
                    <h4 class="modal-title">Konfirmasi Pembelian</h4>
                </div>
                <div class="modal-body">
                    <p>Nama Event: <span id="event-name">{{ $data->name }}</span></p>
					<p>Tipe Ticket: <span id="ticket-type">{{ $ticket->type }}</span></p>
                    <p>Harga Tiket: <span id="ticket-price">{{ 'Rp' . number_format($ticket->price, 0, ',', '.') }}</span></p>
                    <p>Jumlah Tiket: <span id="ticket-quantity"></span></p>
                    <p>Kategori: <span id="event-category">{{ $data->category->name }}</span></p>
					<p><strong>Total Harga: <span id="total-price"></span></strong></p>
                </div>
                <div class="modal-footer">
                    <button type="button" class="primary-btn order-submit" data-dismiss="modal">Batal</button>
                    <button type="button" class="primary-btn" onclick="submitBuyForm()">Konfirmasi</button>
                </div>
            </div>

        </div>
    </div>
    <!-- /Modal -->

    <!-- FOOTER -->
    @include('home.template.footer')
    <!-- /FOOTER -->

    <!-- jQuery Plugins -->
    <script src="{{ asset('electro-master/js/jquery.min.js') }}"></script>
    <script src="{{ asset('electro-master/js/bootstrap.min.js') }}"></script>
    <script src="{{ asset('electro-master/js/slick.min.js') }}"></script>
    <script src="{{ asset('electro-master/js/nouislider.min.js') }}"></script>
    <script src="{{ asset('electro-master/js/jquery.zoom.min.js') }}"></script>
    <script src="{{ asset('electro-master/js/main.js') }}"></script>
    <script>
        function openConfirmationModal() {
            const quantity = document.getElementById('quantity').value;
            const ticketPrice = {{ $ticket->price }};
            const totalPrice = quantity * ticketPrice;
            document.getElementById('ticket-quantity').innerText = quantity;
            document.getElementById('total-price').innerText = 'Rp' + totalPrice.toLocaleString('id-ID');
            $('#confirmationModal').modal('show');
        }

        function submitBuyForm() {
            document.getElementById('buy-form').submit();
        }
    </script>

</body>
</html>