@extends('layouts.app')
 
@section('content')
 
<div class="os-page">
 
    {{-- Decorative background elements --}}
    <div class="os-bg-grain"></div>
    <div class="os-orb os-orb-1"></div>
    <div class="os-orb os-orb-2"></div>
 
    <div class="os-wrapper">
 
        {{-- Header --}}
        <div class="os-header">
            <div class="os-header-eyebrow">
                <span class="os-dot"></span>
                Review your order
                <span class="os-dot"></span>
            </div>
            <h1 class="os-title">Order Summary</h1>
        </div>
 
        <div class="os-grid">
 
            {{-- LEFT COLUMN --}}
            <div class="os-left">
 
                {{-- Customer Card --}}
                <div class="os-card os-customer-card" style="animation-delay:0.05s">
                    <div class="os-card-label">
                        <svg width="13" height="13" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><path d="M20 21v-2a4 4 0 0 0-4-4H8a4 4 0 0 0-4 4v2"/><circle cx="12" cy="7" r="4"/></svg>
                        Customer
                    </div>
                    <div class="os-customer-info">
                        <div class="os-customer-avatar" id="customer-avatar-initials">
                            {{ strtoupper(substr(session('user_name', 'G'), 0, 1)) }}
                        </div>
                        <div class="os-customer-details">
                            <span class="os-customer-name" id="customer-name">{{ session('user_name') }}</span>
                            <span class="os-customer-meta" id="customer-phone">
                                <svg width="11" height="11" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><path d="M22 16.92v3a2 2 0 0 1-2.18 2 19.79 19.79 0 0 1-8.63-3.07A19.5 19.5 0 0 1 4.69 12 19.79 19.79 0 0 1 1.58 3.42 2 2 0 0 1 3.55 1.27h3a2 2 0 0 1 2 1.72c.127.96.361 1.903.7 2.81a2 2 0 0 1-.45 2.11L7.91 8.77a16 16 0 0 0 6.29 6.29l1.57-1.57a2 2 0 0 1 2.11-.45c.907.339 1.85.573 2.81.7A2 2 0 0 1 22 16.92z"/></svg>
                                Loading...
                            </span>
                            <span class="os-customer-meta" id="customer-address">
                                <svg width="11" height="11" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><path d="M21 10c0 7-9 13-9 13s-9-6-9-13a9 9 0 0 1 18 0z"/><circle cx="12" cy="10" r="3"/></svg>
                                Loading...
                            </span>
                        </div>
                    </div>
                </div>
 
                {{-- Order Items Card --}}
                <div class="os-card" style="animation-delay:0.12s">
                    <div class="os-card-label">
                        <svg width="13" height="13" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><path d="M6 2L3 6v14a2 2 0 0 0 2 2h14a2 2 0 0 0 2-2V6l-3-4z"/><line x1="3" y1="6" x2="21" y2="6"/><path d="M16 10a4 4 0 0 1-8 0"/></svg>
                        Your Items
                    </div>
                    <div id="summary-items" class="os-items-list"></div>
                </div>
 
            </div>
 
            {{-- RIGHT COLUMN --}}
            <div class="os-right">
 
                {{-- Price Breakdown --}}
                <div class="os-card os-sticky-card" style="animation-delay:0.18s">
                    <div class="os-card-label">
                        <svg width="13" height="13" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><line x1="12" y1="1" x2="12" y2="23"/><path d="M17 5H9.5a3.5 3.5 0 0 0 0 7h5a3.5 3.5 0 0 1 0 7H6"/></svg>
                        Price Breakdown
                    </div>
 
                    <div class="os-price-rows">
                        <div class="os-price-row">
                            <span>Subtotal</span>
                            <span id="subtotal">Rs. 0.00</span>
                        </div>
                        <div class="os-price-row">
                            <span>Tax <em>(10%)</em></span>
                            <span id="tax">Rs. 0.00</span>
                        </div>
                        <div class="os-price-row os-price-row--total">
                            <span>Total</span>
                            <span id="grand-total">Rs. 0.00</span>
                        </div>
                    </div>
 
                    {{-- Order type badge --}}
                    <div class="os-order-type">
                        <svg width="14" height="14" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><rect x="3" y="3" width="18" height="18" rx="2"/><path d="M3 9h18"/><path d="M9 21V9"/></svg>
                        Dine In
                    </div>
 
                    {{-- Actions --}}
                    <div class="os-actions">
                        <button class="os-confirm-btn" id="place-order">
                            <span>Confirm Order</span>
                            <svg width="16" height="16" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.5"><line x1="5" y1="12" x2="19" y2="12"/><polyline points="12 5 19 12 12 19"/></svg>
                        </button>
                        <a href="{{ route('cart') }}" class="os-back-btn">
                            <svg width="14" height="14" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><line x1="19" y1="12" x2="5" y2="12"/><polyline points="12 19 5 12 12 5"/></svg>
                            Back to Cart
                        </a>
                    </div>
 
                </div>
 
            </div>
 
        </div>
 
    </div>
