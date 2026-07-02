    @extends('layouts.app')

    @section('content')

    @include('header.header-1')

    <section id="page-title" class="page-title bg-overlay bg-parallax bg-overlay-gradient">
        <div class="bg-section">
            <img src="{{ asset('assets/images/page-title/6.jpg') }}" alt="Background" />
        </div>
        <div class="container">
            <div class="row">   
                <div class="col-xs-12 col-sm-12 col-md-12">
                    <div class="title title-4 text-center">
                        <div class="title--content">
                            <div class="title--subtitle">Products</div>
                            <div class="title--heading">
                                <h1>{{ $item['base_name'] }}</h1>
                            </div>
                        </div>
                        <div class="clearfix"></div>
                        <ol class="breadcrumb">
                            <li><a href="{{ url('/home') }}">Home</a></li>
                            <li><a href="{{ route('menu') }}">Menu</a></li>
                            <li class="active">{{ $item['base_name'] }}</li>
                        </ol>
                        <div class="divider--shape-1down divider--shape-gray"></div>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <section id="product-single" class="shop shop-single bg-white">
        <div class="container">
            <div class="row">
                <div class="col-xs-12 col-sm-12 col-md-9">
                    <div class="row">

                        {{-- Item Image --}}
                        <div class="col-xs-12 col-sm-6 col-md-6">
                            <div class="product-img">
                                @if($item['image_url'])
                                    <img src="{{ $item['image_url'] }}" alt="{{ $item['base_name'] }}" />
                                @else
                                    <img src="{{ asset('assets/images/shop/grid/15.jpg') }}" alt="{{ $item['base_name'] }}" />
                                @endif
                            </div>
                        </div>

                        {{-- Item Details --}}
                        <div class="col-xs-12 col-sm-6 col-md-6">

                            {{-- Title --}}
                            <div class="product-title text-center-xs">
                                <h3>{{ $item['base_name'] }}</h3>
                            </div>

                            {{-- Price & Rating --}}
                            <div class="product-meta mb-30">
                                <div class="product-price pull-left pull-none-xs">
                                    @if(isset($item['real_price']) && $item['real_price'])
                                        <span id="product-price" data-base = "{{ $item['real_price'] }}">Rs. {{ number_format($item['real_price'], 2) }}</span>
                                    @else
                                        <span>Price not available</span>
                                    @endif
                                </div>
                                <div class="product-review text-right text-center-xs">
                                    <div
                                      class="rating-stars"
                                      id="rating-stars"
                                      data-rating="0"    
                                    >
                                        <i class="fa fa-star-0" data-value="1"></i>
                                        <i class="fa fa-star" data-value="2"></i>
                                        <i class="fa fa-star" data-value="3"></i>
                                        <i class="fa fa-star" data-value="4"></i>
                                        <i class="fa fa-star" data-value="5"></i>
                                    </div>
                                    <div class="review-meta">
                                       <span class="review-count">
                                         Your Rating:
                                         <span id="rating-value">0</span>/5
                                       </span>
                                       <span class="divider">|</span>
                                       <a href="javascript:void(0)" class="add-review-link">
                                         Click Stars To Review
                                       </a>
                                    </div>
                                    <input 
                                    type="hidden"
                                    name="rating"
                                    id="rating-input"
                                    value="0"
                                    >
                                </div>
                            </div>

                            {{-- Description --}}
                            <div class="product-desc text-center-xs">
                                <p>{{ $item['description'] ?? 'No description available for this item.' }}</p>
                            </div>

                            {{-- Other Details --}}
                            <div class="product-details text-center-xs">
                                <h5>Other Details :</h5>
                                <ul class="list-unstyled">
                                    <li>Category: <span>{{ $item['category']['name'] ?? 'General' }}</span></li>
                                    @if($item['item_type'])
                                        <li>Type: <span>{{ ucfirst($item['item_type']) }}</span></li>
                                    @endif
                                    @if(isset($item['variant']['name']))
                                        <li>Portion: <span id="selected-portion">Regular</span></li>
                                    @endif
                                    @if($item['include_tax'])
                                        <li>Tax: <span>Included</span></li>
                                    @endif
                                </ul>
                            </div>

                            {{-- Portion Select --}}
                            @if(count($portions) > 0)
                            <div class="portion-select mb-20">
                            <label class="portion-label">Select Portion:</label>
                            <div class="form-select-custom">
                                <select class="form-control" id="portion-select" name="portion_id">
                                @foreach($portions as $portion)
                                <option value="{{ $portion['id'] }}"
                                    data-price="{{ $portion['additional_price'] }}">
                                    {{ $portion['name'] }}
                                    @if($portion['additional_price'] > 0)
                                (+ Rs. {{ number_format($portion['additional_price'], 2) }})
                                @endif
                            </option>
                        @endforeach  
                        </select>
                    </div>
                    </div>
                @endif
                            {{-- Quantity & Add to Cart --}}
                            <div class="product-action">
                                <div class="product-quantity pull-left pull-none-xs">
                                    <span class="qua">Quantity:</span>
                                    <div class="input-group">
                                        <input type="text" class="form-control" value="1" readonly id="pro-quantity">
                                        <div class="input-group-btn-vertical">
                                            <button class="btn btn-default" type="button" id="qty-up">
                                                <i class="fa fa-angle-up"></i>
                                            </button>
                                            <button class="btn btn-default" type="button" id="qty-down">
                                                <i class="fa fa-angle-down"></i>
                                            </button>
                                        </div>
                                    </div>
                                </div>
                                <div class="product-cta text-right text-center-xs">
                                    <button class="btn btn--primary btn--rounded" id="add-to-cart">Add to Cart</button>
                                </div>
                            </div>

                            {{-- Add On Button --}}
    @if(count($addons) > 0)
        <div class="addon-section mb-20">
            <button type="button" class="btn-addon" data-toggle="modal" data-target="#addonModal">
                <i class="fa fa-plus-circle"></i> Add Extras
            </button>
        </div>

        {{-- Addon Modal --}}
        <div class="modal fade" id="addonModal" tabindex="-1" role="dialog">
            <div class="modal-dialog" role="document">
                <div class="modal-content addon-modal-content">
                    <div class="modal-header addon-modal-header">
                        <button type="button" class="close" data-dismiss="modal">
                            <i class="fa fa-times"></i>
                        </button>
                        <h4 class="modal-title">Add Extras to Your Order</h4>
                        <p>Customize your dish with our available extras</p>
                    </div>
                    <div class="modal-body addon-modal-body">
                        <div id="addon-list">
                            @foreach($addons as $addon)
                                <div class="addon-item">
                                    <div class="addon-item-info">
                                        <span class="addon-item-name">{{ $addon['name'] }}</span>
                                        <span class="addon-item-price">
                                            Rs. {{ number_format($addon['price'], 2) }}
                                        </span>
                                    </div>
                                    <div class="addon-item-qty">
                                        <button class="addon-qty-btn" onclick="changeAddonQty({{ $addon['id'] ?? $addon['fid'] }}, -1)">
                                            <i class="fa fa-minus"></i>
                                        </button>
                                        <span class="addon-qty-value" id="addon-qty-{{ $addon['id'] }}">0</span>
                                        <button class="addon-qty-btn" onclick="changeAddonQty({{ $addon['id'] ?? $addon['fid'] }}, 1)">
                                            <i class="fa fa-plus"></i>
                                        </button>
                                    </div>
                                </div>
                            @endforeach
                        </div>

                        {{-- Selected Addons Summary --}}
                        <div class="addon-summary" id="addon-summary" style="display:none;">
                            <div class="addon-summary-title">Selected Extras:</div>
                            <div id="addon-summary-list"></div>
                            <div class="addon-summary-total">
                                Extra Total: <span id="addon-total">Rs. 0.00</span>
                            </div>
                        </div>
                    </div>
                    <div class="modal-footer addon-modal-footer">
                        <button type="button" class="btn-addon-confirm" data-dismiss="modal">
                            <i class="fa fa-check"></i> Confirm Extras
                        </button>
                        <button type="button" class="btn-addon-cancel" data-dismiss="modal">
                            Cancel
                        </button>
                    </div>
                </div>
            </div>
        </div>

         <div class="kitchen-note-box">
         <label>Note to Kitchen</label>
          <textarea id="kitchen-note"
            placeholder="Ex: Less spicy, no onion..."></textarea>
         </div>
          @endif
     </div>
