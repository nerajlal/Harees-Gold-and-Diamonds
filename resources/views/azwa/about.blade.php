@extends('nurah.layouts.app')

@section('title', 'About Us - Nurah Perfumes')

@push('styles')
<style>
    .about-hero {
        position: relative;
        height: 60vh;
        min-height: 400px;
        background-image: url('https://myop.in/cdn/shop/files/Storekurla.jpg?v=1715596487&width=2500');
        background-size: cover;
        background-position: center;
        display: flex;
        align-items: center;
        justify-content: center;
    }

    .about-hero::before {
        content: '';
        position: absolute;
        inset: 0;
        background: rgba(0,0,0,0.5);
    }

    .hero-content {
        position: relative;
        color: var(--white);
        text-align: center;
        padding: 20px;
    }

    .hero-title {
        font-family: 'Playfair Display', serif;
        font-size: 48px;
        font-weight: 700;
        margin-bottom: 20px;
    }

    .hero-subtitle {
        font-size: 18px;
        max-width: 600px;
        margin: 0 auto;
        line-height: 1.6;
    }

    .about-section {
        padding: 80px 20px;
        max-width: 1200px;
        margin: 0 auto;
    }

    .story-grid {
        display: grid;
        grid-template-columns: 1fr;
        gap: 50px;
        align-items: center;
    }

    .story-content h2 {
        font-family: 'Playfair Display', serif;
        font-size: 36px;
        margin-bottom: 30px;
        color: var(--black);
    }

    .story-text {
        font-size: 16px;
        color: var(--text);
        line-height: 1.8;
        margin-bottom: 20px;
    }

    .values-grid {
        display: grid;
        grid-template-columns: repeat(3, 1fr);
        gap: 30px;
        margin-top: 80px;
        text-align: center;
    }

    .value-card {
        padding: 40px 20px;
        background: var(--bg-light);
        border-radius: 20px;
        transition: transform 0.3s;
    }

    .value-card:hover {
        transform: translateY(-5px);
    }

    .value-icon {
        font-size: 40px;
        margin-bottom: 20px;
        color: var(--black);
    }

    .value-title {
        font-family: 'Playfair Display', serif;
        font-size: 24px;
        font-weight: 700;
        margin-bottom: 15px;
        color: var(--black);
    }

    .value-text {
        font-size: 14px;
        color: var(--text-light);
        line-height: 1.6;
    }

    @media (min-width: 768px) {
        .story-grid {
            grid-template-columns: 1fr 1fr;
        }
    }

    @media (max-width: 768px) {
        .values-grid {
            grid-template-columns: 1fr;
        }
        .hero-title {
            font-size: 36px;
        }
    }
</style>
@endpush

@section('content')
    <!-- Hero Section -->
    <div class="about-hero">
        <div class="hero-content">
            <h1 class="hero-title">Our Story</h1>
            <p class="hero-subtitle">Crafting India's finest jewelry with passion, expertise, and a touch of magic.</p>
        </div>
    </div>

    <!-- Brand Story -->
    <section class="about-section">
        <div class="story-grid">
            <div class="story-image">
                <img src="https://myop.in/cdn/shop/files/Storekurla.jpg?v=1715596487&width=800" alt="Azwa Store" style="width: 100%; border-radius: 20px;">
            </div>
            <div class="story-content">
                <h2>Why We Do, What We Do</h2>
                <p class="story-text">
                    Azwa Jewelry was born from a simple yet profound desire: to bring the art of high-quality jewelry to everyone. We believe that a piece of jewelry is more than just an accessory; it's a memory, an emotion, and a personal statement.
                </p>
                <p class="story-text">
                    As India's pioneering jewelry boutique, we combine traditional expertise with modern designs. Our pieces are crafted with <strong>certified gold and diamonds</strong>, ensuring they sparkle for a lifetime and become heirlooms for generations.
                </p>
                <p class="story-text">
                    Every piece tells a story of craftsmanship, dedication, and the pursuit of excellence. We invite you to find your signature sparkle with us.
                </p>
            </div>
        </div>

        <!-- Values -->
        <div class="values-grid">
            <div class="value-card">
                <div class="value-icon"><i class="fas fa-gem"></i></div>
                <h3 class="value-title">Premium Quality</h3>
                <p class="value-text">Sourced from the finest materials, our jewelry offers luxury that you can wear every day.</p>
            </div>
            <div class="value-card">
                <div class="value-icon"><i class="fas fa-hammer"></i></div>
                <h3 class="value-title">Expertly Crafted</h3>
                <p class="value-text">Our designs are meticulously hand-crafted by skilled artisans for perfection.</p>
            </div>
            <div class="value-card">
                <div class="value-icon"><i class="fas fa-users"></i></div>
                <h3 class="value-title">Customer First</h3>
                <p class="value-text">From our store experience to online support, we are dedicated to helping you find your perfect match.</p>
            </div>
        </div>
    </section>
@endsection
