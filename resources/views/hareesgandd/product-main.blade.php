@extends('hareesgandd.layouts.app')

@section('title', 'Diamond Solitaire - Harees Gold Diamonds')

@push('styles')
<style>
    /* Image Gallery - Mobile Optimized */
    .image-gallery {
        position: relative;
    }

    .main-image-container {
        position: relative;
        width: 100%;
        aspect-ratio: 1;
        background: var(--bg-light);
        overflow: hidden;
    }

    .main-image {
        width: 100%;
        height: 100%;
        object-fit: cover;
    }

    .image-badge {
        position: absolute;
        top: 15px;
        left: 15px;
        background: var(--gold);
        color: var(--white);
        padding: 6px 15px;
        border-radius: 20px;
        font-size: 11px;
        font-weight: 700;
        text-transform: uppercase;
    }

    .image-dots {
        position: absolute;
        bottom: 15px;
        left: 50%;
        transform: translateX(-50%);
        display: flex;
        gap: 6px;
    }

    .image-dot {
        width: 6px;
        height: 6px;
        border-radius: 50%;
        background: rgba(0,0,0,0.2);
        transition: all 0.3s;
    }

    .image-dot.active {
        background: var(--black);
        transform: scale(1.2);
    }

    /* Product Info Column */
    .product-info {
        padding: 20px;
    }

    .product-header {
        margin-bottom: 20px;
    }

    .product-name {
        font-family: 'Playfair Display', serif;
        font-size: 28px;
        font-weight: 700;
        margin-bottom: 8px;
        color: var(--black);
    }

    .product-price {
        font-size: 20px;
        font-weight: 700;
        color: var(--black);
        margin-bottom: 10px;
    }

    .rating-row {
        display: flex;
        align-items: center;
        gap: 8px;
        font-size: 13px;
        margin-bottom: 15px;
    }

    .stars { color: var(--gold); }
    .rating-text { color: var(--text-light); text-decoration: underline; }

    /* Promo Banner */
    .promo-banner {
        background: #fdf6e9;
        border: 1px dashed var(--gold);
        padding: 10px 15px;
        border-radius: 8px;
        font-size: 12px;
        color: #8a6d3b;
        margin-bottom: 25px;
        display: flex;
        align-items: center;
        gap: 8px;
    }

    .promo-code {
        font-weight: 700;
        background: var(--white);
        padding: 2px 6px;
        border-radius: 4px;
        border: 1px solid #eaddcf;
    }

    /* Options Section */
    .option-section {
        margin-bottom: 25px;
    }

    .option-label {
        font-size: 13px;
        font-weight: 700;
        text-transform: uppercase;
        margin-bottom: 12px;
        display: block;
        color: var(--black);
        letter-spacing: 0.5px;
    }

    .size-options {
        display: flex;
        gap: 10px;
        flex-wrap: wrap;
    }

    .size-option {
        border: 1px solid #ddd;
        border-radius: 8px;
        padding: 10px 15px;
        cursor: pointer;
        transition: all 0.2s;
        text-align: center;
        min-width: 80px;
        display: flex;
        flex-direction: column;
        gap: 2px;
    }

    .size-option:hover { border-color: var(--black); }
    
    .size-option.active {
        border-color: var(--black);
        background: var(--black);
        color: var(--white);
    }

    .size-label { font-size: 14px; font-weight: 600; }

    /* Quantity */
    .quantity-section {
        display: flex;
        align-items: center;
        gap: 20px;
        margin-bottom: 30px;
    }

    .quantity-controls {
        display: flex;
        align-items: center;
        border: 1px solid #ddd;
        border-radius: 25px;
        padding: 5px;
    }

    .qty-btn {
        width: 30px;
        height: 30px;
        border-radius: 50%;
        border: none;
        background: transparent;
        font-size: 16px;
        display: flex;
        align-items: center;
        justify-content: center;
        cursor: pointer;
        transition: background 0.2s;
    }

    .qty-btn:hover { background: #f0f0f0; }
    .qty-display { width: 30px; text-align: center; font-weight: 600; font-size: 14px; }

    /* Bottom Action Bar (Mobile Sticky) */
    .sticky-bottom {
        position: fixed;
        bottom: 0;
        left: 0;
        right: 0;
        padding: 15px 20px 20px;
        background: var(--white);
        box-shadow: 0 -5px 20px rgba(0,0,0,0.05);
        display: flex;
        gap: 10px;
        z-index: 100;
    }

    .add-to-cart-btn {
        flex: 1;
        padding: 15px;
        background: var(--white);
        border: 2px solid var(--black);
        color: var(--black);
        font-weight: 700;
        border-radius: 30px;
        cursor: pointer;
        font-size: 14px;
        text-transform: uppercase;
        letter-spacing: 0.5px;
    }

    .buy-now-btn {
        flex: 1;
        padding: 15px;
        background: var(--black);
        color: var(--white);
        border: none;
        font-weight: 700;
        border-radius: 30px;
        cursor: pointer;
        font-size: 14px;
        text-transform: uppercase;
        letter-spacing: 0.5px;
        box-shadow: 0 5px 15px rgba(0,0,0,0.2);
    }

    /* Notes Card */
    .notes-card {
        background: #f9f9f9;
        border-radius: 12px;
        padding: 20px;
        margin-bottom: 30px;
    }

    .notes-title {
        font-weight: 700;
        font-family: 'Playfair Display', serif;
        margin-bottom: 15px;
        font-size: 16px;
    }
    
    .note-item { margin-bottom: 12px; display: flex; align-items: baseline; gap: 10px; }
    .note-item:last-child { margin-bottom: 0; }
    .note-type { font-size: 11px; font-weight: 700; text-transform: uppercase; color: var(--text-light); width: 80px; }
    .note-list { font-size: 14px; font-weight: 500; color: var(--black); }

    /* Accordions */
    .details-section { border-top: 1px solid #eee; }
    .accordion-header {
        padding: 20px 0;
        border-bottom: 1px solid #eee;
        display: flex;
        justify-content: space-between;
        align-items: center;
        cursor: pointer;
    }

    .accordion-title { font-weight: 600; font-size: 14px; text-transform: uppercase; letter-spacing: 0.5px; }
    .accordion-icon { transition: transform 0.3s; font-size: 12px; }
    .accordion-header.active .accordion-icon { transform: rotate(180deg); }
    .accordion-content {
        max-height: 0;
        overflow: hidden;
        transition: max-height 0.3s ease-out;
    }
    .accordion-content.active { max-height: 500px; }
    .accordion-text { padding: 0 0 20px; font-size: 14px; line-height: 1.6; color: var(--text-light); }

    .detail-highlight { background: #fdfbf7; padding: 15px; border-radius: 8px; margin-bottom: 15px; border-left: 3px solid var(--gold); }
    .highlight-badge { display: inline-block; background: var(--black); color: var(--gold); font-size: 10px; font-weight: 700; padding: 3px 8px; border-radius: 4px; margin-bottom: 8px; text-transform: uppercase; }
    .highlight-text { font-size: 13px; font-style: italic; color: #555; margin: 0; }

    /* Reviews Section */
    .reviews-section { margin-top: 40px; border-top: 1px solid var(--border); padding-top: 40px; }
    .reviews-header { display: flex; justify-content: space-between; align-items: center; margin-bottom: 25px; }
    .reviews-title { font-family: 'Playfair Display', serif; font-size: 24px; font-weight: 700; }
    
    .reviews-summary { 
        background: #f9f9f9; 
        padding: 20px; 
        border-radius: 12px; 
        text-align: center; 
        margin-bottom: 30px;
    }
    .review-score { font-size: 48px; font-weight: 700; line-height: 1; margin-bottom: 5px; color: var(--black); }
    .review-stars { margin-bottom: 5px; color: var(--gold); font-size: 18px; }
    .review-count { font-size: 13px; color: var(--text-light); }

    .review-card { border-bottom: 1px solid #eee; padding-bottom: 20px; margin-bottom: 20px; }
    .review-header { display: flex; justify-content: space-between; margin-bottom: 10px; }
    .reviewer-name { font-weight: 700; font-size: 14px; margin-bottom: 2px; }
    .review-stars-small { font-size: 12px; color: var(--gold); }
    .review-text { font-size: 14px; line-height: 1.6; color: var(--text); }
    .review-label { 
        display: inline-block; 
        border: 1px solid #eee; 
        padding: 4px 10px; 
        border-radius: 15px; 
        font-size: 11px; 
        margin-bottom: 8px; 
        background: #fff;
        color: var(--text-light);
    }

    /* FAQ Section */
    .faq-section { margin-top: 40px; margin-bottom: 80px; }
    .faq-title { font-family: 'Playfair Display', serif; font-size: 20px; font-weight: 700; margin-bottom: 20px; }
    .faq-item { border-bottom: 1px solid #eee; }
    .faq-question { padding: 15px 0; cursor: pointer; display: flex; justify-content: space-between; font-weight: 600; font-size: 14px; }
    .faq-toggle { font-size: 18px; font-weight: 300; }
    .faq-question.active .faq-toggle { transform: rotate(45deg); }
    .faq-answer { max-height: 0; overflow: hidden; transition: max-height 0.3s; }
    .faq-answer.active { max-height: 200px; }
    .faq-answer-text { padding-bottom: 15px; font-size: 13px; line-height: 1.6; color: var(--text-light); }

    /* Desktop Product Layout */
    @media (min-width: 900px) {
        .product-main-wrapper {
            display: grid;
            grid-template-columns: 1.2fr 1fr;
            gap: 50px;
            max-width: 1200px;
            margin: 0 auto;
            padding: 40px 20px;
        }

        .main-image-container { border-radius: 12px; }
        .thumbnail-strip {
             display: flex; gap: 10px; margin-top: 15px;
        }
        .thumbnail {
            width: 80px; height: 80px; border-radius: 8px; object-fit: cover; cursor: pointer; border: 2px solid transparent; opacity: 0.7; transition: all 0.2s;
        }
        .thumbnail.active { border-color: var(--black); opacity: 1; }
        
        .product-info-column { padding-top: 10px; }
        .product-info { max-width: 100%; padding: 0; }
        .product-name { font-size: 42px; }
        
        .sticky-bottom {
            position: relative; box-shadow: none; padding: 20px 0; background: transparent; width: 100%; max-width: 100%; 
            margin-top: 30px; border-top: 1px solid var(--border);
        }
        .add-to-cart-btn, .buy-now-btn { padding: 18px; font-size: 16px; }
        .mobile-header-back { display: none !important; }
        .footer-spacer { display: none; }
    }

    /* Related Products CSS */
    .related-products-section { margin-top: 40px; padding-bottom: 20px; background: var(--white); }
    .related-scroll-container { display: flex; gap: 15px; overflow-x: auto; padding: 0 20px 20px; scrollbar-width: none; -ms-overflow-style: none; }
    .related-scroll-container::-webkit-scrollbar { display: none; }
    
    .product-card { background: var(--white); border-radius: 12px; overflow: hidden; box-shadow: 0 2px 8px rgba(0,0,0,0.08); position: relative; text-decoration: none; color: inherit; display: block; cursor: pointer; flex-shrink: 0; min-width: 170px; max-width: 170px; }
    .product-image-wrapper { position: relative; width: 100%; aspect-ratio: 1; overflow: hidden; background: var(--bg-light); }
    .product-image { width: 100%; height: 100%; object-fit: cover; transition: transform 0.3s; }
    .product-card:hover .product-image { transform: scale(1.05); }
    .product-badge { position: absolute; top: 8px; left: 8px; background: var(--gold); color: var(--white); padding: 4px 10px; border-radius: 12px; font-size: 9px; font-weight: 700; text-transform: uppercase; }
    .favorite-btn { position: absolute; top: 8px; right: 8px; background: var(--white); width: 32px; height: 32px; border-radius: 50%; border: none; display: flex; align-items: center; justify-content: center; font-size: 16px; cursor: pointer; box-shadow: 0 2px 8px rgba(0,0,0,0.15); color: var(--black); }
    .product-card .product-info { padding: 12px; text-align: left; }
    .product-card .product-name { font-family: 'Playfair Display', serif; font-size: 15px; font-weight: 700; color: var(--black); margin: 0 0 6px 0; white-space: nowrap; overflow: hidden; text-overflow: ellipsis; }
    .product-card .product-price { font-size: 14px; font-weight: 700; color: var(--text); margin: 0 0 10px 0; }
    .quick-view-btn { width: 100%; padding: 8px; background: var(--black); color: var(--white); border: none; border-radius: 8px; font-weight: 700; font-size: 12px; text-transform: uppercase; cursor: pointer; }

    @media (min-width: 900px) {
        .related-products-section { max-width: 1200px; margin: 0 auto; padding: 40px 20px; }
        .product-card { min-width: 240px; max-width: 240px; }
        .quick-view-btn { padding: 10px; }
    }
</style>
@endpush

@section('content')

    <!-- Mini Header with Back Button (Mobile Only) -->
    <div class="mobile-header-back" style="background:var(--white); padding:10px 15px; display:flex; align-items:center; gap:10px; border-bottom:1px solid #eee;">
        <button onclick="history.back()" style="border:none; background:none; font-size:24px; cursor:pointer;">←</button>
        <span style="font-family:'Playfair Display',serif; font-weight:700; font-size:18px;">Product Details</span>
    </div>

    <div class="product-main-wrapper">
        <!-- Left Column: Gallery -->
        <div class="product-gallery-column">
            <div class="image-gallery">
                <div class="main-image-container">
                    <span class="image-badge">Bestseller</span>
                    <img src="{{ asset('Images/product-sandal-veer.webp') }}" alt="Diamond Solitaire" class="main-image" id="mainImage">
                </div>
                <div class="thumbnail-strip">
                    <img src="{{ asset('Images/product-sandal-veer.webp') }}" data-full-img="{{ asset('Images/product-sandal-veer.webp') }}" class="thumbnail active" onclick="changeImage(this, 0)" alt="View 1">
                    <img src="{{ asset('Images/product-sandal-veer.webp') }}" data-full-img="{{ asset('Images/product-sandal-veer.webp') }}" class="thumbnail" onclick="changeImage(this, 1)" alt="View 2">
                    <img src="{{ asset('Images/product-sandal-veer.webp') }}" data-full-img="{{ asset('Images/product-sandal-veer.webp') }}" class="thumbnail" onclick="changeImage(this, 2)" alt="View 3">
                </div>
            </div>
        </div>

        <!-- Right Column: Product Info -->
        <div class="product-info-column">
            <div class="product-info">
                <div class="product-header">
                    <h1 class="product-name">Diamond Solitaire</h1>
                    <div class="product-price" id="productPrice">₹45,129</div>
                    <div class="rating-row">
                        <span class="stars">⭐⭐⭐⭐⭐</span>
                        <span class="rating-text">5.0 (2 reviews)</span>
                    </div>
                </div>

                <!-- Promo Banner -->
                <div class="promo-banner">
                    🎁 FIRST ORDER OFFER! Use code: <span class="promo-code">FIRSTGOLD20</span>
                </div>

                <!-- Size Selection -->
                <div class="option-section">
                    <label class="option-label">Ring Size</label>
                    <div class="size-options">
                        <div class="size-option active" data-price="45129" onclick="selectSize(this)">
                            <span class="size-label">Size 6</span>
                        </div>
                        <div class="size-option" data-price="45129" onclick="selectSize(this)">
                            <span class="size-label">Size 7</span>
                        </div>
                        <div class="size-option" data-price="45129" onclick="selectSize(this)">
                            <span class="size-label">Size 8</span>
                        </div>
                    </div>
                </div>

                <!-- Details Card -->
                <div class="notes-card">
                    <div class="notes-title">Product Specifications</div>
                    <div class="note-item">
                        <div class="note-type">Material</div>
                        <div class="note-list">18K Yellow Gold</div>
                    </div>
                    <div class="note-item">
                        <div class="note-type">Stone</div>
                        <div class="note-list">Natural Diamond (VS1, G-H)</div>
                    </div>
                    <div class="note-item">
                        <div class="note-type">Weight</div>
                        <div class="note-list">Approx. 3.5g</div>
                    </div>
                </div>

                <!-- Quantity -->
                <div class="quantity-section">
                    <label class="option-label" style="margin: 0;">Quantity</label>
                    <div class="quantity-controls">
                        <button class="qty-btn" onclick="decreaseQty()">−</button>
                        <div class="qty-display" id="quantity">1</div>
                        <button class="qty-btn" onclick="increaseQty()">+</button>
                    </div>
                </div>

                 <!-- Action Buttons -->
                 <div class="sticky-bottom">
                    <button class="add-to-cart-btn" onclick="addToCart()">
                        Add to Cart
                    </button>
                    <button class="buy-now-btn" onclick="window.location.href='/checkout'">
                        Buy Now
                    </button>
                </div>

                <!-- Product Details Accordion -->
                <div class="details-section">
                    <div class="detail-accordion">
                        <div class="accordion-header" onclick="toggleAccordion(this)">
                            <span class="accordion-title">Description</span>
                            <span class="accordion-icon">▼</span>
                        </div>
                        <div class="accordion-content active">
                            <div class="accordion-text">
                                <strong>Timeless. Elegant. Eternal.</strong>
                                <br><br>
                                A classic solitaire ring that speaks volumes of love and commitment. Expertly crafted in 18K yellow gold, featuring a brilliant-cut center diamond that captures every ray of light.
                                <br><br>
                                This piece is designed for everyday elegance, comfortable to wear and secure in its setting. A perfect choice for engagements or as a statement of self-love.
                            </div>
                        </div>
                    </div>

                    <div class="detail-accordion">
                        <div class="accordion-header" onclick="toggleAccordion(this)">
                            <span class="accordion-title">Certification</span>
                            <span class="accordion-icon">▼</span>
                        </div>
                        <div class="accordion-content">
                            <div class="detail-highlight">
                                <span class="highlight-badge">BIS Hallmarked</span>
                                <p class="highlight-text">Authenticity guaranteed with IGI Certified Diamonds.</p>
                            </div>
                            <div class="accordion-text">
                                • 100% Certified Jewelry<br>
                                • BIS Hallmarked Gold<br>
                                • IGI/GIA Certified Diamonds<br>
                                • Lifetime Exchange & Buyback Policy
                            </div>
                        </div>
                    </div>

                    <div class="detail-accordion">
                        <div class="accordion-header" onclick="toggleAccordion(this)">
                            <span class="accordion-title">Shipping & Returns</span>
                            <span class="accordion-icon">▼</span>
                        </div>
                        <div class="accordion-content">
                            <div class="accordion-text">
                                <strong>Shipping:</strong><br>
                                • Insured Shipping across India<br>
                                • Delivery within 5-7 business days<br><br>
                                <strong>Returns:</strong><br>
                                • 7-day no-questions-asked return policy<br>
                                • Product must be unused and with original tags
                            </div>
                        </div>
                    </div>
                </div>

                <!-- Reviews -->
                <div class="reviews-section">
                    <div class="reviews-header">
                        <h2 class="reviews-title">Customer Reviews</h2>
                        <button style="background: none; border: none; color: var(--gold); font-weight: 700; font-size: 14px;">Write Review</button>
                    </div>

                    <div class="reviews-summary">
                        <div class="review-score">5.0</div>
                        <div class="review-stars">⭐⭐⭐⭐⭐</div>
                        <div class="review-count">Based on 2 reviews</div>
                    </div>

                    <div class="review-card">
                        <div class="review-header">
                            <div>
                                <div class="reviewer-name">Lipsa Dhar</div>
                                <div class="review-stars-small">⭐⭐⭐⭐⭐</div>
                            </div>
                        </div>
                        <div class="review-text">
                            <div class="review-label">Design</div>
                            Absolutely stunning finish!
                        </div>
                    </div>

                    <div class="review-card">
                        <div class="review-header">
                            <div>
                                <div class="reviewer-name">Ajmal K.</div>
                                <div class="review-stars-small">⭐⭐⭐⭐⭐</div>
                            </div>
                        </div>
                        <div class="review-text">
                            <div class="review-label">Quality</div>
                            Excellent quality and packaging.
                        </div>
                    </div>
                </div>

                <!-- FAQs -->
                <div class="faq-section">
                    <h2 class="faq-title">Frequently Asked</h2>

                    <div class="faq-item">
                        <div class="faq-question" onclick="toggleFAQ(this)">
                            <span class="faq-q-text">Is the gold hallmarked?</span>
                            <span class="faq-toggle">+</span>
                        </div>
                        <div class="faq-answer">
                            <div class="faq-answer-text">
                                Yes, every piece of gold jewelry from Harees Gold Diamonds is BIS Hallmarked, ensuring purity and quality.
                            </div>
                        </div>
                    </div>

                    <div class="faq-item">
                        <div class="faq-question" onclick="toggleFAQ(this)">
                            <span class="faq-q-text">Does it come with a certificate?</span>
                            <span class="faq-toggle">+</span>
                        </div>
                        <div class="faq-answer">
                            <div class="faq-answer-text">
                                Absolutely. All diamond jewelry is accompanied by a certificate of authenticity from reputed laboratories like IGI or GIA.
                            </div>
                        </div>
                    </div>

                    <div class="faq-item">
                        <div class="faq-question" onclick="toggleFAQ(this)">
                            <span class="faq-q-text">How do I clean my jewelry?</span>
                            <span class="faq-toggle">+</span>
                        </div>
                        <div class="faq-answer">
                            <div class="faq-answer-text">
                                We recommend using a soft cloth to wipe your jewelry after use. Dip in mild soapy water and brush gently for a deep clean occasionally.
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- Related Products -->
    <div class="related-products-section">
        <h2 class="reviews-title" style="margin: 0 0 20px 20px; font-size: 20px;">You May Also Like</h2>
        <div class="related-scroll-container">
            
            <div class="product-card" onclick="window.location.href='{{ route('product') }}'">
                <div class="product-image-wrapper">
                    <span class="product-badge">New</span>
                    <img src="{{ asset('Images/product-marshmallow-fluff.webp') }}" class="product-image" alt="Gold Choker">
                </div>
                <div class="product-info">
                    <h3 class="product-name">Gold Choker</h3>
                    <p class="product-price">₹85,129</p>
                    <button class="quick-view-btn" onclick="event.stopPropagation(); addToCart()">Add to Cart</button>
                </div>
            </div>

            <div class="product-card" onclick="window.location.href='{{ route('product') }}'">
                <div class="product-image-wrapper">
                    <img src="{{ asset('Images/product-purple-mystique.webp') }}" class="product-image" alt="Sapphire Drops">
                </div>
                <div class="product-info">
                    <h3 class="product-name">Sapphire Drops</h3>
                    <p class="product-price">₹25,129</p>
                    <button class="quick-view-btn" onclick="event.stopPropagation(); addToCart()">Add to Cart</button>
                </div>
            </div>

            <div class="product-card" onclick="window.location.href='{{ route('product') }}'">
                <div class="product-image-wrapper">
                    <img src="{{ asset('Images/product-bangalore-bloom.webp') }}" class="product-image" alt="Emerald Pendant">
                </div>
                <div class="product-info">
                    <h3 class="product-name">Emerald Pendant</h3>
                    <p class="product-price">₹32,129</p>
                    <button class="quick-view-btn" onclick="event.stopPropagation(); addToCart()">Add to Cart</button>
                </div>
            </div>

            <div class="product-card" onclick="window.location.href='{{ route('product') }}'">
                <div class="product-image-wrapper">
                    <img src="{{ asset('Images/product-fruit-punch.webp') }}" class="product-image" alt="Ruby Bracelet">
                </div>
                <div class="product-info">
                    <h3 class="product-name">Ruby Bracelet</h3>
                    <p class="product-price">₹48,129</p>
                    <button class="quick-view-btn" onclick="event.stopPropagation(); addToCart()">Add to Cart</button>
                </div>
            </div>

        </div>
    </div>

    <!-- Toast Notification -->
    <div class="toast" id="toast">Added to cart! 🎉</div>

@endsection

@push('scripts')
<script>
(function() {
    let quantity = 1;
    let currentPrice = 45129;

    window.changeImage = function(thumbnail, index) {
        const mainImage = document.getElementById('mainImage');
        const thumbnails = document.querySelectorAll('.thumbnail');
        if (!mainImage) return;
        mainImage.src = thumbnail.getAttribute('data-full-img');
        thumbnails.forEach(t => t.classList.remove('active'));
        thumbnail.classList.add('active');
    };

    window.selectSize = function(element) {
        document.querySelectorAll('.size-option').forEach(opt => opt.classList.remove('active'));
        element.classList.add('active');
    };

    window.increaseQty = function() {
        quantity++;
        document.getElementById('quantity').textContent = quantity;
    };

    window.decreaseQty = function() {
        if (quantity > 1) {
            quantity--;
            document.getElementById('quantity').textContent = quantity;
        }
    };

    window.addToCart = function() {
        const toast = document.getElementById('toast');
        if(toast) {
            toast.classList.add('show');
            setTimeout(() => toast.classList.remove('show'), 2000);
        }
        const cartCount = document.querySelector('.cart-count');
        if(cartCount) {
             const currentCount = parseInt(cartCount.textContent) || 0;
             cartCount.textContent = currentCount + quantity;
        }
    };

    window.toggleAccordion = function(header) {
        const content = header.nextElementSibling;
        const isActive = header.classList.contains('active');
        // document.querySelectorAll('.accordion-header').forEach(h => {
        //     h.classList.remove('active');
        //     h.nextElementSibling.classList.remove('active');
        // });
        if (!isActive) {
            header.classList.add('active');
            content.classList.add('active');
        } else {
            header.classList.remove('active');
            content.classList.remove('active');
        }
    };

    window.toggleFAQ = function(question) {
        const answer = question.nextElementSibling;
        question.classList.toggle('active');
        answer.classList.toggle('active');
    };
})();
</script>
@endpush