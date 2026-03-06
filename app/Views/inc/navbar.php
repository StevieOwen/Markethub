
<link rel="stylesheet" href="<?php echo URLROOT;?>/css/navbar.css">
<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.8/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-sRIl4kxILFvY47J16cr9ZwB07vP4J8+LH7qKQnuqkuIAvNWLzeN8tE5YBujZqJLB" crossorigin="anonymous">
<nav class="navbar navbar-expand-lg bg-body-tertiary  border-bottom border-body">
  <div class="container-fluid">
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
        <li class="btn w-90" id="register" > 
          <input type="hidden" id="cust_id" value="<?php echo $cust_id?>">
          <a class="nav-link" id="home" href=""><svg class="icon" width="30" height="30" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 640 640"><path d="M341.8 72.6C329.5 61.2 310.5 61.2 298.3 72.6L74.3 280.6C64.7 289.6 61.5 303.5 66.3 315.7C71.1 327.9 82.8 336 96 336L112 336L112 512C112 547.3 140.7 576 176 576L464 576C499.3 576 528 547.3 528 512L528 336L544 336C557.2 336 569 327.9 573.8 315.7C578.6 303.5 575.4 289.5 565.8 280.6L341.8 72.6zM304 384L336 384C362.5 384 384 405.5 384 432L384 528L256 528L256 432C256 405.5 277.5 384 304 384z"/></svg></a>
        </li>
        <li class="btn w-90" id="login" >
          <a class="nav-link" aria-current="page" href=""><svg class="icon" width="30" height="30" fill="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg"><path d='M12 12.75c3.942 0 7.987 2.563 8.249 7.712a.75.75 0 0 1-.71.787c-2.08.106-11.713.171-15.077 0a.75.75 0 0 1-.711-.787C4.013 15.314 8.058 12.75 12 12.75m0-9a3.75 3.75 0 1 0 0 7.5 3.75 3.75 0 0 0 0-7.5'/></svg></a>
          <ul class="subnav hide">
            <form action="/logout" method="POST">
              <li><a href="">Profile</a></li>
              <li><button type="submit" name="logout">Logout</button> </li>
            </form>
          </ul>
        </li>

        <li class="btn w-90" id="register" > 
          <a class="nav-link"  href=""><svg class="icon" width="30" height="30" fill="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg"><path d='M2.787 2.28a.75.75 0 0 1 .932.507l.55 1.863h14.655c1.84 0 3.245 1.717 2.715 3.51l-1.655 5.6c-.352 1.193-1.471 1.99-2.715 1.99H8.113c-1.244 0-2.362-.797-2.715-1.99L2.281 3.212a.75.75 0 0 1 .506-.931M6.25 19.5a2.25 2.25 0 1 1 4.5 0 2.25 2.25 0 0 1-4.5 0m8 0a2.25 2.25 0 1 1 4.5 0 2.25 2.25 0 0 1-4.5 0'/></svg></a>
        </li>
        
      </ul>
       
    </div>
  </div>
</nav>


<script src="<?php echo URLROOT;?>/js/navbar.js"></script>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-MrcW6ZMFYlzcLA8Nl+NtUVF0sA7MsXsP1UyJoMp4YLEuNSfAP+JcXn/tWtIaxVXM" crossorigin="anonymous"></script>