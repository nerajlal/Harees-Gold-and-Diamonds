@extends('nurah.layouts.app')

@section('title', 'Checkout - Nurah Perfumes')

@push('styles')
<style>
    .checkout-page {
        padding: 40px 20px;
        max-width: 1200px;
        margin: 0 auto;
        min-height: 80vh;
    }
    
    .checkout-container {
        display: grid;
        grid-template-columns: 1.5fr 1fr;
        gap: 50px;
        margin-top: 30px;
    }
    
    .section-title {
        font-family: 'Playfair Display', serif;
        font-size: 24px;
        font-weight: 700;
        margin-bottom: 25px;
        padding-bottom: 10px;
        border-bottom: 1px solid var(--border);
        color: var(--black);
    }
    
    /* Form Styles */
    .form-row {
        display: grid;
        grid-template-columns: 1fr 1fr;
        gap: 20px;
        margin-bottom: 20px;
    }
    
    .form-group {
        margin-bottom: 20px;
    }
    
    .form-group label {
        display: block;
        font-size: 13px;
        font-weight: 600;
        margin-bottom: 8px;
        color: var(--text);
        text-transform: uppercase;
        letter-spacing: 0.5px;
    }
    
    .form-control {
        width: 100%;
        padding: 12px 15px;
        border: 1px solid var(--border);
        border-radius: 6px;
        font-family: 'Montserrat', sans-serif;
        font-size: 14px;
        transition: border 0.3s;
        outline: none;
    }
    
    .form-control:focus {
        border-color: var(--black);
    }
    
    /* Order Summary & Payment */
    .order-summary-box {
        background: var(--bg-light);
        padding: 30px;
        border-radius: 12px;
        position: sticky;
        top: 100px;
    }
    
    .summary-item {
        display: flex;
        justify-content: space-between;
        margin-bottom: 15px;
        padding-bottom: 15px;
        border-bottom: 1px dashed #ddd;
    }
    
    .summary-item:last-of-type {
        border-bottom: none;
    }
    
    .prod-name {
        font-weight: 500;
        color: var(--black);
    }
    
    .prod-meta {
        font-size: 12px;
        color: var(--text-light);
        margin-top: 4px;
    }

    .totals-row {
        display: flex;
        justify-content: space-between;
        margin-bottom: 12px;
        color: var(--text);
        font-size: 14px;
    }
    
    .final-total {
        display: flex;
        justify-content: space-between;
        margin-top: 20px;
        padding-top: 20px;
        border-top: 2px solid var(--black);
        font-weight: 800;
        font-size: 20px;
        color: var(--black);
    }
    
    /* Payment Method */
    .payment-method {
        background: var(--white);
        border: 2px solid var(--black);
        padding: 20px;
        border-radius: 8px;
        margin: 25px 0;
        display: flex;
        align-items: center;
        gap: 15px;
    }
    
    .pay-radio {
        width: 20px;
        height: 20px;
        accent-color: var(--black);
    }
    
    .pay-label {
        font-weight: 700;
        color: var(--black);
        font-size: 15px;
    }
    
    .pay-desc {
        font-size: 12px;
        color: var(--text-light);
        margin-top: 5px;
        display: block;
    }
    
    .place-order-btn {
        width: 100%;
        padding: 18px;
        background: var(--black);
        color: var(--white);
        border: none;
        border-radius: 8px;
        font-weight: 700;
        text-transform: uppercase;
        letter-spacing: 1px;
        cursor: pointer;
        transition: background 0.3s;
        font-size: 15px;
    }
    
    .place-order-btn:hover {
        background: #333;
    }
    
    @media (max-width: 900px) {
        .checkout-container {
            grid-template-columns: 1fr;
            gap: 30px;
        }
        
        .order-summary-box {
            position: static;
            order: -1; /* Show summary first on mobile? Usually better after contact info, but let's keep standard flow */
            order: 1; /* Standard flow: Details -> Payment */
        }
        
        .form-row {
            grid-template-columns: 1fr;
            gap: 0;
        }
    }
</style>
@endpush

