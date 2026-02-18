<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.8/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-sRIl4kxILFvY47J16cr9ZwB07vP4J8+LH7qKQnuqkuIAvNWLzeN8tE5YBujZqJLB" crossorigin="anonymous">
    <link rel="stylesheet" href="<?php echo URLROOT;?>/css/<?= $this->e($stylename) ?>.css">
    <link rel="stylesheet" href="<?php echo URLROOT;?>/css/navbar.css">
    <title><?=  $this->e($title) ?></title>
</head>
<body>


<nav class="navbar navbar-expand-lg bg-body-tertiary  border-bottom border-body" >
  <div class="container-fluid">
    <!-- Logo -->
     <div class="col-4">
        <h2>Logo</h2>
     </div>  
      <!-- togler button    -->
    <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
      <span class="navbar-toggler-icon"></span>
    </button>
    <div class="collapse navbar-collapse " id="navbarSupportedContent">
        
      <div class="d-flex mb-3 mb-md-0" style="width:50%">
        <form class="d-flex flex-grow-1"  role="search">
            <input class="form-control me-2" type="search" placeholder="Look for a product" aria-label="Search"/>
            <button class="btn btn-outline-success" type="submit">Search</button>
        </form>
      </div>
      <ul class="navbar-nav  mb-2 mb-lg-0 ms-auto d-flex flex-row gap-3 authbut">
        <li class="nav-item" id="login" >
          <a class="nav-link" aria-current="page" href="login">Login</a>
        </li>
        <li class="nav-item" id="register" > 
          <a class="nav-link"  href="register">Register</a>
        </li>
          
      </ul>
       
    </div>
  </div>
</nav>














    <!-- <nav class="navbar navbar-expand-lg bg-body-tertiary">
        
        <div class="container-fluid">
            
            <div class="col-4">
                <h2>Logo</h2>
            </div>   
    
            <div class="col-4" >
                <form class="d-flex" role="search">
                    <input class="form-control me-2" type="search" placeholder="Look for a product" aria-label="Search"/>
                    <button class="btn btn-outline-success" type="submit">Search</button>
                </form>
            </div>
            
            <div class="col-4 auth" >
                <div class="authbut">
                    <span id="login"><a href="login">Login</a></span> /
                    <span id="register"><a href="register">Register</a></span>
                </div>
            </div>

        </div>   
       
    </nav>





    
    <div class="container" >
        <div class="row justify-content-around" >
           
            
        </div>
    </div> -->



 <?=   $this->section("content") ;?>
 <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-MrcW6ZMFYlzcLA8Nl+NtUVF0sA7MsXsP1UyJoMp4YLEuNSfAP+JcXn/tWtIaxVXM" crossorigin="anonymous"></script>
</body>
</html>