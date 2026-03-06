<?php $this->layout("inc/layout",["title"=>"Home","stylename"=>"index"]) ?>
<link rel="stylesheet" href="<?php echo URLROOT;?>/css/navbar.css">

<nav id="nav" class="navbar navbar-expand-lg bg-body-tertiary  border-bottom border-body">
  <div    class="container-fluid">
    <!-- Logo -->
     <a class="navbar-brand fw-bold fs-2" href="/">Logo</a>
      <!-- togler button    -->
    <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
      <span class="navbar-toggler-icon"></span>
    </button>

    <div class="collapse navbar-collapse " id="navbarSupportedContent">
        <form class="d-flex flex-grow-1 mx-lg-5 my-3 my-lg-0"  role="search">
          <div class="input-group">
            <input class="form-control" type="search" placeholder="Look for a product" aria-label="Search"/>
            <button class="btn btn-outline-success" id="searchbutton" type="submit">Search</button>
          </div>  
        </form>
      
      <ul class="navbar-nav mb-2 mb-lg-0 ms-auto d-flex flex-row gap-3 authbut pe-lg-4 authbut">
        <li class="btn w-90" id="login" >
          <a class="nav-link" aria-current="page" href="login">Login</a>
        </li>
        <li class="btn w-90" id="register" > 
          <a class="nav-link"  href="register">Register</a>
        </li>
          
      </ul>
       
    </div>
  </div>
</nav>

<!-- carousselbanner -->

<?php include APPROOT . "/Views/inc/carousselbanner.php";  ?>


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
                <!-- <a href="/registerShop" class="btn btn-primary rounded-pill px-4 py-3 fw-bold shadow-sm">
                    Start Selling Today
                </a> -->
                <button type="button" class="btn btn-primary btn-outline-dark rounded-pill px-4 py-3 fw-bold" data-bs-toggle="modal" data-bs-target="#benefitsModal1">
                    Learn More
                </button>
                
            </div>
        </div>
    </div>
</section>



<!-- Modal providing more information about Market hub sell -->
<div class="modal fade" id="benefitsModal1" tabindex="-1" aria-labelledby="benefitsModalLabel" aria-hidden="true">
  <div class="modal-dialog modal-dialog-centered">
    <div class="modal-content rounded-4 shadow border-0">
      <div class="modal-header border-0 pb-0">
        <h5 class="modal-title fw-bold fs-4" id="benefitsModalLabel">Welcome to the Market Hub Family!</h5>
        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
      </div>
      
      <div class="modal-body py-4">
        <ul class="list-unstyled">
        <div class="mb-4">
            <p class="text-muted">
                At <strong>Market Hub</strong>, we believe everyone has something valuable to share. Whether you're clearing out your garage or launching a small business, our platform is built to help you succeed safely and quickly.
            </p>
            <hr class="text-secondary opacity-25">
        </div>

          <li class="d-flex mb-0 align-items-start">
            <div class="icon-box me-3 mt-1">
                <i class="bi bi-chat-dots-fill text-primary fs-5"></i>
            </div>
            <div>
                <strong></strong> 
                <p class="small text-muted mb-0">To have access to this service, you need to login or register</p>
            </div>
          </li>
        </ul>
      </div>

      <div class="modal-footer border-0 pt-0">
        <a href="/login" class="btn btn-primary rounded-pill px-4 fw-bold shadow-sm">Login</a>
        <a href="/register" class="btn btn-primary rounded-pill px-4 fw-bold shadow-sm">Register</a>
      </div>
    </div>
  </div>
</div>
