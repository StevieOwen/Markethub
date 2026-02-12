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
    <header>
        <nav class="navbar navbar-expand-lg bg-body-tertiary">
            <div class="container-fluid">
                <a class="navbar-brand" href="#">Logo</a>      
                <form class="d-flex" role="search">
                    <input class="form-control me-2" type="search" placeholder="Looking for a product" aria-label="Search"/>
                    <button class="btn btn-outline-success" type="submit">Search</button>
                </form>
                <div class="auth">
                    <span id="login"><a href="/login">Login</a></span> /
                    <span id="register"><a href="/register">Register</a></span>
                </div>
            </div>
        </nav>
    </header>


 <?=   $this->section("content") ;?>
 <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-MrcW6ZMFYlzcLA8Nl+NtUVF0sA7MsXsP1UyJoMp4YLEuNSfAP+JcXn/tWtIaxVXM" crossorigin="anonymous"></script>
</body>
</html>