<footer class="site-footer" role="contentinfo" aria-label="Footer">
    <div class="footer-container">
        <div class="footer-section about">
            <h3>Rent A Car Diari</h3>
            <p>Your trusted car rental partner in Prishtina. Quality cars, great prices, and excellent service.</p>
        </div>

        <div class="footer-section links">
            <h4>Quick Links</h4>
            <ul>
                <li><a href="index.php">Home</a></li>
                <li><a href="register.php">Register</a></li>
                <li><a href="searchResults.php">Search Cars</a></li>
                <li><a href="contact.php">Contact Us</a></li>
            </ul>
        </div>

        <div class="footer-section contact">
            <h4>Contact</h4>
            <p>Address: Rruga e Prishtinës, Prishtina, Kosovo</p>
            <p>Phone: +383 44 123 456</p>
            <p>Email: info@rentacar-diari.com</p>
            <div class="social-icons" aria-label="Social media links">
                <a href="#" aria-label="Facebook" target="_blank" rel="noopener"><img src="https://cdn-icons-png.flaticon.com/24/733/733547.png" alt="Facebook"></a>
                <a href="#" aria-label="Instagram" target="_blank" rel="noopener"><img src="https://cdn-icons-png.flaticon.com/24/2111/2111463.png" alt="Instagram"></a>
                <a href="#" aria-label="Twitter" target="_blank" rel="noopener"><img src="https://cdn-icons-png.flaticon.com/24/733/733579.png" alt="Twitter"></a>
            </div>
        </div>
    </div>
    <div class="footer-bottom">
        &copy; <?= date('Y') ?> Rent A Car Diari. All rights reserved.
    </div>
</footer>
<style>
    .site-footer {
        background-color: #222;
        color: #ddd;
        padding: 40px 20px 20px;
        font-size: 14px;
        font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif;
    }

    .footer-container {
        max-width: 1100px;
        margin: 0 auto;
        display: flex;
        flex-wrap: wrap;
        gap: 40px;
        justify-content: space-between;
    }

    .footer-section {
        flex: 1 1 250px;
        min-width: 220px;
    }

    .footer-section h3,
    .footer-section h4 {
        color: #f7941d;
        margin-bottom: 15px;
    }

    .footer-section p,
    .footer-section ul,
    .footer-section li {
        margin: 0;
        padding: 0;
        list-style: none;
        color: #ccc;
    }

    .footer-section ul {
        margin-top: 10px;
    }

    .footer-section ul li {
        margin-bottom: 10px;
    }

    .footer-section ul li a {
        color: #ccc;
        text-decoration: none;
        transition: color 0.3s ease;
    }

    .footer-section ul li a:hover,
    .footer-section ul li a:focus {
        color: #f7941d;
        outline: none;
    }

    .social-icons {
        margin-top: 10px;
    }

    .social-icons a {
        display: inline-block;
        margin-right: 10px;
        opacity: 0.8;
        transition: opacity 0.3s ease;
    }

    .social-icons a:hover,
    .social-icons a:focus {
        opacity: 1;
        outline: none;
    }

    .footer-bottom {
        text-align: center;
        padding: 20px 0 10px;
        color: #777;
        border-top: 1px solid #444;
        font-size: 13px;
    }

    /* Responsive */
    @media (max-width: 768px) {
        .footer-container {
            flex-direction: column;
            gap: 30px;
        }
    }
</style>