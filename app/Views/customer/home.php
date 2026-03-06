<?php 
$this->layout("inc/layout",["title"=>"Home","stylename"=>"index"]);

include APPROOT . "/Views/inc/header.php";
//navbar
include APPROOT . "/Views/inc/navbar.php";

// <!-- carousselbanner -->
include APPROOT . "/Views/inc/carousselbanner.php";
?>


<!-- Call to action section -->
<section class="container my-5">
    <div class="seller-cta-banner position-relative overflow-hidden rounded-4 p-5 shadow-lg text-center">
        <div class="shape-1"></div>
        <div class="shape-2"></div>

        <div class="position-relative z-1">
            <span class="badge bg-primary-subtle text-primary border border-primary-subtle px-3 py-2 rounded-pill mb-3">
                Grow with Market Hub
            </span>
            <h2 class="display-5 fw-bold mb-3">Ready to start earning?</h2>
            <p class="lead text-muted mb-4 mx-auto" style="max-width: 600px;">
                Join our community of sellers. Get your own professional dashboard to list products, track sales, and manage your inventory in one place.
            </p>
            <div class="d-grid d-sm-flex justify-content-sm-center gap-3">
                <a href="/shopregistrationform" class="btn btn-primary rounded-pill px-4 py-3 fw-bold shadow-sm">
                    Start Selling Today
                </a>
                <button type="button" class="btn btn-primary btn-outline-dark rounded-pill px-4 py-3 fw-bold" data-bs-toggle="modal" data-bs-target="#benefitsModal">
                    Learn More
                </button>
                
            </div>
        </div>
    </div>
</section>


<!-- Modal providing more information about Market hub sell -->
<div class="modal fade" id="benefitsModal" tabindex="-1" aria-labelledby="benefitsModalLabel" aria-hidden="true">
  <div class="modal-dialog modal-dialog-centered">
    <div class="modal-content rounded-4 shadow border-0">
      <div class="modal-header border-0 pb-0">
        <h5 class="modal-title fw-bold fs-4" id="benefitsModalLabel">Welcome to the Market Hub Family!</h5>
        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
      </div>
      
      <div class="modal-body py-4">
        <div class="mb-4">
            <p class="text-muted">
                At <strong>Market Hub</strong>, we believe everyone has something valuable to share. Whether you're clearing out your garage or launching a small business, our platform is built to help you succeed safely and quickly.
            </p>
            <hr class="text-secondary opacity-25">
        </div>

        <h6 class="fw-bold mb-3">What you get as a seller:</h6>
        
        <ul class="list-unstyled">
          <li class="d-flex mb-3 align-items-start">
            <div class="icon-box me-3 mt-1">
                <i class="bi bi-rocket-takeoff-fill text-primary fs-5"></i>
            </div>
            <div>
                <strong>Instant Listing:</strong> 
                <p class="small text-muted mb-0">Upload photos directly from your phone and be live in under 60 seconds.</p>
            </div>
          </li>
          
          <li class="d-flex mb-3 align-items-start">
            <div class="icon-box me-3 mt-1">
                <i class="bi bi-person-badge-fill text-primary fs-5"></i>
            </div>
            <div>
                <strong>Professional Profile:</strong> 
                <p class="small text-muted mb-0">Build trust with buyer reviews and a dedicated shop page for all your items.</p>
            </div>
          </li>

          <li class="d-flex mb-0 align-items-start">
            <div class="icon-box me-3 mt-1">
                <i class="bi bi-chat-dots-fill text-primary fs-5"></i>
            </div>
            <div>
                <strong>Direct Messaging:</strong> 
                <p class="small text-muted mb-0">Chat securely with interested buyers without sharing your private phone number.</p>
            </div>
          </li>
        </ul>
      </div>

      <div class="modal-footer border-0 pt-0">
        <button type="button" class="btn btn-light rounded-pill px-4" data-bs-dismiss="modal">Maybe later</button>
        <a href="/shopregistrationform" class="btn btn-primary rounded-pill px-4 fw-bold shadow-sm">Join the Community</a>
      </div>
    </div>
  </div>
</div>