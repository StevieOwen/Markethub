<?php 
include APPROOT . "/Views/inc/header.php";
//navbar
include APPROOT . "/Views/inc/navbar.php";
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="<?php echo URLROOT;?>/css/dashboard.css">
    <title>Dashboard</title>
</head>
<body>
    <!-- keep customer id  -->
    <form action="">   
        <input type="hidden" value="<?php echo $cust_id;?>" id="cust_id">
    </form> 

    <div class="dashboard-container">

        <button class="mobile-toggle" id="mobileToggle">
            <div class="hamburger-lines">
                <span></span>
                <span></span>
                <span></span>
            </div>
        </button>
        
        <aside class="sidebar" id="sidebar">
            <div class="shop-branding">
                <div class="logo-circle">
                    <img id="shopLogo" src="<?php echo URLROOT;?>/uploads/logos/" alt="Shop Logo">
                </div>
                <h3 id="shopName"></h3>
                <h6 id="shopContact"></h6>
            </div>

            <nav class="side-menu">
                <a href="#" class="menu-item active"   data-target="overview_section">
                    <i class="fas fa-home"></i> <span id="overviewLink">Overview</span>
                </a>
                <a href="#" class="menu-item"  data-target="addProducts_section">
                    <i class="fas fa-plus"></i> <span id="addProductLink">Add Products</span>
                </a>
                <a href="#" class="menu-item"  data-target="inventory_section">
                    <i class="fas fa-boxes"></i> <span id="inventoryLink">My Inventory</span>
                </a>
                <a href="#" class="menu-item"  data-target="orders_section">
                    <i class="fas fa-shopping-cart"></i> <span id="orderLink">Orders</span>
                </a>
            </nav>
        </aside>

         <main class="main-dashboard" >
            <div class="welcome-section">
                <h2 id="welcome"></h2>
            </div>

            
            <div id="dashboardContent" >
                <!-- Overview section -->
               <section class="content-view" id="overview_section">
                    <h3>Dashboard Overview</h3>

                    <div class="stats-grid">
                        <div class="stat-card">
                            <div class="stat-icon icon-sales">
                                <i class="fas fa-dollar-sign"></i>
                            </div>
                            <div class="stat-details">
                                <span class="stat-label">Total Sales</span>
                                <h3 class="stat-value">Rwf0.00</h3>
                                <p class="stat-trend positive"><i class="fas fa-arrow-up"></i> 12% inc.</p>
                            </div>
                        </div>

                        <div class="stat-card">
                            <div class="stat-icon icon-products">
                                <i class="fas fa-box"></i>
                            </div>
                            <div class="stat-details">
                                <span class="stat-label">Active Products</span>
                                <h3 class="stat-value">0</h3>
                                <p class="stat-subtitle">In your inventory</p>
                            </div>
                        </div>

                        <div class="stat-card">
                            <div class="stat-icon icon-orders">
                                <i class="fas fa-shopping-cart"></i>
                            </div>
                            <div class="stat-details">
                                <span class="stat-label">Total Orders</span>
                                <h3 class="stat-value">0</h3>
                                <p class="stat-subtitle">Lifetime orders</p>
                            </div>
                        </div>
                    </div>

                </section>

            <!-- Add product section -->
            <section class="tab-content hide"  id="addProducts_section">
               <div class="form-card">
                    <div class="form-header">
                        <h3><i class="fas fa-plus-circle"></i> List New Product</h3>
                    </div>
                        <!-- Form to insert product infos -->
                    <form id="productForm" action="" method="POST" enctype="multipart/form-data">
                        <div class="form-grid">
                            <!-- product name -->
                            <div class="form-section">
                                <div class="form-group">
                                    <label>Product Name</label>
                                    <input type="text" name="item_name" id="item_name" placeholder="e.g. Slim Fit Denim" value="" required>
                                    <p id="emptyName" class="error-text" ></p>
                                </div>
                                <!-- Product brand -->
                                <div class="form-row">
                                    <div class="form-group">
                                        <label>Brand</label>
                                        <input type="text" name="item_brand" id="item_brand" value="" placeholder="Brand Name">
                                    </div>
                                    <div class="form-group">
                                        <label>Category</label>
                                        <select name="item_category" id="item_category" required>
                                            <option value="T-shirt">T-shirt</option>
                                            <option value="Pants">Pants</option>
                                            <option value="Shoes">Shoes</option>
                                            <option value="Electronics">Electronics</option>
                                            <option value="House Furnitures">House Furnitures</option>
                                            <option value="Home Accessories">Home Accessories</option>
                                            <option value="Women Clothes">Women Clothes</option>
                                            <option value="Makeup and Beauty">Makeup and Beauty</option>

                                        </select>
                                    </div>
                                </div>
                                <!-- product price -->
                                <div class="form-row">
                                    <div class="form-group">
                                        <label>Price (Rwf)</label>
                                        <input type="number" id="item_price" value="" name="item_price" placeholder="0" required>
                                        <p id="emptyPrice" class="error-text" ></p>
                                    </div>
                                    <!-- product quantity -->
                                    <div class="form-group">
                                        <label>Stock Quantity</label>
                                        <input type="number" id="item_quantity" value="" name="item_quantity" placeholder="0" required>
                                        <p id="emptyQuantity" class="error-text" ></p>
                                    </div>
                                </div>
                            </div>
                             <!-- product material -->
                            <div class="form-section">
                                <div class="form-row">
                                    <div class="form-group">
                                        <label>Material</label>
                                        <input type="text" id="item_material" value="" name="item_material" placeholder="e.g. Cotton">
                                    </div>
                                    <!-- product size -->
                                    <div class="form-group">
                                        <label>Size (where applicable)</label>
                                        <input type="text" id="item_size" value="" name="item_size" placeholder="e.g. 42, M">
                                    </div>
                                </div>
                                    <!-- Product gender type -->
                                <div class="form-group">
                                    <label>Gender</label>
                                    <div class="radio-group">
                                        <label><input type="radio" name="item_forgender" id="forMale" value="Male"> Male</label>
                                        <label><input type="radio" name="item_forgender" id="forFemale" value="Female"> Female</label>
                                    </div>
                                </div>
                                <!-- Product image -->
                                <div class="form-group">
                                    <label>Product Image</label>
                                    <div class="image-upload-box" onclick="document.getElementById('item_image').click()">
                                        <input type="file" id="item_image" name="item_image" accept="image/*" hidden>
                                        <i class="fas fa-camera"></i>
                                        <span>Upload Photo</span>
                                        <img id="previewImg" style="display:none; position:absolute; width:100%; height:100%; object-fit:cover;">
                                        <p id="emptyImage" class="error-text" ></p>
                                    </div>
                                </div>
                            </div>
                        </div>

                        <div class="form-group full-width">
                            <label>Description</label>
                            <textarea name="item_description" id="item_description" value="" rows="3" placeholder="Describe the item..."></textarea>
                        </div>

                        <div class="form-actions">
                            <button type="submit" id="add_product" class="btn-primary">Add to Inventory</button>
                        </div>
                    </form>
                </div>

            </section>

            <!-- Inventory section -->
            <section class="hide" id="inventory_section">
                <div class="inventory-container">
                    <div class="inventory-header">
                        <div class="header-titles">
                            <h3><i class="fas fa-boxes"></i> My Inventory</h3>
                            <p>Manage your products, stock levels, and pricing.</p>
                        </div>
                        <div class="inventory-actions">
                            <button class="btn-outline"><i class="fas fa-download"></i> Export</button>
                        </div>
                    </div>

                    <div class="table-responsive">
                        <table class="inventory-table">
                            <thead>
                                <tr>
                                    <th>Product</th>
                                    <th>Category</th>
                                    <th>Price</th>
                                    <th>Stock</th>
                                    <th></th>
                                    <th>Actions</th>
                                </tr>
                            </thead>
                            <tbody id="inventoryBody">
                                
                            </tbody>
                        </table>
                    </div>
                </div>    

            </section>

            <!-- order section -->
            <section class="hide" id="orders_section">
                <h3>Dashboard Orders</h3>
                <div class="orders-container">
                <div class="orders-header">
                    <div class="header-titles">
                        <h3><i class="fas fa-shopping-basket"></i> Customer Orders</h3>
                        <p>Track and manage your sales performance.</p>
                    </div>
                    <div class="order-stats-summary">
                        <div class="mini-stat">
                            <span class="label">Pending</span>
                            <span class="value warning">0</span>
                        </div>
                        <div class="mini-stat">
                            <span class="label">Completed</span>
                            <span class="value success">0</span>
                        </div>
                    </div>
                </div>

                <div class="order-filters">
                    <button class="filter-btn active">All Orders</button>
                    <button class="filter-btn">Pending</button>
                    <button class="filter-btn">Shipped</button>
                    <button class="filter-btn">Cancelled</button>
                </div>

                <div class="orders-list" id="ordersList">
                    <div class="order-card">
                        <div class="order-main">
                            <div class="customer-profile">
                                <div class="avatar-circle">JD</div>
                                <div class="customer-info">
                                    <strong>John Doe</strong>
                                    <span>Order #ORD-8821</span>
                                </div>
                            </div>
                            <div class="order-item-detail">
                                <span class="item-name">Slim Fit Denim (x2)</span>
                                <span class="order-date">March 3, 2026</span>
                            </div>
                            <div class="order-price">
                                <strong>$90.00</strong>
                                <span class="payment-method">Paid via Stripe</span>
                            </div>
                            <div class="order-status">
                                <span class="status-pill pending">Pending</span>
                            </div>
                            <div class="order-actions">
                                <button class="btn-action primary">Ship Order</button>
                                <button class="btn-action icon"><i class="fas fa-ellipsis-v"></i></button>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            </section>

            
        </div>

                
            </div>   
        </main>
    
         <!-- success modal to display when successfully adding product -->
