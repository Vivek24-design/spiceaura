<style>
/* Footer Section */
footer {
    background: #222;
    color: white;
    padding: 50px 10%;
    text-align: center;
}

.footer-container {
    display: flex;
    flex-wrap: wrap;
    justify-content: space-between;
    gap: 20px;
}

.footer-section {
    flex: 1;
    min-width: 250px;
    text-align: left;
}

.footer-section h3 {
    font-size: 1.5rem;
    margin-bottom: 10px;
    color: #ff9800;
}

.footer-section p {
    font-size: 1rem;
}

.footer-section ul {
    list-style: none;
    padding: 0;
}

.footer-section ul li {
    margin: 8px 0;
}

.footer-section ul li a {
    color: white;
    text-decoration: none;
    transition: 0.3s;
}

.footer-section ul li a:hover {
    color: #ff9800;
}

.social-icons {
    display: flex;
    gap: 14px;
    flex-wrap: wrap;
    margin-top: 10px;
}

.social-icons a {
    width: 42px;
    height: 42px;
    border-radius: 50%;
    background: rgba(255,255,255,0.08);
    border: 1px solid rgba(255,255,255,0.15);
    display: inline-flex;
    align-items: center;
    justify-content: center;
    transition: transform 0.25s ease, background 0.25s ease, border-color 0.25s ease;
    color: #ccc;
    text-decoration: none;
}

.social-icons a:hover { transform: scale(1.18) translateY(-3px); }
.social-icons a.fb:hover  { background: #1877f2; border-color: #1877f2; color: #fff; }
.social-icons a.ig:hover  { background: radial-gradient(circle at 30% 110%,#fdf497 0%,#fd5949 45%,#d6249f 60%,#285aeb 90%); border-color: #d6249f; color: #fff; }
.social-icons a.tw:hover  { background: #000; border-color: #000; color: #fff; }
.social-icons a.yt:hover  { background: #ff0000; border-color: #ff0000; color: #fff; }
.social-icons a svg { flex-shrink: 0; }

.newsletter form {
    display: flex;
    flex-direction: column;
    gap: 10px;
}

.newsletter input {
    padding: 10px;
    border: none;
    border-radius: 5px;
    font-size: 1rem;
    width: 100%;
}

.newsletter button {
    padding: 10px;
    background: #ff9800;
    border: none;
    border-radius: 5px;
    font-size: 1rem;
    color: white;
    cursor: pointer;
    transition: 0.3s;
}

.newsletter button:hover {
    background: #e68900;
}

.footer-bottom {
    margin-top: 30px;
    border-top: 1px solid #444;
    padding-top: 15px;
    font-size: 1rem;
}

@media (max-width: 1024px) {
    .footer-container, .footer-section {
        text-align: center;
    }
}
</style>
<footer>
    <div class="footer-container">
        <!-- Contact Info -->
        <div class="footer-section">
            <h3>Contact Us</h3>
            <p><strong>Address:</strong> 123 Food Street, New York, USA</p>
            <p><strong>Phone:</strong> +1 234 567 890</p>
            <p><strong>Email:</strong> contact@ourrestaurant.com</p>
        </div>

        <!-- Quick Links -->
        <div class="footer-section">
            <h3>Quick Links</h3>
            <ul>
                <li><a href="home.php">Home</a></li>
                <li><a href="main.php">Menu</a></li>
                <li><a href="reservations.php">Reservations</a></li>
                <li><a href="about.php">About Us</a></li>
                <li><a href="ambiance.php">Gallery</a></li>
                <li><a href="feedback.php">Feedback</a></li>
                <li><a href="gourmet.php">Gourmet</a></li>
            </ul>
        </div>

        <!-- Social Media -->
        <div class="footer-section">
            <h3>Follow Us</h3>
            <div class="social-icons">
                <!-- Facebook -->
                <a href="#" class="fb" title="Facebook">
                    <svg xmlns="http://www.w3.org/2000/svg" width="20" height="20" fill="currentColor" viewBox="0 0 24 24">
                        <path d="M18 2h-3a5 5 0 0 0-5 5v3H7v4h3v8h4v-8h3l1-4h-4V7a1 1 0 0 1 1-1h3z"/>
                    </svg>
                </a>
                <!-- Instagram -->
                <a href="#" class="ig" title="Instagram">
                    <svg xmlns="http://www.w3.org/2000/svg" width="20" height="20" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                        <rect x="2" y="2" width="20" height="20" rx="5" ry="5"/>
                        <circle cx="12" cy="12" r="4"/>
                        <circle cx="17.5" cy="6.5" r="1" fill="currentColor" stroke="none"/>
                    </svg>
                </a>
                <!-- X / Twitter -->
                <a href="#" class="tw" title="X (Twitter)">
                    <svg xmlns="http://www.w3.org/2000/svg" width="18" height="18" fill="currentColor" viewBox="0 0 24 24">
                        <path d="M18.244 2.25h3.308l-7.227 8.26 8.502 11.24H16.17l-5.214-6.817L4.99 21.75H1.68l7.73-8.835L1.254 2.25H8.08l4.713 6.231zm-1.161 17.52h1.833L7.084 4.126H5.117z"/>
                    </svg>
                </a>
                <!-- YouTube -->
                <a href="#" class="yt" title="YouTube">
                    <svg xmlns="http://www.w3.org/2000/svg" width="22" height="22" fill="currentColor" viewBox="0 0 24 24">
                        <path d="M19.59 6.69a2.48 2.48 0 0 0-1.75-1.75C16.25 4.5 12 4.5 12 4.5s-4.25 0-5.84.44A2.48 2.48 0 0 0 4.41 6.69 26 26 0 0 0 4 12a26 26 0 0 0 .41 5.31 2.48 2.48 0 0 0 1.75 1.75C7.75 19.5 12 19.5 12 19.5s4.25 0 5.84-.44a2.48 2.48 0 0 0 1.75-1.75A26 26 0 0 0 20 12a26 26 0 0 0-.41-5.31zM10 15.5v-7l6 3.5z"/>
                    </svg>
                </a>
            </div>
        </div>

        <!-- Newsletter Subscription -->
        <div class="footer-section newsletter">
            <h3>Subscribe to Our Newsletter</h3>
            <form action="subscribe.php" method="post">
                <input type="email" name="email" placeholder="Enter your email" required>
                <button type="submit">Subscribe</button>
            </form>
        </div>
    </div>

    <!-- Copyright & Branding -->
    <div class="footer-bottom">
        <p>&copy; <?php echo date("Y"); ?> Our Restaurant | Designed with ❤️ by Our Team</p>
    </div>
</footer>