</div>

                    {{-- Related Products --}}
                    <div class="row">
                        <div class="col-xs-12 col-sm-12 col-md-12">
                            <div class="widget-related-product mt-50">
                                <div class="widget--title">
                                    <h5>Related Products</h5>
                                </div>
                                <div class="widget--content">
                                    <div class="row">
                                        @isset($relatedItems)
                                            @forelse($relatedItems as $related)
                                                <div class="col-xs-12 col-sm-6 col-md-4">
                                                    <div class="product-item">
                                                        <div class="product--img">
                                                            @if($related['image_url'])
                                                                <img src="{{ $related['image_url'] }}"
                                                                    alt="{{ $related['base_name'] }}"/>
                                                            @else
                                                                <img src="{{ asset('assets/images/shop/grid/15.jpg') }}"
                                                                    alt="{{ $related['base_name'] }}"/>
                                                            @endif
                                                            <div class="product--hover">
                                                                <div class="product--action">
                                                                    <a href="{{ route('menu.show', $related['id']) }}">
                                                                        View Item
                                                                    </a>
                                                                </div>
                                                            </div>
                                                        </div>
                                                        <div class="product--content">
                                                            <div class="product--title">
                                                                <h3>
                                                                    <a href="{{ route('menu.show', $related['id']) }}">
                                                                        {{ $related['base_name'] }}
                                                                    </a>
                                                                </h3>
                                                            </div>
                                                            <div class="product--price">
                                                                @if(isset($item['real_price']) && $item['real_price'])
                                                                <span id="product-price" data-base = "{{ $item['real_price'] }}">Rs. {{ number_format($item['real_price'], 2) }}</span>
                                                                @else
                                                                <span>Price not available</span>
                                                                @endif
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                            @empty
                                                <p class="text-center">No related items found.</p>
                                            @endforelse
                                        @endisset
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>

                </div>

                {{-- Sidebar --}}
                <div class="col-xs-12 col-sm-12 col-md-3">
                    <div class="sidebar sidebar-full">
                        <div class="widget widget-categories">
                            <div class="widget--title">
                                <h5>Categories</h5>
                            </div>
                            <div class="widget--content">
                                <ul class="list-unstyled">
                                    @isset($categories)
                                        @foreach($categories as $cat)
                                            <li>
                                                <a href="{{ route('menu') }}">
                                                    {{ $cat['name'] }}
                                                    <span>({{ $cat['items_count'] ?? 0 }}) </span>
                                                </a>
                                            </li>
                                        @endforeach
                                    @endisset {{-- fixed: was @enset --}}
                                </ul>
                            </div>
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

