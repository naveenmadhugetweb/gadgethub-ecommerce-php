// Page Loading Time It Will Calling DOM
document.addEventListener("DOMContentLoaded", async function () {       // async for await
    const urlParams = new URLSearchParams(window.location.search);
    // alert('hi', urlParams);
    // console.log("hellow", urlParams);

    if (urlParams.get('logout') === 'success') {
        // console.log("modal");

        var myModal = new bootstrap.Modal(document.getElementById('cartModalCenter'));
        myModal.show();
    }
/*
        // Calling PHP file 
        // this method not possible to filter or search and more so commented
        fetch("includes/loadProducts.php")
            .then(response => response.text())
            .then(data => {
                document.getElementById("result").innerHTML = data;
            })
            .catch(error => {
                console.log("Error:", error);
            });
*/
        await loadProducts();
        renderProducts();
        setupEventListeners();
        updatePriceDisplay();
    });
    

    // Load Product Data
let products = [];
async function loadProducts() {
    const response = await fetch('includes/getProducts.php');
        products = await response.json();
        // in database id and price field are string means varchar so need to convert into numerical for add to cart and some other process.
        products = products.map(product => ({
        ...product,
        id: parseInt(product.id),
        price: parseFloat(product.price)
        }));
        //console.log("helo", products);

}

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
    // console.log("HI", products);
    let filteredProducts = products.filter(product => { // filter will return true if match found otherwise return false.
        const matchesSearch = product.product_name.toLowerCase().includes(searchTerm);              // name into product_name fr product search
        const matchesCategory = currentCategory === 'all' || product.category_name === currentCategory;
        const matchesPrice = product.price <= priceFilter;
        return matchesSearch && matchesCategory && matchesPrice;
    });

    productsContainer.innerHTML = filteredProducts.map(product => `
        <div class="col-xl-3 col-lg-4 col-md-6 col-sm-6">
            <div class="card product-card h-100 position-relative overflow-hidden">
                ${product.discount ? `<span class="discount-badge">${product.discount}% OFF</span>` : ''}
                <div class="product-image"> <img class="w-100" src="/GADGETHUB/uploads/${product.image}"></div>       <!-- here,src accept absolute url -->
                <div class="card-body p-3">
                    <h6 class="card-title fw-semibold mb-2">${product.product_name}</h6>
                    <div class="mb-2">
                        <div class="d-flex align-items-center mb-1">
                            <span class="price-highlight me-2">₹${product.price.toLocaleString()}</span>
                            ${product.price ? `<!-- <span class="text-muted text-decoration-line-through small">₹${product.price.toLocaleString()}</span> -->` : ''}         <!-- need to update old price field in db later -->
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
                <img src="/GADGETHUB/uploads/${item.image}" class="cart-item-image rounded me-3" alt="${item.product_name}">
                <div class="flex-grow-1">
                    <h6 class="mb-1">${item.product_name}</h6>
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
