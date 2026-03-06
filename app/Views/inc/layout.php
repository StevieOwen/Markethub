<?php include APPROOT . "/Views/inc/header.php";?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.8/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-sRIl4kxILFvY47J16cr9ZwB07vP4J8+LH7qKQnuqkuIAvNWLzeN8tE5YBujZqJLB" crossorigin="anonymous">
    <link rel="stylesheet" href="<?php echo URLROOT;?>/css/<?= $this->e($stylename) ?>.css">
    <!-- <link rel="stylesheet" href="<?php echo URLROOT;?>/css/navbar.css"> -->
    <title><?=  $this->e($title) ?></title>
</head>
<body>

 <?=   $this->section("content") ;?>

 
<!-- Main-section -->

<div class="container my-5">
    <div class="row">
        <button class="btn btn-outline-primary d-lg-none mb-3" type="button" data-bs-toggle="offcanvas" data-bs-target="#sidebarOffcanvas">
          <i class="bi bi-funnel">Filter & Categories</i> 
        </button>
        <aside class="offcanvas-lg offcanvas-start col-lg-3" tabindex="-1" id="sidebarOffcanvas">
            <div class="offcanvas-header d-lg-none">
                <h5 class="offcanvas-title">Filters</h5>
                <button type="button" class="btn-close" data-bs-dismiss="offcanvas" data-bs-target="#sidebarOffcanvas"></button>
            </div>

            <div class="offcanvas-body p-lg-0 d-block">
                <div class="filter-group mb-4">
                    <h5 class="fw-bold">Categories</h5>
                        
                        <ul class="list-unstyled" id="category">
                            
                        </ul>
                        
                </div>
            </div>
        </aside>

        <main class="col-lg-9 col-12">
            <div class="d-flex justify-content-between align-items-center mb-4 border-bottom pb-3">
                <span class="text-muted">Showing 1-12 of 120 results</span>
                <select class="form-select w-auto">
                    <option>Default Sorting</option>
                    <option>Price: Low to High</option>
                </select>
            </div>
            <!-- Products grid -->
              
              <div class="row g-4 products-grid">
                
                  
                

            

            


        </main>
    </div>
</div>










<script src="<?php echo URLROOT;?>/js/index.js"></script>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-MrcW6ZMFYlzcLA8Nl+NtUVF0sA7MsXsP1UyJoMp4YLEuNSfAP+JcXn/tWtIaxVXM" crossorigin="anonymous"></script>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-MrcW6ZMFYlzcLA8Nl+NtUVF0sA7MsXsP1UyJoMp4YLEuNSfAP+JcXn/tWtIaxVXM" crossorigin="anonymous"></script>
</body>
</html>