let qtyInput;
let qtyUp;
let qtyDown;
let portionSelect;
let priceElement;
let basePrice = 0;

let addonData = @json($addons) || [];
let addonQty = {};

if (!Array.isArray(addonData)) {
    addonData = Object.values(addonData);
}

//update totoal price
function updatePrice() {

    const quantity = parseInt(qtyInput.value) || 1;

    let extraPrice = 0;
    let portionName = 'Regular';

    if (portionSelect) {
        const selectedOption =
            portionSelect.options[portionSelect.selectedIndex];

        extraPrice =
            parseFloat(selectedOption.getAttribute('data-price')) || 0;

        portionName =
            selectedOption.text.split('(')[0].trim();
    }

    // Add-on total
    let addonTotal = 0;

    addonData.forEach(function(addon) {

        const addonId = addon.id || addon.fid;
        const qty = addonQty[addonId] || 0;
        const price = parseFloat(addon.price) || 0;

        addonTotal += qty * price;
    });

    const finalPrice =
        ((basePrice + extraPrice) * quantity) + addonTotal;

    priceElement.textContent =
        'Rs. ' + finalPrice.toFixed(2);

    // Portion label
    const portionLabel =
        document.getElementById('selected-portion');

    if (portionLabel) {
        portionLabel.textContent = portionName;
    }
}

//addon change
function changeAddonQty(id, change) {

    if (!addonQty[id]) {
        addonQty[id] = 0;
    }

    addonQty[id] =
        Math.max(0, addonQty[id] + change);

    const qtyElement =
        document.getElementById('addon-qty-' + id);

    if (qtyElement) {
        qtyElement.textContent = addonQty[id];
    }

    updateAddonSummary();
    updatePrice();
}

//addon summary
function updateAddonSummary() {

    let total = 0;
    let html = '';

    addonData.forEach(function(addon) {

        const addonId = addon.id || addon.fid;
        const qty = addonQty[addonId] || 0;

        if (qty > 0) {

            const price =
                parseFloat(addon.price) || 0;

            const itemTotal =
                qty * price;

            total += itemTotal;

            html += `
                <div>
                    + ${addon.name} x ${qty}
                    - Rs. ${itemTotal.toFixed(2)}
                </div>
            `;
        }
    });

    const summaryBox =
        document.getElementById('addon-summary');

    const list =
        document.getElementById('addon-summary-list');

    const totalEl =
        document.getElementById('addon-total');

    if (summaryBox && list && totalEl) {

        if (total > 0) {

            summaryBox.style.display = 'block';
            list.innerHTML = html;
            totalEl.textContent =
                'Rs. ' + total.toFixed(2);

        } else {

            summaryBox.style.display = 'none';
        }
    }
}

