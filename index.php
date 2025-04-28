<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Manga Meow - Your Favorite Manga Store</title>
    <link rel="stylesheet" href="View/css/style.css">
    <link rel="stylesheet" href="View/css/responsive.css">
    <!-- Font Awesome for icons -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.1/css/all.min.css">
</head>
<body>
    <header>
        <nav class="main-nav">
            <div class="nav-brand">
                <a href="index.php">
                    <h1>Manga Meow</h1>
                </a>
            </div>
            <div class="nav-toggle" id="navToggle">
                <i class="fas fa-bars"></i>
            </div>
            <ul class="nav-links" id="navLinks">
                <li><a href="index.php">Home</a></li>
                <li><a href="Controller/catalog.php">Catalog</a></li>
                <li><a href="Controller/cart.php"><i class="fas fa-shopping-cart"></i> Cart</a></li>
                <?php
                session_start();
                if(isset($_SESSION['user_id'])) {
                    echo '<li><a href="Controller/profile.php"><i class="fas fa-user"></i> Profile</a></li>';
                    echo '<li><a href="Controller/logout.php">Logout</a></li>';
                } else {
                    echo '<li><a href="Controller/login.php">Login</a></li>';
                    echo '<li><a href="Controller/register.php">Register</a></li>';
                }
                ?>
            </ul>
        </nav>
    </header>

    <main>
        <section class="hero">
            <div class="hero-content">
                <h2>Welcome to Manga Meow</h2>
                <p>Discover your next favorite manga series!</p>
                <a href="Controller/catalog.php" class="cta-button">Browse Catalog</a>
                <a href 
            </div>
        </section>

        <section class="featured-manga">
            <h2>Featured Manga</h2>
            <div class="manga-grid" id="featuredManga">
                <!-- Manga items will be loaded here via JavaScript -->
            </div>
        </section>
    </main>

    <footer>
        <div class="footer-content">
            <div class="footer-section">
                <h3>Manga Meow</h3>
                <p>Your trusted source for the best manga collection</p>
            </div>
            <div class="footer-section">
                <h3>Quick Links</h3>
                <ul>
                    <li><a href="php/about.php">About Us</a></li>
                    <li><a href="php/contact.php">Contact</a></li>
                    <li><a href="php/shipping.php">Shipping Info</a></li>
                </ul>
            </div>
            <div class="footer-section">
                <h3>Connect With Us</h3>
                <div class="social-links">
                    <a href="#"><i class="fab fa-facebook"></i></a>
                    <a href="#"><i class="fab fa-twitter"></i></a>
                    <a href="#"><i class="fab fa-instagram"></i></a>
                </div>
            </div>
        </div>
        <div class="footer-bottom">
            <p>&copy; 2024 Manga Meow. All rights reserved.</p>
        </div>
    </footer>

    <script src="View/js/main.js"></script>
    <script src="View/js/api.js"></script>
</body>
</html>