@extends('layouts.app')

@section('content')

<div class="summary-page">

    <div class="summary-container">

        <h2>Order Summary</h2>

        {{-- Customer Info --}}
        <div class="customer-box">
            <h4>Customer Details</h4>
            <p><strong>Name:</strong> <span id="customer-name">{{ session('user_name') }}</span></p>
            <p><strong>Phone:</strong> <span id="customer-phone">Loading...</span></p>
            <p><strong>Address:</strong> <span id="customer-address">Loading...</span></p>
        </div>

        {{-- Order Items --}}
        <div class="order-box">
            <h4>Your Items</h4>
            <div id="summary-items"></div>
        </div>

        {{-- Totals --}}
        <div class="total-box">
            <p>Subtotal: <span id="subtotal">Rs. 0.00</span></p>
            <p>Tax (10%): <span id="tax">Rs. 0.00</span></p>
            <p><strong>Total: <span id="grand-total">Rs. 0.00</span></strong></p>
        </div>

        {{-- Buttons --}}
        <div class="summary-buttons">
            <a href="{{ route('cart') }}" class="back-btn">
                ← Back To Cart
            </a>
            <button class="confirm-btn" id="place-order">
                Confirm Order
            </button>
        </div>

    </div>

</div>

@endsection

@push('scripts')
<script>
document.addEventListener('DOMContentLoaded', function() {

    const cartKey = 'cart_{{ session("user_email") ?? "guest" }}';
    let cart = JSON.parse(localStorage.getItem(cartKey)) || [];

    // Load fresh customer profile from API 
    fetch('/customer/profile/check')
        .then(res => res.json())
        .then(data => {
            document.getElementById('customer-name').textContent    = data.name    || '{{ session("user_name") }}';
            document.getElementById('customer-phone').textContent   = data.phone   || 'N/A';
            document.getElementById('customer-address').textContent = data.address || 'N/A';
        })
        .catch(() => {
            document.getElementById('customer-phone').textContent   = 'N/A';
            document.getElementById('customer-address').textContent = 'N/A';
        });

    //Load cart items
    if(!cart.length) {
        document.getElementById('summary-items').innerHTML = '<p>No items in cart</p>';
        return;
    }

    let html     = '';
    let subTotal = 0;

    cart.forEach(function(item) {

        const itemTotal = item.price * item.quantity;
        subTotal += itemTotal;

        let addonHtml = '';
        if(item.addons && item.addons.length > 0) {
            item.addons.forEach(function(addon) {
                addonHtml += `<div>+ ${addon.name} x ${addon.qty}</div>`;
            });
        }

        html += `
            <div class="summary-item">
                <div>
                    <strong>${item.name}</strong><br>
                    Quantity : ${item.quantity}<br>
                    Portion  : ${item.portion}<br>
                    ${addonHtml}
                    ${item.note ? 'Note : ' + item.note + '<br>' : ''}
                </div>
                <div>Rs. ${itemTotal.toFixed(2)}</div>
            </div>
        `;
    });

    document.getElementById('summary-items').innerHTML = html;

    //Calculate totals
    const tax   = subTotal * 0.10;
    const total = subTotal + tax;

    document.getElementById('subtotal').textContent    = 'Rs. ' + subTotal.toFixed(2);
    document.getElementById('tax').textContent         = 'Rs. ' + tax.toFixed(2);
    document.getElementById('grand-total').textContent = 'Rs. ' + total.toFixed(2);

});
</script>
@endpush