class MangaAPI {
    constructor() {
        this.baseUrl = 'Controller/api.php';
    }

    async getFeaturedManga() {
        try {
            const response = await fetch(`${this.baseUrl}?action=featured`);
            const data = await response.json();
            return data;
        } catch (error) {
            console.error('Error fetching featured manga:', error);
            return [];
        }
    }

    async searchManga(query) {
        try {
            const response = await fetch(`${this.baseUrl}?action=search&query=${encodeURIComponent(query)}`);
            const data = await response.json();
            return data;
        } catch (error) {
            console.error('Error searching manga:', error);
            return [];
        }
    }

    async getMangaDetails(id) {
        try {
            const response = await fetch(`${this.baseUrl}?action=details&id=${id}`);
            const data = await response.json();
            return data;
        } catch (error) {
            console.error('Error fetching manga details:', error);
            return null;
        }
    }
}

// Create manga card HTML
function createMangaCard(manga) {
    const price = (Math.random() * (30 - 10) + 10).toFixed(2); // Random price between 10 and 30
    return `
        <div class="manga-card" data-id="${manga.mal_id}">
            <img src="${manga.image_url}" alt="${manga.title}">
            <div class="manga-info">
                <h3 class="manga-title">${manga.title}</h3>
                <p class="manga-price">$${price}</p>
                <button class="add-to-cart-btn" onclick="addToCart(${manga.mal_id}, '${manga.title}', ${price})">
                    Add to Cart
                </button>
            </div>
        </div>
    `;
}

// Initialize API
const mangaAPI = new MangaAPI();

// Load featured manga on homepage
async function loadFeaturedManga() {
    const featuredContainer = document.getElementById('featuredManga');
    if (featuredContainer) {
        const manga = await mangaAPI.getFeaturedManga();
        const mangaHTML = manga.map(createMangaCard).join('');
        featuredContainer.innerHTML = mangaHTML;
    }
}

// Add to cart functionality
function addToCart(mangaId, title, price) {
    let cart = JSON.parse(localStorage.getItem('cart')) || [];
    
    const existingItem = cart.find(item => item.id === mangaId);
    if (existingItem) {
        existingItem.quantity += 1;
    } else {
        cart.push({
            id: mangaId,
            title: title,
            price: price,
            quantity: 1
        });
    }
    
    localStorage.setItem('cart', JSON.stringify(cart));
    updateCartCount();
    alert('Added to cart!');
}

// Update cart count in navigation
function updateCartCount() {
    const cart = JSON.parse(localStorage.getItem('cart')) || [];
    const totalItems = cart.reduce((sum, item) => sum + item.quantity, 0);
    const cartLink = document.querySelector('.nav-links a[href="Controller/cart.php"]');
    if (cartLink) {
        cartLink.innerHTML = `<i class="fas fa-shopping-cart"></i> Cart (${totalItems})`;
    }
}

// Initialize
document.addEventListener('DOMContentLoaded', () => {
    loadFeaturedManga();
    updateCartCount();
});