//save to cart
 const cartKey = 'cart_{{ session("user_email") ?? "guest" }}';
function saveToCart(item) {

    let cart =
        JSON.parse(localStorage.getItem(cartKey)) || [];

    cart.push(item);

    localStorage.setItem(
        cartKey,
        JSON.stringify(cart)
    );
}

//page 
document.addEventListener('DOMContentLoaded', function() {

    qtyInput =
        document.getElementById('pro-quantity');

    qtyUp =
        document.getElementById('qty-up');

    qtyDown =
        document.getElementById('qty-down');

    portionSelect =
        document.getElementById('portion-select');

    priceElement =
        document.getElementById('product-price');

    basePrice =
        parseFloat(
            priceElement.getAttribute('data-base')
        ) || 0;

    //quantity increase
    if (qtyUp) {
        qtyUp.addEventListener('click', function() {

            let current =
                parseInt(qtyInput.value) || 1;

            if (current < 99) {
                qtyInput.value = current + 1;
                updatePrice();
            }
        });
    }

    //quantity decrease
    if (qtyDown) {
        qtyDown.addEventListener('click', function() {

            let current =
                parseInt(qtyInput.value) || 1;

            if (current > 1) {
                qtyInput.value = current - 1;
                updatePrice();
            }
        });
    }

    //portion change
    if (portionSelect) {
        portionSelect.addEventListener(
            'change',
            updatePrice
        );
    }

    //add to cart
    const addCartBtn =
        document.getElementById('add-to-cart');

    if (addCartBtn) {

        addCartBtn.addEventListener('click', function() {

            const quantity =
                parseInt(qtyInput.value) || 1;

            let extraPrice = 0;
            let portion = 'Regular';

            if (portionSelect) {

                const selectedOption =
                    portionSelect.options[
                        portionSelect.selectedIndex
                    ];

                extraPrice =
                    parseFloat(
                        selectedOption.getAttribute(
                            'data-price'
                        )
                    ) || 0;

                portion =
                    selectedOption.text
                    .split('(')[0]
                    .trim();
            }

            let addonTotal = 0;
            let selectedAddons = [];

            addonData.forEach(function(addon) {

                const addonId =
                    addon.id || addon.fid;

                const qty =
                    addonQty[addonId] || 0;

                const price =
                    parseFloat(addon.price) || 0;

                if(qty > 0){
                    addonTotal += qty * price;

                    selectedAddons.push({
                       id : addonId,
                       name : addon.name,
                       qty : qty,
                       price : addon.price
                    });
                }
            });

            const finalPrice =
                ((basePrice + extraPrice) * quantity)
                + addonTotal;

            const kitchenNote = 
                  document.getElementById('kitchen-note').value;

            const cartItem = {
                id: Date.now(),
                item_id: {{ $item['id'] }},
                name: "{{ $item['base_name'] }}",
                image:
                    "{{ $item['image_url'] ?? asset('assets/images/shop/grid/1.jpg') }}",
                quantity: quantity,
                portion: portion,
                price: finalPrice,
                addons: selectedAddons,
                note : kitchenNote
            };

            saveToCart(cartItem);

            window.location.href =
                "{{ route('cart') }}";
        });
    }

    //initial load
    updatePrice();

    //review
    const stars = document.querySelectorAll('#rating-stars i');
    const ratingValue = document.querySelectorAll('rating-value');
    const ratingInput = document.getElementById('rating-input');

    let selectedRating = 0;

    stars.forEach(star => {
        star.addEventListener('mousecenter', function() {
           const value = parseInt(this.dataset.value);

           highlightStars(value);
        });  
        star.addEventListener('click', function() {
           selectedRating = parseInt(this.dataset.value);

           ratingValue.textContent = selectedRating;

           ratingInput.value = selectedRating;

           highlightStars(selectedRating);
        });
    });
    document.getElementById('rating-stars').addEventListener('mouseleave', function() {
         highlightStars(selectedRating);
    });

    function highlightStars(value){
        stars.forEach(star => {
           const starValue = parseInt(star.dataset.value);

           if(starValue <= value){
              star.classList.add('active');
              star.classList.add('fa-star-0');
              star.classList.add('fa-star');
           }else {
            star.classList.remove('active');
            star.classList.remove('fa-star');
            star.classList.add('fa-star-o');
           }
        });
    }

});
</script>
@endpush