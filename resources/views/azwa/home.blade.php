@extends('azwa.layouts.app')

@section('title', 'Timeless Jewelry Elegance')

@push('styles')
<style>
    /* Global Overrides */
    body { background-color: #fcfcfc; }
    
    /* Hero Slider */
    .hero-slider { position: relative; width: 100%; height: 85vh; overflow: hidden; }
    .slide { position: absolute; inset: 0; opacity: 0; transition: opacity 1.5s ease; transform: scale(1.05); transition: transform 6s ease, opacity 1.5s ease; }
    .slide.active { opacity: 1; transform: scale(1); }
    .slide img { width: 100%; height: 100%; object-fit: cover; object-position: center; }
    .hero-content {
        position: absolute; bottom: 80px; left: 50%; transform: translateX(-50%);
        text-align: center; color: var(--white); z-index: 2; width: 90%;
    }
    .hero-title { font-family: 'Playfair Display', serif; font-size: 48px; margin-bottom: 20px; text-shadow: 0 2px 10px rgba(0,0,0,0.3); }
    .hero-btn { 
        display: inline-block; padding: 15px 40px; background: rgba(255,255,255,0.1); 
        backdrop-filter: blur(10px); border: 1px solid rgba(255,255,255,0.4); 
        color: var(--white); text-transform: uppercase; letter-spacing: 2px; 
        font-size: 12px; font-weight: 600; text-decoration: none; transition: all 0.3s;
    }
    .hero-btn:hover { background: var(--white); color: var(--black); }

    /* 3D Collections Carousel */
    .collections-section { padding: 80px 0; overflow: hidden; background: #fff; }
    .section-header { text-align: center; margin-bottom: 50px; }
    .section-title { font-family: 'Playfair Display', serif; font-size: 36px; color: var(--primary-color); position: relative; display: inline-block; }
    .section-title::after { content: ''; position: absolute; bottom: -10px; left: 50%; transform: translateX(-50%); width: 60px; height: 2px; background: var(--secondary-color); }
    
    .carousel-container {
        position: relative; width: 100%; height: 400px;
        perspective: 1000px; display: flex; justify-content: center; align-items: center;
    }
    .carousel {
        position: absolute; width: 250px; height: 350px;
        transform-style: preserve-3d; transition: transform 1s;
    }
    .carousel-item {
        position: absolute; width: 250px; height: 350px;
        background: #fff; border-radius: 20px; overflow: hidden;
        box-shadow: 0 10px 30px rgba(0,0,0,0.1); cursor: pointer;
        /* Computed in JS based on index */
    }
    .carousel-item img { width: 100%; height: 100%; object-fit: cover; transition: transform 0.5s; }
    .carousel-item:hover img { transform: scale(1.1); }
    .carousel-overlay {
        position: absolute; inset: 0; background: linear-gradient(to top, rgba(0,0,0,0.7), transparent);
        display: flex; flex-direction: column; justify-content: flex-end; padding: 25px;
        color: var(--white); text-align: center;
    }
    .carousel-title { font-family: 'Playfair Display', serif; font-size: 24px; margin-bottom: 5px; }
    .carousel-desc { font-size: 12px; text-transform: uppercase; letter-spacing: 1px; opacity: 0.8; }
    
    .carousel-controls { text-align: center; margin-top: 30px; }
    .control-btn { background: none; border: 1px solid var(--primary-color); color: var(--primary-color); width: 40px; height: 40px; border-radius: 50%; cursor: pointer; transition: all 0.3s; margin: 0 10px; }
    .control-btn:hover { background: var(--primary-color); color: var(--white); }

    .bestsellers-section { padding: 40px 10px; background: #fcfcfc; }
    .product-grid { 
        display: grid; grid-template-columns: repeat(2, 1fr); /* Mobile: 2 columns */
        gap: 15px; max-width: 1300px; margin: 0 auto; 
    }
    .product-card {
        background: transparent; border: none; overflow: hidden; position: relative;
        transition: transform 0.3s;
    }
    .product-image-box {
        position: relative; aspect-ratio: 4/5; overflow: hidden; border-radius: 8px;
        background: #f0f0f0; margin-bottom: 10px;
    }
    .product-image-box img { width: 100%; height: 100%; object-fit: cover; transition: transform 0.6s ease; }
    /* .product-card:hover .product-image-box img { transform: scale(1.08); } Removed zoom for cleaner mobile/desktop feel or keep it optional */
    
    .product-details { padding: 5px; }
    .product-row { display: flex; flex-direction: column; align-items: flex-start; margin-bottom: 10px; gap: 5px; }
    .product-name { font-family: 'Playfair Display', serif; font-size: 14px; color: var(--black); font-weight: 600; line-height: 1.2; }
    .product-price { font-weight: 700; color: var(--secondary-color); font-size: 14px; }
    
    .add-cart-btn {
        width: 100%; padding: 10px; background: var(--primary-color); color: var(--white);
        border: none; border-radius: 4px; font-weight: 600; text-transform: uppercase;
        font-size: 10px; letter-spacing: 1px; cursor: pointer; transition: all 0.3s;
        opacity: 1; transform: translateY(0); display: block; /* Always visible */
    }
    .add-cart-btn:hover { background: var(--secondary-color); }
    
    /* Desktop optimization */
    @media(min-width: 900px) {
        .product-grid { grid-template-columns: repeat(4, 1fr); gap: 30px; }
        .product-row { flex-direction: row; justify-content: space-between; align-items: center; }
        .product-name { font-size: 18px; max-width: 70%; }
        .product-price { font-size: 16px; }
        .add-cart-btn { padding: 12px; font-size: 12px; }
    }

    /* Shop By Gender */
    .gender-section { padding: 60px 20px; max-width: 1200px; margin: 0 auto; }
    .gender-grid { display: grid; grid-template-columns: repeat(3, 1fr); gap: 20px; }
    .gender-card { position: relative; height: 400px; border-radius: 4px; overflow: hidden; cursor: pointer; }
    .gender-card img { width: 100%; height: 100%; object-fit: cover; transition: transform 0.6s; }
    .gender-card:hover img { transform: scale(1.05); }
    .gender-overlay { position: absolute; inset: 0; background: rgba(0,0,0,0.2); display: flex; align-items: center; justify-content: center; transition: background 0.3s; }
    .gender-card:hover .gender-overlay { background: rgba(0,0,0,0.4); }
    .gender-title { font-family: 'Playfair Display', serif; font-size: 32px; color: var(--white); text-transform: uppercase; letter-spacing: 2px; text-shadow: 0 2px 10px rgba(0,0,0,0.3); border: 2px solid rgba(255,255,255,0.5); padding: 15px 30px; backdrop-filter: blur(2px); }

    @media (max-width: 768px) {
        .gender-grid { grid-template-columns: 1fr; }
        .gender-card { height: 250px; }
    }

    /* Cosmic/Wedding Section (Marquee) */
    .wedding-section {
        background: #06281e; /* Darker Emerald */
        color: var(--white); padding: 80px 0; text-align: center;
        overflow: hidden;
    }
    .wedding-content { max-width: 800px; margin: 0 auto 50px; padding: 0 20px; }
    .wedding-title { font-family: 'Playfair Display', serif; font-size: 42px; color: var(--secondary-color); margin-bottom: 20px; }
    .wedding-text { font-size: 16px; opacity: 0.9; margin-bottom: 30px; font-weight: 300; }
    
    .marquee-container { width: 100%; overflow: hidden; white-space: nowrap; position: relative; }
    .marquee-track { display: flex; gap: 20px; animation: scroll 30s linear infinite; width: max-content; }
    .wedding-item { 
        position: relative; width: 300px; height: 400px; flex-shrink: 0; 
        border-radius: 4px; overflow: hidden; cursor: pointer; 
    }
    .wedding-item img { width: 100%; height: 100%; object-fit: cover; opacity: 0.9; transition: opacity 0.3s; }
    .wedding-item:hover img { opacity: 1; }
    
    @keyframes scroll {
        0% { transform: translateX(0); }
        100% { transform: translateX(-50%); } /* Move half because we duplicate content */
    }

    /* Why We Do (About) - Redesigned */
    .about-section { 
        display: flex; flex-direction: column; padding: 100px 20px; 
        max-width: 1200px; margin: 0 auto; gap: 60px; 
    }
    @media(min-width: 900px) {
        .about-section { flex-direction: row; align-items: center; }
    }
    .about-image-col { flex: 1; position: relative; }
    .about-main-img { width: 100%; border-radius: 8px; }
    .about-accent-img { 
        position: absolute; bottom: -30px; right: -30px; width: 50%; 
        border: 10px solid #fff; border-radius: 8px; box-shadow: 0 20px 40px rgba(0,0,0,0.1); 
    }
    .about-text-col { flex: 1; padding-left: 40px; }
    .about-label { color: var(--secondary-color); letter-spacing: 2px; font-size: 12px; font-weight: 700; text-transform: uppercase; margin-bottom: 15px; display: block; }
    .about-heading { font-family: 'Playfair Display', serif; font-size: 42px; color: var(--primary-color); margin-bottom: 30px; line-height: 1.2; }
    .about-p { line-height: 1.8; color: var(--text-light); margin-bottom: 20px; font-size: 15px; }

    /* Testimonials - Redesigned */
    .reviews-section { padding: 100px 20px; background: #f4f4f4; text-align: center; }
    .review-slider { 
        display: flex; gap: 30px; overflow-x: auto; padding: 40px 20px; 
        scroll-snap-type: x mandatory; scrollbar-width: none; 
    }
    .review-card {
        min-width: 350px; scroll-snap-align: center;
        background: var(--white); padding: 40px; border-radius: 4px;
        box-shadow: 0 10px 30px rgba(0,0,0,0.05); text-align: left;
        position: relative; border-bottom: 4px solid var(--secondary-color);
    }
    .review-quote { font-family: 'Playfair Display', serif; font-size: 20px; font-style: italic; color: var(--primary-color); margin-bottom: 20px; }
    .review-author { font-weight: 700; font-size: 14px; letter-spacing: 1px; color: var(--black); }
    .review-loc { font-size: 11px; color: #999; text-transform: uppercase; }

    /* Newsletter Popup */
    .popup-newsletter {
        position: fixed; top: 50%; left: 50%; transform: translate(-50%, -50%);
        background: var(--white); padding: 0; width: 90%; max-width: 700px;
        display: flex; box-shadow: 0 30px 60px rgba(0,0,0,0.3); z-index: 3000;
        visibility: hidden; opacity: 0; transition: all 0.4s;
    }
    .popup-newsletter.active { visibility: visible; opacity: 1; }
    .popup-img { width: 40%; background: url('https://images.unsplash.com/photo-1573408301185-9146fe635d71?auto=format&fit=crop&w=600&q=80') center/cover; display: none; }
    @media(min-width: 768px) { .popup-img { display: block; } }
    .popup-content { flex: 1; padding: 50px; position: relative; text-align: center; }
    .popup-close { position: absolute; top: 15px; right: 20px; font-size: 24px; cursor: pointer; border: none; background: none; }
    .popup-title { font-family: 'Playfair Display', serif; font-size: 32px; color: var(--primary-color); margin-bottom: 10px; }
    
    /* Store Section (kept minimal) */
    .store-banner { background: var(--primary-color); color: var(--white); padding: 60px 20px; text-align: center; }
    .store-btn-outline { border: 1px solid var(--white); padding: 12px 30px; color: var(--white); text-decoration: none; display: inline-block; margin-top: 20px; transition: all 0.3s; }
    .store-btn-outline:hover { background: var(--white); color: var(--primary-color); }
</style>
@endpush

@section('content')

    <!-- Hero Slider -->
    <div class="hero-slider">
        <div class="hero-content">
            <h1 class="hero-title">Timeless Elegance, <br> Modern Craftsmanship</h1>
            <a href="#collections" class="hero-btn">Explore Collections</a>
        </div>
        <div class="slide active">
            <img src="https://images.unsplash.com/photo-1584302179602-e4c3d3fd629d?auto=format&fit=crop&w=1920&q=80" alt="Hero 1">
        </div>
        <div class="slide">
            <img src="https://images.unsplash.com/photo-1601121141461-9d6647bca1ed?auto=format&fit=crop&w=1920&q=80" alt="Hero 2">
        </div>
        <div class="slide">
            <img src="https://images.unsplash.com/photo-1584302179602-e4c3d3fd629d?auto=format&fit=crop&w=1920&q=80" alt="Hero 3">
        </div>
    </div>

    <!-- 3D Collections Carousel -->
    <section class="collections-section" id="collections">
        <div class="section-header">
            <h2 class="section-title">Our Collections</h2>
        </div>
        
        <div class="carousel-container">
            <div class="carousel" id="carousel">
                <!-- Items will be positioned by JS -->
                <div class="carousel-item" onclick="window.location='/collections?category=necklaces'">
                    <img src="https://images.unsplash.com/photo-1599643478518-17488fbbcd75?auto=format&fit=crop&w=600&q=80" alt="Necklaces">
                    <div class="carousel-overlay">
                        <h3 class="carousel-title">Necklaces</h3>
                        <p class="carousel-desc">Statement Pieces</p>
                    </div>
                </div>
                <div class="carousel-item" onclick="window.location='/collections?category=rings'">
                    <img src="https://images.unsplash.com/photo-1605100804763-ebea466dd424?auto=format&fit=crop&w=600&q=80" alt="Rings">
                    <div class="carousel-overlay">
                        <h3 class="carousel-title">Rings</h3>
                        <p class="carousel-desc">Symbol of Love</p>
                    </div>
                </div>
                <div class="carousel-item" onclick="window.location='/collections?category=earrings'">
                    <img src="https://images.unsplash.com/photo-1535632066927-ab7c9ab60908?auto=format&fit=crop&w=600&q=80" alt="Earrings">
                    <div class="carousel-overlay">
                        <h3 class="carousel-title">Earrings</h3>
                        <p class="carousel-desc">Elegant Details</p>
                    </div>
                </div>
                <div class="carousel-item" onclick="window.location='/collections?category=bracelets'">
                    <img src="https://images.unsplash.com/photo-1611591437281-460bfbe1220a?auto=format&fit=crop&w=600&q=80" alt="Bracelets">
                    <div class="carousel-overlay">
                        <h3 class="carousel-title">Bracelets</h3>
                        <p class="carousel-desc">Wrist Adornments</p>
                    </div>
                </div>
                <div class="carousel-item" onclick="window.location='/collections?category=bridal'">
                    <img src="https://images.unsplash.com/photo-1515934751635-c81c6bc9a2d8?auto=format&fit=crop&w=600&q=80" alt="Bridal">
                    <div class="carousel-overlay">
                        <h3 class="carousel-title">Bridal</h3>
                        <p class="carousel-desc">For Your Special Day</p>
                    </div>
                </div>
                <div class="carousel-item" onclick="window.location='/collections?category=gold'">
                    <img src="https://images.unsplash.com/photo-1626784215021-2e39ccf971cd?auto=format&fit=crop&w=600&q=80" alt="Gold">
                    <div class="carousel-overlay">
                        <h3 class="carousel-title">Gold</h3>
                        <p class="carousel-desc">Pure Luxury</p>
                    </div>
                </div>
            </div>
        </div>
        
        <div class="carousel-controls">
            <button class="control-btn" onclick="rotateCarousel(-1)">&#8592;</button>
            <button class="control-btn" onclick="rotateCarousel(1)">&#8594;</button>
        </div>
    </section>

    <!-- Bestsellers (Redesigned) -->
    <section class="bestsellers-section">
        <div class="section-header">
            <h2 class="section-title">Discover Bestsellers</h2>
        </div>
        
        <div class="product-grid">
            <!-- Product 1 -->
            <div class="product-card">
                <div class="product-image-box">
                    <img src="https://images.unsplash.com/photo-1603561591411-cd7eb9527c55?auto=format&fit=crop&w=800&q=80" alt="Diamond Solitaire">
                </div>
                <div class="product-details">
                    <div class="product-row">
                        <h3 class="product-name">Diamond Solitaire Ring</h3>
                        <span class="product-price">₹45,129</span>
                    </div>
                    <button class="add-cart-btn" onclick="window.location='{{ route('product') }}'">Add to Cart</button>
                </div>
            </div>

            <!-- Product 2 -->
            <div class="product-card">
                <div class="product-image-box">
                    <img src="https://images.unsplash.com/photo-1599643477877-5313557d873b?auto=format&fit=crop&w=800&q=80" alt="Gold Choker">
                </div>
                <div class="product-details">
                    <div class="product-row">
                        <h3 class="product-name">Gold Choker Necklace</h3>
                        <span class="product-price">₹85,129</span>
                    </div>
                    <button class="add-cart-btn" onclick="window.location='{{ route('product') }}'">Add to Cart</button>
                </div>
            </div>

            <!-- Product 3 -->
            <div class="product-card">
                <div class="product-image-box">
                    <img src="https://images.unsplash.com/photo-1535632066927-ab7c9ab60908?auto=format&fit=crop&w=800&q=80" alt="Sapphire Drops">
                </div>
                <div class="product-details">
                    <div class="product-row">
                        <h3 class="product-name">Sapphire Drop Earrings</h3>
                        <span class="product-price">₹25,129</span>
                    </div>
                    <button class="add-cart-btn" onclick="window.location='{{ route('product') }}'">Add to Cart</button>
                </div>
            </div>

            <!-- Product 4 -->
            <div class="product-card">
                <div class="product-image-box">
                    <img src="https://images.unsplash.com/photo-1617038220319-276d3cfab638?auto=format&fit=crop&w=800&q=80" alt="Emerald Pendant">
                </div>
                <div class="product-details">
                    <div class="product-row">
                        <h3 class="product-name">Emerald Pendant</h3>
                        <span class="product-price">₹32,129</span>
                    </div>
                    <button class="add-cart-btn" onclick="window.location='{{ route('product') }}'">Add to Cart</button>
                </div>
            </div>
            
             <!-- Product 5 -->
             <div class="product-card">
                <div class="product-image-box">
                    <img src="https://images.unsplash.com/photo-1611591437281-460bfbe1220a?auto=format&fit=crop&w=800&q=80" alt="Ruby Bracelet">
                </div>
                <div class="product-details">
                    <div class="product-row">
                        <h3 class="product-name">Ruby Tennis Bracelet</h3>
                        <span class="product-price">₹48,129</span>
                    </div>
                    <button class="add-cart-btn" onclick="window.location='{{ route('product') }}'">Add to Cart</button>
                </div>
            </div>

             <!-- Product 6 -->
             <div class="product-card">
                <div class="product-image-box">
                    <img src="https://images.unsplash.com/photo-1605100804763-ebea466dd424?auto=format&fit=crop&w=800&q=80" alt="Platinum Band">
                </div>
                <div class="product-details">
                    <div class="product-row">
                        <h3 class="product-name">Platinum Eternity Band</h3>
                        <span class="product-price">₹55,129</span>
                    </div>
                    <button class="add-cart-btn" onclick="window.location='{{ route('product') }}'">Add to Cart</button>
                </div>
            </div>
            
             <!-- Product 7 -->
             <div class="product-card">
                <div class="product-image-box">
                    <img src="https://images.unsplash.com/photo-1599643478518-17488fbbcd75?auto=format&fit=crop&w=800&q=80" alt="Pearl Necklace">
                </div>
                <div class="product-details">
                    <div class="product-row">
                        <h3 class="product-name">Freshwater Pearl Necklace</h3>
                        <span class="product-price">₹15,129</span>
                    </div>
                    <button class="add-cart-btn" onclick="window.location='{{ route('product') }}'">Add to Cart</button>
                </div>
            </div>

             <!-- Product 8 -->
             <div class="product-card">
                <div class="product-image-box">
                    <img src="https://images.unsplash.com/photo-1626784215021-2e39ccf971cd?auto=format&fit=crop&w=800&q=80" alt="Gold Bangles">
                </div>
                <div class="product-details">
                    <div class="product-row">
                        <h3 class="product-name">Antique Gold Bangles</h3>
                        <span class="product-price">₹95,129</span>
                    </div>
                    <button class="add-cart-btn" onclick="window.location='{{ route('product') }}'">Add to Cart</button>
                </div>
            </div>
        </div>
    </section>

    <!-- Shop By Gender -->
    <section class="gender-section">
        <div class="section-header">
            <h2 class="section-title">Shop by Gender</h2>
        </div>
        <div class="gender-grid">
            <div class="gender-card" onclick="window.location='/collection?category=women'">
                <img src="https://images.unsplash.com/photo-1515562141207-7a88fb7ce338?auto=format&fit=crop&w=600&q=80" alt="Women">
                <div class="gender-overlay">
                    <h3 class="gender-title">Women</h3>
                </div>
            </div>
            <div class="gender-card" onclick="window.location='/collection?category=men'">
                <img src="https://images.unsplash.com/photo-1622398931139-44569d30005a?auto=format&fit=crop&w=600&q=80" alt="Men">
                <div class="gender-overlay">
                    <h3 class="gender-title">Men</h3>
                </div>
            </div>
            <div class="gender-card" onclick="window.location='/collection?category=kids'">
                <img src="https://images.unsplash.com/photo-1601666497274-0f2c4167905f?auto=format&fit=crop&w=600&q=80" alt="Kids">
                <div class="gender-overlay">
                    <h3 class="gender-title">Kids</h3>
                </div>
            </div>
        </div>
    </section>

    <!-- Wedding Collection (Marquee) -->
    <div class="wedding-section">
        <div class="wedding-content">
            <h2 class="wedding-title">The Wedding Collection</h2>
            <p class="wedding-text">
                Celebrate your eternal love with our exquisite bridal collection. 
                Hand-picked diamonds and the purest gold, crafted to make your special day unforgettable.
            </p>
            <a href="/cosmopolitan" class="hero-btn" style="border-color: var(--secondary-color); color: var(--secondary-color);">View Collection</a>
        </div>
        
        <div class="marquee-container">
            <div class="marquee-track">
                <!-- Set 1 -->
                <div class="wedding-item"><img src="https://images.unsplash.com/photo-1603561591411-cd7eb9527c55?auto=format&fit=crop&w=600&q=80" alt="Bridal"></div>
                <div class="wedding-item"><img src="https://images.unsplash.com/photo-1629224316810-9d8805b95076?auto=format&fit=crop&w=600&q=80" alt="Bridal"></div>
                <div class="wedding-item"><img src="https://images.unsplash.com/photo-1515934751635-c81c6bc9a2d8?auto=format&fit=crop&w=600&q=80" alt="Bridal"></div>
                <div class="wedding-item"><img src="https://images.unsplash.com/photo-1584302179602-e4c3d3fd629d?auto=format&fit=crop&w=600&q=80" alt="Bridal"></div>
                <div class="wedding-item"><img src="https://images.unsplash.com/photo-1589674781759-c21c34028bc6?auto=format&fit=crop&w=600&q=80" alt="Bridal"></div>
                <div class="wedding-item"><img src="https://images.unsplash.com/photo-1611085583191-a3b181a88401?auto=format&fit=crop&w=600&q=80" alt="Bridal"></div>
                
                <!-- Set 2 (Duplicate for smooth scroll) -->
                <div class="wedding-item"><img src="https://images.unsplash.com/photo-1603561591411-cd7eb9527c55?auto=format&fit=crop&w=600&q=80" alt="Bridal"></div>
                <div class="wedding-item"><img src="https://images.unsplash.com/photo-1629224316810-9d8805b95076?auto=format&fit=crop&w=600&q=80" alt="Bridal"></div>
                <div class="wedding-item"><img src="https://images.unsplash.com/photo-1515934751635-c81c6bc9a2d8?auto=format&fit=crop&w=600&q=80" alt="Bridal"></div>
                <div class="wedding-item"><img src="https://images.unsplash.com/photo-1584302179602-e4c3d3fd629d?auto=format&fit=crop&w=600&q=80" alt="Bridal"></div>
                <div class="wedding-item"><img src="https://images.unsplash.com/photo-1589674781759-c21c34028bc6?auto=format&fit=crop&w=600&q=80" alt="Bridal"></div>
                <div class="wedding-item"><img src="https://images.unsplash.com/photo-1611085583191-a3b181a88401?auto=format&fit=crop&w=600&q=80" alt="Bridal"></div>
            </div>
        </div>
    </div>

    <!-- Why We Do (About) -->
    <section class="about-section">
        <div class="about-image-col">
            <img src="https://images.unsplash.com/photo-1582142407894-ec85f1260a4c?auto=format&fit=crop&w=800&q=80" alt="Craftsmanship" class="about-main-img">
            <img src="https://images.unsplash.com/photo-1617038260897-41a1f14a8ca0?auto=format&fit=crop&w=600&q=80" alt="Detail" class="about-accent-img">
        </div>
        <div class="about-text-col">
            <span class="about-label">Our Philosophy</span>
            <h2 class="about-heading">The Art of Adornment</h2>
            <p class="about-p">
                At Harees Gold Diamonds, we believe that every piece of jewelry tells a story. 
                Born from a legacy of craftsmanship, our artisans blend traditional techniques with contemporary design.
            </p>
            <p class="about-p">
                We ethically source every gemstone and certify every gram of gold, ensuring that your treasure 
                is not just beautiful, but responsible.
            </p>
            <a href="/about" class="hero-btn" style="background: var(--black); border-color: var(--black);">Read our Story</a>
        </div>
    </section>

    <!-- Testimonials -->
    <section class="reviews-section">
        <div class="section-header">
            <h2 class="section-title">Client Stories</h2>
        </div>
        <div class="review-slider">
            <div class="review-card">
                <p class="review-quote">"The ring exceeded all my expectations. The diamond brilliance is unmatched."</p>
                <div class="review-author">Sarah Jenkins</div>
                <div class="review-loc">Verified Buyer, Mumbai</div>
            </div>
            <div class="review-card">
                <p class="review-quote">"Excellent service and packaging. It felt like receiving a royal gift."</p>
                <div class="review-author">Rahul Mehta</div>
                <div class="review-loc">Verified Buyer, Delhi</div>
            </div>
            <div class="review-card">
                <p class="review-quote">"My wife loved the anniversary necklace. Truly timeless design."</p>
                <div class="review-author">Amit Singh</div>
                <div class="review-loc">Verified Buyer, Bangalore</div>
            </div>
            <div class="review-card">
                <p class="review-quote">"Trustworthy and premium. I found my go-to jeweler for life."</p>
                <div class="review-author">Priya Kapoor</div>
                <div class="review-loc">Verified Buyer, Chennai</div>
            </div>
        </div>
    </section>

    <!-- Store Banner Removed -->

    <!-- Newsletter Popup -->
    <div class="menu-overlay" id="popupOverlay"></div>
    <div class="popup-newsletter" id="popup">
        <div class="popup-img"></div>
        <div class="popup-content">
            <button class="popup-close" onclick="closePopup()">×</button>
            <span class="about-label">Exclusive Offer</span>
            <h2 class="popup-title">Join the Circle</h2>
            <p class="about-p">Subscribe to receive early access to new collections and an exclusive 20% welcome offer.</p>
            <div style="margin: 20px 0; font-size: 24px; font-weight: 700; letter-spacing: 2px;">GOLD20</div>
            <form class="newsletter-form" style="display: block; background: none; border: none;">
                <input type="email" placeholder="Your Email Address" style="width: 100%; padding: 15px; border: 1px solid #ddd; margin-bottom: 10px; border-radius: 4px;">
                <button type="button" class="hero-btn" style="background: var(--primary-color); width: 100%; border-color: var(--primary-color);">Subscribe</button>
            </form>
        </div>
    </div>

@endsection

@push('scripts')
<script>
    // Hero Slider
    let currentSlide = 0;
    const slides = document.querySelectorAll('.slide');
    if (slides.length > 0) {
        setInterval(() => {
            slides[currentSlide].classList.remove('active');
            currentSlide = (currentSlide + 1) % slides.length;
            slides[currentSlide].classList.add('active');
        }, 5000);
    }

    // 3D Carousel Logic
    const carousel = document.getElementById('carousel');
    const items = document.querySelectorAll('.carousel-item');
    const totalItems = items.length;
    let currDeg = 0;
    
    function updateCarousel() {
        const angle = 360 / totalItems;
        const radius = Math.round((250 / 2) / Math.tan(Math.PI / totalItems)); // 250 is item width
        
        // Apply transform to center
        carousel.style.transform = `translateZ(-${radius}px) rotateY(${currDeg}deg)`;
        
        items.forEach((item, index) => {
            item.style.transform = `rotateY(${index * angle}deg) translateZ(${radius}px)`;
        });
    }

    function rotateCarousel(direction) {
        const angle = 360 / totalItems;
        currDeg -= direction * angle;
        carousel.style.transform = `translateZ(-400px) rotateY(${currDeg}deg)`; 
    }
    
    // Initial Setup
    updateCarousel();
    
    // Auto Rotation
    setInterval(() => {
        rotateCarousel(1);
    }, 4000);

    // Popup Logic
    setTimeout(() => {
        document.getElementById('popup').classList.add('active');
        document.getElementById('popupOverlay').classList.add('active');
    }, 5000);

    function closePopup() {
        document.getElementById('popup').classList.remove('active');
        document.getElementById('popupOverlay').classList.remove('active');
    }
</script>
@endpush
