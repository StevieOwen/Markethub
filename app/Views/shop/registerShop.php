<?php include APPROOT . "/Views/inc/header.php";?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Market Hub - Create Your Shop</title>
    
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.1/font/bootstrap-icons.css">
    <link rel="stylesheet" href="<?php echo URLROOT;?>/css/shopregistration.css">
</head>
<body>

    <div class="swirl-bg" style="width: 400px; height: 400px; background: #2292a4; top: -100px; left: -100px;"></div>
    <div class="swirl-bg" style="width: 300px; height: 300px; background: #F5EFED; bottom: -50px; right: -50px;"></div>

    <div class="container shop-container">
        <div class="row g-5 align-items-start">
            
            <div class="col-lg-7">
                <div class="glass-card p-4 p-md-5">
                    <h2 class="fw-bold mb-1">Create Your Shop</h2>
                    <p class="text-muted mb-4">Set up your brand and start selling to the community.</p>

                    <form id="shopForm" method="Post" action="" enctype="multipart/form-data">
                        
                        <div class="mb-4">
                            <label class="form-label fw-bold small text-uppercase">Shop Name</label>
                            <input type="text" id="shopname" class="form-control" placeholder="e.g. Mike's Vintage Finds">
                            <p id="emptyname" class="errors error-text">   </p>
                        </div>
                         <div class="mb-4">
                            <label class="form-label fw-bold small text-uppercase">Contact</label>
                            <input type="text" id="shopcontact" class="form-control" placeholder="+250 789567879">
                            <p id="emptycontact" class="errors error-text">   </p>
                        </div>

                        <div class="mb-4">
                            <label class="form-label fw-bold small text-uppercase">About Your Shop</label>
                            <textarea id="shopdescription" class="form-control" rows="4" placeholder="Describe what you specialize in..."></textarea>
                            <p id="emptydesc" class="errors error-text"></p>
                        </div>

                        <div class="mb-4">
                            <label class="form-label fw-bold small text-uppercase">Shop Logo</label>
                            <input type="file" id="shoplogo" class="form-control" accept="image/*">
                            <p class="errors error-text" id="emptylogo "></p>
                            <input type="hidden" value="<?php echo $cust_id?>" id="cust_id" >
                        </div>

                        <button type="submit" id="launchshop" class="btn btn-primary btn-launch w-100 mt-3">Launch My Shop</button>
                    </form>
                </div>
            </div>

            <div class="col-lg-4 d-none d-lg-block sticky-top" style="top: 50px;">
                <div class="text-center mb-3">
                    <span class="badge bg-white text-dark shadow-sm border px-3 py-2 rounded-pill small fw-bold">LIVE PREVIEW</span>
                </div>
                
                <div class="glass-card p-4 text-center">
                    <div class="preview-avatar">
                        <span id="p-initial" class="fs-1 fw-bold text-primary">M</span>
                        <img id="p-img" src="" class="d-none">
                    </div>
                    
                    <h4 id="p-name" class="fw-bold mb-1">Your Shop Name</h4>
                    <h6  id="p-contact">Your contact</h6>
                    <p class="text-primary small fw-bold mb-3">New Merchant</p>
                    
                    <p id="p-desc" class="text-muted px-3 mb-4">
                        "Your shop description will appear here as you type..."
                    </p>

                    <div class="row border-top pt-3 g-0">
                        <div class="col-6 border-end">
                            <div class="fw-bold">0</div>
                            <small class="text-muted">Items</small>
                        </div>
                        <div class="col-6">
                            <div class="fw-bold">0.0</div>
                            <small class="text-muted">Rating</small>
                        </div>
                    </div>
                </div>
            </div>

        </div>
    </div>


    //modal with success button
    <div id="successModal" class="modal-overlay" style="display: none !important;">
        <div class="modal-content">
            <div class="success-icon">
                <svg viewBox="0 0 52 52" class="checkmark">
                    <circle class="checkmark-circle" cx="26" cy="26" r="25" fill="none"/>
                    <path class="checkmark-check" fill="none" d="M14.1 27.2l7.1 7.2 16.7-16.8"/>
                </svg>
            </div>
            <h2>Shop Created!</h2>
            <p>Your shop is ready. You're being redirected to your dashboard...</p>
            <button id="modalCloseBtn" class="btn-dashboard">Go to Dashboard Now</button>
        </div>
    </div>

    <script src="<?php echo URLROOT;?>/js/shopregistration.js"> </script>
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
</body>
</html>