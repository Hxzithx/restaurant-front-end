@extends('layouts.app')

@section('content')

@include('header.header-1')

<section id="page-title" class="page-title bg-overlay bg-parallax bg-overlay-gradient">
    <div class="bg-section">
        <img src="/assets/images/page-title/6.jpg" alt="Background" />
    </div>
    <div class="container">
        <div class="row">
            <div class="col-md-12">
                <div class="title text-center">
                    <h1>Your Order</h1>
                </div>
                 <ol class="breadcrumb">
                    <li><a href="{{ url('/home') }}">Home</a></li>
                    <li><a href="{{ url('/menu') }}">Menu</a></li>
                    </ol>
            </div>
        </div>
    </div>
</section>

<section id="shopcart" class="shop shop-cart bg-gray">
    <div class="container">
        <div class="row">
            <div class="col-md-12">

                <div class="cart-table table-responsive">
                    <table class="table table-bordered">

                        <thead>
                            <tr>
                                <th>Product</th>
                                <th>Price</th>
                                <th>Quantity</th>
                                <th>Total</th>
                            </tr>
                        </thead>

                        <tbody id="cart-body"></tbody>

                    </table>
                </div>

            </div>

            <!-- TOTAL SECTION -->
            <div class="col-md-6 col-md-offset-3">
                <div class="cart-total-amount">
                    <h6>Cart Totals :</h6>
                    <ul class="list-unstyled">
                        <li>
                            Cart Subtotal :
                            <span id="cart-subtotal" class="pull-right">Rs. 0.00</span>
                        </li>
                        <li>
                            Order Type :
                            <span class="pull-right">Dine In</span>
                        </li>
                        <li>
                            Order Total :
                            <span id="cart-total" class="pull-right">Rs. 0.00</span>
                        </li>
                    </ul>
                </div>
            </div>

        </div>
    </div>
    <div class="checkout-btn" id="order-checkout">Check Out Order</div>
</section>

@include('footer.footer-1') 

@endsection


@push('scripts')
<script>
document.addEventListener('DOMContentLoaded', function () {

    const cartBody = document.getElementById('cart-body');
    const subtotalElement = document.getElementById('cart-subtotal');
    const totalElement = document.getElementById('cart-total');

    //user based cart
    const cartKey = 
         'cart_{{ session("user_email") ?? "guest" }}';

    //load cart
    getCartItems().then(items => {

        if (!items.length) {
            cartBody.innerHTML = `<tr><td colspan="5" class="text-center">Cart is empty</td></tr>`;
            return;
        }

        cartBody.innerHTML = '';
        let grandTotal = 0;

        items.forEach(item => {

            const itemTotal = item.price * item.quantity;
            grandTotal += itemTotal;

            const row = `
                <tr class="cart-product">

                    <td class="cart-info">
                        <button class = "remove-item" data-id = "${item.id}">
                            <i class = "fa fa-trash"></i>
                        </button>
                        <img src="${item.image || '/assets/images/shop/thumb/1.jpg'}" width="50" class="cart-image">
                         <div class="cart-details">
                            <span class="cart-name">
                              ${item.name}
                           </span>

                       <small class="cart-portion">
                         ${item.portion}
                      </small>
                     </div>

                    </td>

                     <td class="cart-product-price">
        Rs. ${item.price.toFixed(2)}
    </td>

    <td>

        <div class="qty-box">

            <button class="qty-down" data-id="${item.id}">
                -
            </button>

            <input
                class="qty-input"
                data-id="${item.id}"
                value="${item.quantity}"
                readonly
            >

            <button class="qty-up" data-id="${item.id}">
                +
            </button>

        </div>

    </td>

    <td>
        <span class="item-total" data-id="${item.id}">
            Rs. ${itemTotal.toFixed(2)}
        </span>
    </td>

</tr>
            `;

            cartBody.innerHTML += row;
        });

        updateCartTotal(grandTotal);
    });

    //update total function
    function updateCartTotal(total) {
        subtotalElement.textContent = 'Rs. ' + total.toFixed(2);
        totalElement.textContent = 'Rs. ' + total.toFixed(2);
    }

    //handle click events
    cartBody.addEventListener('click', function (e) {

        const button = e.target.closest('button');
        if (!button) return;

            const id = button.getAttribute('data-id');

            if(button.classList.contains('remove-item')){
                //remove row
                button.closest('tr').remove();

                //remove from storage
                removeFromCart(id);

                //update total
                recalculateTotal();

                //show empty message
                if(!cartBody.children.length){
                    cartBody.innerHTML = `<tr><td colspan="5" class="text-center">Cart is empty</td></tr>`;
                }
                return;
            }

            if(button.classList.contains('qty-up') || button.classList.contains('qty-down')){
                const input = document.querySelector(`.qty-input[data-id="${id}"]`);
                let qty = parseInt(input.value);

                 if (button.classList.contains('qty-up')) {
                qty++;
            } else if (button.classList.contains('qty-down') && qty > 1) {
                qty--;
            }

            input.value = qty;

            const row = button.closest('tr');

            const priceText = row.querySelector('.cart-product-price').textContent;
            const price = parseFloat(priceText.replace('Rs.', '').trim());

            const itemTotal = price * qty;

            row.querySelector('.item-total').textContent = 'Rs. ' + itemTotal.toFixed(2);

            //update indexDB
            updateCartItemQuantity(id, qty);

            //recalculate total
            recalculateTotal();
        }
    });

    //recalculate grand total
    function recalculateTotal() {
        let total = 0;

        document.querySelectorAll('.item-total').forEach(el => {
            const text = el.textContent;
            const values = parseFloat(text.replace('Rs.', '').trim());
            total += values;
        });

        updateCartTotal(total);
    }
    function getCartItems() {
        return Promise.resolve(JSON.parse(localStorage.getItem(cartKey)) ||[]);
    }

    //item remove function
    function removeFromCart(id){
        let cart = JSON.parse(localStorage.getItem(cartKey)) || [];

        cart = cart.filter(item => item.id != id);

        localStorage.setItem(cartKey, JSON.stringify(cart));
    }

    function updateCartItemQuantity(id, qty){
        let cart = JSON.parse(localStorage.getItem(cartKey)) || [];

        cart = cart.map(item => {
           if(item.id == id) {
              item.quantity = qty;
           }
           return item;
        });
        localStorage.setItem(cartKey, JSON.stringify(cart));
    }

    //checkout order
      document.getElementById('order-checkout')
        .addEventListener('click', function () {

        //check cart is not empty
        const cart = JSON.parse(localStorage.getItem(cartKey)) || [];

        if(cart.length === 0) {
            Swal.fire({
               icon : 'warning',
               title : 'Cart is Empty',
               text : 'Please add items to your cart before checkout!',
            });
            return;
        }

          fetch('/customer/profile/check')
         .then(res => res.json())
         .then(result => {

        let phone = result.phone ?? '';
        let address = result.address ?? '';

        if(phone.trim() === '' || address.trim() === ''){

            Swal.fire({
               icon : 'warning',
               title : 'Profile Incomplete',
               text : 'Please Update Your Phone Number and Address'
            }).then((result) => {
                if(result.isConfirmed){
                   window.location.href = '/profile';
                }
            });
            return;
        }
        
        window.location.href = '/order-summary';
    });
});

});
</script>
@endpush
