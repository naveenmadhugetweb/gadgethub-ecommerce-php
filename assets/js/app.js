
document.addEventListener("DOMContentLoaded", function () {
    const urlParams = new URLSearchParams(window.location.search);
    // alert('hi', urlParams);
    // console.log("hellow", urlParams);

    if (urlParams.get('logout') === 'success') {
        // console.log("modal");

        var myModal = new bootstrap.Modal(document.getElementById('cartModalCenter'));
        myModal.show();
    }
});


// Product Data
const products = [
    {id:1, name:"iPhone 15 Pro Max", price:99999, oldPrice:119999, category:"electronics", rating:4.9, image:"📱", discount:17},
    {id:2, name:"Samsung Galaxy S24 Ultra", price:84999, oldPrice:99999, category:"electronics", rating:4.7, image:"📱", discount:15},
    {id:3, name:"Nike Air Jordan 1", price:12999, oldPrice:15999, category:"fashion", rating:4.8, image:"👟", discount:19},
    {id:4, name:"Sony WH-1000XM5 Headphones", price:29999, oldPrice:34999, category:"electronics", rating:4.9, image:"🎧", discount:14},
    {id:5, name:"Levis 511 Slim Fit Jeans", price:3999, oldPrice:4999, category:"fashion", rating:4.6, image:"👖", discount:20},
    {id:6, name:"MacBook Air M3", price:114999, oldPrice:129999, category:"electronics", rating:4.9, image:"💻", discount:12},
    {id:7, name:"Adidas Ultraboost 22", price:14999, oldPrice:17999, category:"fashion", rating:4.7, image:"👟", discount:17},
    {id:8, name:"Kindle Paperwhite 2024", price:13999, oldPrice:15999, category:"books", rating:4.8, image:"📖", discount:13},
    {id:9, name:"Apple Watch Series 9", price:44999, oldPrice:49999, category:"electronics", rating:4.8, image:"⌚", discount:10},
    {id:10, name:"Ray-Ban Wayfarer Sunglasses", price:8999, oldPrice:11999, category:"fashion", rating:4.7, image:"🕶️", discount:25},
    {id:11, name:"Dyson V15 Vacuum", price:59999, oldPrice:69999, category:"home", rating:4.9, image:"🧹", discount:14},
    {id:12, name:"Philips Air Fryer XL", price:12999, oldPrice:15999, category:"home", rating:4.6, image:"🍟", discount:19}
];

let cart = [];
let currentCategory = 'all';
let priceFilter = 50000;


// DOM Elements
const productsContainer = document.getElementById('productsContainer');
const cartCount = document.getElementById('cartCount');
const cartItemsContainer = document.getElementById('cartItemsContainer');
const cartTotal = document.getElementById('cartTotal');
const cartIcon = document.getElementById('cartIcon');
const searchInput = document.getElementById('search-Input');
const priceRange = document.getElementById('priceRange');
const priceValue = document.getElementById('priceValue');

const profileIcon = document.getElementById('profile');


// window.alert("hi");
// document.write("hello",typeof searchInput);


// Initialize
document.addEventListener('DOMContentLoaded', function() {
    renderProducts();
    setupEventListeners();
    updatePriceDisplay();
});

// Event Listeners
function setupEventListeners() {
    // Category filters
    document.querySelectorAll('[data-category]').forEach(item => {
        item.addEventListener('click', (e) => {
            e.preventDefault();
            document.querySelector('[data-category].active')?.classList.remove('active');
            item.classList.add('active');
            currentCategory = item.dataset.category;
            renderProducts();
        });
    });

    // Search
    searchInput.addEventListener('input', debounce(renderProducts, 300));

    // Price filter
    priceRange.addEventListener('input', function() {
        priceFilter = parseInt(this.value);
        updatePriceDisplay();
        renderProducts();
    });

    // Cart toggle
    cartIcon.addEventListener('click', (e) => {
        e.preventDefault();                             // stop the default behaviour of CartIcon element like href="#" to custom js (model showing like below)
        new bootstrap.Offcanvas(document.getElementById('cartOffcanvas')).show();   // which opens the sidebar
    });

    // Checkout
    document.getElementById('checkoutBtn').addEventListener('click', () => {
        if (cart.length > 0) {
            alert('Redirecting to checkout... (Demo)');
        }
    });

    // Profile toggle
    profileIcon.addEventListener('click', (e) => {
        e.preventDefault();                             // stop the default behaviour of CartIcon element like href="#" to custom js (model showing like below)
        new bootstrap.Offcanvas(document.getElementById('profileOffcanvas')).show();   // which opens the sidebar
    });


}

