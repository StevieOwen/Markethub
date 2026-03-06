<?php include APPROOT . "/Views/inc/header.php";?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="<?php echo URLROOT;?>/css/editProduct.css">
    <title>Document</title>
</head>
<body>
    
    <section class="tab-content hide"  id="addProducts_section">
               <div class="form-card">
                    <div class="form-header">
                        <h3><i class="fas fa-plus-circle"></i> Edit Product</h3>
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
                                        <img src="<?php echo URLROOT;?>/uploads/items/" id="previewImg" style="display:none; position:absolute; width:100%; height:100%; object-fit:cover;">
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
                            <button type="submit" id="edit_product" class="btn-primary">Save Changes</button>
                             <button type="button" id="cancel-btn" class="btn-primary">Cancel</button>
                        </div>
                    </form>
                </div>

            </section>
<div id="editModal" class="modal-overlay" style="display: none !important;">
        <div class="modal-content">
            <div class="success-icon">
                <svg viewBox="0 0 52 52" class="checkmark">
                    <circle class="checkmark-circle" cx="26" cy="26" r="25" fill="none"/>
                    <path class="checkmark-check" fill="none" d="M14.1 27.2l7.1 7.2 16.7-16.8"/>
                </svg>
            </div>
            <h2 id="modal-text">Changes saved! </h2>
            
        </div>
</div>

    <script src="<?php echo URLROOT;?>/js/editProduct.js"></script>
</body>
</html>