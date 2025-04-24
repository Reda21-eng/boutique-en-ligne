<section class="hero">
    <h1>Bienvenue chez Neko Manga</h1>
    <p>Découvrez notre sélection de mangas exclusifs !</p>
</section>
<section class="featured-products">
    <h2>Produits Phares</h2>
    <div class="product-grid">
        <?php foreach (array_slice($products, 0, 4) as $product): ?>
            <div class="product-card">
                <img src="<?php echo $product['image']; ?>" alt="<?php echo $product['name']; ?>">
                <h3><?php echo $product['name']; ?></h3>
                <p><?php echo $product['price']; ?> €</p>
                <a href="/product-details.php?id=<?php echo $product['id']; ?>">Voir détails</a>
            </div>
        <?php endforeach; ?>
    </div>
</section>