@section('content')
<div class="checkout-page">
    <div class="checkout-container">
        <!-- Shipping Details -->
        <div class="checkout-left">
            <h2 class="section-title">Shipping Address</h2>
            <form id="shippingForm" action="#" method="POST">
                <div class="form-row">
                    <div class="form-group">
                        <label>First Name</label>
                        <input type="text" class="form-control" placeholder="Neraj" required>
                    </div>
                    <div class="form-group">
                        <label>Last Name</label>
                        <input type="text" class="form-control" placeholder="Lal" required>
                    </div>
                </div>
                
                <div class="form-group">
                    <label>Email Address</label>
                    <input type="email" class="form-control" placeholder="neraj@example.com" required>
                </div>
                
                <div class="form-group">
                    <label>Street Address</label>
                    <input type="text" class="form-control" placeholder="House number and street name" required>
                </div>
                
                <div class="form-group">
                    <label>Apartment, suite, etc. (optional)</label>
                    <input type="text" class="form-control" placeholder="">
                </div>
                
                <div class="form-row">
                    <div class="form-group">
                        <label>City</label>
                        <input type="text" class="form-control" placeholder="Mumbai" required>
                    </div>
                    <div class="form-group">
                        <label>State / Province</label>
                        <select class="form-control" required>
                            <option value="">Select State</option>
                            <option value="MH">Maharashtra</option>
                            <option value="DL">Delhi</option>
                            <option value="KA">Karnataka</option>
                            <option value="TN">Tamil Nadu</option>
                            <!-- Add more as needed -->
                        </select>
                    </div>
                </div>
                
                <div class="form-row">
                    <div class="form-group">
                        <label>ZIP / Postal Code</label>
                        <input type="text" class="form-control" placeholder="400001" required>
                    </div>
                    <div class="form-group">
                        <label>Phone Number</label>
                        <input type="tel" class="form-control" placeholder="+91 98765 43210" required>
                    </div>
                </div>
                
                <div class="form-group">
                    <label>Order Notes (Optional)</label>
                    <textarea class="form-control" rows="3" placeholder="Notes about your order, e.g. special notes for delivery."></textarea>
                </div>
            </form>
        </div>
        
        <!-- Order Summary -->
        <div class="checkout-right">
            <div class="order-summary-box">
                <h2 class="section-title">Your Order</h2>
                
                <div class="cart-items-review">
                    <div class="summary-item">
                        <div>
                            <div class="prod-name">Purple Mystique</div>
                            <div class="prod-meta">Qty: 1</div>
                        </div>
                        <div class="prod-price">₹1,500</div>
                    </div>
                    <div class="summary-item">
                        <div>
                            <div class="prod-name">Dark Oud</div>
                            <div class="prod-meta">Qty: 1</div>
                        </div>
                        <div class="prod-price">₹2,200</div>
                    </div>
                </div>
                
                <div style="margin: 20px 0; border-top: 1px solid #ddd; padding-top: 20px;">
                    <div class="totals-row">
                        <span>Subtotal</span>
                        <span>₹3,700</span>
                    </div>
                    <div class="totals-row">
                        <span>Shipping</span>
                        <span style="color: green; font-weight: 600;">Free</span>
                    </div>
                    <div class="final-total">
                        <span>Total</span>
                        <span>₹3,700</span>
                    </div>
                </div>
                
                <h3 style="font-size: 16px; font-weight: 700; margin-top: 30px; margin-bottom: 15px;">Payment Method</h3>
                
                <div class="payment-method">
                    <input type="radio" name="payment" id="cod" class="pay-radio" checked>
                    <div>
                        <label for="cod" class="pay-label">Cash on Delivery (COD)</label>
                        <span class="pay-desc">Pay with cash upon delivery. No extra charges.</span>
                    </div>
                </div>
                
                <p style="font-size: 12px; color: #666; margin-bottom: 20px; line-height: 1.6;">
                    Your personal data will be used to process your order, support your experience throughout this website, and for other purposes described in our <a href="#" style="color: var(--black); text-decoration: underline;">privacy policy</a>.
                </p>
                
                <button type="button" class="place-order-btn" onclick="placeOrder()">Place Crder</button>
            </div>
        </div>
    </div>
</div>

@push('scripts')
<script>
    function placeOrder() {
        const form = document.getElementById('shippingForm');
        if (form.checkValidity()) {
            // Show loading state
            const btn = document.querySelector('.place-order-btn');
            const originalText = btn.innerText;
            btn.innerText = 'Processing...';
            btn.disabled = true;
            
            setTimeout(() => {
                alert('Order Placed Successfully! Order ID: #NR-' + Math.floor(100000 + Math.random() * 900000));
                window.location.href = "{{ route('home') }}";
            }, 2000);
        } else {
            form.reportValidity();
        }
    }
</script>
@endpush
@endsection
