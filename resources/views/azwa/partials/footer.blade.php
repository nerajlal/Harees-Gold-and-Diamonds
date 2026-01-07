<!-- Footer -->
<footer style="background-color: var(--primary-color); color: var(--white);">
    <div class="footer-content">
        <!-- Brand Column -->
        <div class="footer-col">
            <div class="footer-logo">Harees Gold Diamonds</div>
            <p class="footer-tagline">Exquisite jewelry for every occasion. Discover our timeless collection of rings, necklaces, and more.</p>
            <div class="footer-social">
                <a href="#" class="social-link"><i class="fab fa-instagram"></i></a>
                <a href="#" class="social-link"><i class="fab fa-facebook-f"></i></a>
                <a href="#" class="social-link"><i class="fab fa-twitter"></i></a>
                <a href="#" class="social-link"><i class="fab fa-pinterest-p"></i></a>
            </div>
        </div>

        <!-- Shop Column -->
        <div class="footer-col">
            <h3 class="footer-heading">Shop</h3>
            <ul class="footer-links">
                <li><a href="{{ route('collection', ['category' => 'necklaces']) }}">Necklaces</a></li>
                <li><a href="{{ route('collection', ['category' => 'rings']) }}">Rings</a></li>
                <li><a href="{{ route('collection', ['category' => 'earrings']) }}">Earrings</a></li>
                <li><a href="{{ route('all-products') }}">All Products</a></li>
                <li><a href="{{ route('cosmopolitan') }}">Cosmopolitan</a></li>
            </ul>
        </div>

        <!-- Support Column -->
        <div class="footer-col">
            <h3 class="footer-heading">Support</h3>
            <ul class="footer-links">
                <li><a href="{{ route('about') }}">About Us</a></li>
                <li><a href="{{ route('contact') }}">Contact Us</a></li>
                <li><a href="#">Store Locator</a></li>
                <li><a href="{{ route('shipping-policy') }}">Shipping Policy</a></li>
                <li><a href="{{ route('return-policy') }}">Returns & Exchanges</a></li>
            </ul>
        </div>

        <!-- Chat Support Column -->
        <div class="footer-col">
            <h3 class="footer-heading">Need Assistance?</h3>
            <p class="newsletter-text">Have questions concerning our products? Chat with our support team for instant assistance.</p>
            <!-- <a href="https://wa.me/917306900600" target="_blank" class="footer-btn" style="text-decoration: none; display: inline-flex; align-items: center; justify-content: center; gap: 8px; width: auto; padding: 12px 25px; margin-top: 10px; background-color: #25D366; color: white; border: none;">
                <i class="fab fa-whatsapp" style="font-size: 20px;"></i> WhatsApp
            </a> -->
        </div>
    </div>

    <div class="footer-bottom">
        <div class="copyright">
            © 2026 Harees Gold Diamonds. All rights reserved. 
            <span style="opacity: 0.7; margin-left: 5px;">Developed by <a href="https://metora.in/" target="_blank" style="color: var(--gold); text-decoration: none; font-weight: bold;">Metora</a></span>
        </div>
        <div class="payment-icons">
            <i class="fab fa-cc-visa"></i>
            <i class="fab fa-cc-mastercard"></i>
            <i class="fab fa-cc-amex"></i>
            <i class="fab fa-google-pay"></i>
        </div>
    </div>
</footer>

<!-- Quick Action Button -->
<div class="quick-action">
    <button class="action-btn" onclick="window.scrollTo({top: 0, behavior: 'smooth'})"><i class="fas fa-arrow-up"></i></button>
</div>
