document.addEventListener('DOMContentLoaded', () => {
    const searchInput = document.getElementById('search');
    const searchResults = document.getElementById('search-results');

    searchInput.addEventListener('input', async () => {
        const query = searchInput.value.trim();
        if (query.length < 3) {
            searchResults.innerHTML = '';
            return;
        }

        try {
            const response = await fetch(`/controllers/ProductController.php?action=search&query=${encodeURIComponent(query)}`);
            const products = await response.json();
            searchResults.innerHTML = products.map(product => `
                <div class="search-result">
                    <a href="/product-details.php?id=${product.id}">${product.name}</a>
                </div>
            `).join('');
        } catch (error) {
            console.error('Erreur lors de la recherche:', error);
        }
    });
});