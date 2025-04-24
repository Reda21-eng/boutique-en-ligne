<section class="product-details">
    <img src="<?php echo $product['image']; ?>" alt="<?php echo $product['name']; ?>">
    <h1><?php echo $product['name']; ?></h1>
    <p>Prix : <?php echo $product['price']; ?> €</p>
    <p>Catégorie : <?php echo $product['category_name']; ?></p>
    <p><?php echo $product['description']; ?></p>
    <button onclick="addToCart(<?php echo $product['id']; ?>)">Ajouter au panier</button>
</section>