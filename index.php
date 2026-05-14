<?php
session_start();

if (!isset($_SESSION['user_id'])) {
    header("Location: ../GadgetHub/auth/login.php");
    exit();
}

?>
<?php include 'includes/header.php'; ?>

    <title>GadgetHub-Shop - Buy Everything Online</title>

    <!-- Topbar -->
    <div class="topbar bg-light py-2 border-bottom">
        <div class="container">
            <div class="row align-items-center">
                <div class="col-md-6">
                    <span class="text-muted small">
                        <i class="fas fa-truck me-1"></i> Free Delivery on Orders ₹999+
                    </span>
                </div>
                <div class="col-md-6 text-end">
                    <span class="text-muted small">
                        <i class="fas fa-phone me-1"></i> 1800-123-4567
                    </span>
                </div>
            </div>
        </div>
    </div>

    <!-- Navbar -->
    <nav class="navbar navbar-expand-lg navbar-light bg-white shadow-sm sticky-top">
        <div class="container">
            <!-- Logo -->
            <a class="navbar-brand fw-bold fs-4" href="#">
                <i class="fas fa-shopping-bag text-warning me-2"></i>GadgetHub-Shop
            </a>

            <!-- Mobile collapse button -->
            <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNav">
                <span class="navbar-toggler-icon"></span>
            </button>

            <!-- Search Form -->
            <div class="search-container mx-auto">
                <form class="d-flex position-relative">
                    <input class="form-control me-2 search-input shadow-sm" type="search" placeholder="Search for products..." id="search-Input">
                    <button class="btn btn-warning position-absolute end-0 top-0 bottom-0 px-3" type="submit">
                        <i class="fas fa-search"></i>
                    </button>
                </form>
            </div>

            <!-- Nav Icons -->
            <div class="navbar-nav ms-auto align-items-center">
                <a class="nav-link px-3" href="#"><i class="fas fa-heart fs-5"></i></a>
                <a class="nav-link px-3 position-relative cart-toggle" href="#" id="cartIcon">
                    <i class="fas fa-shopping-cart fs-5"></i>
                    <span class="cart-badge badge rounded-pill bg-danger" id="cartCount">0</span>
                </a>
                <a class="nav-link px-3" href="#" id="profile"><i class="fas fa-user fs-5"></i></a>
            </div>
        </div>
    </nav>

    <!-- Main Container -->
    <div class="container-fluid py-4">
        <div class="row g-4">
            <!-- Left Sidebar -->
            <div class="col-lg-3 col-md-4 col-12">
                <div class="card shadow-sm h-50 sticky-top" style="top: 20px;">
                    <div class="card-header bg-white border-0 pb-0">
                        <h6 class="fw-bold mb-3">
                            <i class="fas fa-list text-warning me-2"></i>Shop by Category
                        </h6>
                    </div>
                    <div class="card-body pt-0">
                        <div class="list-group list-group-flush">
                            <a href="#" class="list-group-item list-group-item-action active fw-semibold" data-category="all">
                                <i class="fas fa-th-large me-2 text-warning"></i>All Products
                            </a>
                            <a href="#" class="list-group-item list-group-item-action" data-category="electronics">
                                <i class="fas fa-laptop me-2"></i>Electronics
                            </a>
                            <a href="#" class="list-group-item list-group-item-action" data-category="fashion">
                                <i class="fas fa-tshirt me-2"></i>Fashion
                            </a>
                            <a href="#" class="list-group-item list-group-item-action" data-category="home">
                                <i class="fas fa-home me-2"></i>Home & Living
                            </a>
                            <a href="#" class="list-group-item list-group-item-action" data-category="books">
                                <i class="fas fa-book me-2"></i>Books
                            </a>
                            <a href="#" class="list-group-item list-group-item-action" data-category="sports">
                                <i class="fas fa-dumbbell me-2"></i>Sports
                            </a>
                        </div>
                    </div>
                </div>

                <!-- Price Filter -->
                <div class="card shadow-sm mt-4 h-50 sticky-top" style="top: 20px;">
                    <div class="card-header bg-white border-0 pb-0">
                        <h6 class="fw-bold mb-3">Price Range</h6>
                    </div>
                    <div class="card-body pt-0">
                        <div class="mb-3">
                            <input type="range" class="form-range" id="priceRange" min="0" max="50000" value="50000">
                            <div class="d-flex justify-content-between small text-muted mt-1">
                                <span>₹0</span>
                                <span id="priceValue">₹50,000</span>
                            </div>
                        </div>
                        <button class="btn btn-outline-warning w-100">Filter</button>
                    </div>
                </div>
            </div>

            <!-- Main Content -->
            <div class="col-lg-9 col-md-8 col-12">
                <!-- Breadcrumb & Sort -->
                <div class="row align-items-center mb-4">
                    <div class="col-md-6">
                        <nav aria-label="breadcrumb">
                            <ol class="breadcrumb mb-0">
                                <li class="breadcrumb-item"><a href="#">Home</a></li>
                                <li class="breadcrumb-item active">Products</li>
                            </ol>
                        </nav>
                    </div>
                    <div class="col-md-6 text-md-end mt-2 mt-md-0">
                        <div class="d-flex align-items-center gap-2 justify-content-md-end">
                            <label class="mb-0 small text-muted">Sort by:</label>
                            <select class="form-select form-select-sm" style="width: auto;">
                                <option>Popularity</option>
                                <option>Price - Low to High</option>
                                <option>Price - High to Low</option>
                                <option>Newest</option>
                            </select>
                        </div>
                    </div>
                </div>

                <!-- Products Grid -->
                <div class="row g-3 mb-5" id="result">
                     Products will be loaded here
                </div>

                <!-- Products Grid -->
                <div class="row g-3 mb-5 d-none" id="productsContainer">
                    Products will be loaded here
                </div>

                <!-- Load More Button -->
                <div class="text-center" id="search-Input">
                    <button class="btn btn-outline-warning btn-lg">
                        <i class="fas fa-plus me-2"></i>Load More Products
                    </button>
                </div>
            </div>
        </div>
    </div>

    <!-- Cart Sidebar -->
    <div class="offcanvas offcanvas-end cart-offcanvas" tabindex="-1" id="cartOffcanvas">
        <div class="offcanvas-header border-bottom">
            <h5 class="offcanvas-title fw-bold">
                <i class="fas fa-shopping-cart me-2 text-warning"></i>My Cart
            </h5>
            <button type="button" class="btn-close" data-bs-dismiss="offcanvas"></button>
        </div>
        <div class="offcanvas-body p-0">
            <div id="cartItemsContainer" class="p-3">
                <div class="text-center py-5">
                    <i class="fas fa-shopping-cart fa-3x text-muted mb-3"></i>
                    <h6 class="text-muted">Your cart is empty</h6>
                    <p class="text-muted small">Add items to cart to see them here</p>
                </div>
            </div>
            <div class="p-3 border-top">
                <div class="d-flex justify-content-between align-items-center mb-3">
                    <span class="fs-5 fw-bold">Total:</span>
                    <span class="fs-4 fw-bold text-warning" id="cartTotal">₹0.00</span>
                </div>
                <button class="btn btn-warning w-100 py-3 fw-bold rounded-0" id="checkoutBtn">
                    <i class="fas fa-credit-card me-2"></i>PROCEED TO CHECKOUT
                </button>
            </div>
        </div>
    </div>

    <!-- Profile Sidebar -->
    <div class="offcanvas offcanvas-end cart-offcanvas" tabindex="-1" id="profileOffcanvas">
        <div class="offcanvas-header border-bottom">
            <h5 class="offcanvas-title fw-bold">
                <i class="bi bi-person-fill me-2 text-warning"></i>Profile
            </h5>
            <button type="button" class="btn-close" data-bs-dismiss="offcanvas"></button>
        </div>
        <div class="offcanvas-body p-0">
                <div class="card shadow-sm h-100 sticky-top" style="top: 20px;">
                    <div class="card-header bg-white border-0 pb-0">
                        <h6 class="fw-bold mb-3">
                            <i class="fas fa-list text-warning me-2"></i>My Profile
                        </h6>
                    </div>
                    <div class="card-body pt-0">
                        <div class="list-group list-group-flush">
                            <a href="#" class="list-group-item list-group-item-action active fw-semibold" data-category="all">
                                <i class="bi bi-bag text-warning me-2"></i>Orders
                            </a>
                            <a href="#" class="list-group-item list-group-item-action" data-category="electronics">
                                <i class="bi bi-heart me-2"></i>Wishlist
                            </a>
                            <a href="#" class="list-group-item list-group-item-action" data-category="fashion">
                                <i class="bi bi-gear me-2"></i>Settings
                            </a>
                            <form action="auth/logout.php?logout=success"  method="post" class="p-2 list-group-item list-group-item-action">
                                <button type="submit" class="border-0 bg-transparent text-start w-100" style="background-color:noen;"><i class="bi bi-box-arrow-right me-2"></i> Logout</button>
                            </form>
                        </div>
                    </div>
                </div>
        </div>
    </div>


    <!-- <div class="bg-danger" id="result"></div> -->


    <!-- Backdrop for Cart -->
    <!-- <div class="offcanvas-backdrop fade"></div> -->

    <!-- Footer -->
    <footer class="bg-dark text-light py-5 mt-5">
        <div class="container">
            <div class="row g-4">
                <div class="col-lg-4 col-md-6">
                    <h5 class="fw-bold mb-3">
                        <i class="fas fa-shopping-bag me-2 text-warning"></i>E-Shop
                    </h5>
                    <p class="opacity-75">India's largest online store. Best prices, fastest delivery, and top customer service.</p>
                    <div class="d-flex gap-2">
                        <a href="#" class="btn btn-outline-light btn-sm rounded-circle">
                            <i class="fab fa-facebook-f"></i>
                        </a>
                        <a href="#" class="btn btn-outline-light btn-sm rounded-circle">
                            <i class="fab fa-instagram"></i>
                        </a>
                        <a href="#" class="btn btn-outline-light btn-sm rounded-circle">
                            <i class="fab fa-twitter"></i>
                        </a>
                    </div>
                </div>
                <div class="col-lg-2 col-md-6">
                    <h6 class="fw-bold mb-3">Quick Links</h6>
                    <ul class="list-unstyled">
                        <li><a href="#" class="text-light text-decoration-none opacity-75">About Us</a></li>
                        <li><a href="#" class="text-light text-decoration-none opacity-75">Contact</a></li>
                        <li><a href="#" class="text-light text-decoration-none opacity-75">Careers</a></li>
                        <li><a href="#" class="text-light text-decoration-none opacity-75">Press</a></li>
                    </ul>
                </div>
                <div class="col-lg-2 col-md-6">
                    <h6 class="fw-bold mb-3">Customer Care</h6>
                    <ul class="list-unstyled">
                        <li><a href="#" class="text-light text-decoration-none opacity-75">Help Center</a></li>
                        <li><a href="#" class="text-light text-decoration-none opacity-75">Returns</a></li>
                        <li><a href="#" class="text-light text-decoration-none opacity-75">Shipping</a></li>
                        <li><a href="#" class="text-light text-decoration-none opacity-75">Track Order</a></li>
                    </ul>
                </div>
                <div class="col-lg-2 col-md-6">
                    <h6 class="fw-bold mb-3">Payments</h6>
                    <div class="d-flex flex-column gap-2 small opacity-75">
                        <span><i class="fab fa-cc-visa me-1"></i>Visa</span>
                        <span><i class="fab fa-cc-mastercard me-1"></i>Mastercard</span>
                        <span><i class="fab fa-cc-paypal me-1"></i>PayPal</span>
                        <span>UPI • Net Banking</span>
                    </div>
                </div>
                <div class="col-lg-2 col-md-6">
                    <h6 class="fw-bold mb-3">Download App</h6>
                    <div class="d-flex flex-column gap-2">
                        <a href="#" class="btn btn-outline-light btn-sm">
                            <i class="fab fa-apple me-1"></i>App Store
                        </a>
                        <a href="#" class="btn btn-outline-light btn-sm">
                            <i class="fab fa-google-play me-1"></i>Play Store
                        </a>
                    </div>
                </div>
            </div>
            <hr class="my-4 opacity-25">
            <div class="text-center opacity-75">
                <p>&copy; 2026 E-Shop. All rights reserved | Made with <i class="fas fa-heart text-danger"></i> in India</p>
            </div>
        </div>
    </footer>


    <!-- Custom JS -->
    <script src="/GadgetHub/assets/js/app.js"></script> 
    <!-- custom js Must be end of the html docs.-->
    <!-- WHY: If header in included file then some elements will readed before html docs loaded -->
