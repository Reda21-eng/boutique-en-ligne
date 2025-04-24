<section class="cart">
    <h1>Votre Panier</h1>
    <div class="cart-items">
        <?php foreach ($cart_items as $item): ?>
            <div class="cart-item">
                <img src="<?php echo $item['product']['image']; ?>" alt="<?php echo $item['product']['name']; ?>">
                <h3><?php echo $item['product']['name']; ?></h3>
                <p>Quantité : <?php echo $item['quantity']; ?></p>
                <p>Prix : <?php echo $item['product']['price'] * $item['quantity']; ?> €</p>
                <button onclick="removeFromCart(<?php echo $item['id']; ?>)">Supprimer</button>
            </div>
        <?php endforeach; ?>
    </div>
    <p>Total : <?php echo $cart_total; ?> €</p>
    <button onclick="validateCart()">Valider le panier</button>
</section>