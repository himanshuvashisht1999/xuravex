<footer class="main-footer">
    <div class="container">
        <div class="footer-grid">
            <div class="footer-about">
                <div class="footer-logo">
                    <img src="https://via.placeholder.com/150x50?text=XURAVEX" alt="Xuravex Logo">
                </div>
                <p>Xuravex delivers trusted research peptides with verified quality, supported by independent lab testing and transparent reporting.</p>
            </div>
            
            <div class="footer-links">
                <h4>Quick Links</h4>
                <ul>
                    <li><a href="#">Home</a></li>
                    <li><a href="#">About</a></li>
                    <li><a href="#">Shop</a></li>
                    <li><a href="#">Contact</a></li>
                </ul>
            </div>
            
            <div class="footer-links">
                <h4>Policy</h4>
                <ul>
                    <li><a href="#">FAQ</a></li>
                    <li><a href="#">Shipping & Returns</a></li>
                    <li><a href="#">Terms & Conditions</a></li>
                    <li><a href="#">Privacy Policy</a></li>
                </ul>
            </div>
            
            <div class="footer-contact">
                <h4>Contact</h4>
                <ul>
                    <li><i class="fa-solid fa-location-dot"></i> 245 Madison Avenue, Suite 1200 NY 10016, USA</li>
                    <li><i class="fa-solid fa-envelope"></i> support@xuravex.com</li>
                    <li><i class="fa-solid fa-phone"></i> +1 (212) 555-7834</li>
                </ul>
            </div>
        </div>
        
        <div class="footer-bottom">
            <p>&copy; {{ date('Y') }}, XURAVEX</p>
        </div>
    </div>
</footer>

<style>
.main-footer {
    background: var(--primary-color);
    color: var(--white);
    padding: 60px 0 20px;
}

.footer-grid {
    display: grid;
    grid-template-columns: 2fr 1fr 1fr 1.5fr;
    gap: 40px;
    margin-bottom: 40px;
}

.footer-logo img {
    margin-bottom: 20px;
    filter: brightness(0) invert(1);
}

.footer-about p {
    color: var(--gray-400);
    font-size: 14px;
}

.footer-links h4, .footer-contact h4 {
    color: var(--accent-color);
    margin-bottom: 25px;
    font-size: 18px;
}

.footer-links ul li {
    margin-bottom: 12px;
}

.footer-links ul li a {
    color: var(--gray-400);
    font-size: 14px;
}

.footer-links ul li a:hover {
    color: var(--accent-color);
    padding-left: 5px;
}

.footer-contact ul li {
    display: flex;
    gap: 15px;
    margin-bottom: 15px;
    color: var(--gray-400);
    font-size: 14px;
}

.footer-contact i {
    color: var(--accent-color);
    margin-top: 4px;
}

.footer-bottom {
    border-top: 1px solid rgba(255, 255, 255, 0.1);
    padding-top: 20px;
    text-align: center;
}

.footer-bottom p {
    font-size: 12px;
    color: var(--gray-500);
}

@media (max-width: 992px) {
    .footer-grid {
        grid-template-columns: 1fr 1fr;
    }
}

@media (max-width: 576px) {
    .footer-grid {
        grid-template-columns: 1fr;
    }
}
</style>
