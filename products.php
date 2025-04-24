<section class="products">
    <h1>Notre Boutique</h1>
    <div class="filters">
        <select id="category-filter">
            <option value="">Toutes les catégories</option>
            <?php foreach ($categories as $category): ?>
                <option value="<?php echo $category['id']; ?>"><?php echo $category['name']; ?></option>
            <?php endforeach; ?>
        </select>
    </div>
    <div class="product-grid">
        <?php foreach ($products as $product): ?>
            <div class="product-card">
                <img src="<?php echo $product['image']; ?>" alt="<?php echo $product['name']; ?>">
                <h3><?php echo $product['name']; ?></h3>
                <p><?php echo $product['price']; ?> €</p>
                <a href="/product-details.php?id=<?php echo $product['id']; ?>">Voir détails</a>
            </div>
        <?php endforeach; ?>
    </div>
</section>