function renderProducts() {
    // const searchTerm = searchInput.value.toLowerCase();
    const searchTerm = searchInput ? searchInput.value.toLowerCase() : '';

    let filteredProducts = products.filter(product => {
        const matchesSearch = product.name.toLowerCase().includes(searchTerm);
        const matchesCategory = currentCategory === 'all' || product.category === currentCategory;
        const matchesPrice = product.price <= priceFilter;
        return matchesSearch && matchesCategory && matchesPrice;
    });

    productsContainer.innerHTML = filteredProducts.map(product => `
        <div class="col-xl-3 col-lg-4 col-md-6 col-sm-6">
            <div class="card product-card h-100 position-relative overflow-hidden">
                ${product.discount ? `<span class="discount-badge">${product.discount}% OFF</span>` : ''}
                <div class="product-image">${product.image}</div>
                <div class="card-body p-3">
                    <h6 class="card-title fw-semibold mb-2">${product.name}</h6>
                    <div class="mb-2">
                        <div class="d-flex align-items-center mb-1">
                            <span class="price-highlight me-2">₹${product.price.toLocaleString()}</span>
                            ${product.oldPrice ? `<span class="text-muted text-decoration-line-through small">₹${product.oldPrice.toLocaleString()}</span>` : ''}
                        </div>
                        <div class="d-flex align-items-center gap-1 small">
                            <i class="fas fa-star stars"></i>
                            <span>${product.rating}</span>
                        </div>
                    </div>
                    <button class="btn btn-warning w-100 fw-semibold py-2 add-to-cart-btn" 
                            onclick="addToCart(${product.id})">
                        <i class="fas fa-cart-plus me-1"></i>Add to Cart
                    </button>
                </div>
            </div>
        </div>
    `).join('');

    // Add event listeners to new buttons
    document.querySelectorAll('.add-to-cart-btn').forEach(btn => {
        btn.addEventListener('click', function(e) {
            e.stopPropagation();
        });
    });
}

// Cart Functions
function addToCart(productId) {
    const product = products.find(p => p.id === productId);
    const existingItem = cart.find(item => item.id === productId);

    if (existingItem) {
        existingItem.quantity += 1;
    } else {
        cart.push({...product, quantity: 1});
    }

    updateCartUI();
    showToast('Item added to cart!', 'success');
}

function updateCartUI() {
    const totalItems = cart.reduce((sum, item) => sum + item.quantity, 0);
    cartCount.textContent = totalItems;
    cartCount.style.display = totalItems > 0 ? 'inline-flex' : 'none';

    if (cart.length === 0) {
        cartItemsContainer.innerHTML = `
            <div class="text-center py-5">
                <i class="fas fa-shopping-cart fa-3x text-muted mb-3"></i>
                <h6 class="text-muted">Your cart is empty</h6>
                <p class="text-muted small">Add items to cart to see them here</p>
            </div>
        `;
        cartTotal.textContent = '₹0.00';
        document.getElementById('checkoutBtn').disabled = true;
    } else {
        cartItemsContainer.innerHTML = cart.map((item, index) => `
            <div class="d-flex align-items-center p-3 border-bottom">
                <img src="#" class="cart-item-image rounded me-3" alt="${item.name}">
                <div class="flex-grow-1">
                    <h6 class="mb-1">${item.name}</h6>
                    <div class="d-flex align-items-center gap-2">
                        <span class="fw-bold text-warning">₹${item.price.toLocaleString()}</span>
                        <span class="badge bg-light text-dark">${item.quantity}</span>
                    </div>
                </div>
                <div class="d-flex align-items-center gap-2">
                    <button class="btn btn-sm btn-outline-secondary" onclick="updateQuantity(${item.id}, -1)">-</button>
                    <span class="px-2">${item.quantity}</span>
                    <button class="btn btn-sm btn-outline-secondary" onclick="updateQuantity(${item.id}, 1)">+</button>
                    <button class="btn btn-sm btn-danger ms-1" onclick="removeFromCart(${item.id})">
                        <i class="fas fa-trash"></i>
                    </button>
                </div>
            </div>
        `).join('');

        const total = cart.reduce((sum, item) => sum + (item.price * item.quantity), 0);
        cartTotal.textContent = `₹${total.toLocaleString()}.00`;
        document.getElementById('checkoutBtn').disabled = false;
    }
}

function updateQuantity(productId, change) {
    const item = cart.find(item => item.id === productId);
    if (item) {
        item.quantity += change;
        if (item.quantity <= 0) {
            removeFromCart(productId);
        } else {
            updateCartUI();
        }
    }
}

function removeFromCart(productId) {
    cart = cart.filter(item => item.id !== productId);     // Arrow function used to declare single line stmt.
    updateCartUI();
}

function updatePriceDisplay() {
    priceValue.textContent = `₹${priceFilter.toLocaleString()}`;
}

// Utility Functions
function debounce(func, wait) {
    let timeout;
    return function executedFunction(...args) {
        const later = () => {
            clearTimeout(timeout);
            func(...args);
        };
        clearTimeout(timeout);
        timeout = setTimeout(later, wait);
    };
}

function showToast(message, type = 'success') {
    const toast = document.createElement('div');
    toast.className = `toast align-items-center text-white bg-${type === 'success' ? 'success' : 'danger'} border-0 position-fixed`;
    toast.setAttribute('role', 'alert');
    toast.innerHTML = `
        <div class="d-flex">
            <div class="toast-body">${message}</div>
            <button type="button" class="btn-close btn-close-white me-2 m-auto" data-bs-dismiss="toast"></button>
        </div>
    `;
    toast.style.top = '20px';
    toast.style.right = '20px';
    toast.style.zIndex = '9999';
    
    document.body.appendChild(toast);
    const bsToast = new bootstrap.Toast(toast);
    bsToast.show();
    
    toast.addEventListener('hidden.bs.toast', () => toast.remove());
}
