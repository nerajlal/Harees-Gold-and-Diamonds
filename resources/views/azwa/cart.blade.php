@extends('nurah.layouts.app')

@section('title', 'Shopping Cart - Nurah Perfumes')

@push('styles')
<style>
    .cart-page {
        padding: 40px 20px;
        max-width: 1200px;
        margin: 0 auto;
        min-height: 60vh;
    }
    
    .page-title {
        font-family: 'Playfair Display', serif;
        font-size: 32px;
        font-weight: 700;
        margin-bottom: 30px;
        text-align: center;
        color: var(--black);
    }
    
    .cart-container {
        display: grid;
        grid-template-columns: 2fr 1fr;
        gap: 40px;
    }
    
    /* Cart Items */
    .cart-items {
        background: var(--white);
        border-radius: 12px;
        border: 1px solid var(--border);
        overflow: hidden;
    }
    
    .cart-header {
        display: grid;
        grid-template-columns: 2fr 1fr 1fr 0.5fr;
        padding: 15px 20px;
        background: var(--bg-light);
        border-bottom: 1px solid var(--border);
        font-weight: 700;
        font-size: 13px;
        text-transform: uppercase;
        color: var(--text-light);
    }
    
    .cart-item {
        display: grid;
        grid-template-columns: 2fr 1fr 1fr 0.5fr;
        padding: 20px;
        border-bottom: 1px solid var(--border);
        align-items: center;
    }
    
    .cart-item:last-child {
        border-bottom: none;
    }
    
    .item-info {
        display: flex;
        gap: 15px;
        align-items: center;
    }
    
    .item-image {
        width: 80px;
        height: 80px;
        border-radius: 8px;
        object-fit: cover;
        background: var(--bg-light);
    }
    
    .item-details h3 {
        font-family: 'Playfair Display', serif;
        font-size: 16px;
        margin-bottom: 5px;
        color: var(--black);
    }
    
    .item-price {
        font-weight: 600;
        color: var(--text);
    }
    
    .item-quantity {
        display: flex;
        align-items: center;
        gap: 10px;
    }
    
    .qty-btn {
        width: 28px;
        height: 28px;
        border: 1px solid var(--border);
        background: var(--white);
        border-radius: 4px;
        cursor: pointer;
        display: flex;
        align-items: center;
        justify-content: center;
        font-size: 14px;
        color: var(--text);
    }
    
    .qty-input {
        width: 30px;
        text-align: center;
        border: none;
        font-weight: 600;
    }
    
    .item-total {
        font-weight: 700;
        color: var(--black);
    }
    
    .remove-btn {
        background: none;
        border: none;
        color: #ff3b30;
        cursor: pointer;
        font-size: 16px;
        opacity: 0.7;
        transition: opacity 0.3s;
    }
    
    .remove-btn:hover {
        opacity: 1;
    }
    
    /* Order Summary */
    .cart-summary {
        background: var(--bg-light);
        padding: 25px;
        border-radius: 12px;
        height: fit-content;
    }
    
    .summary-title {
        font-family: 'Playfair Display', serif;
        font-size: 20px;
        margin-bottom: 20px;
        padding-bottom: 10px;
        border-bottom: 1px solid #ddd;
    }
    
    .summary-row {
        display: flex;
        justify-content: space-between;
        margin-bottom: 15px;
        font-size: 14px;
        color: var(--text);
    }
    
    .summary-total {
        display: flex;
        justify-content: space-between;
        margin-top: 20px;
        padding-top: 20px;
        border-top: 1px solid #ddd;
        font-weight: 800;
        font-size: 18px;
        color: var(--black);
    }
    
    .checkout-btn {
        width: 100%;
        padding: 15px;
        background: var(--black);
        color: var(--white);
        border: none;
        border-radius: 8px;
        font-weight: 700;
        text-transform: uppercase;
        margin-top: 25px;
        cursor: pointer;
        transition: background 0.3s;
    }
    
    .checkout-btn:hover {
        background: #333;
    }
    
    .continue-shopping {
        display: block;
        text-align: center;
        margin-top: 15px;
        color: var(--text-light);
        text-decoration: underline;
        font-size: 13px;
    }
    
    /* Empty State */
    .empty-cart {
        text-align: center;
        padding: 60px 20px;
        display: none; /* Hidden by default */
    }
    
    .empty-icon {
        font-size: 60px;
        color: var(--border);
        margin-bottom: 20px;
    }
    
    @media (max-width: 768px) {
        .cart-container {
            grid-template-columns: 1fr;
        }
        
        .cart-header {
            display: none; /* Hide header on mobile */
        }
        
        .cart-item {
            grid-template-columns: 1fr;
            gap: 15px;
            position: relative;
        }
        
        .item-info {
            width: 100%;
        }
        
        .remove-btn {
            position: absolute;
            top: 20px;
            right: 20px;
        }
        
        .item-quantity, .item-total {
            justify-content: space-between;
            width: 100%;
            display: flex;
        }
        
        .item-quantity::before {
            content: 'Quantity:';
            font-size: 13px;
            color: var(--text-light);
        }
        
        .item-total {
            margin-top: 10px;
            padding-top: 10px;
            border-top: 1px dashed var(--border);
        }
        
        .item-total::before {
            content: 'Total:';
        }
    }
