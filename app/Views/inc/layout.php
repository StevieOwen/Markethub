<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.8/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-sRIl4kxILFvY47J16cr9ZwB07vP4J8+LH7qKQnuqkuIAvNWLzeN8tE5YBujZqJLB" crossorigin="anonymous">
    <link rel="stylesheet" href="<?php echo URLROOT; ?>/css/<?= $this->e($stylename) ?>.css">
    <link rel="stylesheet" href="<?php echo URLROOT; ?>/css/navbar.css">
    <title><?=  $this->e($title) ?></title>
</head>
<body>
    
    <div class="container" >
        <div class="row justify-content-around" >
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
    </div>

    


 <?=   $this->section("content") ;?>
 <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-MrcW6ZMFYlzcLA8Nl+NtUVF0sA7MsXsP1UyJoMp4YLEuNSfAP+JcXn/tWtIaxVXM" crossorigin="anonymous"></script>
</body>
</html>