</div>
 
@endsection

@push('scripts')
<script>
document.addEventListener('DOMContentLoaded', function() {
 
    const cartKey = 'cart_{{ session("user_email") ?? "guest" }}';
    let cart = JSON.parse(localStorage.getItem(cartKey)) || [];
 
    // ── Load fresh customer profile ──
    fetch('/customer/profile/check')
        .then(res => res.json())
        .then(data => {
            document.getElementById('customer-name').textContent = data.name || '{{ session("user_name") }}';
            document.getElementById('customer-avatar-initials').textContent =
                (data.name || '{{ session("user_name") }}').charAt(0).toUpperCase();
 
            const phoneEl   = document.getElementById('customer-phone');
            const addressEl = document.getElementById('customer-address');
 
            phoneEl.innerHTML = `
                <svg width="11" height="11" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><path d="M22 16.92v3a2 2 0 0 1-2.18 2 19.79 19.79 0 0 1-8.63-3.07A19.5 19.5 0 0 1 4.69 12 19.79 19.79 0 0 1 1.58 3.42 2 2 0 0 1 3.55 1.27h3a2 2 0 0 1 2 1.72c.127.96.361 1.903.7 2.81a2 2 0 0 1-.45 2.11L7.91 8.77a16 16 0 0 0 6.29 6.29l1.57-1.57a2 2 0 0 1 2.11-.45c.907.339 1.85.573 2.81.7A2 2 0 0 1 22 16.92z"/></svg>
                ${data.phone || 'N/A'}
            `;
            addressEl.innerHTML = `
                <svg width="11" height="11" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><path d="M21 10c0 7-9 13-9 13s-9-6-9-13a9 9 0 0 1 18 0z"/><circle cx="12" cy="10" r="3"/></svg>
                ${data.address || 'N/A'}
            `;
        })
        .catch(() => {
            document.getElementById('customer-phone').textContent   = 'N/A';
            document.getElementById('customer-address').textContent = 'N/A';
        });
 
    // ── Load cart items ──
    if (!cart.length) {
        document.getElementById('summary-items').innerHTML =
            '<div class="os-empty">No items in cart</div>';
        return;
    }
 
    let html     = '';
    let subTotal = 0;
 
    cart.forEach(function(item, index) {
        const itemTotal = item.price * item.quantity;
        subTotal += itemTotal;
 
        let addonHtml = '';
        if (item.addons && item.addons.length > 0) {
            item.addons.forEach(function(addon) {
                addonHtml += `<div class="os-item-addon">+ ${addon.name} × ${addon.qty}</div>`;
            });
        }
 
        html += `
            <div class="os-item" style="animation-delay:${0.08 * index}s">
                <div class="os-item-left">
                    <span class="os-item-number">${index + 1}</span>
                    <span class="os-item-name">${item.name}</span>
                    <div class="os-item-meta">
                        <span class="os-item-meta-tag">Qty: ${item.quantity}</span>
                        <span class="os-item-meta-tag">${item.portion}</span>
                    </div>
                    ${addonHtml}
                    ${item.note ? `<div class="os-item-note">📝 ${item.note}</div>` : ''}
                </div>
                <div class="os-item-price">Rs. ${itemTotal.toFixed(2)}</div>
            </div>
        `;
    });
 
    document.getElementById('summary-items').innerHTML = html;
 
    // ── Totals ──
    const tax   = subTotal * 0.10;
    const total = subTotal + tax;
 
    document.getElementById('subtotal').textContent    = 'Rs. ' + subTotal.toFixed(2);
    document.getElementById('tax').textContent         = 'Rs. ' + tax.toFixed(2);
    document.getElementById('grand-total').textContent = 'Rs. ' + total.toFixed(2);
 
});
</script>
@endpush