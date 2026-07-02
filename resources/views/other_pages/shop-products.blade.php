@extends('layouts.app')

@section('content')

@include('header.header-1')

<!-- Page Title -->
<section id="page-title" class="page-title bg-overlay bg-parallax bg-overlay-gradient">
    <div class="bg-section">
        <img src="/assets/images/page-title/6.jpg" alt="Background" />
    </div>
    <div id="orderTypeModal" class="order-modal">
        <div class="order-modal-content">
            <h3>Select Your Order Type</h3>

            <button class="order-btn" data-type = "dine-in">Dine In</button>
            <button class="order-btn" data-type = "takeaway">Take Away</button>
            <button class="order-btn" data-type="online">Online Order</button>
        </div>
    </div>
    <div class="container">
        <div class="row">
            <div class="col-md-12">
                <div class="title title-4 text-center">
                    <div class="title--content">
                        <div class="title--subtitle">Menu</div>
                        <div class="title--heading">
                            <h1>Make Your Order</h1>
                        </div>
                    </div>

                    <ol class="breadcrumb">
                        <li><a href="/">Home</a></li>
                        <li class="active">Shop</li>
                    </ol>

                    <div class="divider--shape-1down divider--shape-gray"></div>
                </div>
            </div>
        </div>
    </div>
</section>

<!-- Shop -->
<section id="shop" class="shop shop-3 bg-gray pb-90">
    <div class="container">
        <div class="row">

            <!-- ================= PRODUCTS ================= -->
            <div class="col-md-9">

                <!-- Options -->
                <div class="shop-options">
                    <div class="product-options2 pull-left">
                        <span>Products</span>
                    </div>
                </div>

                <!-- Product Grid -->
                <div class="row">

                    @foreach ($items as $item)
                    <div class="col-xs-12 col-sm-6 col-md-4 mb-30 product-card"
                      data-price = "{{ $item['real_price'] ?? 0 }}"
                      data-category = "{{ strtolower($item['category']['name'] ?? '') }}">

                        <div class="product-item">

                            <div class="product--img">
                                <img src="{{ $item['image_url'] ?? asset('assets/images/shop/grid/15.jpg') }}" alt="Product">

                                <div class="product--hover">
                                    <div class="product--action">
                                        <a href="{{ route('menu.show', $item['id']) }}">
                                            View Details
                                        </a>
                                    </div>
                                </div>

                                <div class="divider--shape-1down"></div>
                            </div>

                            <div class="product--content text-center">

                                <div class="product--type">
                                    <span>{{ $item['category']['name'] ?? 'Food' }}</span>
                                </div>

                                <div class="product--title">
                                    <h3>
                                        <a href="{{ route('menu.show', $item['id']) }}">
                                            {{ $item['base_name'] }}
                                        </a>
                                    </h3>
                                </div>

                                <div class="product--price">
                                    Rs. {{ number_format($item['real_price'] ?? 0, 2) }}
                                </div>

                            </div>

                        </div>

                    </div>
                    @endforeach

                </div>
            </div>

            <!-- ================= SIDEBAR ================= -->
            <div class="col-md-3">

                <!-- Best Sellers -->
                <div class="widget widget-recent-products">
                    <div class="widget--title">
                        <h5>Best Sellers</h5>
                    </div>

                    {{-- best selling items tab --}}
                    {{-- <div class="widget--content">

                        <div class="product clearfix">
                            <img src="{{ asset('assets/images/shop/thumb/4.jpg') }}" />
                            <div class="product-desc">
                                <div class="product-meta">$38.99</div>
                                <div class="product-title">Roast Sea Trout</div>
                            </div>
                        </div>

                        <div class="product clearfix">
                            <img src="{{ asset('assets/images/shop/thumb/4.jpg') }}" />
                            <div class="product-desc">
                                <div class="product-meta">$23.99</div>
                                <div class="product-title">Roasted Steak Roulade</div>
                            </div>
                        </div>

                    </div> --}}
                </div>

                <!-- Filter -->
                <div class="widget widget-filter">
                    <div class="widget--title">
                        <h5>Pricing Filter</h5>
                    </div>

                    <div class="widget--content">
                        <div id="slider-range"></div>
                        <p>
                            <label>Price:</label>
                            <input type="text" id="amount" readonly>
                        </p>
                    </div>
                </div>

                <!-- Tags -->
                <div class="widget widget-tags">
                    <div class="widget--title">
                        <h5>Categories</h5>
                    </div>

                    <div class="widget--content">
                        <a href="#" class="tag-btn active" data-category="all">All</a>
                        <a href="#" class="tag-btn" data-category="main course">Main Course</a>
                        <a href="#" class="tag-btn" data-category="beverages">Beverages</a>
                    </div>
                </div>

            </div>

        </div>
    </div>
</section>

@include('footer.footer-1')

@endsection


@push('scripts')
   <script>
    //price filter
    $(function () {
       const products = document.querySelectorAll('.product-card');

       $("#slider-range").slider({
          range : true,
          min : 0,
          max : 1500,
          values : [0, 500],

          slide : function(event, ui) {
            $("#amount").val("Rs." + ui.values[0] + "-Rs." + ui.values[1]);

            filterProducts(ui.values[0], ui.values[1]);
          }
       });

       $("#amount").val(
         "Rs. " +
         $("#slider-range").slider("values", 0) + 
         " - Rs. " +
         $("#slider-range").slider("values", 1)
       );

       function filterProducts(min, max){
          products.forEach(product => {
             const price = parseFloat(product.getAttribute('data-price'));

             if(price >= min && price <= max) {
                product.style.display = "block";
             } else {
                product.style.display = "none";
             }
          });
       }
    });

    document.querySelectorAll('.tag-btn').forEach(button => {
       button.addEventListener('click', function (e) {
          e.preventDefault();

          //highlight the current active button
          document.querySelectorAll('.tag-btn').forEach(btn => btn.classList.remove('active'));
          this.classList.add('active');

          const selectedCategory = this.getAttribute('data-category');
          const products = document.querySelectorAll('.product-card');

          products.forEach(product => {
             const productCategory = product.getAttribute('data-category');

             if(selectedCategory === 'all' || productCategory === selectedCategory){
                product.style.display = "";
             } else {
                product.style.display = "none";
             }
          });
       });
    });

    document.addEventListener('DOMContentLoaded', function () {
        const savedType = localStorage.getItem('orderType');
        const modal = document.getElementById('orderTypeModal');
        const currentPath = window.location.pathname;

        if(!savedType){
            modal.style.display = 'flex';
        }else {
            modal.style.display = 'none';
        }

        document.querySelectorAll('.order-btn').forEach(function(btn) {

            btn.addEventListener('click', function() {
            const type = this.getAttribute('data-type');

            //save selection
            localStorage.setItem('orderType', type);

            //dine in
            if(type === 'dine-in'){
                window.location.href = "{{ route('reservation') }}"
                return;
            }

            //take-away and online
            modal.style.display = 'none';
            });
        });
    });
   </script>
@endpush