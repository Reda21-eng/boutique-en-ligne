async function addToCart(productId) {
    try {
        const response = await fetch('/controllers/CartController.php?action=add', {
            method: 'POST',
            headers: { 'Content-Type': 'application/json' },
            body: JSON.stringify({ product_id: productId, quantity: 1 })
        });
        const result = await response.json();
        if (result.success) {
            alert('Produit ajouté au panier !');
        } else {
            alert('Erreur lors de l\'ajout au panier');
        }
    } catch (error) {
        console.error('Erreur:', error);
    }
}

async function removeFromCart(itemId) {
    try {
        const response = await fetch('/controllers/CartController.php?action=remove', {
            method: 'POST',
            headers: { 'Content-Type': 'application/json' },
            body: JSON.stringify({ item_id: itemId })
        });
        const result = await response.json();
        if (result.success) {
            location.reload();
        } else {
            alert('Erreur lors de la suppression');
        }
    } catch (error) {
        console.error('Erreur:', error);
    }
}

async function validateCart() {
    try {
        const response = await fetch('/controllers/CartController.php?action=validate', {
            method: 'POST',
            headers: { 'Content-Type': 'application/json' }
        });
        const result = await response.json();
        if (result.success) {
            alert('Commande validée !');
            location.href = '/profile.php';
        } else {
            alert('Erreur lors de la validation');
        }
    } catch (error) {
        console.error('Erreur:', error);
    }
}