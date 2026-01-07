@extends('azwa.layouts.app')

@section('title', 'Timeless Jewelry Elegance')

@push('styles')
<style>
    /* Hero Slider */
    .hero-slider { position: relative; width: 100%; height: 500px; overflow: hidden; }
    .slide { position: absolute; inset: 0; opacity: 0; transition: opacity 1s ease; }
    .slide.active { opacity: 1; }
    .slide img { width: 100%; height: 100%; object-fit: cover; object-position: center; }
    .slider-dots { position: absolute; bottom: 15px; left: 50%; transform: translateX(-50%); display: flex; gap: 8px; z-index: 10; }
    .dot { width: 8px; height: 8px; background: rgba(255,255,255,0.5); border-radius: 50%; cursor: pointer; transition: background 0.3s; }
    .dot.active { background: var(--white); }

    /* Common Section */
    .section { padding: 40px 15px; max-width: 1200px; margin: 0 auto; }
    .section-header { text-align: center; margin-bottom: 30px; }
    .section-title { font-family: 'Playfair Display', serif; font-size: 28px; font-weight: 700; color: var(--black); }
    .section-title em { font-style: italic; font-weight: 400; font-family: 'Playfair Display', serif; }

    /* Product Grid */
    .product-grid { display: grid; grid-template-columns: repeat(2, 1fr); gap: 15px; }
    .product-card { background: var(--white); border-radius: 12px; overflow: hidden; box-shadow: 0 4px 15px rgba(0,0,0,0.05); transition: transform 0.3s; text-decoration: none; color: inherit; display: block; }
    .product-card:hover { transform: translateY(-5px); }
    .product-image-wrapper { position: relative; aspect-ratio: 1; background: var(--bg-light); overflow: hidden; }
    .product-image { width: 100%; height: 100%; object-fit: cover; transition: transform 0.5s; }
    .product-card:hover .product-image { transform: scale(1.05); }
    .product-badge { position: absolute; top: 10px; left: 10px; background: var(--gold); color: var(--white); padding: 4px 10px; border-radius: 12px; font-size: 10px; font-weight: 700; text-transform: uppercase; z-index: 1; }
    .product-info { padding: 15px; text-align: center; }
    .product-name { font-family: 'Playfair Display', serif; font-size: 16px; font-weight: 700; margin-bottom: 5px; color: var(--black); }
    .product-price { font-size: 14px; font-weight: 700; color: var(--black); }
    .product-price span { font-weight: 400; color: var(--text-light); font-size: 12px; margin-right: 5px; }
    .view-all-btn { display: block; width: max-content; margin: 40px auto 0; padding: 12px 30px; background: var(--black); color: var(--white); text-decoration: none; border-radius: 25px; font-weight: 600; font-size: 14px; transition: background 0.3s; }
    .view-all-btn:hover { background: var(--gold); }

    /* Store Section */
    .store-section { background: var(--black); color: var(--white); padding: 80px 20px; text-align: center; position: relative; overflow: hidden; }
    .store-count { font-size: 120px; font-weight: 900; line-height: 1; color: transparent; -webkit-text-stroke: 2px rgba(212, 165, 116, 0.2); margin-bottom: -40px; position: relative; z-index: 0; }
    .store-title { font-family: 'Playfair Display', serif; font-size: 36px; margin-bottom: 10px; position: relative; z-index: 1; color: var(--white); }
    .store-subtitle { color: var(--gold); text-transform: uppercase; letter-spacing: 3px; margin-bottom: 30px; font-size: 14px; font-weight: 600; }
    .store-btn { display: inline-block; border: 2px solid var(--white); color: var(--white); padding: 12px 30px; text-decoration: none; text-transform: uppercase; font-size: 13px; letter-spacing: 1px; transition: all 0.3s; margin-bottom: 40px; position: relative; z-index: 1; font-weight: 700; }
    .store-btn:hover { background: var(--white); color: var(--black); }
    .store-description { max-width: 600px; margin: 0 auto; font-size: 15px; opacity: 0.8; line-height: 1.8; position: relative; z-index: 1; }

    /* Category Grid */
    .category-grid { display: grid; grid-template-columns: 1fr; gap: 20px; }
    .category-card { position: relative; border-radius: 15px; overflow: hidden; aspect-ratio: 4/5; cursor: pointer; display: block; text-decoration: none; color: inherit; }
    .category-card img { width: 100%; height: 100%; object-fit: cover; transition: transform 0.5s; }
    .category-card:hover img { transform: scale(1.05); }
    .category-overlay { position: absolute; inset: 0; background: linear-gradient(0deg, rgba(0,0,0,0.6) 0%, transparent 50%); display: flex; align-items: flex-end; justify-content: center; color: var(--white); text-align: center; padding: 30px; }
    .category-name { font-weight: 800; font-size: 24px; margin-bottom: 5px; letter-spacing: 1px; text-transform: uppercase; font-family: 'Playfair Display', serif; }
    .category-desc { font-style: italic; font-size: 14px; opacity: 0.9; }

    /* Cosmopolitan */
    .cosmopolitan-section { background: #111; padding: 80px 20px; color: var(--white); text-align: center; }
    .cosmo-header { margin-bottom: 50px; }
    .cosmo-title { font-family: 'Playfair Display', serif; font-size: 36px; color: var(--gold); margin-bottom: 15px; }
    .cosmo-subtitle { font-size: 15px; opacity: 0.7; max-width: 500px; margin: 0 auto; line-height: 1.6; }
    .cosmopolitan-section .product-card { background: #222; color: var(--white); border: 1px solid #333; }
    .cosmopolitan-section .product-image-wrapper { background: #1a1a1a; }
    .cosmopolitan-section .product-name { color: var(--white); }
    .cosmopolitan-section .product-price { color: var(--gold); }
    .cosmopolitan-section .product-price span { color: rgba(255,255,255,0.4); }

    /* Video Section */
    .video-section { position: relative; width: 100%; height: 60vh; overflow: hidden; }
    .video-section video { width: 100%; height: 100%; object-fit: cover; }
    .video-overlay { position: absolute; inset: 0; background: rgba(0,0,0,0.3); display: flex; align-items: center; justify-content: center; }
    .video-text { font-family: 'Playfair Display', serif; font-size: 36px; color: var(--white); font-weight: 700; text-align: center; padding: 20px; line-height: 1.2; text-shadow: 0 2px 10px rgba(0,0,0,0.3); }

    /* Gender Grid */
    .gender-grid { display: grid; grid-template-columns: repeat(3, 1fr); gap: 10px; }
    .gender-card { position: relative; border-radius: 12px; overflow: hidden; cursor: pointer; display: block; text-decoration: none; color: inherit; }
    .gender-card img { width: 100%; aspect-ratio: 3/4; object-fit: cover; transition: transform 0.5s; }
    .gender-card:hover img { transform: scale(1.05); }
    .gender-overlay { position: absolute; bottom: 0; left: 0; right: 0; background: linear-gradient(0deg, rgba(0,0,0,0.8) 0%, transparent 100%); padding: 30px 10px 15px; text-align: center; }
    .gender-title { color: var(--white); font-size: 14px; font-weight: 700; letter-spacing: 2px; }

    /* Testimonials */
    .testimonials { background: var(--bg-light); padding: 80px 20px; }
    .testimonial-slider { display: flex; overflow-x: auto; gap: 20px; padding: 10px 5px 30px; scrollbar-width: none; -ms-overflow-style: none; }
    .testimonial-slider::-webkit-scrollbar { display: none; }
    .testimonial-card { min-width: 300px; background: var(--white); padding: 30px; border-radius: 20px; box-shadow: 0 10px 30px rgba(0,0,0,0.05); border: 1px solid rgba(0,0,0,0.03); }
    .testimonial-text { font-size: 16px; line-height: 1.8; margin-bottom: 25px; color: var(--text); font-style: italic; }
    .testimonial-author { font-weight: 700; color: var(--black); font-size: 15px; margin-bottom: 5px; }
    .testimonial-location { font-size: 12px; color: var(--text-light); text-transform: uppercase; letter-spacing: 1px; }

    /* Press */
    .press-section { text-align: center; padding: 60px 20px; border-top: 1px solid var(--border); }
    .press-title { font-family: 'Playfair Display', serif; font-size: 24px; margin-bottom: 40px; color: var(--black); }
    .press-slider { display: flex; justify-content: center; gap: 40px; align-items: center; flex-wrap: wrap; opacity: 0.6; }
    .press-logo { height: 25px; object-fit: contain; filter: grayscale(100%); transition: filter 0.3s, opacity 0.3s; }
    .press-logo:hover { filter: grayscale(0%); opacity: 1; }

    /* About Section */
    .about-section { display: grid; gap: 40px; padding: 80px 20px; align-items: center; max-width: 1200px; margin: 0 auto; }
    .about-image img { width: 100%; border-radius: 20px; box-shadow: 0 20px 40px rgba(0,0,0,0.1); }
    .about-title { font-family: 'Playfair Display', serif; font-size: 42px; margin-bottom: 25px; line-height: 1.2; color: var(--black); }
    .about-text { margin-bottom: 25px; line-height: 1.9; color: var(--text-light); font-size: 16px; }
    .about-text strong { color: var(--black); }
    .about-btn { display: inline-block; background: var(--black); color: var(--white); padding: 14px 35px; border-radius: 30px; text-decoration: none; font-weight: 600; font-size: 14px; text-transform: uppercase; letter-spacing: 1px; transition: transform 0.3s; }
    .about-btn:hover { transform: translateY(-3px); }

    /* Blog */
    .blog-grid { display: grid; gap: 25px; }
    .blog-card { background: var(--white); border-radius: 15px; overflow: hidden; box-shadow: 0 4px 20px rgba(0,0,0,0.06); transition: transform 0.3s; }
    .blog-card:hover { transform: translateY(-5px); }
    .blog-image { width: 100%; aspect-ratio: 16/9; object-fit: cover; }
    .blog-content { padding: 25px; }
    .blog-date { font-size: 12px; color: var(--gold); font-weight: 700; margin-bottom: 10px; text-transform: uppercase; letter-spacing: 1px; }
    .blog-title { font-family: 'Playfair Display', serif; font-size: 20px; margin-bottom: 15px; line-height: 1.4; color: var(--black); font-weight: 700; }
    .blog-link { color: var(--black); text-decoration: none; font-weight: 700; font-size: 13px; text-transform: uppercase; border-bottom: 1px solid var(--black); padding-bottom: 2px; }

    /* Features */
    .features { display: grid; grid-template-columns: repeat(3, 1fr); gap: 20px; padding: 50px 20px; border-top: 1px solid var(--border); text-align: center; background: var(--white); }
    .feature-icon { font-size: 32px; margin-bottom: 15px; }
    .feature-title { font-weight: 700; font-size: 13px; margin-bottom: 8px; text-transform: uppercase; letter-spacing: 1px; color: var(--black); }
    .feature-text { font-size: 12px; color: var(--text-light); line-height: 1.5; padding: 0 10px; }

    /* Popup */
    .popup-newsletter { position: fixed; top: 50%; left: 50%; transform: translate(-50%, -50%) scale(0.9); background: var(--white); padding: 50px; border-radius: 20px; text-align: center; max-width: 450px; width: 90%; z-index: 2000; opacity: 0; pointer-events: none; transition: all 0.4s cubic-bezier(0.175, 0.885, 0.32, 1.275); box-shadow: 0 20px 60px rgba(0,0,0,0.3); }
    .popup-newsletter.active { opacity: 1; transform: translate(-50%, -50%) scale(1); pointer-events: all; }
    .popup-close { position: absolute; top: 20px; right: 20px; background: none; border: none; font-size: 30px; cursor: pointer; color: #ccc; transition: color 0.3s; }
    .popup-close:hover { color: var(--black); }
    .popup-tag { font-size: 13px; font-weight: 700; color: var(--gold); letter-spacing: 2px; margin-bottom: 15px; text-transform: uppercase; }
    .popup-title { font-family: 'Playfair Display', serif; font-size: 32px; font-weight: 700; line-height: 1.2; margin-bottom: 8px; color: var(--black); }
    .popup-subtitle { font-size: 14px; letter-spacing: 3px; margin-bottom: 25px; font-weight: 600; color: var(--text-light); }
    .popup-code { background: #fafafa; padding: 20px; border-radius: 12px; margin-bottom: 25px; border: 2px dashed var(--gold); }
    .popup-code-text { font-size: 11px; font-weight: 700; color: var(--text-light); margin-bottom: 5px; text-transform: uppercase; }
    .popup-code-value { font-size: 24px; font-weight: 900; color: var(--black); letter-spacing: 2px; }

    /* Newsletter Form */
    .newsletter-form { display: flex; align-items: center; background: #f9f9f9; padding: 5px; border-radius: 30px; border: 1px solid #eee; }
    .newsletter-input { flex: 1; border: none; background: transparent; padding: 12px 20px; outline: none; font-size: 14px; color: #333; }
    .newsletter-btn { background: var(--black); color: var(--white); border: none; padding: 12px 30px; border-radius: 25px; font-weight: 700; cursor: pointer; font-size: 13px; letter-spacing: 1px; transition: background 0.3s; }
    .newsletter-btn:hover { background: var(--gold); }

    /* Desktop Media Queries */
    @media (min-width: 768px) {
        .section { padding: 80px 20px; }
        .hero-slider { height: 90vh; }
        .product-grid { grid-template-columns: repeat(4, 1fr); gap: 30px; }
        .category-grid { grid-template-columns: repeat(3, 1fr); }
        .blog-grid { grid-template-columns: repeat(3, 1fr); }
        .about-section { grid-template-columns: 1fr 1px; }
        /* Fix for about section grid column count - intended to be 2 column */
        .about-section { grid-template-columns: 1fr 1fr; gap: 60px; }
        .video-text { font-size: 56px; }
        .section-title { font-size: 42px; }
        .store-count { font-size: 160px; margin-bottom: -55px; }
        .store-title { font-size: 48px; }
    }
</style>
@endpush

@section('content')

    <!-- Hero Slider -->
    <div class="hero-slider">
        <div class="slide active">
            <picture>
                <source media="(max-width: 768px)" srcset="{{ asset('Images/hero-mobile-1.webp') }}">
                <img src="{{ asset('Images/hero-desktop-1.webp') }}" alt="Buy 2 Get 1">
            </picture>
        </div>
        <div class="slide">
            <picture>
                <source media="(max-width: 768px)" srcset="{{ asset('Images/hero-mobile-2.webp') }}">
                <img src="{{ asset('Images/hero-desktop-2.webp') }}" alt="New Store">
            </picture>
        </div>
        <div class="slide">
            <picture>
                 <source media="(max-width: 768px)" srcset="{{ asset('Images/hero-mobile-3.webp') }}">
                <img src="{{ asset('Images/hero-desktop-3.webp') }}" alt="Featured">
            </picture>
        </div>
        <div class="slide">
            <picture>
                <source media="(max-width: 768px)" srcset="https://myop.in/cdn/shop/files/marshamallow_phone.webp?v=1753949875&width=1000">
                <img src="{{ asset('Images/hero-desktop-4.webp') }}" alt="Marshmallow">
            </picture>
        </div>
        <div class="slider-dots">
            <div class="dot active" data-slide="0"></div>
            <div class="dot" data-slide="1"></div>
            <div class="dot" data-slide="2"></div>
            <div class="dot" data-slide="3"></div>
        </div>
    </div>

    <!-- Bestsellers -->
    <section class="section">
        <div class="section-header">
            <h2 class="section-title">Discover <em>Our Bestsellers</em></h2>
        </div>
        <div class="product-grid">
            <a href="{{ route('product') }}" class="product-card">
                <div class="product-image-wrapper">
                    <span class="product-badge">New</span>
                    <img src="{{ asset('Images/product-sandal-veer.webp') }}" alt="Diamond Solitaire" class="product-image">
                </div>
                <div class="product-info">
                    <h3 class="product-name">Diamond Solitaire</h3>
                    <p class="product-price"><span>From</span> ₹45,129</p>
                </div>
            </a>

            <a href="{{ route('product') }}" class="product-card">
                <div class="product-image-wrapper">
                    <span class="product-badge">New</span>
                    <img src="{{ asset('Images/product-marshmallow-fluff.webp') }}" alt="Gold Choker" class="product-image">
                </div>
                <div class="product-info">
                    <h3 class="product-name">Gold Choker</h3>
                    <p class="product-price"><span>From</span> ₹85,129</p>
                </div>
            </a>

            <a href="{{ route('product') }}" class="product-card">
                <div class="product-image-wrapper">
                    <img src="{{ asset('Images/product-purple-mystique.webp') }}" alt="Sapphire Drops" class="product-image">
                </div>
                <div class="product-info">
                    <h3 class="product-name">Sapphire Drops</h3>
                    <p class="product-price"><span>From</span> ₹25,129</p>
                </div>
            </a>

            <a href="{{ route('product') }}" class="product-card">
                <div class="product-image-wrapper">
                    <img src="{{ asset('Images/product-bangalore-bloom.webp') }}" alt="Emerald Pendant" class="product-image">
                </div>
                <div class="product-info">
                    <h3 class="product-name">Emerald Pendant</h3>
                    <p class="product-price"><span>From</span> ₹32,129</p>
                </div>
            </a>

            <a href="{{ route('product') }}" class="product-card">
                <div class="product-image-wrapper">
                    <img src="{{ asset('Images/product-fruit-punch.webp') }}" alt="Ruby Bracelet" class="product-image">
                </div>
                <div class="product-info">
                    <h3 class="product-name">Ruby Bracelet</h3>
                    <p class="product-price"><span>From</span> ₹48,129</p>
                </div>
            </a>

            <a href="{{ route('product') }}" class="product-card">
                <div class="product-image-wrapper">
                    <img src="{{ asset('Images/product-one-of-a-kind.webp') }}" alt="Platinum Band" class="product-image">
                </div>
                <div class="product-info">
                    <h3 class="product-name">Platinum Band</h3>
                    <p class="product-price"><span>From</span> ₹55,129</p>
                </div>
            </a>

            <a href="{{ route('product') }}" class="product-card">
                <div class="product-image-wrapper">
                    <img src="{{ asset('Images/product-midnight-jasmine.webp') }}" alt="Midnight Jasmine" class="product-image">
                </div>
                <div class="product-info">
                    <h3 class="product-name">Pearl Necklace</h3>
                    <p class="product-price"><span>From</span> ₹15,129</p>
                </div>
            </a>

            <a href="{{ route('product') }}" class="product-card">
                <div class="product-image-wrapper">
                    <img src="{{ asset('Images/product-amber-elixir.webp') }}" alt="Gold Bangles" class="product-image">
                </div>
                <div class="product-info">
                    <h3 class="product-name">Gold Bangles</h3>
                    <p class="product-price"><span>From</span> ₹95,129</p>
                </div>
            </a>
        </div>
        <a href="/all-products" class="view-all-btn">View All Products</a>
    </section>

    <!-- Store Section -->
    <div class="store-section" id="stores">
        <div class="store-count">60</div>
        <h2 class="store-title">Stores Near You</h2>
        <p class="store-subtitle">Find a store near you</p>
        <a href="/stores" class="store-btn">Locate Stores</a>
        <p class="store-description">
            Azwa Jewelry offers exquisite, hand-crafted jewelry with exceptional expertise in the art of design and craftsmanship.
        </p>
    </div>

    <!-- Our Fragrances -->
    <section class="section" id="signature">
        <div class="section-header">
            <h2 class="section-title">Our <em>Collections</em></h2>
        </div>
        <div class="category-grid">
            <a href="/collections?category=necklaces" class="category-card">
                <img src="{{ asset('Images/category-fresh.webp') }}" alt="Necklaces">
                <div class="category-overlay">
                    <div>
                        <h3 class="category-name">NECKLACES</h3>
                        <p class="category-desc">Statement. Elegant. Timeless.</p>
                    </div>
                </div>
            </a>

            <a href="/collections?category=rings" class="category-card">
                <img src="{{ asset('Images/category-oriental-woody.webp') }}" alt="Rings">
                <div class="category-overlay">
                    <div>
                        <h3 class="category-name">RINGS</h3>
                        <p class="category-desc">Engagement. Wedding. Fashion.</p>
                    </div>
                </div>
            </a>

            <a href="/collections?category=earrings" class="category-card">
                <img src="{{ asset('Images/category-floral.webp') }}" alt="Earrings">
                <div class="category-overlay">
                    <div>
                        <h3 class="category-name">EARRINGS</h3>
                        <p class="category-desc">Studs. Hoops. Drops.</p>
                    </div>
                </div>
            </a>
        </div>
    </section>

    <!-- Cosmopolitan -->
    <div class="cosmopolitan-section" id="cosmopolitan">
        <div class="cosmo-header">
            <h2 class="cosmo-title"><em>Wedding Collection</em></h2>
            <p class="cosmo-subtitle">Shine bright on your special day with our exclusive Wedding Collection.</p>
        </div>
        <div class="product-grid">
            <a href="{{ route('product') }}" class="product-card">
                <div class="product-image-wrapper">
                    <img src="{{ asset('Images/product-oud-de-beirut.webp') }}" alt="Bridal Set" class="product-image">
                </div>
                <div class="product-info">
                    <h3 class="product-name">Bridal Set</h3>
                    <p class="product-price"><span>From</span> ₹1,34,499</p>
                </div>
            </a>

            <a href="{{ route('product') }}" class="product-card">
                <div class="product-image-wrapper">
                    <img src="{{ asset('Images/product-california-sunshine.webp') }}" alt="Temple Jewelry" class="product-image">
                </div>
                <div class="product-info">
                    <h3 class="product-name">Temple Jewelry</h3>
                    <p class="product-price"><span>From</span> ₹85,499</p>
                </div>
            </a>

            <a href="{{ route('product') }}" class="product-card">
                <div class="product-image-wrapper">
                    <img src="{{ asset('Images/product-moroccan-rose.webp') }}" alt="Kundan Set" class="product-image">
                </div>
                <div class="product-info">
                    <h3 class="product-name">Kundan Set</h3>
                    <p class="product-price"><span>From</span> ₹65,499</p>
                </div>
            </a>

            <a href="{{ route('product') }}" class="product-card">
                <div class="product-image-wrapper">
                    <img src="{{ asset('Images/product-parisian-night.webp') }}" alt="Diamond Necklace" class="product-image">
                </div>
                <div class="product-info">
                    <h3 class="product-name">Diamond Necklace</h3>
                    <p class="product-price"><span>From</span> ₹2,45,499</p>
                </div>
            </a>
        </div>
        <a href="/cosmopolitan" class="view-all-btn" style="background: var(--gold);">Shop Collection</a>
    </div>

    <!-- Video Section -->
    <div class="video-section">
        <video autoplay loop muted playsinline>
            <source src="https://myop.in/cdn/shop/videos/c/vp/d3c4018982b7463b856b22c551804e7d/d3c4018982b7463b856b22c551804e7d.HD-1080p-3.3Mbps-48643562.mp4?v=0" type="video/mp4">
        </video>
        <div class="video-overlay">
            <h2 class="video-text">A gift that lasts a lifetime</h2>
        </div>
    </div>

    <!-- Shop By Gender -->
    <section class="section">
        <div class="section-header">
            <h2 class="section-title">Shop By <em>Gender</em></h2>
        </div>
        <div class="gender-grid">
            <a href="/collections?gender=for-him" class="gender-card">
                <img src="{{ asset('Images/gender-him.webp') }}" alt="For Him">
                <div class="gender-overlay">
                    <h3 class="gender-title">FOR HIM</h3>
                </div>
            </a>

            <a href="/collections?gender=for-her" class="gender-card">
                <img src="{{ asset('Images/gender-her.webp') }}" alt="For Her">
                <div class="gender-overlay">
                    <h3 class="gender-title">FOR HER</h3>
                </div>
            </a>

            <a href="/collections?gender=unisex" class="gender-card">
                <img src="{{ asset('Images/gender-unisex.webp') }}" alt="Unisex">
                <div class="gender-overlay">
                    <h3 class="gender-title">UNISEX</h3>
                </div>
            </a>
        </div>
    </section>

    <!-- Testimonials -->
    <div class="testimonials">
        <div class="section-header">
            <h2 class="section-title">What Our <em>Customers Say</em></h2>
        </div>
        <div class="testimonial-slider">
            <div class="testimonial-card">
                <p class="testimonial-text">The designs are absolutely mesmerizing and stand out. Truly a <em>premium experience</em> that I cherish.</p>
                <p class="testimonial-author">— Ananya Iyer</p>
                <p class="testimonial-location">Mumbai</p>
            </div>

            <div class="testimonial-card">
                <p class="testimonial-text">I was looking for a unique gift, and Azwa was the perfect choice. The <em>packaging is as exquisite</em> as the jewelry itself.</p>
                <p class="testimonial-author">— Rahul Menon</p>
                <p class="testimonial-location">Kochi</p>
            </div>

            <div class="testimonial-card">
                <p class="testimonial-text">Finally found jewelry that matches my personality. Bold, distinct, and <em>beautifully crafted</em>. Highly recommended!</p>
                <p class="testimonial-author">— Priya Sharma</p>
                <p class="testimonial-location">Bangalore</p>
            </div>

            <div class="testimonial-card">
                <p class="testimonial-text">The quality is comparable to top international luxury brands but at a <em>much better price point</em>. My new go-to for gifts.</p>
                <p class="testimonial-author">— Arjun Das</p>
                <p class="testimonial-location">Chennai</p>
            </div>
        </div>
    </div>

    <!-- Press -->
    <div class="press-section">
        <h2 class="press-title">As <em>seen</em> on</h2>
        <div class="press-slider">
            <img src="https://upload.wikimedia.org/wikipedia/commons/thumb/7/78/Elle_Magazine.svg/1200px-Elle_Magazine.svg.png" alt="Elle" class="press-logo">
            <img src="https://upload.wikimedia.org/wikipedia/commons/thumb/4/4f/Times_of_India_logo.svg/1200px-Times_of_India_logo.svg.png" alt="TOI" class="press-logo">
            <img src="https://cdn.worldvectorlogo.com/logos/vogue-logo.svg" alt="Vogue" class="press-logo">
            <img src="https://upload.wikimedia.org/wikipedia/commons/thumb/7/78/Elle_Magazine.svg/1200px-Elle_Magazine.svg.png" alt="Magazine" class="press-logo">
        </div>
    </div>

    <!-- About -->
    <div class="about-section" id="about">
        <div class="about-image">
            <img src="{{ asset('Images/about-store.webp') }}" alt="MYOP Store">
        </div>
        <div>
            <h2 class="about-title"><em>Why We Do,</em> What We Do</h2>
            <p class="about-text">Azwa Jewelry is India's premium jewelry brand known for <strong>high-quality, hand-crafted</strong> designs with unparalleled expertise in the art of adornment.</p>
            <p class="about-text">Azwa jewelry, crafted with <strong>certified gold and diamonds</strong> lasts for generations to come.</p>
            <a href="/about" class="about-btn">Learn More</a>
        </div>
    </div>

    <!-- Blog -->
    <!-- <section class="section">
        <div class="section-header">
            <h2 class="section-title">From the <em>Journal</em></h2>
        </div>
        <div class="blog-grid">
            <div class="blog-card">
                <img src="https://images.unsplash.com/photo-1541643600914-78b084683601?w=800&q=80" alt="Blog" class="blog-image">
                <div class="blog-content">
                    <p class="blog-date">Dec 03, 2025</p>
                    <h3 class="blog-title">Green Apple Used in Perfumes</h3>
                    <a href="/blog/green-apple" class="blog-link">Read more →</a>
                </div>
            </div>

            <div class="blog-card">
                <img src="https://images.unsplash.com/photo-1615634260167-c8cdede054de?w=800&q=80" alt="Blog" class="blog-image">
                <div class="blog-content">
                    <p class="blog-date">Nov 26, 2025</p>
                    <h3 class="blog-title">Sandalwood - The Instant Wood Fragrance</h3>
                    <a href="/blog/sandalwood" class="blog-link">Read more →</a>
                </div>
            </div>

            <div class="blog-card">
                <img src="https://images.unsplash.com/photo-1587556930832-5e67d85c8f05?w=800&q=80" alt="Blog" class="blog-image">
                <div class="blog-content">
                    <p class="blog-date">Nov 22, 2025</p>
                    <h3 class="blog-title">October Newsletter</h3>
                    <a href="/blog/newsletter" class="blog-link">Read more →</a>
                </div>
            </div>
        </div>
    </section> -->

    <!-- Features -->
    <div class="features">
        <div class="feature">
            <div class="feature-icon"><i class="fas fa-truck"></i></div>
            <h3 class="feature-title">Free Shipping</h3>
            <p class="feature-text">Free shipping on orders above ₹399 across India</p>
        </div>

        <div class="feature">
            <div class="feature-icon"><i class="fas fa-undo"></i></div>
            <h3 class="feature-title">Easy Returns</h3>
            <p class="feature-text">Simple 7-day return policy</p>
        </div>

        <div class="feature">
            <div class="feature-icon"><i class="fas fa-lock"></i></div>
            <h3 class="feature-title">Secure Payment</h3>
            <p class="feature-text">Your payment information is processed securely</p>
        </div>
    </div>

    <!-- Popup Newsletter -->
    <div class="menu-overlay" id="popupOverlay"></div>
    <div class="popup-newsletter" id="popup">
        <button class="popup-close" onclick="closePopup()">×</button>
        <p class="popup-tag">First Time?</p>
        <h2 class="popup-title">JOIN THE <em>#AZWASQUAD</em></h2>
        <p class="popup-subtitle">AND GET 20% OFF!</p>
        <div class="popup-code">
            <p class="popup-code-text">USE CODE:</p>
            <p class="popup-code-value">FIRSTJEWEL20</p>
        </div>
        <form class="newsletter-form">
            <input type="email" placeholder="Enter your email" class="newsletter-input">
            <button type="submit" class="newsletter-btn">JOIN</button>
        </form>
    </div>

@endsection

@push('scripts')
<script>
    // Hero Slider
    let currentSlide = 0;
    const slides = document.querySelectorAll('.slide');
    const dots = document.querySelectorAll('.dot');

    if (slides.length > 0) {
        function showSlide(index) {
            slides.forEach(s => s.classList.remove('active'));
            dots.forEach(d => d.classList.remove('active'));
            slides[index].classList.add('active');
            dots[index].classList.add('active');
        }

        function nextSlide() {
            currentSlide = (currentSlide + 1) % slides.length;
            showSlide(currentSlide);
        }

        setInterval(nextSlide, 4000);

        dots.forEach((dot, i) => {
            dot.addEventListener('click', () => {
                currentSlide = i;
                showSlide(i);
            });
        });
    }

    // Popup
    setTimeout(() => {
        const popup = document.getElementById('popup');
        const alertOverlay = document.getElementById('popupOverlay');
        if(popup && alertOverlay) {
            popup.classList.add('active');
            alertOverlay.classList.add('active');
        }
    }, 5000);

    function closePopup() {
        const popup = document.getElementById('popup');
        const alertOverlay = document.getElementById('popupOverlay');
        if(popup) popup.classList.remove('active');
        if(alertOverlay) alertOverlay.classList.remove('active');
    }

    const alertOverlay = document.getElementById('popupOverlay');
    if(alertOverlay) alertOverlay.addEventListener('click', closePopup);
</script>
@endpush
