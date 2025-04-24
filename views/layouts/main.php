<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Neko Manga - Boutique en Ligne</title>
    <link rel="stylesheet" href="/assets/css/styles.css">
</head>
<body>
    <header>
        <img src="/assets/images/neko-manga-logo.png" alt="Neko Manga Logo" class="logo">
        <nav>
            <ul>
                <li><a href="/index.php">Accueil</a></li>
                <li><a href="/products.php">Boutique</a></li>
                <?php if (isset($_SESSION['user_id'])): ?>
                    <li><a href="/profile.php">Profil</a></li>
                    <li><a href="/cart.php">Panier</a></li>
                    <?php if ($_SESSION['is_admin']): ?>
                        <li><a href="/admin/dashboard.php">Admin</a></li>
                    <?php endif; ?>
                    <li><a href="/logout.php">Déconnexion</a></li>
                <?php else: ?>
                    <li><a href="/login.php">Connexion</a></li>
                    <li><a href="/register.php">Inscription</a></li>
                <?php endif; ?>
            </ul>
        </nav>
        <div class="search-bar">
            <input type="text" id="search" placeholder="Rechercher un manga..." autocomplete="off">
            <div id="search-results"></div>
        </div>
    </header>
    <main>
        <?php include $content; ?>
    </main>
    <footer>
        <p>© 2025 Neko Manga. Tous droits réservés.</p>
    </footer>
    <script src="/assets/js/search.js"></script>
    <script src="/assets/js/cart.js"></script>
    <script src="/assets/js/auth.js"></script>
</body>
</html>