<div id="successModal" class="modal-overlay" style="display: none !important;">
        <div class="modal-content">
            <div class="success-icon">
                <svg viewBox="0 0 52 52" class="checkmark">
                    <circle class="checkmark-circle" cx="26" cy="26" r="25" fill="none"/>
                    <path class="checkmark-check" fill="none" d="M14.1 27.2l7.1 7.2 16.7-16.8"/>
                </svg>
            </div>
            <h2 id="modal-text">Product successfully Added!</h2>
            
        </div>
</div>

<!-- modal to display when the user clicked delete product -->
<div id="deleteModal" class="modal-overlay" style="display: none !important;">
        <div class="modal-content">
            <h2>Delete Item!</h2>
            <p id="modal-p"> </p>
            <button id="modalCloseBtn" class="btn-dashboard not-del">Cancel</button>
            <input type="hidden" value="" id="del_prod">
            <button id="modalCloseBtn" class="btn-dashboard del-btn">Delete</button>
        </div>
</div>

<!-- successfully deleted item  -->
<div id="successDelModal" class="modal-overlay" style="display: none !important;">
        <div class="modal-content">
            <div class="success-icon">
                <svg viewBox="0 0 52 52" class="checkmark">
                    <circle class="checkmark-circle" cx="26" cy="26" r="25" fill="none"/>
                    <path class="checkmark-check" fill="none" d="M14.1 27.2l7.1 7.2 16.7-16.8"/>
                </svg>
            </div>
            <h2 id="modal-text">Product successfully removed! </h2>
            
        </div>
</div>

 <script src="<?php echo URLROOT;?>/js/dashboard.js"></script>
</body>
</html>