</style>
@endpush

@section('content')
<div class="cart-page">
    <h1 class="page-title">Shopping Cart</h1>
    
    <!-- Cart populated -->
    <div class="cart-container" id="cartContainer">
        <div class="cart-items">
            <div class="cart-header">
                <div>Product</div>
                <div>Price</div>
                <div>Quantity</div>
                <div>Total</div>
                <div></div>
            </div>
            
            <!-- Sample Item 1 -->
            <div class="cart-item">
                <div class="item-info">
                    <img src="{{ asset('Images/product-purple-mystique.webp') }}" alt="Purple Mystique" class="item-image">
                    <div class="item-details">
                        <h3>Purple Mystique</h3>
                        <p style="font-size: 12px; color: #666;">EDP - 100ml</p>
                    </div>
                </div>
                <div class="item-price">₹1,500</div>
                <div class="item-quantity">
                    <button class="qty-btn minus">-</button>
                    <input type="text" value="1" class="qty-input" readonly>
                    <button class="qty-btn plus">+</button>
                </div>
                <div class="item-total">₹1,500</div>
                <button class="remove-btn"><i class="fas fa-trash"></i></button>
            </div>
            
            <!-- Sample Item 2 -->
            <div class="cart-item">
                <div class="item-info">
                    <img src="{{ asset('Images/product-dark-oud.webp') }}" alt="Dark Oud" class="item-image">
                    <div class="item-details">
                        <h3>Dark Oud</h3>
                        <p style="font-size: 12px; color: #666;">EDP - 50ml</p>
                    </div>
                </div>
                <div class="item-price">₹2,200</div>
                <div class="item-quantity">
                    <button class="qty-btn minus">-</button>
                    <input type="text" value="1" class="qty-input" readonly>
                    <button class="qty-btn plus">+</button>
                </div>
                <div class="item-total">₹2,200</div>
                <button class="remove-btn"><i class="fas fa-trash"></i></button>
            </div>
        </div>
        
        <div class="cart-summary">
            <h2 class="summary-title">Order Summary</h2>
            <div class="summary-row">
                <span>Subtotal</span>
                <span>₹3,700</span>
            </div>
            <div class="summary-row">
                <span>Shipping</span>
                <span class="text-success">Free</span>
            </div>
            <div class="summary-total">
                <span>Total</span>
                <span>₹3,700</span>
            </div>
            <a href="{{ route('checkout') }}" class="checkout-btn" style="text-decoration: none; display: block; text-align: center;">Proceed to Checkout</a>
            <a href="{{ route('collection') }}" class="continue-shopping">Continue Shopping</a>
        </div>
    </div>
    
    <!-- Empty State -->
    <div class="empty-cart" id="emptyCart">
        <div class="empty-icon"><i class="fas fa-shopping-bag"></i></div>
        <h2>Your cart is empty</h2>
        <p class="mb-20">Looks like you haven't added any perfumes yet.</p>
        <a href="{{ route('collection') }}" class="checkout-btn" style="display: inline-block; width: auto; padding: 12px 30px;">Start Shopping</a>
    </div>
</div>

@push('scripts')
<script>
    // Simple Qty Logic (Frontend Demo)
    document.querySelectorAll('.qty-btn').forEach(btn => {
        btn.addEventListener('click', function() {
            const input = this.parentElement.querySelector('.qty-input');
            let val = parseInt(input.value);
            
            if (this.classList.contains('plus')) {
                val++;
            } else {
                if (val > 1) val--;
            }
            input.value = val;
            
            // Note: In a real app, you'd trigger an AJAX update here to recalculate totals
            updateTotals();
        });
    });
    
    document.querySelectorAll('.remove-btn').forEach(btn => {
        btn.addEventListener('click', function() {
            if(confirm('Remove this item?')) {
                const item = this.closest('.cart-item');
                item.remove();
                
                if (document.querySelectorAll('.cart-item').length === 0) {
                    document.getElementById('cartContainer').style.display = 'none';
                    document.getElementById('emptyCart').style.display = 'block';
                }
                updateTotals();
            }
        });
    });
    
    function updateTotals() {
        let total = 0;
        document.querySelectorAll('.cart-item').forEach(item => {
            const priceStr = item.querySelector('.item-price').textContent.replace(/[^\d]/g, '');
            const qty = parseInt(item.querySelector('.qty-input').value);
            const price = parseInt(priceStr);
            
            // Update individual item total
            const itemTotal = price * qty;
            item.querySelector('.item-total').textContent = '₹' + itemTotal.toLocaleString();
            
            total += itemTotal;
        });
        
        document.querySelector('.summary-row span:last-child').textContent = '₹' + total.toLocaleString();
        document.querySelector('.summary-total span:last-child').textContent = '₹' + total.toLocaleString();
    }
</script>
@endpush
@endsection
