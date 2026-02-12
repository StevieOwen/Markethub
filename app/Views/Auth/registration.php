
<?php $this->layout("/Auth/layout",["title"=>"Registration","stylename"=>"registration"]) ?>
<!-- <link rel="stylesheet" href="<?php echo URLROOT; ?>/css/registration.css"> -->

<body>

    <div class="container text-center" style="border:2px solid green">
        <div class="row " style="border:2px solid green">
            <div class="container col-sm-5 signin " style="border:2px solid yellow">
                <div class="row">
                    <div class="col align-self-center" style="border:2px solid red; padding:1rem;">
                    <h3>WELCOME BACK!</h3><br>
                    <p>Already have an account? Then only sign in</p>
                    <a href="login">SIGN IN</a>
                    </div>
                </div>  
                
            </div>
            
            <div class="col-sm-7 signup" style="border:2px solid blue">
                <h3>Create an Account</h3><br>
                <form action="">
                    <!-- First name -->
                     <div class="input-group mb-3">
                        <span class="input-group-text" id="basic-addon1">@</span>
                        <input type="text" class="form-control" placeholder="Username" aria-label="Username" aria-describedby="basic-addon1">
                     </div>
                    <!-- Last name -->
                     <div class="input-group mb-3">
                        <span class="input-group-text" id="basic-addon1">@</span>
                        <input type="text" class="form-control" placeholder="Username" aria-label="Username" aria-describedby="basic-addon1">
                     </div>
                    <!-- Email -->
                     <div class="input-group mb-3">
                        <span class="input-group-text" id="basic-addon1">@</span>
                        <input type="text" class="form-control" placeholder="Username" aria-label="Username" aria-describedby="basic-addon1">
                     </div>
                </form>
            </div>
        </div>
    </div>

</body>
